<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

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
        $comment->save();
        return back();
    }

    public function disapprove(Comment $comment)
    {

        $comment->is_moderated = false;
        $comment->delete();

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
        $comment->save();
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
        $comment->save();
        Gate::authorize('update', $comment);
        return redirect()->route('article.show', ['article' => $request->article_id]);
    }
    public function delete($id)
    {
        $comment = Comment::findOrFail($id);
        Gate::authorize('delete', $comment);
        $comment->delete();
        return redirect()->route('article.show', ['article' => $comment->article_id]);
    }
}