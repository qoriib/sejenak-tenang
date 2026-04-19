<?php
namespace App\Http\Controllers\Psychologist;

use App\Http\Controllers\Controller;
use App\Models\Consultation;
use Illuminate\Http\Request;

class ConsultationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = request()->user();
        if (!$user || !$user->isPsychologist()) {
            return redirect('/')->with('error', 'Access denied');
        }

        $psychologist = $user->psychologist;
        
        $consultations = Consultation::with(['user', 'payment'])
            ->where('psychologist_id', $psychologist->id)
            ->latest()
            ->paginate(10);

        return view('psychologist.consultations.index', compact('consultations'));
    }

    public function show(Consultation $consultation)
    {
        $user = request()->user();
        if (!$user || $consultation->psychologist->user_id !== $user->id) {
            return redirect('/')->with('error', 'Access denied');
        }

        $consultation->load(['user', 'payment', 'chats.sender']);

        return view('psychologist.consultations.show', compact('consultation'));
    }

    public function updateStatus(Request $request, Consultation $consultation)
    {
        $user = request()->user();
        if (!$user || $consultation->psychologist->user_id !== $user->id) {
            return redirect('/')->with('error', 'Access denied');
        }

        $request->validate([
            'status' => 'required|in:active,completed,cancelled'
        ]);

        $consultation->update([
            'status' => $request->status,
            'started_at' => $request->status === 'active' ? now() : $consultation->started_at,
            'ended_at' => $request->status === 'completed' ? now() : null
        ]);

        return redirect()->back()->with('success', 'Status konsultasi berhasil diupdate.');
    }
}