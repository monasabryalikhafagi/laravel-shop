<?php
namespace Modules\Users\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Auth;
class RegisterRequest extends FormRequest
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
            'name' => 'required|min:3|max:250',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|max:50',
        ];
    }
}