<?php

namespace App\Http\Requests\Admin\Users;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

/**
 * Class UpdateRequest
 * @package App\Http\Requests\Admin\Users
 * @property User $user
 */
class UpdateRequest extends FormRequest
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
            'name' => 'required|string|max:225',
            'email' => 'required|string|email|unique:users,id,' . $this->user->id,
            'status' => [
                'required','string',Rule::in([
                    User::STATUS_WAIT,
                    User::STATUS_ACTIVE
                ])
            ]
        ];
    }
}
