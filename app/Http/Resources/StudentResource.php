<?php

namespace App\Http\Resources;

use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class StudentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'reg_number' => $this->reg_number,
            'department' => Department::find($this->department_id)->name,
            'department_id' => $this->department_id,
            'option' => $this->option,
            'academic_year' => $this->academic_year,
            'profile_image' => $this->profile_image ?  'storage/' . $this->profile_image
                : 'assets/images/users/user-dummy-img.jpg',
            'status' => $this->status,
            'completion_date' => $this->completion_date,
            'created_at' => $this->created_at->format('d M, Y'),
        ];
    }
}
