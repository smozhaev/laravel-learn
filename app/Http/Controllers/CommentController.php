<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Cache;
use App\Models\User;
use App\Notifications\NotifyNewArticle;

class CommentController extends Controller
{

    public function index()
    {
        $comments = Comment::where('is_moderated', false)->latest()->paginate(5);

        return view('moderates/moderate', ['comments' => $comments]);
    }



    public function approve(Comment $comment)
    {

        $comment->is_moderated = true;
        $res = $comment->save();
        if ($res) {
            $keys = DB::table('cache')->whereRaw('`key` GLOB :key', ['key' => 'commentAll:article*[0-9]/*[0-9]'])->get();
            foreach ($keys as $key) {
                Cache::forget($key->key);
            }
        }
        return back();
    }

    public function disapprove(Comment $comment)
    {

        $comment->is_moderated = false;
        $res = $comment->delete();
        if ($res) {
            $keys = DB::table('cache')->whereRaw('`key` GLOB :key', ['key' => 'commentAll:article*[0-9]/*[0-9]'])->get();
            foreach ($keys as $key) {
                Cache::forget($key->key);
            }
        }

        return back();
    }


    public function store(Request $request)
    {
        $request->validate([
            'text' => 'required'
        ]);

        $comment = new Comment;
        $comment->title = $request->title;
        $comment->text = $request->text;
        $comment->article_id = $request->article_id;
        $comment->user_id = auth()->id();
        $res = $comment->save();

        if ($res) {
            $keys = DB::table('cache')->whereRaw('`key` GLOB :key', ['key' => 'commentAll:article*[0-9]/*[0-9]'])->get();
            foreach ($keys as $key) {
                Cache::forget($key->key);
            }
        }

        $comment->load('author');
        session()->flash('message', 'Ваш комментарий добавлен и ожидает модерации.');
        return redirect()->route('article.show', [
            'article' => $request->article_id,

        ]);
    }


    public function edit($id)
    {
        $comment = Comment::findOrFail($id);
        return view('comment.edit', ['comment' => $comment]);
    }


    public function update(Request $request, $id)
    {

        $request->validate([
            'text' => 'required'
        ]);

        $comment = Comment::findOrFail($id);
        $comment->title = $request->title;
        $comment->text = $request->text;
        $res = $comment->save();
        if ($res) {
            $keys = DB::table('cache')->whereRaw('`key` GLOB :key', ['key' => 'commentAll:article*[0-9]/*[0-9]'])->get();
            foreach ($keys as $key) {
                Cache::forget($key->key);
            }
        }
        Gate::authorize('update', $comment);
        return redirect()->route('article.show', ['article' => $request->article_id]);
    }


    public function delete($id)
    {
        $comment = Comment::findOrFail($id);
        Gate::authorize('delete', $comment);
        $res = $comment->delete();
        if ($res) {
            $keys = DB::table('cache')->whereRaw('`key` GLOB :key', ['key' => 'commentAll:article*[0-9]/*[0-9]'])->get();
            foreach ($keys as $key) {
                Cache::forget($key->key);
            }
        }
        return redirect()->route('article.show', ['article' => $comment->article_id]);
    }
}