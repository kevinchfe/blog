<?php

namespace App\Http\Controllers;

use App\Article;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\ArticleRequest;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;


class ArticlesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth',['only'=>'create']);
    }
    public function index()
    {
        $articles = Article::latest()->published()->get();

        return view('articles.index', compact('articles'));
    }

    public function show(Article $article)//路由模型绑定
    {
        /*dd($id);
        $article = Article::findOrFail($id);*/
        //  dd($article->published_at);

        return view('articles.show',compact('article'));
    }

    public function create()
    {
       return view('articles.create');
    }

    public function store(ArticleRequest $request)
    {
        /*$articles = new Article($request->all());
        Auth::user()->articles()->save($articles);*///或者下面这个方法
        Auth::user()->articles()->create($request->all());
        //session()->flash('flash_message','Your article created success!');
        //\Session::flash('flash_message','Your article created success!');同上一致
        //return redirect('articles');
        return redirect('articles')->with([
            'flash_message'=>'Your article created successfully!',
           // 'flash_message_important'=>'',
        ]);
    }

    public function edit($id)
    {
        $article = Article::findOrFail($id);
        return view('articles.edit',compact('article'));
    }

    public function update(ArticleRequest $request,$id)
    {
        //dd($request->all());
        $article = Article::findOrFail($id);
        $article->update($request->all());
        return redirect('articles');
    }
}
