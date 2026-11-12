<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'product_name' => ['required', 'string', 'max:255'],
            'price'        => ['required', 'numeric', 'min:0'],
            'stock'        => ['required', 'integer', 'min:0'],
            'description'  => ['required', 'string'],
            'img_path'     => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048'],
        ];
    }

    public function messages(): array
    {
        return [
            'product_name.required' => '商品名は必須です。',
            'product_name.string'   => '商品名は文字列で入力してください。',
            'product_name.max'      => '商品名は255文字以内で入力してください。',
            
            'price.required'        => '価格は必須です。',
            'price.numeric'         => '価格は数値で入力してください。',
            'price.min'             => '価格は0円以上で入力してください。',
            
            'stock.required'        => '在庫数は必須です。',
            'stock.integer'         => '在庫数は整数で入力してください。',
            'stock.min'             => '在庫数は0以上で入力してください。',
            
            'description.required'  => '商品説明は必須です。',
            'description.string'    => '商品説明は文字列で入力してください。',
            
            'img_path.image'        => 'アップロードされたファイルは画像である必要があります。',
            'img_path.mimes'        => '画像は jpeg, png, jpg, gif, svg 形式を指定してください。',
            'img_path.max'          => '画像サイズは2MB以内でアップロードしてください。',
        ];
    }
}