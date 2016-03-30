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
        $tags = \App\Tag::lists('name','id');
       return view('articles.create',compact('tags'));
    }

    public function store(ArticleRequest $request)
    {
        /*$articles = new Article($request->all());
        Auth::user()->articles()->save($articles);*///或者下面这个方法

        $this->createArticle($request);
        /*$article = Auth::user()->articles()->create($request->all());
        $this->syncTag($article,$request->input('tag_list'));*/
        //$article->tags()->sync($request->input('tag_list'));

        //session()->flash('flash_message','Your article created success!');
        //\Session::flash('flash_message','Your article created success!');同上一致
        //return redirect('articles');
        return redirect('articles')->with([
            'flash_message'=>'Your article created successfully!',
           // 'flash_message_important'=>'',
        ]);
    }

    public function edit(Article $article)
    {
        $tags = \App\Tag::lists('name','id');
        return view('articles.edit',compact('article','tags'));
    }

    public function update(ArticleRequest $request,Article $article)
    {
        //dd($request->all());
        $article->update($request->all());
        $this->syncTag($article,$request->input('tag_list'));
        //$article->tags()->sync($request->input('tag_list'));
        return redirect('articles');
    }

    /**
     * sync the tag
     */
    public function syncTag(Article $article,array $tag)
    {
        return $article->tags()->sync($tag);
    }

    /*
     * save a new article
     */
    public function createArticle(ArticleRequest $request)
    {
        $article = Auth::user()->articles()->create($request->all());
        $this->syncTag($article,$request->input('tag_list'));
        return $article;
    }
}
