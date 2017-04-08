<?php

namespace Vialoja\Http\Requests\Control\Authorization;

use Illuminate\Foundation\Http\FormRequest;

class RoleUpdateRequest extends FormRequest
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
     * @return array
     */
     public function rules()
     {

         return [
             'name' => 'min:5|max:50|required',
             'description' => 'min:5|max:50|required'
         ];

     }

     public function messages()
     {

         return [
             'name.required' => 'Preencha o campo :attribute.',
             'name.min' => 'O nome deve ter no mínimo 5 caracteres.',
             'name.max' => 'O nome deve ter no máximo 50 caracteres.',
             'description.required' => 'Preencha a descrição.',
             'description.min' => 'A descrição deve ter no mínimo 5 caracteres.',
             'description.max' => 'A descrição deve ter no máximo 50 caracteres.'
         ];

     }

}
