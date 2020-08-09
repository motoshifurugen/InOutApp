<?php

namespace App\Http\Controllers;

use App\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ArticleController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    public function index()
    {
        $user_id = Auth::id();
        $user = Auth::user();
        $query = DB::table('articles')->where('user_id', $user_id);
        $count = $query->count();
        $articles = $query->orderBy('created_at', 'asc')->paginate(10);

        return view('articles.index', compact('articles'), ['user'=>$user, 'count'=>$count]);
    }

    public function create()
    {
        return view('articles.create');
    }

    public function store(Request $request)
    {
        $article = new Article();
        $article->user_id = Auth::id();
        $article->title = request('title');
        $article->body = request('body');
        $article->save();

        return redirect('articles');
    }

    public function show(Article $article)
    {
        //
    }

    public function edit(Article $article)
    {
        return view('articles.edit', compact('article'));
    }

    public function update(Request $request, Article $article)
    {
        $article->user_id = Auth::id();
        $article->title = request('title');
        $article->body = request('body');
        $article->save();

        return redirect('articles');
    }

    public function destroy(Article $article)
    {
        $article->delete();

        return redirect('articles');
    }
}
