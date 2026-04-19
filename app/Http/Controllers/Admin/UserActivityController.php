<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserMoodLog;
use App\Models\UserMeditationLog;
use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class UserActivityController extends Controller
{
    /**
     * Daftar semua user (bukan admin) beserta ringkasan aktivitas hari ini.
     */
    public function index(Request $request)
    {
        $this->authorizeAdmin();

        $users = User::where('role', 'user')
            ->withCount([
                'moodLogs',
                'meditationLogs',
                'articleReads',
            ])
            ->orderByDesc('last_active_at')
            ->paginate(20);

        return view('admin.user-activity.index', compact('users'));
    }

    /**
     * Riwayat aktivitas harian satu user tertentu.
     */
    public function show(Request $request, User $user)
    {
        $this->authorizeAdmin();

        // Rentang tanggal: default 30 hari terakhir
        $startDate = $request->filled('start_date')
            ? Carbon::parse($request->start_date)->startOfDay()
            : now()->subDays(29)->startOfDay();

        $endDate = $request->filled('end_date')
            ? Carbon::parse($request->end_date)->endOfDay()
            : now()->endOfDay();

        // --- Mood logs per hari ---
        $moodLogs = UserMoodLog::with('mood')
            ->where('user_id', $user->id)
            ->whereBetween('created_at', [$startDate, $endDate])
            ->orderByDesc('created_at')
            ->get()
            ->groupBy(fn($log) => $log->created_at->toDateString());

        // --- Meditation logs per hari ---
        $meditationLogs = UserMeditationLog::with('audio')
            ->where('user_id', $user->id)
            ->whereBetween('created_at', [$startDate, $endDate])
            ->orderByDesc('created_at')
            ->get()
            ->groupBy(fn($log) => $log->created_at->toDateString());

        // --- Article reads per hari ---
        $articleReads = DB::table('article_reads')
            ->join('articles', 'article_reads.article_id', '=', 'articles.id')
            ->where('article_reads.user_id', $user->id)
            ->whereBetween('article_reads.created_at', [$startDate, $endDate])
            ->select(
                'article_reads.created_at',
                'articles.id as article_id',
                'articles.title as article_title',
            )
            ->orderByDesc('article_reads.created_at')
            ->get()
            ->groupBy(fn($row) => Carbon::parse($row->created_at)->toDateString());

        // Gabungkan semua tanggal unik lalu urutkan descending
        $allDates = collect(array_keys($moodLogs->toArray()))
            ->merge(array_keys($meditationLogs->toArray()))
            ->merge(array_keys($articleReads->toArray()))
            ->unique()
            ->sortDesc()
            ->values();

        return view('admin.user-activity.show', compact(
            'user',
            'moodLogs',
            'meditationLogs',
            'articleReads',
            'allDates',
            'startDate',
            'endDate',
        ));
    }

    private function authorizeAdmin(): void
    {
        if (!auth()->user()?->isAdmin()) {
            abort(403, 'Akses ditolak. Hanya admin yang dapat melihat halaman ini.');
        }
    }
}
