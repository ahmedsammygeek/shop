<?php

namespace App\Http\Requests\Dashboard\Products;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
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
            'barcode' => 'required',
            'name.ar' => 'required', 
            'name.en' => 'required', 
            'category_id' => 'required' , 
            'brand_id' => 'nullable' , 
            'description.ar' => 'nullable' ,  
            'description.en' => 'nullable' ,  
            'min_description.ar' => 'nullable' , 
            'min_description.en' => 'nullable' , 
            'image' => 'required|mimes:jpeg,png,gif,avif' , 
            'images' => 'nullable'  , 
            'images.*' => 'required|mimes:jpeg,png,gif,avif' , 
            'price.*' => 'required' , 
        ];
    }
}
