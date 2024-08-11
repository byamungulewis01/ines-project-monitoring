<?php

namespace App\Http\Resources;

use App\Models\Project;
use App\Models\Sponser;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SponsorResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $project = Project::find($this->project_id);
        $student = Student::find($project->student_id);
        $sponsor = Sponser::find($this->sponser_id);

        return [
            'id' => $this->id,
            'sponsor_name' => $sponsor->name,
            'sponsor_email' => $sponsor->email,
            'student_name' => $student->name,
            'profile_image' => $student->profile_image ?  'storage/' . $student->profile_image
                : 'assets/images/users/user-dummy-img.jpg',
            'project_name' => $project->title,
            'project_price' => $project->price,
            'created_at' => $this->created_at->format('d M, Y'),
        ];
    }
}
