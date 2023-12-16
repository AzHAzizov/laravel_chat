<?php

namespace App\Http\Resources\Post;

use App\Http\Resources\User\UsersResource;
use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'title' => $this->title,
            'content' => $this->content,
            'is_liked' => $this->is_liked ?? false,
            'id' => $this->id,
            'url' => $this->image->url ?? null,
            'user' => new UsersResource($this->user),
            'date' => $this->date,
            'likes_count' => $this->liked_users_count,
            'reposted_post' => new RepostedPostResource($this->repostedPost),
            'comments_count' => $this->comments_count,
            'reposted_by_posts_count' => $this->reposted_by_posts_count
        ];
    }
}
