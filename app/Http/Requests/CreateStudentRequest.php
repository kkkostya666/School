<?php

namespace App\Http\Requests;

use App\Enums\UserRole;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreateStudentRequest extends FormRequest
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
    public function rules(): array
    {
        return [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'date_of_birth' => 'required|date|before:today|after:1900-01-01',
            'surname' => 'nullable|string|max:255',
            'group_id' => 'required|exists:groups,id',
            'email' => 'required|email|unique:users,email,',
            'password' => 'required|string|min:5|confirmed',
            'role' => [Rule::enum(UserRole::class)],
            'address.city' => 'required|string|max:255',
            'address.street' => 'required|string|max:255',
            'address.house' => 'nullable|string|max:255',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ];
    }
}
