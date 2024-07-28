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
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'surname' => $this->surname,
            'group_id' => $this->group->id,
            'email' => $this->email,
            'address' => $this->address,
            'role' => $this->role->name,
        ];
    }
}
