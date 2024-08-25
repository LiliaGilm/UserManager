<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ShowUserRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'id' => 'required|int'
        ];
    }

    /**
     * Сообщение для каждой ошибки
     *
     * @return array
     */
    public function messages(): array
    {
        return [
            'id.required' => 'Поле id обязательно для заполнения.',
            'id.int' => 'Поле id должно быть целым числом.',
        ];
    }
}
