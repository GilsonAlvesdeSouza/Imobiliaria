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
        $rules = [
            'name' => 'required|min:3|max:191',
            'genre' => 'in:male,female,other',
            'document' => (!empty($this->request->all()['id']) ? 'required|min:11|max:14|unique:users,document,' . $this->request->all()['id'] : 'required|min:11|max:14|unique:users,document'),
            'document_secondary' => 'required|min:8|max:12',
            'document_secondary_complement' => 'required',
            'date_of_birth' => 'required|date_format:d/m/Y',
            'place_of_birth' => 'required',
            'civil_status' => 'required|in:married,separated,single,divorced,widower',
            'cover' => 'image',

            // Income
            'occupation' => 'required',
            'income' => 'required',
            'company_work' => 'required',

            // Address
            'zipcode' => 'required|min:8|max:9',
            'street' => 'required',
            'number' => 'required',
            'neighborhood' => 'required',
            'state' => 'required',
            'city' => 'required',

            // Contact
            'cell' => 'required',

            // Access
            'email' => (!empty($this->request->all()['id']) ? 'required|email|unique:users,email,' . $this->request->all()['id'] : 'required|email|unique:users,email'),
            'password' => 'required|min:8',
            'password_confirm' => 'required|same:password',
        ];

        // Spouse
        if (in_array($this->request->all()['civil_status'], ['married', 'separated'])) {
            $rules['type_of_communion'] = 'required|in:Comunhão Universal de Bens,Comunhão Parcial de Bens,Separação Total de Bens,Participação Final de Aquestos';
            $rules['spouse_name'] = 'required|min:3|max:191';
            $rules['spouse_genre'] = 'required|in:male,female,other';
            $rules['spouse_document'] = (!empty($this->request->all()['id']) ? 'required|min:11|max:14|unique:users,spouse_document,' . $this->request->all()['id'] : 'required|min:11|max:14|unique:users,spouse_document');
            $rules['spouse_document_secondary'] = 'required|min:8|max:12';
            $rules['spouse_document_secondary_complement'] = 'required';
            $rules['spouse_date_of_birth'] = 'required|date_format:d/m/Y';
            $rules['spouse_place_of_birth'] = 'required';
            $rules['spouse_occupation'] = 'required';
            $rules['spouse_income'] = 'required';
            $rules['spouse_company_work'] = 'required';
        }

        return $rules;
    }
}
