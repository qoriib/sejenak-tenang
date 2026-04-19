<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    private function checkAdmin()
    {
        $user = request()->user();
        if (!$user || !$user->isAdmin()) {
            abort(403, 'Access denied');
        }
    }

    public function index()
    {
        $this->checkAdmin();
        
        $payments = Payment::with(['consultation.user', 'consultation.psychologist.user'])
            ->latest()
            ->paginate(10);
            
        return view('admin.payments.index', compact('payments'));
    }

    public function verify(Payment $payment)
    {
        $this->checkAdmin();
        
        $payment->update([
            'status' => 'verified',
            'verified_by' => request()->user()->id,
            'verified_at' => now()
        ]);

        // Update consultation payment status
        $payment->consultation->update([
            'payment_status' => 'paid',
            'status' => 'active'
        ]);

        return redirect()->back()->with('success', 'Payment verified successfully');
    }

    public function reject(Request $request, Payment $payment)
    {
        $this->checkAdmin();
        
        $payment->update([
            'status' => 'rejected',
            'verified_by' => request()->user()->id,
            'verified_at' => now(),
            'notes' => $request->notes
        ]);

        return redirect()->back()->with('success', 'Payment rejected');
    }
}