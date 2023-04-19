<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CustomizeJsonResource extends JsonResource
{
    public function with($request)
    {
        return [
            'status' => [
                'code' => 200,
                'message' => 'success'
            ],
        ];
    }
}
