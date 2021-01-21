<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SaveEventRequest extends FormRequest
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
            'organization_name' => 'required|max:100',
            'admin_email_address' => 'required|email|max:100',
            'title' => 'required|max:100',
            'category_ids' => 'required',
            'type_id' => 'required',
            'contact_person' => 'required',
            'enquireis_email_address' => 'required|email|max:100',
            'website_address' => 'required|max:100',
            'start_date' => 'required',
            'end_date' => 'required',
            'abstract' => 'required|max:100',
            'short_description' => 'required|max:500',
            'keywords' => 'required||max:500',
            'publisher_id' => 'required',
            'other' => Rule::requiredIf( function (){
                return $this->publisher_id == 'other';
            })
        ];
    }
}
