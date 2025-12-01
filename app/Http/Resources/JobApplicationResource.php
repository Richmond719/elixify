<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class JobApplicationResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'job_posting_id' => $this->job_posting_id,
            'user_id' => $this->user_id,
            'applicant_name' => $this->applicant_name,
            'applicant_email' => $this->applicant_email,
            'cover_letter' => $this->cover_letter,
            'resume_path' => $this->resume_path,
            'status' => $this->status,
            'applied_at' => $this->applied_at,
            'created_at' => $this->created_at,
        ];
    }
}
