<?php

namespace Modules\Products\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
                'title'=>'required|regex:/^[\pL\s]*$/u|max:250',
                'description'=>'nullable|regex:/^[\pL\s]*$/u|max:600',
                'price'=>'required|integer',
        ];
    }
}
