<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class languageRequest extends FormRequest
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
            'name'=>'required |string||max:100',
            'abbr'=>'required |string|max:10',
            
            'direction'=>'required|in:rtl,ltr'


        ];
    }
    public function messages()
    {
        return [
            'required'    => 'هذ الحقل مطلوب',
            'in'          => 'القيم المدخلة غير صالحة ',
            'name.max'    => 'اسم اللغة   كبير جدا ',
            'abbr.string' => 'اختصار اللغة يجب ان يكون نص ',
            'abbr.max'    => 'اختصار اللغة كبير للغاية ',
            


        ];
    }
}
