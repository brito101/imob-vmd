<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class ClientRequest extends FormRequest
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
            'name' => 'required|min:3|max:191',
            'genre' => 'in:male,female,other',
            'document' => (!empty($this->request->all()['id']) ? 'nullable|min:11|max:14|unique:users,document,' . $this->request->all()['id'] : 'nullable|min:11|max:14|unique:users,document'),
            'document_secondary' => 'nullable|max:12',
            'document_secondary_complement' => 'nullable',
            'date_of_birth' => 'nullable|date_format:d/m/Y',
            'place_of_birth' => 'nullable',
            'civil_status' => 'nullable|in:married,separated,single,divorced,widower',
            'cover' => 'image',
            // Income
            'occupation' => 'nullable',
            'income' => 'nullable',
            'company_work' => 'nullable',
            // Address
            'zipcode' => 'nullable|min:8|max:10',
            'street' => 'nullable',
            'number' => 'nullable',
            'neighborhood' => 'nullable',
            'state' => 'nullable',
            'city' => 'nullable',
            // Contact
            'cell' => 'nullable',
            // Access
            'email' => (!empty($this->request->all()['id']) ? 'nullable|email|unique:users,email,' . $this->request->all()['id'] : 'nullable|email|unique:users,email'),
            // Spouse
            'type_of_communion' => 'required_if:civil_status,married,separated|in:Comunhão Universal de Bens,Comunhão Parcial de Bens,Separação Total de Bens,Participação Final de Aquestos',
            'spouse_name' => 'required_if:civil_status,married,separated|min:3|max:191',
            'spouse_genre' => 'required_if:civil_status,married,separated|in:male,female,other',
            'spouse_document' => 'required_if:civil_status,married,separated|min:11|max:14',
            'spouse_document_secondary' => 'required_if:civil_status,married,separated|min:8|max:12',
            'spouse_document_secondary_complement' => 'required_if:civil_status,married,separated',
            'spouse_date_of_birth' => 'required_if:civil_status,married,separated|date_format:d/m/Y',
            'spouse_place_of_birth' => 'required_if:civil_status,married,separated',
            'spouse_occupation' => 'required_if:civil_status,married,separated',
            'spouse_income' => 'required_if:civil_status,married,separated',
            'spouse_company_work' => 'required_if:civil_status,married,separated',

            // Broker
            'broker' => 'nullable|max:191',
            'creci' => 'nullable|max:191',
            'commission' => 'nullable|max:191',
            'max_budget' => 'nullable|max:191',
            'fgts' => 'nullable|max:191',
            'entry_value' => 'nullable|max:191',
            'bank_account' => 'nullable|max:191',
        ];
    }
}
