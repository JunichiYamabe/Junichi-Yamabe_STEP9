<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UserRequest extends FormRequest
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
        // 共通の基本ルール
        $rules = [
            'name'       => ['required', 'string', 'max:255'],
            // 漢字・ひらがなのみを許可する正規表現ルールを追加
            'name_kanji' => ['required', 'string', 'max:255', 'regex:/^[ぁ-ん一-龠々ー]+$/u'],
            // カタカナのみを許可する正規表現ルールを追加
            'name_kana'  => ['required', 'string', 'max:255', 'regex:/^[ァ-ヶー]+$/u'],
        ];

        // 登録時（POST）と更新時（PUT/PATCH）でメール等のルールを分岐
        if ($this->isMethod('put') || $this->isMethod('patch')) {
            // --- 更新時のルール ---
            $userId = Auth::id();
            // ログイン中の自分のIDを取得し、自分自身のメールアドレス重複は許可する
            $rules['email'] = ['required', 'email', 'max:255', 'unique:users,email,' . $userId];
            // パスワードは更新時任意にする場合（空でもOKにするなど）
            $rules['password'] = ['nullable', 'string', 'min:8', 'confirmed'];
        } else {
            // --- 新規登録時のルール ---
            $rules['email']    = ['required', 'email', 'max:255', 'unique:users,email'];
            $rules['password'] = ['required', 'string', 'min:8', 'confirmed'];
        }

        return $rules;
    }

    public function messages(): array
    {
        return [
            'name.required' => '氏名は必須です。',
            'name.string' => '氏名は文字列で入力してください。',
            'name.max' => '氏名は255文字以内で入力してください。',
            'name_kanji.required' => '氏名（漢字・ひらがな）は必須です。',
            'name_kanji.string' => '氏名（漢字・ひらがな）は文字列で入力してください。',
            'name_kanji.max' => '氏名（漢字・ひらがな）は255文字以内で入力してください。',
            'name_kana.required' => '氏名（カナ）は必須です。',
            'name_kana.string' => '氏名（カナ）は文字列で入力してください。',
            'name_kana.max' => '氏名（カナ）は255文字以内で入力してください。',
            'name_kanji.regex' => '氏名（漢字・ひらがな）には、漢字およびひらがなのみを入力してください。',
            'name_kana.regex' => '氏名（カナ）には、カタカナのみを入力してください。',
        ];
    }
}
