<?php

namespace App\Http\Resources\Post;

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
            'date' => $this->date,
            'likes_count' => $this->likedUsers->count(),
            'reposted_post' => new RepostedPostResource($this->repostedPost)
        ];
    }
}
