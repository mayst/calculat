<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Article;
use App\User;
use Illuminate\Support\Facades\Auth;

class BlogController extends Controller
{
    //
    public function viewPosts() {
        $articles = Article::where('user_id', 0)->paginate(6);
        $user = Auth::user();
        $list_dialogs = $user->messages()
            ->orderBy('created_at', 'desc')
            ->get(['receiver', 'message', 'created_at'])
            ->unique('receiver');

        return view('blog', [
            'articles' => $articles,
            'list_dialogs' => $list_dialogs,
        ]);
    }

    public function viewArticle($name) {
        $article = Article::where('title', $name)->first();
        $last_articles = Article::where('id', '!=', $article->id)->groupBy('created_at')->take(3)->get();
        $user = Auth::user();
        $list_dialogs = $user->messages()
            ->orderBy('created_at', 'desc')
            ->get(['receiver', 'message', 'created_at'])
            ->unique('receiver');

        return view('article', [
            'article' => $article,
            'last_articles' => $last_articles,
            'list_dialogs' => $list_dialogs,
        ]);
    }

    public function index() {
        $articles = Article::all();

        return view('articles',['articles' => $articles]);
    }

    public function show($id) {
        $article = Article::find($id);

        return view('show',['article' => $article]);
    }

    public function create() {
        return view('create');
    }

    public function store(Request $request) {
        Article::create($request->all());

        return redirect('/articles');
    }

    public function edit($id) {
        $article = Article::find($id);

        return view('edit',['article' => $article]);
    }

    public function update(Request $request, $id) {
        $article = Article::find($id);
        $article->title = $request->title;
//        $article->content = $request->content;
        $article->save();

        return redirect('/articles');
    }

    public function delete($id) {
        $article = Article::find($id);
        $article->delete();

        return redirect('/articles');
    }
}
