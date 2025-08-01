<?php
namespace App\Domains\Auth\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AuthResource extends JsonResource
{
    /**
     * Transform the authentication response data into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array<string, mixed>
     */
    public function toArray($request): array
    {
        return [
            'user' => [
                'id'    => $this['user']->id,
                'name'  => $this['user']->name,
                'email' => $this['user']->email,
            ],
            'token' => $this['token'],
        ];
    }
}