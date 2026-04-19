<?php
namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\ArticleRead;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function index(Request $request)
    {
        $query = Article::published()->latest();
        
        if ($request->has('search')) {
            $query->where('title', 'like', '%' . $request->search . '%')
                  ->orWhere('content', 'like', '%' . $request->search . '%');
        }
        
        $articles = $query->paginate(9);
        
        return view('articles.index', compact('articles'));
    }

    public function show(Article $article)
    {
        if (!$article->is_published) {
            abort(404);
        }

        // Catat aktivitas baca artikel jika user sudah login
        if (auth()->check()) {
            ArticleRead::create([
                'user_id'    => auth()->id(),
                'article_id' => $article->id,
            ]);
        }

        return view('articles.show', compact('article'));
    }
}