<?php

namespace App\Http\Resources\Post;

use App\Http\Resources\User\UsersResource;
use Illuminate\Http\Resources\Json\JsonResource;

class RepostedPostResource extends JsonResource
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
            'url' => $this->image->url ?? null,
            'user' => new UsersResource($this->user),   
        ];
    }
}
