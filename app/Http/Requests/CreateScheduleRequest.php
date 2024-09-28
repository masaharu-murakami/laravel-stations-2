<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Carbon\Carbon;

class CreateScheduleRequest extends FormRequest
{
    public function rules()
    {
        return [
            'movie_id' => ['required', 'exists:movies,id'],
            'start_time_date' => [
                'required',
                'date_format:Y-m-d',
                'before_or_equal:end_time_date',
            ],
            'start_time_time' => [
                'required',
                'date_format:H:i',
                'before:end_time_time',
            ],
            'end_time_date' => [
                'required',
                'date_format:Y-m-d',
                'after_or_equal:start_time_date',
            ],
            'end_time_time' => [
                'required',
                'date_format:H:i',
                'after:start_time_time',
            ],
        ];
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            $startTimeDate = $this->start_time_date;
            $startTimeTime = $this->start_time_time;
            $endTimeDate = $this->end_time_date;
            $endTimeTime = $this->end_time_time;

            if ($startTimeDate && $startTimeTime && $endTimeDate && $endTimeTime) {
                try {
                    $startTime = Carbon::createFromFormat('Y-m-d H:i', $startTimeDate . ' ' . $startTimeTime);
                    $endTime = Carbon::createFromFormat('Y-m-d H:i', $endTimeDate . ' ' . $endTimeTime);
                } catch (\Exception $e) {
                    $validator->errors()->add('start_time', '開始日時のフォーマットが無効です。');
                    $validator->errors()->add('end_time', '終了日時のフォーマットが無効です。');
                    return;
                }

                // 開始時刻と終了時刻の差が5分未満の場合
                if ($startTime->diffInMinutes($endTime) < 6) {
                    $validator->errors()->add('start_time_time', '上映時間は5分以上でなければなりません。');
                    $validator->errors()->add('end_time_time', '上映時間は5分以上でなければなりません。');
                }
            }
        });
    }

    public function authorize()
    {
        return true;
    }
}
