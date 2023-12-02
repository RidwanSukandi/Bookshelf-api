<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BooksByIdResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'status' => 'success',
            'data' => [
                'book' => [
                    'idbooks' => $this->idbooks,
                    'name' => $this->name,
                    'year' => $this->year,
                    'author' => $this->author,
                    'summary' => $this->summary,
                    'publisher' => $this->publisher,
                    'pageCount' => $this->page_count,
                    'readPage' => $this->read_page,
                    'finished' => $this->finished === 0 ? false : true,
                    'reading' => $this->reading === 0 ? false : true
                ]
            ]
        ];
    }
}
