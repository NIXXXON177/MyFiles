<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'title' => 'required|min:3|max:40',
            'descr' => 'required|min:10|max:550',
            'img' => 'nullable|mimes:jpeg,png|max:5000',
        ];
    }

    /**
     * Custom error messages for validator.
     *
     * @return array<string, string>
     */
    public function messages()
    {
        return [
            'title.required' => 'Поле :attribute обязательно для заполнения.',
            'title.min' => 'Поле :attribute должно содержать не менее :min символов.',
            'title.max' => 'Поле :attribute должно содержать не более :max символов.',

            'descr.required' => 'Поле :attribute обязательно для заполнения.',
            'descr.min' => 'Поле :attribute должно содержать не менее :min символов.',
            'descr.max' => 'Поле :attribute должно содержать не более :max символов.',

            'img.mimes' => 'Поле ":attribute" должно быть в формате: jpeg, png.',
            'img.max' => 'Размер файла в поле ":attribute" не должен превышать :max КБ.',

            'password.min'=> 'Поле ":attribute" должно быть минимум 3 символа',
        ];
    }

    /**
     * Custom attributes to display in messages.
     *
     * @return array<string, string>
     */
    public function attributes()
    {
        return [
            'title' => 'заголовок',
            'descr' => 'описание',
            'img' => 'изображение',
            'password' => 'пароль',
        ];
    }
}
