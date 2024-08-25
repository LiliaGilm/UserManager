<?php

namespace App\Http\Requests;

use AllowDynamicProperties;
use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Validator;


/**
 * @property string $name
 */
class UpdateUserRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
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
            'name.required' => 'Поле name обязательно для заполнения',
            'name.string' => 'Поле name должно быть строкой.',
        ];
    }
}
