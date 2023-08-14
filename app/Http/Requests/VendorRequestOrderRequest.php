<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VendorRequestOrderRequest extends FormRequest
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
            'pk_vendors'      => 'required',
            'po_number'    => 'required',
            'delivery_date_request' => 'required',
            'pk_locations'  => 'required',
            'address' => $this->addressRule(),
            'city' => $this->addressRule(),
            'zip' => $this->addressRule(),
            'state_name' => $this->addressRule(),
            'country_name' => $this->addressRule(),
            "item_name"         => "required|array",
            "item_name.*"         => "required|string",  
        ];
    }

    public function addressRule()
    {
        return $this->input('pk_locations') === 'other' ? 'required' : '';
    }
}
