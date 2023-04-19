<?php

namespace App\Http\Requests\Admin\Supporter\PreInterviewSettingRequests;


use App\Http\Requests\CustomFormRequest;
use Illuminate\Validation\Rule;

class UpdateRequest extends CustomFormRequest
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

    public function attributes()
    {
        return [
            'initial_meeting_comment' => '初回面談について',
            'web_meeting_fee' => 'WEB事前面談料金',
            'facetoface_meeting_fee' => '対面事前面談料金'
        ];
    }

    public function rules()
    {
        return [
            'initial_meeting_comment' => 'required',
            'web_meeting_fee' => 'nullable | integer',
            'facetoface_meeting_fee' => 'nullable | integer'
        ];
    }
}
