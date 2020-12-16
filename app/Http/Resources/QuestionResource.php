<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class QuestionResource extends JsonResource
{
    /**
     * The "data" wrapper that should be applied.
     *
     * @var string
     */
    public static $wrap = 'Questions';

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'question' => $this->question,
            'with_image' => $this->with_image ? true : false,
            'image' => $this->with_image ? asset('storage/'.$this->image) : null,
            'correct_answer' => $this->with_image ? asset('storage/'.$this->correct_answer) : $this->correct_answer,
            'answer' => [
                $this->with_image ? asset('storage/'.$this->answer2) : $this->answer2,
                $this->with_image ? asset('storage/'.$this->answer3) : $this->answer3,
                $this->with_image ? asset('storage/'.$this->answer4) : $this->answer4
            ],
            'category_id' => $this->category_id
        ];
    }
}
