<?php

namespace App\Http\Requests\Settings;

use App\Rules\Settings\NoDigitsRule;
use Illuminate\Foundation\Http\FormRequest;

class AuthorRequest extends FormRequest
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
            'NameSurname' => [
                'required',
                'min:2',
                'max:500',
                new NoDigitsRule(),
            ],
            'biography' => 'required|max:500',
        ];
    }
}
