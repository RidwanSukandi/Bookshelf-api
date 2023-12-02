<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class GetBooksResource extends JsonResource
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
                'books' => [
                    'idbooks' => $this->idbooks,
                    'name' => $this->name,
                    'publisher' => $this->publisher
                ]

            ]
        ];
    }
}
