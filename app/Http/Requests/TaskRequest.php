<?php

namespace App\Http\Requests;

use App\Enums\TaskPriority;
use App\Enums\TaskStatus;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class TaskRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    /**
     * @return array<string, list<mixed>>
     */
    public function rules(): array
    {
        return [
            'description' => ['nullable', 'string', 'max:2000'],
            'due_date' => ['nullable', 'date', 'after_or_equal:today'],
            'priority' => ['required', Rule::enum(TaskPriority::class)],
            'status' => ['required', Rule::enum(TaskStatus::class)],
            'title' => ['required', 'string', 'max:120'],
        ];
    }

    /**
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'due_date.date' => 'La date limite doit etre une date valide.',
            'due_date.after_or_equal' => 'La date limite ne peut pas etre dans le passe.',
            'priority.required' => 'La priorite est obligatoire.',
            'status.required' => 'Le statut est obligatoire.',
            'title.max' => 'Le titre ne doit pas depasser 120 caracteres.',
            'title.required' => 'Le titre est obligatoire.',
        ];
    }
}
