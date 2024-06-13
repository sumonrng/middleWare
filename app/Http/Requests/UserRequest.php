<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    protected $stopOnFirstFailure = true;
    public function attributes()
    {
        return [
            'f_name'=>'Full Name',
            'email' => 'Email',
            'age' => 'Age',
            'role' => 'Role',
            'password' => 'Password',
            'password_confirmation' => 'Password Confirmation',
        ];
    }
    public function rules(): array
    {
        return [
            'f_name' => 'required',
            'email' =>'required|email',
            'age' =>'required',
            'role' => 'required',
            'password'=> 'required',
            'password_confirmation' => 'required|same:password'
        ];
    }
    protected function prepareForValidation() : void
    {
        $this->merge([
            'email' => strtolower($this->email)
        ]);
    }
}
