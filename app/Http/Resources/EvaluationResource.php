<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EvaluationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        // dd($this);
        return [
            'company' => $this->company,
            'comment' => $this->comment,
            'stars' => $this->stars,
            'created_at' => Carbon::make($this->created_at)->format('d/m/Y')
        ];
    }
}
