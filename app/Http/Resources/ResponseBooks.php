<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ResponseBooks extends JsonResource
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
            'message' => "Buku berhasil di tambahkan",
            'data' => [
                'idbooks' => $this->idbooks,
            ]
        ];
    }
}
