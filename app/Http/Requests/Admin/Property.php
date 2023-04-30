<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class Property extends FormRequest
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

    public function prepareForValidation()
    {
        $this->merge([
            'broker' => $this->broker ? $this->broker : Auth::user()->id,
        ]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'user' => 'required|exists:users,id',
            'category' => 'required|max:191',
            'type' => 'required|max:191',
            'sale_price' => 'required_if:sale,on',
            'rent_price' => 'required_if:rent,on',
            'tribute' => 'required',
            'condominium' => 'required',
            'description' => 'required',
            'bedrooms' => 'required|integer',
            'suites' => 'required|integer',
            'bathrooms' => 'required|integer',
            'rooms' => 'required|integer',
            'garage' => 'required|integer',
            'garage_covered' => 'required|integer',
            'area_total' => 'required|integer',
            'area_util' => 'required|integer',
            // Address
            'zipcode' => 'required|min:8|max:10',
            'street' => 'required|max:191',
            'number' => 'required|max:191',
            'neighborhood' => 'required|max:191',
            'state' => 'required|max:191',
            'city' => 'required|max:191',
            'title' => 'required|max:191',
            'broker' => 'required|exists:users,id',
        ];
    }

    public function messages()
    {
        return [
            'user.required' => 'Campo proprietário obrigatório',
        ];
    }
}
