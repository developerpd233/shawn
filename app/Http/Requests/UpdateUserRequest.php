<?php

namespace App\Http\Requests;

use App\Models\User;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateUserRequest extends FormRequest
{
    public function authorize()
    {
        // return Gate::allows('user_edit');
        return true;
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'required',
            ],
            'lastname' => [
                'string',
                'required',
            ],
            'email' => [
                'required',
                'unique:users,email,' . request()->route('user')->id,
            ],
            // 'roles.*' => [
            //     'integer',
            // ],
            // 'roles' => [
            //     'required',
            //     'array',
            // ],
            'phone' => [
                'string',
                'min:8',
                'max:20',
                'required',
            ],
            'country' => [
                'string',
                'max:100',
                'required',
            ],
            'city' => [
                'string',
                'max:100',
                'required',
            ],
            'address_1' => [
                'string',
                'max:255',
                'required',
            ],
            'address_2' => [
                'string',
                'max:255',
                'nullable',
            ],
            // 'kyc' => [
            //     'string',
            //     'required',
            // ],
            // 'image' => [
            //     'string',
            //     'max:255',
            //     'nullable',
            // ],
        ];
    }
}
