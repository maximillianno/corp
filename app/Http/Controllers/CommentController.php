<?php

namespace App\Http\Controllers;

use App\Article;
use App\Comment;
use Illuminate\Http\Request;

class CommentController extends SiteController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\Response
     * @throws \Throwable
     */
    public function store(Request $request)
    {
        //
        $data = $request->except(['_token', 'comment_post_id', 'comment_parent']);
        $data['article_id'] = $request->input('comment_post_id');
        $data['parent_id'] = $request->input('comment_parent');
        $validator = \Validator::make($data, [
           'article_id' => 'integer|required',
           'parent_id' => 'integer|required',
            'text' => 'string|required'
        ]);
        $validator->sometimes(['name', 'email'], 'required|max:255', function ($input){
            return !\Auth::check();
        });
        if ($validator->fails()){
            return \Response::json(['error' => $validator->errors()->all()]);
        }
        $user = \Auth::user();
        $comment = new Comment($data);
        if($user){
            $comment->user_id = $user->id;
        }
        $post = Article::find($data['article_id']);
        $post->comments()->save($comment);

        $comment->load('user');

        $data['id'] = $comment->id;
        $data['name'] = (!empty($data['name']))?($data['name']):$comment->user->name;
        $data['email'] = (!empty($data['email']))?($data['email']):$comment->user->email;
        $data['hash'] = md5($data['email']);

        $view_comment = view(env('THEME').'.one_comment')->with('data', $data)->render();

        return \Response::json(['success'=>'true', 'comment'=> $view_comment, 'data'=>$data]);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function show(Comment $comment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function edit(Comment $comment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Comment $comment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Comment $comment)
    {
        //
    }
}
