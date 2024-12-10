<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CourseRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'club_id' => 'required|exists:clubs,id',
            'coach_id' => 'required|exists:users,id',
            'lesson_id' => 'required|exists:lessons,id',
            'room_id' => 'required|exists:rooms,id',
            'startTime' => 'required|date',
            'endTime' => 'required|date|after:startTime',
        ];
    }
}
