<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'name_kanji' => ['required', 'string', 'max:255', 'regex:/^[\p{Han}\p{Hiragana}ー]+$/u'],
            'name_kana' => ['required', 'string', 'max:255', 'regex:/^[\p{Katakana}ー]+$/u'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ], [
            //エラーメッセージ
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
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @return User
     */
    protected function create(UserRequest $request)
    {
        $data = $request->validated();
        return User::create([
            'name' => $data['name'],
            'name_kanji' => $data['name_kanji'],
            'name_kana' => $data['name_kana'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }

    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    public function register(UserRequest $request)
    {
        $this->validator($request->all())->validate();
        $this->create($request);
        return redirect()->route('login');
    }
}
