<?php

namespace App\Http\Controllers;

use App\Jobs\VeryLongJob;
use App\Models\Article;
use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\User;
use Illuminate\Support\Facades\Gate;
use App\Notifications\ArticleCreatedNotification;
use Illuminate\Support\Facades\Notification;
use App\Events\EventNewArticle;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;


class ArticleController extends Controller
{

    public function index()
    {

        $currentPage = request('page') ? request('page') : 1;
        $article = Cache::remember('articleAll:' . $currentPage, 60, function () {
            return Article::latest()->paginate(10);
        });

        // $article = Article::latest()->paginate(5);
        return view('articles/article', ['articles' => $article]);
    }

    public function create()
    {
        Gate::authorize('create', [self::class]);
        $currentUserId = auth()->id();

        return view('articles/create', ['currentUserId' => $currentUserId]);
    }

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



        if ($result) {
            $users = User::where('id', '!=', auth()->id())->get();
            Notification::send($users, new ArticleCreatedNotification($article));
            EventNewArticle::dispatch($article);
            // VeryLongJob::dispatch($article);
            $keys = DB::table('cache')->whereRaw('`key` GLOB :key', [':key' => 'articleAll:*[0-9]'])->get();
            foreach ($keys as $key) {
                Cache::forget($key->key);
            }
        }

        return redirect(route('article.index'));
    }

    public function show(Article $article)
    {
        $currentPage = request('page') ? request('page') : 1;
        $article->load('user');





        $comments = Cache::rememberForever('commentAll:article' . $article->id . '/' . $currentPage, function () use ($article) {
            return Comment::with('author')
                ->where('article_id', $article->id)
                ->where('is_moderated', true)
                ->latest()
                ->get();
        });

        // Отметка уведомлений о комментариях к этой статье как прочитанных
        auth()->user()->unreadNotifications()
            ->where('data->article_id', $article->id)
            ->get()
            ->markAsRead();

        return view('articles/show', [
            'authorName' => $article->user->name,
            'article' => $article,
            'comments' => $comments,
        ]);
    }

    public function edit(Article $article)
    {

        return view('articles/edit', ['article' => $article]);
    }

    public function update(Request $request, Article $article)
    {
        Gate::authorize('update', $article);
        $request->validate([
            'datePublic' => 'required',
            'title' => 'required',
            'desc' => 'required',
        ]);

        $article->datePublic = $request->datePublic;
        $article->title = $request->title;
        $article->shortDesc = $request->shortDesc;
        $article->desc = $request->desc;
        $res = $article->save();
        if ($res) {
            $keys = DB::table('cache')->whereRaw('`key` GLOB :key', [':key' => 'articleAll:*[0-9]'])->get();
            foreach ($keys as $key) {
                Cache::forget($key->key);
            }
        }
        return redirect(route('article.show', ['article' => $article->id]));
    }

    public function destroy(Article $article)
    {
        Gate::authorize('delete', $article);
        Comment::where('article_id', $article->id)->delete();
        $res = $article->delete();
        if ($res) {
            $keys = DB::table('cache')->whereRaw('`key` GLOB :key', [':key' => 'articleAll:*[0-9]'])->get();
            foreach ($keys as $key) {
                Cache::forget($key->key);
            }
        }
        return redirect()->route('article.index');
    }
}