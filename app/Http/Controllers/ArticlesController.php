<?php

namespace App\Http\Controllers;

use App\Article;
//use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Carbon\Carbon;


class ArticlesController extends Controller
{
    public function index()
    {
        $articles = Article::latest()->published()->get();

        return view('articles.index', compact('articles'));
    }

    public function show($id)
    {
        $article = Article::findOrFail($id);
        //  dd($article->published_at);

        return view('articles.show',compact('article'));
    }

    public function create()
    {
       return view('articles.create');
    }

    public function store(Requests\CreateArticleRequest $request)
    {
        Article::create($request->all());
        return redirect('articles');
    }

    public function edit($id)
    {
        $article = Article::findOrFail($id);
        return view('articles.edit',compact('article'));
    }

    public function update($id,\Request $request)
    {
        //dd($request->all());
        $article = Article::findOrFail($id);
        $article->update($request->all());
    }
}
