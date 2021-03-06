<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReviewUpdateRequest extends FormRequest
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
        $projectIdRequired = 'required|unique:reviews,project_id,' . $this->project_id . ',project_id';
        return [
            'project_id'        => $projectIdRequired,
            'pip'               => 'required|bool',
            'pip_typology_id'   => 'required',
            'cip'               => 'required|bool',
            'cip_type_id'       => 'required',
            'trip'              => 'required|bool',
            'ifp'               => 'required|bool',
            'readiness_level_id'=> 'required',
//            'pipol_title'       => 'nullable',
//            'pipol_code'        => 'nullable',
//            'pipol_url'         => 'nullable',
//            'pipol_encoded'     => 'nullable|bool',
//            'pipol_finalized'   => 'nullable|bool',
//            'pipol_endorsed'    => 'nullable|bool',
//            'pipol_validated'   => 'nullable|bool',
            'comments'          => 'nullable',
        ];
    }
}
