<?php

namespace LaraDev\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use LaraDev\Support\Utils;

class PropertyRequest extends FormRequest
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
            'user' => 'required',
            'category' => 'required|in:residential_property,commercial_industrial,terrain',
            'type' => 'required|in:home,roof,apartment,studio,kitnet,commercial_room,deposit_shed,commercial_point,terrain',
            'sale_price' => 'required_if:sale,on',
            'rent_price' => 'required_if:rent,on',
            'tribute' => 'required',
            'condominium' => 'required',
            'description' => 'required',
            'bedrooms' => 'required',
            'suites' => 'required',
            'bathrooms' => 'required',
            'rooms' => 'required',
            'garage' => 'required',
            'garage_covered' => 'required',
            'area_total' => 'required',
            'area_util' => 'required',

            // Address
            'zipcode' => 'required|min:8|max:9',
            'street' => 'required',
            'number' => 'required',
            'neighborhood' => 'required',
            'state' => 'required',
            'city' => 'required',
        ];
    }

    /**
     * método mágico do request para fazer as validações
     */
    protected function prepareForValidation()
    {
        $this->merge([
        ]);
    }
}
