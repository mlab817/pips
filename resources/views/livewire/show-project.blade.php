<div>
    <div class="Subhead Subhead--spacious">
        <div class="Subhead-heading">{{ __("General Information") }}</div>
    </div>

    <form wire:submit.prevent="updateOffice">
        <div id="office">
            <dl class="form-group d-inline-block my-0">
                <dt class="input-label">
                    <label for="office_id">Office</label>
                </dt>
                <dd>
                    <select class="form-select" name="office_id" wire:model="officeId">
                        <option value="">Select Office</option>
                        @foreach($offices as $option)
                            <option value="{{ $option->id }}">{{ $option->id .' - '. $option->acronym }}</option>
                        @endforeach
                    </select>

                    @if($officeId != $project->office_id)
                        <button class="btn ml-2" type="submit">Save</button>
                    @endif
                </dd>
            </dl>
        </div>
    </form>

    <div class="my-3" id="pap"></div>

    <form wire:submit.prevent="updatePapType">
        <dl class="form-group d-inline-block my-0">
            <dt class="input-label">
                <label for="rename-field">Program or Project</label>
            </dt>
            <dd>
                @foreach($pap_types as $pap_type)
                    <div class="form-checkbox">
                        <label for="pap_type_{{$pap_type->id}}">
                            <input wire:model="papTypeId" class="form-checkbox-details-trigger" type="radio" id="pap_type_{{$pap_type->id}}" name="pap_type_id" value="{{ $pap_type->id }}">
                            {{ $pap_type->name }}
                            <p class="note">
                                {{ $pap_type->description }}
                            </p>
                            @if($pap_type->id ==1)
                                <span class="form-checkbox-details text-normal d-block">
                                    <span>Regular Program</span>
                                    <select @if($papTypeId == 2) disabled @endif class="form-select" name="regular_program" id="regular_program">
                                        <option value="0">No</option>
                                        <option value="1">Yes</option>
                                    </select>
                                </span>
                            @endif
                        </label>
                    </div>
                @endforeach

                @if($project->pap_type_id != $papTypeId)
                <button class="btn ml-3" type="submit">Save</button>
                @endif
            </dd>
        </dl>
    </form>

    <div class="my-3"></div>

    <form wire:submit.prevent="updateHasInfra">
        <dl class="form-group d-inline-block my-0">
            <dt class="input-label">
                <label for="rename-field">Does this PAP have INFRASTRUCTURE component/s?</label>
            </dt>
            <dd>
                <div class="form-checkbox ">
                    <label>
                        <input wire:model="hasInfra" class="form-checkbox-details-trigger" type="radio" id="has_infra_1" name="has_infra" value="1">
                        Yes
                        <p class="note">
                            Ticking yes will prequalify the PAP into the Three-Year Rolling Infrastructure Program (TRIP).
                            You will also need to provide infrastructure profile for the PAP to be considered for inclusion in the TRIP.
                        </p>
                    </label>
                </div>
                <div class="form-checkbox ">
                    <label>
                        <input wire:model="hasInfra" class="form-checkbox-details-trigger" type="radio" id="has_infra_0" name="has_infra" value="0">
                        No
                        <p class="note">
                            Ticking no will disqualify the PAP from the Three-Year Rolling Infrastructure Program (TRIP).
                            The infrastructure profile previously supplied will not be deleted but will no longer be viewable
                            until the yes option is ticked.
                        </p>
                    </label>
                </div>

                @if($project->has_infra != $hasInfra)
                <button class="btn ml-3" type="submit">Save</button>
                @endif
            </dd>
        </dl>
    </form>

    <div class="my-3"></div>

    <form wire:submit.prevent="updateProjectBases">
        <dl class="form-group d-inline-block my-0">
            <dt class="input-label">
                <label>Basis for Implementation</label>
            </dt>
            <dd>
                @foreach($bases as $key => $option)
                    <div class="form-checkbox">
                        <label for="basis_{{ $option->id }}">
                            <input
                                type="checkbox"
                                id="basis_{{ $option->id }}"
                                name="bases[]"
                                value="{{ $option->id }}"
                                wire:model="projectBases">
                            {{ $option->name }}
                            <p class="note">
                                {{ $option->description }}
                            </p>
                        </label>
                    </div>
                @endforeach
                <button class="btn ml-3" type="submit">Save</button>
            </dd>
        </dl>
    </form>

    <div class="my-3"></div>

    <form wire:submit.prevent="updateDescription">
        <dl class="form-group my-0">
            <dt class="input-label">
                <label for="">Description</label>
            </dt>
            <dd class="form-group-body">
                <textarea wire:model="description" class="form-control input-contrast" id="mde-description" name="description"></textarea>

                @push('scripts')
                    <script>
                        const mdeDescription = new EasyMDE({
                            element: document.getElementById('mde-description'),
                            maxHeight: '120px'
                        });
                    </script>
                @endpush

                @if($description != optional($project->description)->description)
                    <div class="d-flex mt-3">
                        <span class="flex-auto"></span>
                        <button class="btn ml-3" type="submit" id="submit-description">Save</button>
                    </div>
                @endif
            </dd>
        </dl>
    </form>

    <div class="my-3"></div>

    <form wire:submit.prevent="updateExpectedOutputs">
        <dl class="form-group my-0">
            <dt class="input-label">
                <label for="">Expected Outputs</label>
            </dt>
            <dd class="form-group-body">
                <textarea wire:model="expectedOutputs" class="form-control input-contrast" id="mde-expected-outputs" name="expected_outputs"></textarea>

                @push('scripts')
                    <script>
                        const mdeExpectedOutputs = new EasyMDE({
                            element: document.getElementById('mde-expected-outputs'),
                            maxHeight: '120px'
                        });
                    </script>
                @endpush

                @if($expectedOutputs != optional($project->expected_output)->expected_outputs)
                    <div class="d-flex mt-3">
                        <span class="flex-auto"></span>
                        <button class="btn ml-3" type="submit">Save</button>
                    </div>
                @endif
            </dd>
        </dl>
    </form>

    <div class="my-3"></div>

    <form wire:submit.prevent="updateTotalProjectCost">
        <dl class="form-group my-0">
            <dt class="input-label">
                <label for="">Total Project Cost</label>
            </dt>
            <dd class="form-group-body" x-data="{ isEditing: false, totalProjectCost: @entangle('totalProjectCost') }">
                <input x-show="!isEditing" @click="isEditing = true; $nextTick(() => $refs.totalProjectCost.focus());" type="text" class="form-control input-contrast" readonly x-bind:value="totalProjectCost.toLocaleString()">
                <input x-cloak x-show="isEditing" @click.away="isEditing = false" type="number" wire:model="totalProjectCost" class="form-control input-contrast" x-ref="totalProjectCost" name="total_project_cost">
                @if($project->total_project_cost != $totalProjectCost)
                    <button class="btn" type="submit">Save</button>
                @endif
                <p class="note">
                    For projects, the total project cost is the total cost of the project including funding years beyond the plan period.
                    For programs, the total project cost is the total cost for the plan period only.
                </p>
            </dd>
        </dl>
    </form>

    <div class="my-3"></div>

    <form wire:submit.prevent="updateProjectStatus">
        <div>
            <dl class="form-group d-inline-block my-0">
                <dt class="input-label">
                    <label for="office_id">Project Status</label>
                </dt>
                <dd>
                    <select class="form-select" name="project_status_id" wire:model="projectStatus">
                        <option value="">Select Status</option>
                        @foreach($project_statuses as $option)
                            <option value="{{ $option->id }}">{{ $option->id .' - '. $option->name }}</option>
                        @endforeach
                    </select>

                    @if($projectStatus != $project->project_status_id)
                        <button class="btn ml-2" type="submit">Save</button>
                    @endif
                </dd>
            </dl>
        </div>
    </form>

    <div class="Subhead Subhead--spacious my-3">
        <div class="Subhead-heading">{{ __("Other PAP Information") }}</div>
    </div>

    <form wire:submit.prevent="updateResearch">
        <div>
            <dl class="form-group d-inline-block my-0">
                <dt class="input-label">
                    <label for="research">Is it a Research and Development Program/Project?</label>
                </dt>
                <dd>
                    <select class="form-select" name="research" wire:model="research">
                        @foreach($booleanOptions as $key => $option)
                            <option value="{{ $key }}">{{ $key . ' - ' . $option}}</option>
                        @endforeach
                    </select>

                    @if($research != $project->research)
                        <button class="btn ml-2" type="submit">Save</button>
                    @endif
                </dd>
            </dl>
        </div>
    </form>

    <div class="my-3"></div>

    <form wire:submit.prevent="updateIct">
        <div>
            <dl class="form-group d-inline-block my-0">
                <dt class="input-label">
                    <label for="research">Is it an ICT
                        Program/Project?</label>
                </dt>
                <dd>
                    <select class="form-select" name="research" wire:model="ict">
                        @foreach($booleanOptions as $key => $option)
                            <option value="{{ $key }}">{{ $key . ' - ' . $option}}</option>
                        @endforeach
                    </select>

                    @if($ict != $project->ict)
                        <button class="btn ml-2" type="submit">Save</button>
                    @endif
                </dd>
            </dl>
        </div>
    </form>

    <div class="my-3"></div>

    <form wire:submit.prevent="updateCovid">
        <div>
            <dl class="form-group d-inline-block my-0">
                <dt class="input-label">
                    <label for="research">Is it responsive to
                        COVID-19/New Normal Intervention?</label>
                </dt>
                <dd>
                    <select class="form-select" name="research" wire:model="covid">
                        @foreach($booleanOptions as $key => $option)
                            <option value="{{ $key }}">{{ $key . ' - ' . $option}}</option>
                        @endforeach
                    </select>

                    @if($covid != $project->covid)
                        <button class="btn ml-2" type="submit">Save</button>
                    @endif
                </dd>
            </dl>
        </div>
    </form>

    <div class="my-3"></div>

    <form wire:submit.prevent="updateCovidInterventions">
        <dl class="form-group d-inline-block my-0">
            <dt class="input-label">
                <label>COVID Interventions</label>
            </dt>
            <dd>
                @foreach($covid_interventions as $key => $option)
                    <div class="form-checkbox">
                        <label for="covid_int_{{ $option->id }}">
                            <input
                                type="checkbox"
                                id="covid_int_{{ $option->id }}"
                                name="covid_interventions[]"
                                value="{{ $option->id }}"
                                wire:model="covidInterventions">
                            {{ $option->name }}
                            <p class="note">
                                {{ $option->description }}
                            </p>
                        </label>
                    </div>
                @endforeach
                <button class="btn ml-3" type="submit">Save</button>
            </dd>
        </dl>
    </form>

    <div class="Subhead Subhead--spacious my-3">
        <div class="Subhead-heading">{{ __("Spatial Coverage") }}</div>
    </div>

    <div class="my-3"></div>

    <form wire:submit.prevent="updateSpatialCoverage">
        <dl class="form-group d-inline-block my-0">
            <dt class="input-label">
                <label>Spatial Coverage</label>
            </dt>
            <dd>
                <select class="form-select" name="spatialCoverage" wire:model="spatialCoverage">
                    @foreach($spatial_coverages as $key => $option)
                        <option value="{{ $key }}">{{ $key . ' - ' . $option->name }}</option>
                    @endforeach
                </select>

                @if($spatialCoverage != $project->spatial_coverage_id)
                    <button class="btn ml-2" type="submit">Save</button>
                @endif
            </dd>
        </dl>
    </form>

    <div class="my-3"></div>

    <form wire:submit.prevent="updateRegions">
        <dl class="form-group d-inline-block my-0">
            <dt class="input-label">
                <label>Regions</label>
            </dt>
            <dd>
                @foreach($region_options as $key => $option)
                    <div class="form-checkbox">
                        <label for="region_{{ $option->id }}">
                            <input
                                type="checkbox"
                                id="region_{{ $option->id }}"
                                name="regions[]"
                                value="{{ $option->id }}"
                                wire:model="regions">
                            {{ $option->name }}
                        </label>
                    </div>
                @endforeach

                <button class="btn ml-3" type="submit">Save</button>
            </dd>
        </dl>
    </form>

    <div class="my-3"></div>

    <div class="Subhead Subhead--spacious">
        <div class="Subhead-heading">{{ __("Implementation Period") }}</div>
    </div>

    <form wire:submit.prevent="updateTargetStartYear">
        <dl class="form-group d-inline-block my-0">
            <dt class="input-label">
                <label>Start Year</label>
            </dt>
            <dd>
                <select class="form-select" name="target_start_year" wire:model="targetStartYear">
                    @foreach($years as $option)
                        <option value="{{ $option }}">{{ $option }}</option>
                    @endforeach
                </select>

                @if($targetStartYear != $project->target_start_year)
                    <button class="btn ml-2" type="submit">Save</button>
                @endif
            </dd>
        </dl>
    </form>

    <div class="my-3"></div>

    <form wire:submit.prevent="updateTargetEndYear">
        <dl class="form-group d-inline-block my-0">
            <dt class="input-label">
                <label>Start Year</label>
            </dt>
            <dd>
                <select class="form-select" name="target_end_year" wire:model="targetEndYear">
                    @foreach($years as $option)
                        <option value="{{ $option }}">{{ $option }}</option>
                    @endforeach
                </select>

                @if($targetEndYear != $project->target_end_year)
                    <button class="btn ml-2" type="submit">Save</button>
                @endif
            </dd>
        </dl>
    </form>

    <div class="my-3"></div>

    <div class="Subhead Subhead--spacious">
        <div class="Subhead-heading">{{ __("Approval Status") }}</div>
    </div>

    <form wire:submit.prevent="updatePapType">
        <dl class="form-group d-inline-block my-0">
            <dt class="input-label">
                <label for="rename-field">Is this project ICC-able?</label>
            </dt>
            <dd>
                <select class="form-select" name="iccable" id="iccable" wire:model="iccable">
                    @foreach($booleanOptions as $key => $option)
                        <option value="{{ $key }}">{{ $option }}</option>
                    @endforeach
                </select>

                @if($project->iccable != $iccable)
                    <button class="btn" type="submit">Save</button>
                @endif
            </dd>
        </dl>
    </form>

    <div class="my-3"></div>

    <form wire:submit.prevent="updateApprovalLevel">
        <dl class="form-group d-inline-block my-0">
            <dt class="input-label">
                <label for="rename-field">Level of Approval (for ICCable projects only)</label>
            </dt>
            <dd>
                <select class="form-select" name="approval_level_id" id="approval_level_id" wire:model="approvalLevel">
                    @foreach($approval_levels as $key => $option)
                        <option value="{{ $option->id }}">{{ $option->id . ' - ' . $option->name }}</option>
                    @endforeach
                </select>

                @if($project->approval_level_id != $approvalLevel)
                    <button class="btn" type="submit">Save</button>
                @endif
            </dd>
        </dl>
    </form>

    <div class="my-3"></div>

    <form wire:submit.prevent="updateApprovalDate">
        <dl class="form-group d-inline-block my-0">
            <dt class="input-label">
                <label for="rename-field">Date of Approval (for ICCable projects only)</label>
            </dt>
            <dd>
                <input type="date" class="form-control" name="approval_date" id="approval_date" wire:model="approvalDate">

                @if($project->approval_date != $approvalDate)
                    <button class="btn" type="submit">Save</button>
                @endif
            </dd>
        </dl>
    </form>

    <div class="my-3"></div>

    <form wire:submit.prevent="updateGad">
        <dl class="form-group d-inline-block my-0">
            <dt class="input-label">
                <label for="rename-field">Gender Responsiveness</label>
            </dt>
            <dd>
                <select class="form-select" name="gad_id" id="gad_id" wire:model="gad">
                    @foreach($gads as $option)
                        <option value="{{ $option->id }}">{{ $option->id . ' - ' . $option->name }}</option>
                    @endforeach
                </select>

                @if($project->gad_id != $gad)
                    <button class="btn" type="submit">Save</button>
                @endif
            </dd>
        </dl>
    </form>

    <div class="my-3"></div>

    <div class="Subhead Subhead--spacious">
        <div class="Subhead-heading">{{ __("Regional Development Investment Program") }}</div>
    </div>

    <form wire:submit.prevent="updateRdip">
        <dl class="form-group d-inline-block my-0">
            <dt class="input-label">
                <label for="rename-field">Is this PAP included in the RDIP?</label>
            </dt>
            <dd>
                <select class="form-select" name="rdip" id="rdip" wire:model="rdip">
                    @foreach($booleanOptions as $key => $option)
                        <option value="{{ $key }}">{{ $key . ' - ' . $option }}</option>
                    @endforeach
                </select>

                @if($project->rdip != $rdip)
                    <button class="btn" type="submit">Save</button>
                @endif
            </dd>
        </dl>
    </form>

    <div class="my-3"></div>

    <form wire:submit.prevent="updateRdcEndorsementRequired">
        <dl class="form-group d-inline-block my-0">
            <dt class="input-label">
                <label for="rename-field">Is RDC endorsement required?</label>
            </dt>
            <dd>
                <select class="form-select" name="rdc_endorsement_required" id="rdc_endorsement_required" wire:model="rdcEndorsementRequired">
                    @foreach($booleanOptions as $key => $option)
                        <option value="{{ $key }}">{{ $key . ' - ' . $option }}</option>
                    @endforeach
                </select>

                @if($project->rdc_endorsement_required != $rdcEndorsementRequired)
                    <button class="btn" type="submit">Save</button>
                @endif
            </dd>
        </dl>
    </form>

    <div class="my-3"></div>

    <form wire:submit.prevent="updateRdcEndorsed">
        <dl class="form-group d-inline-block my-0">
            <dt class="input-label">
                <label for="rename-field">Has the PAP been endorsed?</label>
            </dt>
            <dd>
                <select class="form-select" name="rdc_endorsed" id="rdc_endorsed" wire:model="rdcEndorsed">
                    @foreach($booleanOptions as $key => $option)
                        <option value="{{ $key }}">{{ $key . ' - ' . $option }}</option>
                    @endforeach
                </select>

                @if($project->rdc_endorsed != $rdcEndorsed)
                    <button class="btn" type="submit">Save</button>
                @endif
            </dd>
        </dl>
    </form>

    <div class="my-3"></div>

    <form wire:submit.prevent="updateRdcEndorsedDate">
        <dl class="form-group d-inline-block my-0">
            <dt class="input-label">
                <label for="rename-field">RDC Endorsement Date</label>
            </dt>
            <dd>
                <input type="date" class="form-control" name="rdc_endorsed_date" id="rdc_endorsed_date" wire:model="rdcEndorsedDate">

                @if($project->rdc_endorsed_date != $rdcEndorsedDate)
                    <button class="btn" type="submit">Save</button>
                @endif
            </dd>
        </dl>
    </form>

    <div class="my-3"></div>

    <div class="Subhead Subhead--spacious">
        <div class="Subhead-heading">{{ __("Project Preparation Details") }}</div>
    </div>

    <form wire:submit.prevent="updatePreparationDocument">
        <dl class="form-group d-inline-block my-0">
            <dt class="input-label">
                <label for="rename-field">Project Preparation Document</label>
            </dt>
            <dd>
                <select class="form-select" name="preparation_document_id" id="preparation_document_id" wire:model="preparationDocument">
                    @foreach($preparation_documents as $key => $option)
                        <option value="{{ $option->id }}">{{ $option->id . ' - ' . $option->name }}</option>
                    @endforeach
                </select>

                @if($project->preparation_document_id != $preparationDocument)
                    <button class="btn" type="submit">Save</button>
                @endif
            </dd>
        </dl>
    </form>

    <div class="my-3"></div>

    <form wire:submit.prevent="updateHasFs">
        <dl class="form-group d-inline-block my-0">
            <dt class="input-label">
                <label for="rename-field">Does the project require feasibility study?</label>
            </dt>
            <dd>
                <select class="form-select" name="has_fs" id="has_fs" wire:model="hasFs">
                    @foreach($booleanOptions as $key => $option)
                        <option value="{{ $key }}">{{ $key . ' - ' . $option }}</option>
                    @endforeach
                </select>

                @if($project->has_fs != $hasFs)
                    <button class="btn" type="submit">Save</button>
                @endif
            </dd>
        </dl>
    </form>

    <div class="my-3"></div>

    <form wire:submit.prevent="updateFsStatus">
        <dl class="form-group d-inline-block my-0">
            <dt class="input-label">
                <label for="rename-field">Status of Feasibility Study (Only if FS is required)</label>
            </dt>
            <dd>
                <select class="form-select" name="feasibility_study[fs_status_id]" id="feasibility_study[fs_status_id]" wire:model="fsStatus">
                    @foreach($fs_statuses as $key => $option)
                        <option value="{{ $option->id }}">{{ $option->id . ' - ' . $option->name }}</option>
                    @endforeach
                </select>

                @if($project->feasibility_study->fs_status_id != $fsStatus)
                    <button class="btn" type="submit">Save</button>
                @endif
            </dd>
        </dl>
    </form>

    <div class="my-3"></div>

    <form wire:submit.prevent="updateNeedAssistance">
        <dl class="form-group d-inline-block my-0">
            <dt class="input-label">
                <label for="rename-field">Does the conduct of feasibility study need assistance?</label>
            </dt>
            <dd>
                <select class="form-select" name="feasibility_study[need_assistance]" id="feasibility_study[need_assistance]" wire:model="needAssistance">
                    @foreach($booleanOptions as $key => $option)
                        <option value="{{ $key }}">{{ $key . ' - ' . $option }}</option>
                    @endforeach
                </select>

                @if($project->feasibility_study->need_assistance != $needAssistance)
                    <button class="btn" type="submit">Save</button>
                @endif
            </dd>
        </dl>
    </form>

    <div class="my-3"></div>

    <form wire:submit.prevent="updateFsCost">
        <dl class="form-group d-inline-block my-0">
            <dt class="input-label">
                <label for="rename-field">Schedule of Feasibility Study Cost (in absolute PhP)</label>
            </dt>
            <dd x-data="{
                    isEditing: false,
                    fsY2017: @entangle('fsY2017'),
                    fsY2018: @entangle('fsY2018'),
                    fsY2019: @entangle('fsY2019'),
                    fsY2020: @entangle('fsY2020'),
                    fsY2021: @entangle('fsY2021'),
                    fsY2022: @entangle('fsY2022'),
                }">
                <div class="d-flex flex-column">
                    <div x-show="isEditing" x-cloak>
                        <input type="number" class="form-control text-right mt-2" id="feasibility_study.y2017" name="feasibility_study[y2017]" wire:model="fsY2017">
                        <input type="number" class="form-control text-right mt-2" id="feasibility_study.y2018" name="feasibility_study[y2018]" wire:model="fsY2018">
                        <input type="number" class="form-control text-right mt-2" id="feasibility_study.y2019" name="feasibility_study[y2019]" wire:model="fsY2019">
                        <input type="number" class="form-control text-right mt-2" id="feasibility_study.y2020" name="feasibility_study[y2020]" wire:model="fsY2020">
                        <input type="number" class="form-control text-right mt-2" id="feasibility_study.y2021" name="feasibility_study[y2021]" wire:model="fsY2021">
                        <input type="number" class="form-control text-right mt-2" id="feasibility_study.y2022" name="feasibility_study[y2022]" wire:model="fsY2022">
                    </div>
                    <div x-show="!isEditing" x-cloak>
                        <input type="text" class="form-control text-right mt-2" x-bind:value="parseFloat(fsY2017).toLocaleString()" readonly>
                        <input type="text" class="form-control text-right mt-2" x-bind:value="parseFloat(fsY2018).toLocaleString()" readonly>
                        <input type="text" class="form-control text-right mt-2" x-bind:value="parseFloat(fsY2019).toLocaleString()" readonly>
                        <input type="text" class="form-control text-right mt-2" x-bind:value="parseFloat(fsY2020).toLocaleString()" readonly>
                        <input type="text" class="form-control text-right mt-2" x-bind:value="parseFloat(fsY2021).toLocaleString()" readonly>
                        <input type="text" class="form-control text-right mt-2" x-bind:value="parseFloat(fsY2022).toLocaleString()" readonly>
                    </div>
                    <!-- TODO: compute sum of fs cost -->
                    <input type="text" class="form-control mt-2" id="feasibility_study.total" name="feasibility_study[total]" wire:model="fsTotal">
                </div>

                <button class="btn mt-2" @click="isEditing = true" x-show="!isEditing">Edit</button>
                <button class="btn btn-primary mt-2" type="submit" x-cloak x-show="isEditing" x-cloak>Save</button>
                <button class="btn mt-2" @click="isEditing = false" x-cloak x-show="isEditing">Cancel</button>
            </dd>
        </dl>
    </form>

    <div class="my-3"></div>

    <div class="Subhead Subhead--spacious">
        <div class="Subhead-heading">{{ __("Employment Generation") }}</div>
    </div>

    <form wire:submit.prevent="updateEmploymentGenerated">
        <dl class="form-group d-inline-block my-0">
            <dt class="input-label">
                <label for="rename-field">No. of persons to be employed after completion of the project</label>
            </dt>
            <dd>
                <input type="number" wire:model.debounce.500ms="employmentGenerated" name="employment_generated" id="employment_generated" class="form-control">

                @if($project->employment_generated != $employmentGenerated)
                    <button class="btn" type="submit">Save</button>
                @endif
            </dd>
        </dl>
    </form>

    <div class="my-3"></div>

    <div class="Subhead Subhead--spacious">
        <div class="Subhead-heading">{{ __("PDP Chapter") }}</div>
    </div>

    <form wire:submit.prevent="updatePdpChapter">
        <dl class="form-group d-inline-block my-0">
            <dt class="input-label">
                <label for="rename-field">PDP Chapter</label>
            </dt>
            <dd>
                <select class="form-select" name="pdp_chapter_id" id="pdp_chapter_id" wire:model="pdpChapter">
                    @foreach($pdp_chapters as $option)
                        <option value="{{ $option->id }}">{{ $option->name }}</option>
                    @endforeach
                </select>

                @if($project->pdp_chapter_id != $pdpChapter)
                    <button class="btn" type="submit">Save</button>
                @endif
            </dd>
        </dl>
    </form>

    <div class="my-3"></div>

    <div class="Subhead Subhead--spacious">
        <div class="Subhead-heading">{{ __("Other PDP Chapters") }}</div>
        <div class="Subhead-description">Select all that applies</div>
    </div>

    <form wire:submit.prevent="updatePdpChapters">
        <dl class="form-group d-inline-block my-0">
            <dt class="input-label">
                <label for="rename-field">Other PDP Chapters</label>
            </dt>
            <dd>
                @foreach($pdp_chapters as $key => $option)
                    <div class="form-checkbox">
                        <label for="pdp_chapter_{{ $option->id }}">
                            <input
                                type="checkbox"
                                id="pdp_chapter_{{ $option->id }}"
                                name="pdp_chapters[]"
                                value="{{ $option->id }}"
                                wire:model="pdpChapters">
                            {{ $option->name }}
                        </label>
                    </div>
                @endforeach

                <button class="btn" type="submit">Save</button>
            </dd>
        </dl>
    </form>

    <div class="my-3"></div>

    <div class="Subhead Subhead--spacious">
        <div class="Subhead-heading">{{ __("Sustainable Development Goals") }}</div>
        <div class="Subhead-description">Select all that applies</div>
    </div>

    <form wire:submit.prevent="updateSdgs">
        <dl class="form-group d-inline-block my-0">
            <dt class="input-label">
                <label for="rename-field">Sustainable Development Goals</label>
            </dt>
            <dd>
                @foreach($sdg_options as $key => $option)
                    <div class="form-checkbox">
                        <label for="sdg_{{ $option->id }}">
                            <input
                                type="checkbox"
                                id="sdg_{{ $option->id }}"
                                name="sdgs[]"
                                value="{{ $option->id }}"
                                wire:model="sdgs">
                            {{ $option->name }}
                        </label>
                    </div>
                @endforeach

                <button class="btn" type="submit">Save</button>
            </dd>
        </dl>
    </form>

    <div class="my-3"></div>

    <div class="Subhead Subhead--spacious">
        <div class="Subhead-heading">{{ __("Ten Point Agenda") }}</div>
        <div class="Subhead-description">Select all that applies</div>
    </div>

    <form wire:submit.prevent="updateTpas">
        <dl class="form-group d-inline-block my-0">
            <dt class="input-label">
                <label for="rename-field">Ten Point Agenda</label>
            </dt>
            <dd>
                @foreach($ten_point_agendas as $key => $option)
                    <div class="form-checkbox">
                        <label for="tpa_{{ $option->id }}">
                            <input
                                type="checkbox"
                                id="tpa_{{ $option->id }}"
                                name="ten_point_agendas[]"
                                value="{{ $option->id }}"
                                wire:model="tenPointAgendas">
                            {{ $option->name }}
                            <p class="note">{{ $option->description }}</p>
                        </label>
                    </div>
                @endforeach

                <button class="btn" type="submit">Save</button>
            </dd>
        </dl>
    </form>

    <div class="my-3"></div>

    <div class="Subhead Subhead--spacious">
        <div class="Subhead-heading">{{ __("Financial Information") }}</div>
        <div class="Subhead-description">Select all that applies</div>
    </div>

    <form wire:submit.prevent="updateFundingSource">
        <dl class="form-group d-inline-block my-0">
            <dt class="input-label">
                <label for="rename-field">Main Funding Source</label>
            </dt>
            <dd>
                <select name="funding_source_id" id="funding_source_id" class="form-select" wire:model="fundingSource">
                    @foreach($funding_sources as $option)
                        <option value="{{ $option->id }}">{{ $option->name }}</option>
                    @endforeach
                </select>

                <button class="btn" type="submit">Save</button>
            </dd>
        </dl>
    </form>

    <div class="my-3"></div>

    <form wire:submit.prevent="updateFundingSources">
        <dl class="form-group d-inline-block my-0">
            <dt class="input-label">
                <label for="rename-field">Other Funding Sources</label>
            </dt>
            <dd>
                @foreach($funding_sources as $option)
                    <div class="form-checkbox">
                        <label for="fs_{{ $option->id }}">
                            <input
                                type="checkbox"
                                id="fs_{{ $option->id }}"
                                name="funding_sources[]"
                                value="{{ $option->id }}"
                                wire:model="fundingSources">
                            {{ $option->name }}
                        </label>
                    </div>
                @endforeach

                <button class="btn" type="submit">Save</button>
            </dd>
        </dl>
    </form>

    <div class="my-3"></div>

    <form wire:submit.prevent="updateOtherFs">
        <dl class="form-group d-inline-block my-0">
            <dt class="input-label">
                <label for="rename-field">Other Funding Source (please specify)</label>
            </dt>
            <dd>
                <input type="text" name="other_fs" id="other_fs" wire:model="otherFs" class="form-control input-contrast">

                <button class="btn" type="submit">Save</button>
            </dd>
        </dl>
    </form>

    <div class="my-3"></div>

    <form wire:submit.prevent="updateImplementationMode">
        <dl class="form-group d-inline-block my-0">
            <dt class="input-label">
                <label for="rename-field">Mode of Implementation</label>
            </dt>
            <dd>
                <select name="implementation_mode_id" id="implementation_mode_id" class="form-select" wire:model="implementationMode">
                    @foreach($implementation_modes as $option)
                        <option value="{{ $option->id }}">{{ $option->name }}</option>
                    @endforeach
                </select>

                <button class="btn" type="submit">Save</button>
            </dd>
        </dl>
    </form>

    <div class="my-3"></div>

    <form wire:submit.prevent="updateFundingInstitution">
        <dl class="form-group d-inline-block my-0">
            <dt class="input-label">
                <label for="rename-field">Funding Institution</label>
            </dt>
            <dd>
                <select name="funding_institution_id" id="funding_institution_id" class="form-select" wire:model="fundingInstitution">
                    @foreach($funding_institutions as $option)
                        <option value="{{ $option->id }}">{{ $option->name }}</option>
                    @endforeach
                </select>

                <button class="btn" type="submit">Save</button>
            </dd>
        </dl>
    </form>

    <div class="my-3"></div>

    <form wire:submit.prevent="updateTier">
        <dl class="form-group d-inline-block my-0">
            <dt class="input-label">
                <label for="rename-field">Budget Tier</label>
            </dt>
            <dd>
                <select name="tier_id" id="tier_id" class="form-select" wire:model="tier">
                    @foreach($tiers as $option)
                        <option value="{{ $option->id }}">{{ $option->name }}</option>
                    @endforeach
                </select>

                <button class="btn" type="submit">Save</button>
            </dd>
        </dl>
    </form>

    <div class="my-3"></div>

    <form wire:submit.prevent="updateUacsCode">
        <dl class="form-group d-inline-block my-0">
            <dt class="input-label">
                <label for="rename-field">UACS Code</label>
            </dt>
            <dd>
                <input type="text" name="uacs_code" id="uacs_code" class="form-control input-contrast" wire:model="uacsCode">

                <button class="btn" type="submit">Save</button>
            </dd>
        </dl>
    </form>

    <div class="Subhead Subhead--spacious">
        <div class="Subhead-heading">{{ __("Status & Updates") }}</div>
    </div>

    <form wire:submit.prevent="updateUpdates">
        <dl class="form-group my-0">
            <dt class="input-label">
                <label for="rename-field">Updates</label>
            </dt>
            <dd class="form-group-body">
                <textarea id="updates" name="updates" class="form-control input-contrast" wire:model="updates"></textarea>

                <div class="d-flex mt-3">
                    <button class="btn" type="submit">Save</button>
                </div>
            </dd>
        </dl>
    </form>

    <div class="my-3"></div>

    <form wire:submit.prevent="updateUpdatesDate">
        <dl class="form-group my-0">
            <dt class="input-label">
                <label for="rename-field">As of</label>
            </dt>
            <dd class="form-group-body">
                <input type="date" id="updates_date" name="updates_date" class="form-control input-contrast" wire:model="updatesDate">

                <button class="btn" type="submit">Save</button>
            </dd>
        </dl>
    </form>

    <div class="my-3"></div>

    <div class="Subhead Subhead--spacious">
        <div class="Subhead-heading">{{ __("Investment Required by Funding Source") }}</div>
        <div class="Subhead-description">in absolute PhP terms</div>
    </div>

    <form wire:submit.prevent="updateFsInvestments">
        <dl class="my-0">
            <dt class="input-label">

            </dt>
            <dd class="form-group-body">
                <div class="d-table col-12 border-bottom border-top">
                    <div class="col-1 p-2 text-center v-align-middle d-table-cell">
                        Funding Source
                    </div>
                    <div class="col-1 p-2 text-center v-align-middle d-table-cell">
                        2016 &amp; Prior
                    </div>
                    <div class="col-1 p-2 text-center v-align-middle d-table-cell">
                        2017
                    </div>
                    <div class="col-1 p-2 text-center v-align-middle d-table-cell">
                        2018
                    </div>
                    <div class="col-1 p-2 text-center v-align-middle d-table-cell">
                        2019
                    </div>
                    <div class="col-1 p-2 text-center v-align-middle d-table-cell">
                        2020
                    </div>
                    <div class="col-1 p-2 text-center v-align-middle d-table-cell">
                        2021
                    </div>
                    <div class="col-1 p-2 text-center v-align-middle d-table-cell">
                        2022
                    </div>
                    <div class="col-1 p-2 text-center v-align-middle d-table-cell">
                        2023 &amp; Beyond
                    </div>
                    <div class="col-1 p-2 text-center v-align-middle d-table-cell">
                        Total
                    </div>
                </div>
                @foreach ($project->fs_investments as $fs)
                    <div class="d-table col-12 border-bottom">
                        <div class="col-1 p-1 d-table-cell">
                            {{ $fs->funding_source->name ?? '' }}
                        </div>
                        <div class="col-1 p-1 d-table-cell">
                            <input type="text" class="form-control input-contrast width-full">
                        </div>
                        <div class="col-1 p-1 d-table-cell">
                            <input type="text" class="form-control input-contrast width-full">
                        </div>
                        <div class="col-1 p-1 d-table-cell">
                            <input type="text" class="form-control input-contrast width-full">
                        </div>
                        <div class="col-1 p-1 d-table-cell">
                            <input type="text" class="form-control input-contrast width-full">
                        </div>
                        <div class="col-1 p-1 d-table-cell">
                            <input type="text" class="form-control input-contrast width-full">
                        </div>
                        <div class="col-1 p-1 d-table-cell">
                            <input type="text" class="form-control input-contrast width-full">
                        </div>
                        <div class="col-1 p-1 d-table-cell">
                            <input type="text" class="form-control input-contrast width-full">
                        </div>
                        <div class="col-1 p-1 d-table-cell">
                            <input type="text" class="form-control input-contrast width-full">
                        </div>
                        <div class="col-1 p-1 d-table-cell">
                            <input type="text" class="form-control input-contrast width-full">
                        </div>
                    </div>
                @endforeach

                <div class="d-flex mt-2">
                    <button class="btn" type="submit">Save</button>
                </div>
            </dd>
        </dl>
    </form>
</div>
