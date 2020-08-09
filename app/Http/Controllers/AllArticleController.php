<?php

namespace App\Http\Controllers;

use App\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class AllArticleController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = Auth::user();
        $query = DB::table('articles')->join('users', 'articles.user_id', '=', 'users.id');
        $count = $query->count();
        $articles = $query->orderBy('articles.created_at', 'asc')->paginate(10);
        // $articles = $query->get();

        return view('allarticles.index', compact('articles'), ['count'=>$count, 'user'=>$user]);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
