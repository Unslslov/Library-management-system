<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class IndexBookRequest extends FormRequest
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
            'title' => 'nullable|string',
            'author_id' => 'nullable|int',
            'published_at' => 'nullable|date',
        ];
    }

    public function messages()
    {
        return [
            'title.string' => 'Поле "Название" должно быть заполнено',
            'author_id.integer' => 'Поле "Автор" должен быть выбран',
            'published_at.nullable' => 'Поле "Дата публикации" должно быть заполнено',
        ];
    }
}
