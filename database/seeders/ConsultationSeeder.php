<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Psychologist;
use App\Models\Consultation;
use App\Models\Payment;
use App\Models\Chat;

class ConsultationSeeder extends Seeder
{
    public function run()
    {
        // Get users and psychologists by ID to avoid null errors
        $users = User::where('role', 'user')->get();
        $psychologists = Psychologist::with('user')->get();
        $admin = User::where('role', 'admin')->first();

        // Safety check
        if ($users->count() < 3 || $psychologists->count() < 3) {
            echo "Not enough users or psychologists to create consultations\n";
            return;
        }

        // Consultation 1: Completed consultation
        $user1 = $users->first();
        $psychologist1 = $psychologists->first();
        
        $consultation1 = Consultation::create([
            'user_id' => $user1->id,
            'psychologist_id' => $psychologist1->id,
            'amount' => $psychologist1->price,
            'status' => 'completed',
            'payment_status' => 'paid',
            'started_at' => now()->subDays(5),
            'ended_at' => now()->subDays(5)->addHours(1),
            'created_at' => now()->subDays(7)
        ]);

        Payment::create([
            'consultation_id' => $consultation1->id,
            'amount' => $psychologist1->price,
            'payment_proof' => 'payments/payment1.jpg',
            'status' => 'verified',
            'verified_by' => $admin->id,
            'verified_at' => now()->subDays(6)
        ]);

        // Sample chat for completed consultation
        Chat::create([
            'consultation_id' => $consultation1->id,
            'sender_id' => $consultation1->user_id,
            'message' => 'Halo Dok, saya ingin berkonsultasi tentang kecemasan yang saya rasakan belakangan ini.',
            'sent_at' => now()->subDays(5)
        ]);

        Chat::create([
            'consultation_id' => $consultation1->id,
            'sender_id' => $psychologist1->user_id,
            'message' => 'Halo, terima kasih sudah mempercayai saya. Bisa ceritakan lebih detail tentang kecemasan yang Anda rasakan?',
            'sent_at' => now()->subDays(5)->addMinutes(5)
        ]);

        Chat::create([
            'consultation_id' => $consultation1->id,
            'sender_id' => $consultation1->user_id,
            'message' => 'Saya sering merasa cemas ketika harus presentasi di kantor. Jantung berdebar dan tangan gemetar.',
            'sent_at' => now()->subDays(5)->addMinutes(10)
        ]);

        Chat::create([
            'consultation_id' => $consultation1->id,
            'sender_id' => $psychologist1->user_id,
            'message' => 'Itu adalah reaksi normal untuk kecemasan sosial. Mari kita coba teknik pernapasan untuk membantu mengelola gejala fisik tersebut. Coba tarik napas dalam-dalam selama 4 detik, tahan 4 detik, lalu hembuskan selama 6 detik.',
            'sent_at' => now()->subDays(5)->addMinutes(15)
        ]);

        Chat::create([
            'consultation_id' => $consultation1->id,
            'sender_id' => $consultation1->user_id,
            'message' => 'Baik dok, saya akan coba praktikkan. Apakah ada tips lain untuk menghadapi situasi presentasi?',
            'sent_at' => now()->subDays(5)->addMinutes(20)
        ]);

        Chat::create([
            'consultation_id' => $consultation1->id,
            'sender_id' => $psychologist1->user_id,
            'message' => 'Selain teknik pernapasan, Anda bisa coba persiapan yang matang dan visualisasi positif. Bayangkan presentasi berjalan lancar dan audiens memberikan respon positif.',
            'sent_at' => now()->subDays(5)->addMinutes(25)
        ]);

        // Consultation 2: Active consultation
        if ($users->count() > 1 && $psychologists->count() > 1) {
            $user2 = $users->skip(1)->first();
            $psychologist2 = $psychologists->skip(1)->first();
            
            $consultation2 = Consultation::create([
                'user_id' => $user2->id,
                'psychologist_id' => $psychologist2->id,
                'amount' => $psychologist2->price,
                'status' => 'active',
                'payment_status' => 'paid',
                'started_at' => now()->subHours(2),
                'created_at' => now()->subDays(2)
            ]);

            Payment::create([
                'consultation_id' => $consultation2->id,
                'amount' => $psychologist2->price,
                'payment_proof' => 'payments/payment1.jpg',
                'status' => 'verified',
                'verified_by' => $admin->id,
                'verified_at' => now()->subDays(1)
            ]);

            // Active chat
            Chat::create([
                'consultation_id' => $consultation2->id,
                'sender_id' => $consultation2->user_id,
                'message' => 'Selamat siang Dok, saya ingin belajar mindfulness untuk mengurangi stress kuliah.',
                'sent_at' => now()->subHours(2)
            ]);

            Chat::create([
                'consultation_id' => $consultation2->id,
                'sender_id' => $psychologist2->user_id,
                'message' => 'Selamat siang! Senang bisa membantu. Mindfulness memang sangat efektif untuk mengelola stress. Sudah pernah mencoba teknik meditasi sebelumnya?',
                'sent_at' => now()->subHours(2)->addMinutes(3)
            ]);

            Chat::create([
                'consultation_id' => $consultation2->id,
                'sender_id' => $consultation2->user_id,
                'message' => 'Belum pernah dok, saya masih pemula. Bisa minta panduan dasar untuk memulai?',
                'sent_at' => now()->subHours(2)->addMinutes(8)
            ]);

            Chat::create([
                'consultation_id' => $consultation2->id,
                'sender_id' => $psychologist2->user_id,
                'message' => 'Tentu! Mari kita mulai dengan teknik sederhana. Duduk nyaman, tutup mata, dan fokus pada napas. Mulai dengan 5 menit setiap hari.',
                'sent_at' => now()->subHours(2)->addMinutes(12)
            ]);
        }

        // Consultation 3: Pending payment
        if ($users->count() > 2 && $psychologists->count() > 2) {
            $user3 = $users->skip(2)->first();
            $psychologist3 = $psychologists->skip(2)->first();
            
            $consultation3 = Consultation::create([
                'user_id' => $user3->id,
                'psychologist_id' => $psychologist3->id,
                'amount' => $psychologist3->price,
                'status' => 'pending',
                'payment_status' => 'pending',
                'created_at' => now()->subDays(1)
            ]);

            Payment::create([
                'consultation_id' => $consultation3->id,
                'amount' => $psychologist3->price,
                'payment_proof' => 'payments/payment1.jpg',
                'status' => 'pending'
            ]);
        }

        // Consultation 4: Unpaid
        if ($users->count() > 3 && $psychologists->count() > 3) {
            $user4 = $users->skip(3)->first();
            $psychologist4 = $psychologists->skip(3)->first();
            
            $consultation4 = Consultation::create([
                'user_id' => $user4->id,
                'psychologist_id' => $psychologist4->id,
                'amount' => $psychologist4->price,
                'status' => 'pending',
                'payment_status' => 'unpaid',
                'created_at' => now()->subHours(6)
            ]);

            Payment::create([
                'consultation_id' => $consultation4->id,
                'amount' => $psychologist4->price,
                'status' => 'pending'
            ]);
        }

        // Consultation 5: Another completed one
        if ($users->count() > 4) {
            $user5 = $users->skip(4)->first();
            $psychologist5 = $psychologists->first(); // Reuse first psychologist
            
            $consultation5 = Consultation::create([
                'user_id' => $user5->id,
                'psychologist_id' => $psychologist5->id,
                'amount' => $psychologist5->price,
                'status' => 'completed',
                'payment_status' => 'paid',
                'started_at' => now()->subDays(10),
                'ended_at' => now()->subDays(10)->addMinutes(45),
                'created_at' => now()->subDays(12)
            ]);

            Payment::create([
                'consultation_id' => $consultation5->id,
                'amount' => $psychologist5->price,
                'payment_proof' => 'payments/payment1.jpg',
                'status' => 'verified',
                'verified_by' => $admin->id,
                'verified_at' => now()->subDays(11)
            ]);

            // Add some chat history
            Chat::create([
                'consultation_id' => $consultation5->id,
                'sender_id' => $consultation5->user_id,
                'message' => 'Dok, saya merasa bingung dengan arah hidup setelah lulus kuliah.',
                'sent_at' => now()->subDays(10)
            ]);

            Chat::create([
                'consultation_id' => $consultation5->id,
                'sender_id' => $psychologist5->user_id,
                'message' => 'Quarter-life crisis memang umum dialami fresh graduate. Mari kita explore nilai-nilai dan minat Anda untuk menemukan arah yang tepat.',
                'sent_at' => now()->subDays(10)->addMinutes(5)
            ]);
        }
    }
}