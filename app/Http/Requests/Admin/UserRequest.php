<?php

namespace LaraDev\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'=>'required|min:5|max:150',
            'genre' => 'in:male,female,other',
            'document' => 'required|min:11|max:14|',
            'document_secondary' => 'required|min:8|max:12',
            'document_secondary_complement' => 'required',
            'date_of_birth' => 'required|date_format:d/m/Y',
            'place_of_birth' => 'required',
            'civil_status' => 'required|in:married,separated,divorced,widower',

            /** Income */
            'occupation' => 'required',
            'income' => 'required',
            'company_work' => 'required',

            /** Address */
            'zipcode' => 'required|min:8|max:9',
            'street' => 'required',
            'number' => 'required',
            'complement' => 'required',
            'neighborhood' => 'required',
            'state' => 'required',
            'city' => 'required',

            /** Contact */
            'cell' => 'required',

            /** Access */
            'email' => 'required|email',
            'password' => 'required',
            'password_confirm' => 'required|same:password',

            /** Spouse */
            'type_of_communion' => 'required_if:civil_status,married,separated|in:Comunhão Universal de Bens,
            Comunhão Parcial de Bens,Separação Total de Bens,Participação Final de Aquestos',
            'spouse_name'=>'required_if:civil_status,married,separated|min:5|max:150',
            'spouse_genre' => 'required_if:civil_status,married,separated|in:male,female,other',
            'spouse_document' => 'required_if:civil_status,married,separated|min:11|max:14|',
            'spouse_document_secondary' => 'required_if:civil_status,married,separated|min:8|max:12',
            'spouse_document_secondary_complement' => 'required_if:civil_status,married,separated|',
            'spouse_date_of_birth' => 'required_if:civil_status,married,separated|date_format:d/m/Y',
            'spouse_place_of_birth' => 'required_if:civil_status,married,separated',
            'spouse_occupation' => 'required_if:civil_status,married,separated',
            'spouse_income' => 'required_if:civil_status,married,separated',
            'spouse_company_work' => 'required_if:civil_status,married,separated',
        ];
    }
}
