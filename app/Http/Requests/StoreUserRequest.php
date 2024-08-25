<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
/**
* @property string $name
*/
class StoreUserRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|min:3|max:100'
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
            'name.required' => 'Поле name обязательно для заполнения.',
            'name.string' => 'Поле name должно быть строкой.',
            'name.min' => 'Поле name должно содержать как минимум :min символов.',
            'name.max' => 'Поле name не может содержать больше :max символов.',
        ];
    }
}
