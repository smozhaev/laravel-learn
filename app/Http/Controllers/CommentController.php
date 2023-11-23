<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;


class CommentController extends Controller
{
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
        return redirect()->route('article.show', ['article' => $request->article_id]);
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
        return redirect()->route('article.show', ['article' => $request->article_id]);
    }
    public function delete($id)
    {
        $comment = Comment::findOrFail($id);
        $comment->delete();
        // $comment = NULL;
        return redirect()->route('article.show', ['article' => $comment->article_id]);
    }


    // /**
    //  * Show the form for creating a new resource.
    //  *
    //  * @return \Illuminate\Http\Response
    //  */
    // public function create()
    // {
    // }

    // /**
    //  * Store a newly created resource in storage.
    //  *
    //  * @param  \Illuminate\Http\Request  $request
    //  * @return \Illuminate\Http\Response
    //  */
    // public function store(Request $request)
    // {
    //     //
    // }

    // /**
    //  * Display the specified resource.
    //  *
    //  * @param  \App\Models\Comment  $comment
    //  * @return \Illuminate\Http\Response
    //  */
    // public function show(Comment $comment)
    // {
    //     //
    // }

    // /**
    //  * Show the form for editing the specified resource.
    //  *
    //  * @param  \App\Models\Comment  $comment
    //  * @return \Illuminate\Http\Response
    //  */
    // public function edit(Comment $comment)
    // {
    //     //
    // }

    // /**
    //  * Update the specified resource in storage.
    //  *
    //  * @param  \Illuminate\Http\Request  $request
    //  * @param  \App\Models\Comment  $comment
    //  * @return \Illuminate\Http\Response
    //  */
    // public function update(Request $request, Comment $comment)
    // {
    //     //
    // }

    // /**
    //  * Remove the specified resource from storage.
    //  *
    //  * @param  \App\Models\Comment  $comment
    //  * @return \Illuminate\Http\Response
    //  */
    // public function destroy(Comment $comment)
    // {
    //     //
    // }
}