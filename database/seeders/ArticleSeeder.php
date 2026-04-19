<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Article;
use App\Models\User;

class ArticleSeeder extends Seeder
{
    public function run()
    {
        $admin = User::where('role', 'admin')->first();

        // Article 1 - Mindfulness
        Article::create([
            'title' => 'Mindfulness: Cara Sederhana Menemukan Ketenangan di Tengah Kesibukan',
            'content' => 'Di era modern yang serba cepat ini, mindfulness menjadi kunci untuk menemukan ketenangan dalam diri. Mindfulness adalah praktik kesadaran penuh yang membantu kita fokus pada momen saat ini tanpa menghakimi.

Praktik mindfulness telah terbukti secara ilmiah dapat mengurangi stress, meningkatkan fokus, dan memperbaiki kualitas tidur. Penelitian menunjukkan bahwa hanya 10 menit meditasi mindfulness setiap hari dapat memberikan dampak positif yang signifikan.

Cara memulai mindfulness:

1. Pernapasan Sadar
Duduk dengan nyaman, tutup mata, dan fokus pada napas. Rasakan udara masuk dan keluar dari hidung. Jika pikiran mengembara, kembalikan perhatian ke napas tanpa menghakimi diri sendiri.

2. Body Scan
Berbaring dengan nyaman, mulai dari ujung kaki hingga kepala, rasakan setiap bagian tubuh. Perhatikan sensasi yang muncul tanpa berusaha mengubahnya.

3. Mindful Walking
Berjalan dengan kesadaran penuh, rasakan setiap langkah, gerakan kaki, dan kontak dengan tanah. Ini bisa dilakukan di taman atau bahkan di dalam rumah.

4. Mindful Eating
Makan dengan penuh perhatian, rasakan tekstur, rasa, dan aroma makanan. Kunyah perlahan dan nikmati setiap gigitan.

Mulailah dengan 5 menit setiap hari dan tingkatkan secara bertahap. Konsistensi lebih penting daripada durasi. Dengan latihan rutin, mindfulness akan menjadi bagian alami dari kehidupan sehari-hari.',
            'image' => 'articles/article1.jpg',
            'created_by' => $admin->id,
            'is_published' => true,
            'created_at' => now()->subDays(10),
        ]);

        // Article 2 - Anxiety
        Article::create([
            'title' => 'Mengenal dan Mengatasi Kecemasan: Panduan Praktis untuk Hidup Lebih Tenang',
            'content' => 'Kecemasan adalah respons alami tubuh terhadap stress, namun ketika berlebihan, dapat mengganggu aktivitas sehari-hari. Gangguan kecemasan mempengaruhi jutaan orang di seluruh dunia dan merupakan salah satu masalah kesehatan mental yang paling umum.

Gejala Kecemasan:
- Jantung berdebar atau detak jantung cepat
- Berkeringat berlebihan
- Gemetar atau tremor
- Sulit bernapas atau sesak napas
- Ketegangan otot
- Sulit berkonsentrasi
- Gangguan tidur
- Perasaan takut yang berlebihan

Penyebab Kecemasan:
Kecemasan dapat dipicu oleh berbagai faktor seperti genetik, trauma masa lalu, stress berkepanjangan, perubahan hidup besar, atau kondisi medis tertentu.

Strategi Mengatasi Kecemasan:

1. Teknik Pernapasan 4-7-8
Tarik napas selama 4 hitungan, tahan selama 7 hitungan, buang napas selama 8 hitungan. Ulangi 3-4 kali.

2. Grounding Technique 5-4-3-2-1
Sebutkan 5 hal yang bisa dilihat, 4 hal yang bisa disentuh, 3 hal yang bisa didengar, 2 hal yang bisa dicium, 1 hal yang bisa dirasa.

3. Progressive Muscle Relaxation
Tegang dan lepaskan setiap kelompok otot secara bertahap, mulai dari kaki hingga kepala.

4. Journaling
Tuliskan pikiran dan perasaan untuk membantu memahami trigger kecemasan.

5. Olahraga Teratur
Aktivitas fisik melepaskan endorfin yang membantu mengurangi kecemasan.

Kapan Mencari Bantuan Profesional:
Jika kecemasan mengganggu pekerjaan, hubungan, atau aktivitas sehari-hari selama lebih dari 2 minggu, penting untuk berkonsultasi dengan psikolog atau psikiater.',
            'image' => 'articles/article2.jpg',
            'created_by' => $admin->id,
            'is_published' => true,
            'created_at' => now()->subDays(9),
        ]);

        // Article 3 - Self Care
        Article::create([
            'title' => 'Self Care bukan Egois: Pentingnya Merawat Diri untuk Kesehatan Mental',
            'content' => 'Self care sering disalahpahami sebagai tindakan egois atau manja. Padahal, merawat diri sendiri adalah investasi terbaik untuk kesehatan mental dan kemampuan kita membantu orang lain.

Mengapa Self Care Penting?
Self care membantu mengisi ulang energi fisik dan mental yang terkuras oleh aktivitas sehari-hari. Tanpa self care yang adequate, kita berisiko mengalami burnout, depresi, dan berbagai masalah kesehatan.

Dimensi Self Care:

1. Physical Self Care
- Tidur cukup 7-9 jam per malam
- Makan makanan bergizi seimbang
- Olahraga teratur minimal 30 menit per hari
- Menjaga kebersihan diri
- Medical check-up rutin

2. Emotional Self Care
- Mengakui dan mengekspresikan emosi
- Praktik gratitude
- Menetapkan batasan yang sehat
- Berkomunikasi dengan orang terpercaya
- Melakukan aktivitas yang menyenangkan

3. Mental Self Care
- Membaca buku atau artikel yang inspiratif
- Belajar hal baru
- Meditation atau mindfulness
- Membatasi konsumsi berita negatif
- Puzzle atau permainan yang melatih otak

4. Social Self Care
- Menghabiskan waktu dengan orang-orang positif
- Menjaga hubungan yang sehat
- Menetapkan batasan dengan orang toxic
- Bergabung dengan komunitas yang supportif

5. Spiritual Self Care
- Meditasi atau doa
- Menghabiskan waktu di alam
- Menulis jurnal
- Volunteer untuk kegiatan sosial
- Refleksi nilai-nilai hidup

Self Care Sederhana yang Bisa Dilakukan:
- Mandi air hangat dengan essential oil
- Mendengarkan musik favorit
- Jalan-jalan di taman
- Minum teh sambil menikmati sunset
- Menonton film komedi
- Menelepon teman lama
- Menulis hal-hal yang disyukuri

Ingat, self care adalah kebutuhan, bukan kemewahan. Mulai dengan langkah kecil dan konsisten.',
            'image' => 'articles/article3.jpg',
            'created_by' => $admin->id,
            'is_published' => true,
            'created_at' => now()->subDays(8),
        ]);

        // Article 4 - Stress Management
        Article::create([
            'title' => 'Stress di Tempat Kerja: Strategi Efektif untuk Work-Life Balance',
            'content' => 'Stress di tempat kerja telah menjadi epidemi modern yang mempengaruhi produktivitas, kesehatan, dan kebahagiaan. WHO menyebutkan bahwa stress kerja adalah "epidemi abad ke-21" yang memerlukan perhatian serius.

Penyebab Stress di Tempat Kerja:
- Beban kerja berlebihan
- Deadline yang tidak realistis
- Kurang kontrol atas pekerjaan
- Hubungan interpersonal yang buruk
- Ketidakjelasan peran dan tanggung jawab
- Ketidakamanan pekerjaan
- Lingkungan kerja yang toxic

Dampak Stress Kerja:
Stress yang berkepanjangan dapat menyebabkan burnout, depresi, gangguan tidur, masalah pencernaan, hipertensi, dan menurunnya sistem imun.

Strategi Mengelola Stress Kerja:

1. Time Management
- Prioritaskan tugas berdasarkan urgency dan importance
- Gunakan teknik Pomodoro (25 menit kerja, 5 menit istirahat)
- Buat to-do list yang realistis
- Delegasikan tugas jika memungkinkan

2. Boundary Setting
- Tetapkan jam kerja yang jelas
- Hindari mengecek email di luar jam kerja
- Belajar mengatakan "tidak" pada tugas tambahan yang berlebihan
- Pisahkan ruang kerja dan ruang pribadi

3. Teknik Relaksasi di Kantor
- Deep breathing exercises
- Desk stretching
- Progressive muscle relaxation
- Mini meditation (5 menit)

4. Komunikasi Efektif
- Diskusikan beban kerja dengan atasan
- Minta feedback yang konstruktif
- Bangun hubungan positif dengan rekan kerja
- Jangan ragu meminta bantuan

5. Lifestyle Changes
- Olahraga sebelum atau sesudah kerja
- Makan siang di luar kantor
- Take breaks secara teratur
- Hobi yang tidak berhubungan dengan pekerjaan

Kapan Harus Mencari Bantuan:
Jika stress kerja mulai mempengaruhi kesehatan fisik, hubungan personal, atau menyebabkan thoughts of self-harm, segera konsultasi dengan HR, counselor, atau psikolog.',
            'image' => 'articles/article4.jpg',
            'created_by' => $admin->id,
            'is_published' => true,
            'created_at' => now()->subDays(7),
        ]);

        // Article 5 - Sleep & Mental Health
        Article::create([
            'title' => 'Kualitas Tidur dan Kesehatan Mental: Hubungan yang Tidak Bisa Diabaikan',
            'content' => 'Tidur berkualitas adalah foundation untuk kesehatan mental yang optimal. Research menunjukkan bahwa sleep problems dapat meningkatkan risiko depression, anxiety, dan berbagai mental health disorders.

Hubungan Tidur dan Mental Health:
Sleep dan mental health memiliki bidirectional relationship - poor sleep dapat menyebabkan mental health problems, dan mental health issues dapat mengganggu sleep quality.

Impact Poor Sleep pada Mental Health:
- Increased irritability dan mood swings
- Difficulty concentrating dan making decisions
- Heightened emotional reactivity
- Increased risk of depression dan anxiety
- Impaired memory consolidation
- Reduced stress tolerance

Sleep Hygiene Best Practices:

1. Consistent Sleep Schedule
- Go to bed dan wake up sama time every day
- Maintain schedule bahkan pada weekends
- Avoid "catching up" dengan excessive sleep

2. Create Optimal Sleep Environment
- Room temperature 18-21°C
- Minimize noise dan light
- Comfortable mattress dan pillows
- Remove electronic devices

3. Pre-Sleep Routine
- Start winding down 1 hour before bed
- Relaxing activities: reading, gentle stretching, meditation
- Avoid stimulating activities
- Dim lights to signal body untuk prepare for sleep

4. Daytime Habits
- Get natural sunlight exposure in morning
- Regular exercise, tapi tidak 4 jam sebelum bedtime
- Limit caffeine after 2 PM
- Avoid large meals close to bedtime

5. Manage Stress dan Anxiety
- Practice relaxation techniques
- Journaling untuk clear worrying thoughts
- Progressive muscle relaxation
- Deep breathing exercises

When to Seek Professional Help:
- Persistent difficulty sleeping for over 3 weeks
- Excessive daytime fatigue
- Loud snoring atau breathing interruptions
- Sleep problems affecting daily functioning

Remember: Sleep is not a luxury - it is essential for mental health. Investing in good sleep habits adalah salah satu best things you can do untuk overall wellbeing.',
            'image' => 'articles/article5.jpg',
            'created_by' => $admin->id,
            'is_published' => true,
            'created_at' => now()->subDays(6),
        ]);

        // Article 6 - Digital Wellness
        Article::create([
            'title' => 'Digital Detox: Menemukan Keseimbangan di Era Teknologi',
            'content' => 'Di era digital, kita menghabiskan rata-rata 7+ jam per hari di depan screen. Ketergantungan pada teknologi dapat menyebabkan digital fatigue, mengganggu tidur, dan mempengaruhi kesehatan mental.

Tanda-tanda Digital Overload:
- Merasa cemas ketika tidak bisa mengakses phone
- Mengecek social media hal pertama saat bangun tidur
- Sulit focus tanpa distraction dari notifications
- FOMO (Fear of Missing Out) yang berlebihan
- Gangguan tidur karena screen time berlebihan
- Neck pain dan eye strain
- Penurunan kualitas interaksi face-to-face

Strategi Digital Detox:

1. Create Phone-Free Zones
- Kamar tidur
- Meja makan
- Bathroom
- 1 jam sebelum tidur

2. Schedule Digital Breaks
- 1 hari per minggu tanpa social media
- 1 jam per hari tanpa screen
- Vacation mode: minimal technology use

3. Mindful Technology Use
- Turn off non-essential notifications
- Use apps yang track screen time
- Set specific times untuk check social media
- Unfollow accounts yang membuat negative feelings

4. Replace Digital Activities
- Baca buku fisik instead of e-book
- Journaling dengan pen dan paper
- Board games with family
- Outdoor activities
- Face-to-face conversations

5. Create Evening Routine
- Stop screen time 1 jam sebelum tidur
- Use blue light filters setelah sunset
- Charge phone di luar kamar tidur
- Reading atau meditation sebelum tidur

Benefits Digital Detox:
- Improved sleep quality
- Better focus dan productivity
- Reduced anxiety dan stress
- Enhanced creativity
- Stronger real-world relationships
- Greater mindfulness dan presence

Remember: Technology adalah tool untuk enhance life, bukan menguasai hidup. Balance adalah kunci untuk healthy relationship dengan digital world.',
            'image' => 'articles/article6.jpg',
            'created_by' => $admin->id,
            'is_published' => true,
            'created_at' => now()->subDays(5),
        ]);

        // Article 7 - Building Resilience
        Article::create([
            'title' => 'Membangun Resiliensi Mental: Bangkit Lebih Kuat dari Setiap Tantangan',
            'content' => 'Resiliensi adalah kemampuan untuk beradaptasi dan bangkit dari adversity, trauma, atau stress. Bukan berarti kita tidak pernah mengalami kesulitan, melainkan kemampuan untuk navigate through challenges dan emerge stronger.

Komponen Resiliensi:

1. Emotional Regulation
Kemampuan mengelola emosi tanpa overwhelm atau suppress feelings

2. Cognitive Flexibility
Ability untuk adjust thinking patterns dan perspectives

3. Social Connection
Strong support system dan healthy relationships

4. Meaning-Making
Finding purpose dan meaning dalam experiences, termasuk yang sulit

5. Self-Efficacy
Confidence dalam kemampuan mengatasi challenges

Karakteristik Orang yang Resilient:
- Optimis realistis
- Accept change sebagai part of life
- Focus pada hal yang bisa dikontrol
- Strong problem-solving skills
- Good self-care habits
- Ability to ask for help
- Learn from failures dan setbacks

Strategi Membangun Resiliensi:

1. Develop Self-Awareness
- Recognize emotional patterns
- Identify personal strengths dan weaknesses
- Understand values dan priorities
- Regular self-reflection through journaling

2. Strengthen Relationships
- Invest in meaningful connections
- Practice empathy dan active listening
- Join supportive communities
- Maintain family bonds

3. Practice Acceptance
- Accept what cannot be changed
- Focus energy pada actionable solutions
- Practice letting go of perfection
- Embrace uncertainty sebagai normal

4. Cultivate Optimism
- Practice gratitude daily
- Challenge negative thought patterns
- Visualize positive outcomes
- Celebrate small wins

5. Take Care of Physical Health
- Regular exercise
- Adequate sleep
- Balanced nutrition
- Limit alcohol dan avoid drugs

6. Develop Coping Skills
- Problem-focused coping untuk controllable situations
- Emotion-focused coping untuk uncontrollable situations
- Stress management techniques
- Mindfulness dan meditation

7. Find Purpose dan Meaning
- Volunteer for causes you care about
- Set meaningful goals
- Help others in need
- Connect dengan spiritual beliefs

Remember: Resiliensi bukanlah trait yang fixed. It can be developed dan strengthened throughout life. Every challenge adalah opportunity untuk grow stronger.',
            'image' => 'articles/article7.jpg',
            'created_by' => $admin->id,
            'is_published' => true,
            'created_at' => now()->subDays(4),
        ]);

        // Article 8 - Emotional Intelligence
        Article::create([
            'title' => 'Kecerdasan Emosional: Kunci Sukses dalam Kehidupan dan Karier',
            'content' => 'Emotional Intelligence (EQ) adalah kemampuan untuk recognize, understand, dan manage emotions - both our own dan others. Research menunjukkan bahwa EQ often more important than IQ dalam predicting success in life dan career.

Komponen Emotional Intelligence:

1. Self-Awareness
- Recognizing personal emotions as they occur
- Understanding emotional triggers
- Awareness of strengths dan limitations
- Accurate self-assessment

2. Self-Regulation
- Managing disruptive emotions dan impulses
- Adapting to change
- Taking responsibility for performance
- Thinking before acting

3. Motivation
- Driven to achieve for satisfaction of achievement
- Optimistic bahkan dalam face of failure
- Commitment to goals
- Initiative dan persistence

4. Empathy
- Understanding others emotions
- Reading non-verbal cues
- Showing genuine interest in others concerns
- Cultural sensitivity

5. Social Skills
- Effective communication
- Conflict management
- Leadership abilities
- Building rapport dan networks

Benefits High Emotional Intelligence:

Personal Life:
- Better relationships dengan family dan friends
- Improved communication skills
- Greater life satisfaction
- Better stress management
- Enhanced decision-making

Professional Life:
- Strong leadership capabilities
- Better teamwork dan collaboration
- Improved customer relationships
- Career advancement opportunities
- Workplace harmony

Strategies untuk Develop EQ:

1. Practice Self-Awareness
- Keep emotion journal
- Ask for feedback dari trusted friends
- Practice mindfulness meditation
- Regular self-reflection

2. Improve Self-Regulation
- Pause before reacting
- Practice deep breathing
- Develop healthy coping mechanisms
- Learn dari mistakes

3. Enhance Empathy
- Active listening
- Ask questions untuk understand others perspectives
- Observe body language dan non-verbal cues
- Practice perspective-taking

4. Strengthen Social Skills
- Practice clear communication
- Learn conflict resolution techniques
- Develop networking abilities
- Work on team collaboration

Developing EQ adalah lifelong journey. Start dengan small, conscious efforts untuk understand dan manage emotions better. Over time, these skills will become natural dan significantly improve quality of relationships dan overall life satisfaction.',
            'image' => 'articles/article8.jpg',
            'created_by' => $admin->id,
            'is_published' => true,
            'created_at' => now()->subDays(3),
        ]);

        // Article 9 - Mental Health in Relationships
        Article::create([
            'title' => 'Kesehatan Mental dalam Hubungan: Membangun Koneksi yang Sehat dan Mendukung',
            'content' => 'Healthy relationships adalah cornerstone dari mental wellbeing. Quality of our relationships significantly impacts our mental health, sementara mental health condition dapat affect our ability untuk maintain healthy relationships.

Characteristics Healthy Relationships:

1. Mutual Respect
- Value each others opinions dan feelings
- Respect boundaries dan individual autonomy
- Appreciate differences
- Avoid contempt atau criticism yang destructive

2. Open Communication
- Express feelings dan needs clearly
- Listen actively tanpa judgment
- Discuss problems constructively
- Share vulnerabilities safely

3. Trust dan Honesty
- Be reliable dan consistent
- Keep commitments dan promises
- Share truth bahkan ketika difficult
- Respect confidentiality

4. Support dan Encouragement
- Celebrate each others successes
- Provide comfort during difficult times
- Encourage personal growth
- Be present during challenges

5. Healthy Boundaries
- Maintain individual identity
- Respect personal space dan time
- Communicate limits clearly
- Support each others other relationships

Supporting Partner dengan Mental Health Issues:

1. Educate Yourself
- Learn about their specific condition
- Understand symptoms dan triggers
- Know difference between person dan illness
- Research treatment options

2. Practice Patience dan Compassion
- Avoid taking symptoms personally
- Be patient dengan recovery process
- Show empathy untuk their struggles
- Celebrate small improvements

3. Encourage Professional Help
- Support therapy atau counseling
- Help find mental health resources
- Attend appointments if requested
- Respect their treatment decisions

4. Take Care of Yourself
- Maintain your own mental health
- Set boundaries untuk protect wellbeing
- Seek support from friends atau counselor
- Practice self-care activities

Building Mental Health-Friendly Relationships:

1. Create Safe Space
- Practice non-judgmental listening
- Validate emotions bahkan if you dont understand
- Avoid minimizing concerns
- Respect vulnerability

2. Develop Emotional Intimacy
- Share feelings regularly
- Express appreciation dan gratitude
- Be physically affectionate
- Create rituals of connection

3. Handle Conflict Constructively
- Focus pada issues, not personal attacks
- Use "I" statements instead of "you" statements
- Take breaks ketika emotions run high
- Seek compromise dan solutions

Remember: Healthy relationships require effort dari both parties. If youre struggling dengan mental health issues atau relationship problems, dont hesitate untuk seek professional help.',
            'image' => 'articles/article9.jpg',
            'created_by' => $admin->id,
            'is_published' => true,
            'created_at' => now()->subDays(2),
        ]);

        // Article 10 - Mental Health Awareness
        Article::create([
            'title' => 'Breaking the Stigma: Pentingnya Kesadaran Kesehatan Mental di Masyarakat',
            'content' => 'Stigma terhadap kesehatan mental masih menjadi hambatan besar bagi banyak orang untuk mencari bantuan. Penting untuk membangun awareness dan understanding tentang mental health untuk menciptakan masyarakat yang lebih supportif.

Mengapa Stigma Mental Health Berbahaya:

1. Mencegah Orang Mencari Bantuan
- Fear of judgment dari orang lain
- Worry tentang career consequences
- Shame atau embarrassment
- Misinformation tentang treatment

2. Memperburuk Kondisi Mental Health
- Increased isolation dan loneliness
- Self-blame dan negative self-talk
- Delayed treatment dan intervention
- Higher risk of suicide

Common Myths tentang Mental Health:

Myth: Mental illness adalah tanda weakness
Fact: Mental health conditions adalah medical conditions yang dapat menimpa siapa saja

Myth: People dengan mental illness tidak bisa bekerja atau contribute
Fact: Banyak orang dengan mental health conditions yang sukses dalam karier dan kehidupan

Myth: Mental health problems tidak common
Fact: 1 dari 4 orang mengalami mental health problems dalam hidup mereka

Myth: Therapy adalah untuk "crazy people"
Fact: Therapy adalah tool yang valuable untuk anyone yang ingin improve mental wellbeing

Cara Mengurangi Stigma:

1. Educate Yourself dan Others
- Learn facts tentang mental health
- Share accurate information
- Challenge misconceptions ketika you hear them
- Use respectful language

2. Share Personal Stories
- Open up tentang your own experiences (if comfortable)
- Listen to others stories tanpa judgment
- Support mental health advocacy
- Normalize conversations tentang mental health

3. Support Others
- Check in on friends dan family regularly
- Offer help tanpa being pushy
- Respect boundaries
- Encourage professional help ketika needed

4. Advocate for Change
- Support mental health policies
- Promote mental health resources dalam workplace
- Volunteer untuk mental health organizations
- Speak up against discrimination

Creating Supportive Environment:

Di Workplace:
- Implement employee assistance programs
- Provide mental health days
- Train managers tentang mental health awareness
- Create open, non-judgmental culture

Di Schools:
- Integrate mental health education dalam curriculum
- Provide counseling services
- Train teachers untuk recognize warning signs
- Create peer support programs

Di Community:
- Support local mental health initiatives
- Organize awareness events
- Provide accessible mental health resources
- Foster inclusive, supportive communities

Remember: Mental health adalah just as important as physical health. By working together untuk reduce stigma, we can create world where everyone feels safe untuk seek help dan support they need.

If you atau someone you know is struggling dengan mental health, reach out untuk help. There are resources available, dan recovery adalah possible.',
            'image' => 'articles/article10.jpg',
            'created_by' => $admin->id,
            'is_published' => false, // Draft article
            'created_at' => now()->subDays(1),
        ]);
    }
}