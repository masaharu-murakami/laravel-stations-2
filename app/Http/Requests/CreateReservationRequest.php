<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReservationRequest extends FormRequest
{
    public function rules()
    {
        return [
            'movie_id' => 'required|exists:movies,id',
            'schedule_id' => 'required|exists:schedules,id',
            'sheet_id' => 'required|exists:sheets,id',
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
        ];
    }

    public function authorize()
    {
        return true; // 認可のロジックを追加する場合は変更
    }
}
