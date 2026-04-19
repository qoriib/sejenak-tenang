<?php
namespace App\Http\Controllers\Psychologist;

use App\Http\Controllers\Controller;
use App\Models\Consultation;

class PsychologistController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function dashboard()
    {
        $user = request()->user();
        if (!$user || !$user->isPsychologist()) {
            return redirect('/')->with('error', 'Access denied');
        }

        $psychologist = $user->psychologist;
        
        $consultations = Consultation::where('psychologist_id', $psychologist->id)
            ->with('user')
            ->latest()
            ->paginate(10);

        $stats = [
            'total_consultations' => $consultations->total(),
            'active_consultations' => Consultation::where('psychologist_id', $psychologist->id)
                ->where('status', 'active')->count(),
            'completed_consultations' => Consultation::where('psychologist_id', $psychologist->id)
                ->where('status', 'completed')->count(),
        ];

        return view('psychologist.dashboard', compact('consultations', 'stats'));
    }
}