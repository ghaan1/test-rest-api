<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ResourceBook extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'author' => $this->author,
            'total_books' => $this->total_books,
            'total_borrow' => $this->total_borrow,
            'total_book_available' => $this->total_book_available,
            'category' => $this->category_name
        ];
    }
}