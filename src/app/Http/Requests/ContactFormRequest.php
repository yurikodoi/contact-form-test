<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactFormRequest extends FormRequest
{
    /**
     * 誰でもこのフォームを使えるように許可します
     */
    public function authorize()
    {
        return true;
    }

    /**
     * 入力ルールの設定
     */
    public function rules()
    {
        return [
            'last_name'    => 'required',
            'first_name'   => 'required',
            'gender'       => 'required',
            'email'        => 'required|email',
            'phone1'       => 'required|numeric|digits_between:1,5',
            'phone2'       => 'required|numeric|digits_between:1,5',
            'phone3'       => 'required|numeric|digits_between:1,5',
            'address'      => 'required',
            'inquiry_type' => 'required',
            'message'      => 'required|max:120',
            'building'     => 'nullable|string|max:255',
        ];
    }

    /**
     * 評価項目で指定された日本語エラーメッセージ
     */
    public function messages()
    {
        return [
            'last_name.required'    => '姓を入力してください',
            'first_name.required'   => '名を入力してください',
            'gender.required'       => '性別を選択してください',
            'email.required'        => 'メールアドレスを入力してください',
            'email.email'           => 'メールアドレスはメール形式で入力してください',
            'phone1.required'       => '電話番号を入力してください',
            'phone1.numeric'        => '電話番号は 半角英数字で入力してください',
            'phone1.digits_between' => '電話番号は 5桁まで数字で入力してください',
            'phone2.required'       => '電話番号を入力してください',
            'phone2.numeric'        => '電話番号は 半角英数字で入力してください',
            'phone2.digits_between' => '電話番号は 5桁まで数字で入力してください',
            'phone3.required'       => '電話番号を入力してください',
            'phone3.numeric'        => '電話番号は 半角英数字で入力してください',
            'phone3.digits_between' => '電話番号は 5桁まで数字で入力してください',

            'address.required'      => '住所を入力してください',
            'inquiry_type.required' => 'お問い合わせの種類を選択してください',
            'message.required'      => 'お問い合わせ内容を入力してください',
            'message.max'           => 'お問い合わせ内容は120文字以内で入力してください',
        ];
    }
}