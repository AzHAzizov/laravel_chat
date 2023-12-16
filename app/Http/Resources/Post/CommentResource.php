<?php

namespace App\Http\Resources\Post;

use App\Http\Resources\User\UsersResource;
use Illuminate\Http\Resources\Json\JsonResource;

class CommentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {


        $userName = $this->parent ? $this->parent->user->name : "";


        return [
            'id' => $this->id,
            'body' => $this->body,
            'user' => new UsersResource($this->user),
            'date' => $this->date,
            'answered_for_user' => $userName,
        ];
    }
}
