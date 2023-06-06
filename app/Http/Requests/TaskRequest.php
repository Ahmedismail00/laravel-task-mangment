<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TaskRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        switch ($this->method()) {
            case 'GET':
            case 'POST':{
                    return [
                        'name' => 'required|string',
                        'priority' => 'required|integer',
                        'project_id' => 'required|integer',
                    ];
                }
            case 'PUT':{
                    return [
                        'name' => 'required|string',
                        'priority' => 'required|integer',
                        'project_id' => 'required|integer',
                    ];
                }
            case 'DELETE':{
                return [];
            }
        }
    }
}
