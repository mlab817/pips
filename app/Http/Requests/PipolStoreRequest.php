<?php

namespace App\Http\Requests;

use App\Models\Pipol;
use Illuminate\Foundation\Http\FormRequest;

class PipolStoreRequest extends FormRequest
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

    public function removeUrl($url)
    {
        $baseUrl = [
            'https://pipol.neda.gov.ph/editproject/',
            'http://pipol.neda.gov.ph/editproject/',
            'https://pipolv2.neda.gov.ph/editproject/',
            'http://pipolv2.neda.gov.ph/editproject/',
        ];

        foreach ($baseUrl as $removeUrl) {
            $url = str_replace($removeUrl, '', $url);
        }

        return $url;
    }

    public function prepareForValidation()
    {
        $this->merge([
            'pipol_url' => $this->removeUrl($this->pipol_url),
        ]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'pipol_code'        => 'required|string',
            'project_title'     => 'required|string',
            'submission_status' => 'required|string',
            'pipol_url'         => 'required|string',
        ];
    }
}
