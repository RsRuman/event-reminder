<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class EventRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Prepare the data for validation.
     */
    protected function prepareForValidation(): void
    {
        $recipients = json_decode($this->input('recipients', '[]'), true);

        $recipients = array_map(function ($recipient) {
            return $recipient['value'];
        }, $recipients);

        $this->merge(['recipients' => $recipients]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'title'       => 'required|string|max:100',
            'description' => 'nullable|string|max:200',
            'date'        => 'required|date',
            'recipients'  => 'nullable|array',
            'recipients.*' => 'email'
        ];
    }
}
