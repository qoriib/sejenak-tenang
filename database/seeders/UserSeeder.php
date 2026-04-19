<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Psychologist;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        // Admin
        $admin = User::create([
            'name' => 'Admin Sejenak Tenang',
            'email' => 'admin@sejenaktenang.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
            'avatar' => 'avatars/admin.jpg',
            'bio' => 'Administrator platform Sejenak Tenang yang berkomitmen memberikan layanan kesehatan mental terbaik untuk semua pengguna.'
        ]);

        // Psychologist 1
        $psychologist1 = User::create([
            'name' => 'Dr. Sarah Wijaya, M.Psi',
            'email' => 'sarah@sejenaktenang.com',
            'password' => Hash::make('password'),
            'role' => 'psychologist',
            'avatar' => 'avatars/dr_sarah.jpg',
            'bio' => 'Psikolog klinis dengan pengalaman 10 tahun. Spesialis dalam menangani anxiety disorders, depression, dan trauma. Lulusan Universitas Indonesia dengan pendekatan Cognitive Behavioral Therapy.'
        ]);

        Psychologist::create([
            'user_id' => $psychologist1->id,
            'specialization' => 'Psikologi Klinis & Trauma',
            'price' => 85000,
            'status' => 'available',
            'description' => 'Menangani gangguan kecemasan, depresi, PTSD, dan trauma. Berpengalaman dalam terapi individu dan kelompok untuk remaja dan dewasa. Menggunakan pendekatan CBT, EMDR, dan Mindfulness-based therapy.'
        ]);

        // Psychologist 2
        $psychologist2 = User::create([
            'name' => 'Dr. Ahmad Rahman, S.Psi, M.Si',
            'email' => 'ahmad@sejenaktenang.com',
            'password' => Hash::make('password'),
            'role' => 'psychologist',
            'avatar' => 'avatars/dr_ahmad.jpg',
            'bio' => 'Psikolog keluarga dan pernikahan dengan pendekatan holistik. Memiliki sertifikasi internasional dalam family therapy dan conflict resolution.'
        ]);

        Psychologist::create([
            'user_id' => $psychologist2->id,
            'specialization' => 'Psikologi Keluarga & Pernikahan',
            'price' => 90000,
            'status' => 'available',
            'description' => 'Spesialis terapi keluarga, konseling pernikahan, dan mediasi konflik. Membantu pasangan dan keluarga membangun komunikasi yang sehat dan menyelesaikan masalah hubungan.'
        ]);

        // Psychologist 3
        $psychologist3 = User::create([
            'name' => 'Dr. Lisa Handayani, M.Psi',
            'email' => 'lisa@sejenaktenang.com',
            'password' => Hash::make('password'),
            'role' => 'psychologist',
            'avatar' => 'avatars/dr_lisa.jpg',
            'bio' => 'Psikolog anak dan remaja dengan spesialisasi dalam developmental psychology dan learning disorders. Berpengalaman menangani ADHD, autism spectrum, dan kesulitan belajar.'
        ]);

        Psychologist::create([
            'user_id' => $psychologist3->id,
            'specialization' => 'Psikologi Anak & Remaja',
            'price' => 80000,
            'status' => 'available',
            'description' => 'Menangani masalah psikologis anak usia 5-18 tahun. Spesialis ADHD, autism spectrum disorders, anxiety pada anak, dan kesulitan adaptasi sekolah. Menggunakan play therapy dan art therapy.'
        ]);

        // Psychologist 4
        $psychologist4 = User::create([
            'name' => 'Dr. Michael Tanaka, S.Psi, M.M',
            'email' => 'michael@sejenaktenang.com',
            'password' => Hash::make('password'),
            'role' => 'psychologist',
            'avatar' => 'avatars/dr_michael.jpg',
            'bio' => 'Psikolog industri dan organisasi dengan spesialisasi stress management dan workplace wellness. MBA dalam Human Resources Management.'
        ]);

        Psychologist::create([
            'user_id' => $psychologist4->id,
            'specialization' => 'Psikologi Industri & Stress Management',
            'price' => 95000,
            'status' => 'busy',
            'description' => 'Membantu profesional mengatasi workplace stress, burnout, dan work-life balance. Spesialis dalam coaching eksekutif, team building, dan organizational psychology.'
        ]);

        // Psychologist 5
        $psychologist5 = User::create([
            'name' => 'Dr. Ratna Sari, M.Psi',
            'email' => 'ratna@sejenaktenang.com',
            'password' => Hash::make('password'),
            'role' => 'psychologist',
            'avatar' => 'avatars/dr_ratna.jpg',
            'bio' => 'Psikolog dengan spesialisasi mindfulness dan positive psychology. Certified mindfulness instructor dan life coach dengan pendekatan holistik.'
        ]);

        Psychologist::create([
            'user_id' => $psychologist5->id,
            'specialization' => 'Mindfulness & Positive Psychology',
            'price' => 75000,
            'status' => 'available',
            'description' => 'Menggabungkan pendekatan psikologi positif dengan mindfulness therapy. Membantu klien mengembangkan resiliensi, self-compassion, dan menemukan makna hidup yang lebih mendalam.'
        ]);

        // Regular Users
        User::create([
            'name' => 'Budi Santoso',
            'email' => 'budi@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'user',
            'avatar' => 'avatars/user_default.jpg',
            'bio' => 'Karyawan swasta berusia 28 tahun. Sedang mencari bantuan profesional untuk mengatasi stress kerja dan anxiety yang mulai mengganggu produktivitas sehari-hari.'
        ]);

        User::create([
            'name' => 'Sari Dewi',
            'email' => 'sari@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'user',
            'avatar' => 'avatars/user_default.jpg',
            'bio' => 'Mahasiswa semester 6 yang ingin berkonsultasi tentang kecemasan sosial dan persiapan menghadapi dunia kerja. Tertarik dengan mindfulness dan self-development.'
        ]);

        User::create([
            'name' => 'Andi Wijaya',
            'email' => 'andi@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'user',
            'avatar' => 'avatars/user_default.jpg',
            'bio' => 'Orang tua dari dua anak yang membutuhkan guidance dalam parenting dan mengelola stress keluarga sehari-hari.'
        ]);

        User::create([
            'name' => 'Maya Putri',
            'email' => 'maya@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'user',
            'avatar' => 'avatars/user_default.jpg',
            'bio' => 'Pekerja startup berusia 25 tahun yang mengalami burnout dan mencari cara untuk work-life balance yang lebih sehat.'
        ]);

        User::create([
            'name' => 'Rudi Hermawan',
            'email' => 'rudi@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'user',
            'avatar' => 'avatars/user_default.jpg',
            'bio' => 'Fresh graduate yang sedang menghadapi quarter-life crisis dan membutuhkan bantuan untuk menentukan arah karir dan kehidupan.'
        ]);

        User::create([
            'name' => 'Diva',
            'email' => 'Diva@sejenaktenang.com',
            'password' => Hash::make('password'),
            'role' => 'user',
            'avatar' => 'avatars/user_default.jpg',
            'bio' => 'User testing account untuk development dan quality assurance aplikasi Sejenak Tenang.'
        ]);
    }
}
