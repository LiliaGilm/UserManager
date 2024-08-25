<?php

namespace App\Http\Requests;

use AllowDynamicProperties;
use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Validator;


/**
 * @property string $body
 */
class UpdateCommentRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'body' => 'required|string|max:2000',
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
            'body.required' => 'Поле body обязательно для заполнения',
            'body.string' => 'Поле body должно быть строкой.',
        ];
    }
}
