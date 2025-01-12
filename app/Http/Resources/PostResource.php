<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'=>$this->id,
            'user_id'=>$this->user_id,
            'title'=>$this->title,
            'content'=>$this->content,
//            'relations'=>[
//                'comment'=>[
//                    'user_id'=>$this->comments->user_id,
//                    'content'=>$this->comments->content
//                ],
//            ],


        ];
    }
}
