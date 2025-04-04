<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "user_uuid"  =>   $this->user_uuid,
            "email"      =>   $this->email,
            "bank_cards" =>   $this->bank_cards()->pluck('card_number'),
            "level"      =>   $this->level->level
        ];
    }
}
