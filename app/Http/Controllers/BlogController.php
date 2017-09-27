<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Article;

class BlogController extends Controller
{
    //
    public function viewPosts() {
        $articles = Article::where('user_id', 0)->get();

        return view('blog', [
            'articles' => $articles
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
