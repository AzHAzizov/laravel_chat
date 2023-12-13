<?php

namespace App\Http\Controllers;

use App\Http\Resources\Post\PostResource;
use App\Http\Resources\User\UsersResource;
use App\Models\LikedPost;
use App\Models\SubscriberFollowing;
use App\Models\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return $request->user();
    }



    public function getList(Request $request)
    {
        $usersList = User::whereNot('id', auth()->id())->get();


        $followingIds = SubscriberFollowing::where('subscriber_id', auth()->id())->get('following_id')->pluck('following_id')->toArray();

        foreach($usersList as $user) {
            if(in_array($user->id, $followingIds)) {
                $user->is_followed = true;
            }
        }

        return UsersResource::collection($usersList);
    }


    public function post(User $user)
    {

        $likedPosts = LikedPost::where('user_id', auth()->id())->get('post_id')->pluck('post_id')->toArray();

        foreach ($user->posts as $post) {
            if (in_array($post->id, $likedPosts)) {
                $post->is_liked = true;
            }
        }


        return PostResource::collection($user->posts);
    }



    public function toggle(User $user)
    {
        $res = auth()->user()->followings()->toggle($user->id);
        $data['is_followed'] = count($res['attached']) > 0;
        return $data;
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
