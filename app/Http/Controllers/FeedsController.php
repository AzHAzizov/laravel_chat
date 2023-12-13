<?php

namespace App\Http\Controllers;

use App\Http\Resources\Post\PostResource;
use App\Models\LikedPost;
use App\Models\Post;
use Illuminate\Http\Request;

class FeedsController extends Controller
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Display posts of subscribed users.
     *
     * @return \Illuminate\Http\Response
     */
    public function postList()
    {
        $folledIds = auth()->user()->followings()->get()->pluck('id')->toArray();
        $posts = Post::whereIn('user_id', $folledIds)->get();

        $likedPosts = LikedPost::where('user_id', auth()->id())->get('post_id')->pluck('post_id')->toArray();

        $posts =  Post::whereIn('user_id', $folledIds)->whereNotIn('id', $likedPosts)->get();


        // $posts = $this->prepareLikedPosts($posts);


        return PostResource::collection($posts);
    }



    public function prepareLikedPosts($posts)
    {
        $likedPosts = LikedPost::where('user_id', auth()->id())->get('post_id')->pluck('post_id')->toArray();


        foreach ($posts as $post) {
            if (in_array($post->id, $likedPosts)) {
                $post->is_liked = true;
            }
        }

        return $posts;
    }




    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
