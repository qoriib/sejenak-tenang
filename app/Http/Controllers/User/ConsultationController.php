<?php
namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Consultation;
use App\Models\Psychologist;
use App\Models\Payment;
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
        if (!$user || !$user->isUser()) {
            return redirect('/')->with('error', 'Access denied');
        }

        $consultations = Consultation::with(['psychologist.user', 'payment'])
            ->where('user_id', $user->id)
            ->latest()
            ->paginate(10);

        return view('user.consultations.index', compact('consultations'));
    }

    public function create()
    {
        $user = request()->user();
        if (!$user || !$user->isUser()) {
            return redirect('/')->with('error', 'Access denied');
        }

        $psychologists = Psychologist::available()
            ->with('user')
            ->get();

        return view('user.consultations.create', compact('psychologists'));
    }

    public function store(Request $request)
    {
        $user = request()->user();
        if (!$user || !$user->isUser()) {
            return redirect('/')->with('error', 'Access denied');
        }

        $request->validate([
            'psychologist_id' => 'required|exists:psychologists,id',
        ]);

        $psychologist = Psychologist::findOrFail($request->psychologist_id);

        // Create consultation
        $consultation = Consultation::create([
            'user_id' => $user->id,
            'psychologist_id' => $psychologist->id,
            'amount' => $psychologist->price,
            'status' => 'pending',
            'payment_status' => 'unpaid'
        ]);

        // Create payment record
        Payment::create([
            'consultation_id' => $consultation->id,
            'amount' => $psychologist->price,
            'status' => 'pending'
        ]);

        return redirect()->route('user.consultations.show', $consultation)
            ->with('success', 'Konsultasi berhasil dibuat. Silakan lakukan pembayaran.');
    }

    public function show(Consultation $consultation)
    {
        $user = request()->user();
        if (!$user || $consultation->user_id !== $user->id) {
            return redirect('/')->with('error', 'Access denied');
        }

        $consultation->load(['psychologist.user', 'payment', 'chats.sender']);

        return view('user.consultations.show', compact('consultation'));
    }

    public function uploadPayment(Request $request, Consultation $consultation)
    {
        $user = request()->user();
        if (!$user || $consultation->user_id !== $user->id) {
            return redirect('/')->with('error', 'Access denied');
        }

        $request->validate([
            'payment_proof' => 'required|image|max:2048'
        ]);

        $payment = $consultation->payment;
        
        if ($request->hasFile('payment_proof')) {
            $payment->payment_proof = $request->file('payment_proof')->store('payments', 'public');
            $payment->status = 'pending';
            $payment->save();
        }

        return redirect()->back()->with('success', 'Bukti pembayaran berhasil diupload. Menunggu verifikasi admin.');
    }
}