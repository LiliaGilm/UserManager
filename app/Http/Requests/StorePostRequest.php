<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
/**
* @property string $body
 * @property int user_id
*/
class StorePostRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'body' => 'required|string|min:1|max:2000',
            'user_id' => 'required|int|exists:users,id',
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
            'body.required' => 'Поле body обязательно для заполнения.',
            'body.string' => 'Поле body должно быть строкой.',
            'body.min' => 'Поле body должно содержать как минимум :min символов.',
            'body.max' => 'Поле body не может содержать больше :max символов.',
            'user_id.required' => 'Поле user_id обязательно для заполнения.',
            'user_id.int' => 'Поле user_id должно быть целым числом.',
        ];
    }
}
