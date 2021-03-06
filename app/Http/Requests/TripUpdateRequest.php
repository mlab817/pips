<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TripUpdateRequest extends FormRequest
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

    public function prepareForValidation()
    {
        $this->merge([
            'right_of_way' => [
                'y2017' => str_replace(',', '', $this->right_of_way['y2017']),
                'y2018' => str_replace(',', '', $this->right_of_way['y2018']),
                'y2019' => str_replace(',', '', $this->right_of_way['y2019']),
                'y2020' => str_replace(',', '', $this->right_of_way['y2020']),
                'y2021' => str_replace(',', '', $this->right_of_way['y2021']),
                'y2022' => str_replace(',', '', $this->right_of_way['y2022']),
                'affected_households' => $this->right_of_way['affected_households'],
            ],
            'resettlement_action_plan' => [
                'y2017' => str_replace(',', '', $this->resettlement_action_plan['y2017']),
                'y2018' => str_replace(',', '', $this->resettlement_action_plan['y2018']),
                'y2019' => str_replace(',', '', $this->resettlement_action_plan['y2019']),
                'y2020' => str_replace(',', '', $this->resettlement_action_plan['y2020']),
                'y2021' => str_replace(',', '', $this->resettlement_action_plan['y2021']),
                'y2022' => str_replace(',', '', $this->resettlement_action_plan['y2022']),
                'affected_households' => $this->resettlement_action_plan['affected_households'],
            ],
            'region_infrastructures' => collect($this->region_infrastructures)->map(function ($ri) {
                return [
                    'region_id' => $ri['region_id'],
                    'y2016'     => str_replace(',', '', $ri['y2016']),
                    'y2017'     => str_replace(',', '', $ri['y2017']),
                    'y2018'     => str_replace(',', '', $ri['y2018']),
                    'y2019'     => str_replace(',', '', $ri['y2019']),
                    'y2020'     => str_replace(',', '', $ri['y2020']),
                    'y2021'     => str_replace(',', '', $ri['y2021']),
                    'y2022'     => str_replace(',', '', $ri['y2022']),
                    'y2023'     => str_replace(',', '', $ri['y2023']),
                ];
            }),
            'fs_infrastructures' => collect($this->fs_infrastructures)->map(function ($ri) {
                return [
                    'fs_id' => $ri['fs_id'],
                    'y2016'     => str_replace(',', '', $ri['y2016']),
                    'y2017'     => str_replace(',', '', $ri['y2017']),
                    'y2018'     => str_replace(',', '', $ri['y2018']),
                    'y2019'     => str_replace(',', '', $ri['y2019']),
                    'y2020'     => str_replace(',', '', $ri['y2020']),
                    'y2021'     => str_replace(',', '', $ri['y2021']),
                    'y2022'     => str_replace(',', '', $ri['y2022']),
                    'y2023'     => str_replace(',', '', $ri['y2023']),
                ];
            }),
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
            'infrastructure_sectors'                    => ['required','array'],
            'infrastructure_subsectors'                 => ['nullable','array'],
            'other_infrastructure'                      => ['required_if:infrastructure_subsectors.*,in:65'],
            'risk'                                      => ['required','string'],
            'has_row'                                   => ['required','boolean'],
            'right_of_way.*'                            => ['required_if:has_row,true'],
            'right_of_way.y2017'                        => ['required','gte:0'],
            'right_of_way.y2018'                        => ['required','gte:0'],
            'right_of_way.y2019'                        => ['required','gte:0'],
            'right_of_way.y2020'                        => ['required','gte:0'],
            'right_of_way.y2021'                        => ['required','gte:0'],
            'right_of_way.y2022'                        => ['required','gte:0'],
            'right_of_way.affected_households'          => ['required'],
            'has_rap'                                   => ['required','boolean'],
            'resettlement_action_plan.*'                => ['required_if:has_rap,true'],
            'resettlement_action_plan.y2017'            => ['required','gte:0'],
            'resettlement_action_plan.y2018'            => ['required','gte:0'],
            'resettlement_action_plan.y2019'            => ['required','gte:0'],
            'resettlement_action_plan.y2020'            => ['required','gte:0'],
            'resettlement_action_plan.y2021'            => ['required','gte:0'],
            'resettlement_action_plan.y2022'            => ['required','gte:0'],
            'resettlement_action_plan.affected_households'=> ['required'],
            'fs_infrastructures'                        => ['required'],
            'fs_infrastructures.*.fs_id'                => ['required'],
            'fs_infrastructures.*.y2016'                => ['required','gte:0'],
            'fs_infrastructures.*.y2017'                => ['required','gte:0'],
            'fs_infrastructures.*.y2018'                => ['required','gte:0'],
            'fs_infrastructures.*.y2019'                => ['required','gte:0'],
            'fs_infrastructures.*.y2020'                => ['required','gte:0'],
            'fs_infrastructures.*.y2021'                => ['required','gte:0'],
            'fs_infrastructures.*.y2022'                => ['required','gte:0'],
            'fs_infrastructures.*.y2023'                => ['required','gte:0'],
            'region_infrastructures'                    => ['required'],
            'region_infrastructures.*.region_id'        => ['required'],
            'region_infrastructures.*.y2016'            => ['required','gte:0'],
            'region_infrastructures.*.y2017'            => ['required','gte:0'],
            'region_infrastructures.*.y2018'            => ['required','gte:0'],
            'region_infrastructures.*.y2019'            => ['required','gte:0'],
            'region_infrastructures.*.y2020'            => ['required','gte:0'],
            'region_infrastructures.*.y2021'            => ['required','gte:0'],
            'region_infrastructures.*.y2022'            => ['required','gte:0'],
            'region_infrastructures.*.y2023'            => ['required','gte:0'],
        ];
    }
}
