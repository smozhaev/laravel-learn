<?php

namespace App\Http\Controllers;

use App\Jobs\VeryLongJob;
use App\Models\Article;
use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\User;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $article = Article::latest()->paginate(5);
        return view('articles/article', ['articles' => $article]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create', [self::class]);
        $currentUserId = auth()->id();

        return view('articles/create', ['currentUserId' => $currentUserId]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'datePublic' => 'required',
            'title' => 'required',
            'desc' => 'required',
            'article_id' => 'required',

        ]);
        $article = new Article;
        $article->datePublic = $request->datePublic;
        $article->title = $request->title;
        $article->shortDesc = $request->shortDesc;
        $article->desc = $request->desc;
        $article->user_id = $request->article_id;
        $result = $article->save();
        if ($result) VeryLongJob::dispatch($article);
        return redirect(route('article.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function show(Article $article)
    {

        $article->load('user'); //Эта строка использует "ленивую" загрузку 
        //(lazy loading) для получения данных пользователя, связанного
        // со статьей.
        $comments = Comment::with('author')
            ->where('article_id', $article->id)
            ->latest()
            ->get();

        return view('articles/show', [
            'authorName' => $article->user->name,
            'article' => $article,
            'comments' => $comments,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function edit(Article $article)
    {
        return view('articles/edit', ['article' => $article]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Article $article)
    {
        $request->validate([
            'datePublic' => 'required',
            'title' => 'required',
            'desc' => 'required',
        ]);

        $article->datePublic = $request->datePublic;
        $article->title = $request->title;
        $article->shortDesc = $request->shortDesc;
        $article->desc = $request->desc;
        $article->save();
        return redirect(route('article.show', ['article' => $article->id]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function destroy(Article $article)
    {
        Comment::where('article_id', $article->id)->delete();
        $article->delete();
        return redirect()->route('article.index');
    }
}