<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OfferRequest extends FormRequest
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
            'photo'=>'required',
            'name_en'=>'required|max:100',
            'name_ar'=>'required|max:100',
            'price'=>'required|numeric',
            'details_en'=>'required',
            'details_ar'=>'required',
        ]; 
    }
    public function messages()
    {
        return [ 'name.required'=>trans('messeges.offer name required'),
        'name_en.unique'=>__('messeges.offer name must be unique'),
        'name_ar.unique'=>__('messeges.offer name must be unique'),
        'price.required'=>__('messeges.offer price required'),
        'price.numeric'=>__('messeges.offer price must be numbers'),
        'details_en.required'=>__('messeges.offer details required'),
        'details_ar.required'=>__('messeges.offer details required'),
    ];
    }
}
