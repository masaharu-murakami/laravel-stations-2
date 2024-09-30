<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateAdminReservationRequest extends FormRequest
{
    // バリデーションルールを定義
    public function rules()
    {
        return [
            'movie_id' => 'required|exists:movies,id', // 映画ID
            'schedule_id' => 'required|exists:schedules,id', // スケジュールID
            'sheet_id' => 'required|exists:sheets,id', // 座席ID
            'name' => 'required|string|max:255', // 名前
            'email' => 'required|email|max:255', // メールアドレス
            //'date' => 'required|date', // 日付
        ];
    }

    // リクエストの承認
    public function authorize()
    {
        return true; // 誰でもこのリクエストを承認
    }

    // バリデーションエラーメッセージのカスタマイズ
    // public function messages()
    // {
    //     return [
    //         'movie_id.required' => '映画は必須です。',
    //         'schedule_id.required' => 'スケジュールは必須です。',
    //         'sheet_id.required' => '座席は必須です。',
    //         'name.required' => '名前は必須です。',
    //         'email.required' => 'メールアドレスは必須です。',
    //         'date.required' => '日付は必須です。',
    //         'email.email' => '正しいメールアドレスを入力してください。',
    //         'date.date' => '正しい日付を入力してください。',
    //     ];
    // }
}
