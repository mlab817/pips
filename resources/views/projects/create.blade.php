@extends('layouts.app')

@section('content')
    <section class="content">
        <div class="container-fluid">
            @if($errors->any())
                <div class="callout callout-danger">
                    <h5><i class="fas fa-info"></i> Error:</h5>
                    Please check the form for errors.
                    <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                    </ul>
                </div>
            @endif

            <div class="row p-2">
                <p><i class="text-danger fas fa-flag"></i>  These fields are required.</p>
            </div>

            <form action="{{ route('projects.store') }}" method="POST" class="form-horizontal">
                @csrf
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">{{ __("General Information") }}</h3>
                            </div>

                            <div class="card-body">
                                <div class="form-group row">
                                    <label for="title" class="col-form-label col-sm-2">Project Title <i class="text-danger fas fa-flag"></i></label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control @error('title') is-invalid @enderror" name="title" placeholder="Project Title" value="{{ old('title') }}">
                                        @error('title')<span class="error invalid-feedback">{{ $message }}</span>@enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="pap_type_id" class="col-form-label col-sm-2">PAP Type <i class="text-danger fas fa-flag"></i></label>
                                    <div class="col-sm-10">
                                        <select class="form-control @error('pap_type_id') is-invalid @enderror" name="pap_type_id">
                                            <option value="" selected disabled>Select PAP Type</option>
                                            @foreach($pap_types as $option)
                                                <option value="{{ $option->id }}" @if(old('pap_type_id') == $option->id) selected @endif>{{ $option->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('pap_type_id')<span class="error invalid-feedback">{{ $message }}</span>@enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="pap_type_id" class="col-form-label col-sm-2">Is this a regular program?  <i class="text-danger fas fa-flag"></i></label>
                                    <div class="col-sm-10">
                                        <div class="form-check-inline">
                                            <input class="form-check-input" type="radio" name="regular_program" value="1" @if(old('regular_program') == 1) checked @endif>
                                            <label class="form-check-label">Yes</label>
                                        </div>
                                        <div class="form-check-inline">
                                            <input class="form-check-input" type="radio" name="regular_program" value="0" @if(old('regular_program') == 0) checked @endif>
                                            <label class="form-check-label">No</label>
                                        </div>
                                        @error('regular_program')<span class="error invalid-feedback">{{ $message }}</span>@enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="has_infra" class="col-form-label col-sm-2">Does this PAP have INFRASTRUCTURE component/s?  <i class="text-danger fas fa-flag"></i></label>
                                    <div class="col-sm-10">
                                        <div class="form-check-inline">
                                            <input class="form-check-input" type="radio" name="has_infra" value="1" @if(old('has_infra') == 1) checked @endif>
                                            <label class="form-check-label">Yes</label>
                                        </div>
                                        <div class="form-check-inline">
                                            <input class="form-check-input" type="radio" name="has_infra" value="0" @if(old('has_infra') == 0) checked @endif>
                                            <label class="form-check-label">No</label>
                                        </div>
                                        @error('has_infra')<span class="error invalid-feedback">{{ $message }}</span>@enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="bases" class="col-form-label col-sm-2">Implementation Bases <i class="text-danger fas fa-flag"></i></label>
                                    <div class="col-sm-10">
                                        @foreach($bases as $option)
                                            <div class="form-check">
                                                <label class="form-check-label @error('bases') text-danger @enderror">
                                                    <input type="checkbox" class="form-check-input @error('bases') text-danger @enderror" name="bases[]" value="{{ $option->id }}" @if(in_array($option->id, old('bases') ?? [])) checked @endif>
                                                    {{ $option->name }}
                                                </label>
                                            </div>
                                        @endforeach
                                        @error('bases')<span class="error invalid-feedback">{{ $message }}</span>@enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="description" class="col-form-label col-sm-2">Description  <i class="text-danger fas fa-flag"></i></label>
                                    <div class="col-sm-10">
                                        <textarea rows="4" style="resize: none;"  class="form-control @error('description') is-invalid @enderror" name="description">{{ old('description') }}</textarea>
                                        @error('description')<span class="error invalid-feedback">{{ $message }}</span>@enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="expected_outputs" class="col-form-label col-sm-2">Expected Outputs <i class="text-danger fas fa-flag"></i></label>
                                    <div class="col-sm-10">
                                        <textarea rows="4" style="resize: none;"  class="form-control @error('expected_outputs') is-invalid @enderror" name="expected_outputs">{{ old('expected_outputs') }}</textarea>
                                        @error('expected_outputs')<span class="error invalid-feedback">{{ $message }}</span>@enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="total_project_cost" class="col-form-label col-sm-2">Total Project Cost (in absolute PhP) <i class="text-danger fas fa-flag"></i></label>
                                    <!-- TODO: Replace with MoneyInput -->
                                    <div class="col-sm-10">
                                        <input type="text" class="money form-control @error('total_project_cost') is-invalid @enderror" name="total_project_cost" value="{{ old('total_project_cost', 0) }}">
                                        @error('total_project_cost')<span class="error invalid-feedback">{{ $message }}</span>@enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="project_status_id" class="col-form-label col-sm-2">Project Status <i class="text-danger fas fa-flag"></i></label>
                                    <div class="col-sm-10">
                                        <select class="form-control @error('pap_type_id') is-invalid @enderror" name="project_status_id">
                                            <option value="" selected disabled>Select Project Status</option>
                                            @foreach($project_statuses as $option)
                                                <option value="{{ $option->id }}" @if(old('project_status_id') == $option->id) selected @endif>{{ $option->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('project_status_id')<span class="error invalid-feedback">{{ $message }}</span>@enderror
                                    </div>
                                </div>

                            </div>

                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">{{ __("Spatial Coverage") }}</h3>
                            </div>
                            <div class="card-body">
                                <div class="form-group row">
                                    <label for="spatial_coverage_id" class="col-form-label col-sm-2">Spatial Coverage <i class="text-danger fas fa-flag"></i></label>
                                    <div class="col-sm-10">
                                        <select name="spatial_coverage_id" id="spatial_coverage_id" class="form-control @error('spatial_coverage_id') is-invalid @enderror">
                                            <option value="" selected disabled>Select Spatial Coverage</option>
                                            @foreach($spatial_coverages as $option)
                                                <option value="{{ $option->id }}" @if(old('spatial_coverage_id') == $option->id) selected @endif>{{ $option->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('spatial_coverage_id')<span class="error invalid-feedback">{{ $message }}</span>@enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="regions" class="col-form-label col-sm-2">Regions <i class="text-danger fas fa-flag"></i></label>
                                    <div class="col-sm-10">
                                        @foreach($regions->sortBy('order') as $option)
                                            @if($option->id !== 99)
                                            <div class="form-check">
                                                <label class="form-check-label">
                                                    <input class="form-check-input @error('regions') text-danger @enderror" type="checkbox" name="regions[]" value="{{ $option->id }}" {{ in_array($option->id, old('regions') ?? []) ? 'checked' : '' }}>
                                                    {{ $option->name }}
                                                </label>
                                            </div>
                                            @endif
                                        @endforeach
                                        @error('regions')<span class="error invalid-feedback">{{ $message }}</span>@enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Implementation Period -->
                    <div class="col-md-12">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">{{ __("Implementation Period") }}</h3>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label for="target_start_year" class="col-form-label col-sm-2">Start of Implementation <i class="text-danger fas fa-flag"></i></label>
                                            <div class="col-sm-10">
                                                <select class="form-control @error('target_start_year') is-invalid @enderror" name="target_start_year">
                                                    <option value="" disabled selected>Select Year</option>
                                                    @foreach($years as $option)
                                                        <option value="{{ $option }}" {{ old('target_start_year') == $option ? 'selected' : '' }}>{{ $option }}</option>
                                                    @endforeach
                                                </select>
                                                @error('target_start_year')<span class="error invalid-feedback">{{ $message }}</span>@enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label for="target_end_year" class="col-form-label col-sm-2">Year of Project Completion <i class="text-danger fas fa-flag"></i></label>
                                            <div class="col-sm-10">
                                                <select class="form-control @error('target_end_year') is-invalid @enderror" name="target_end_year">
                                                    <option value="" disabled selected>Select Year</option>
                                                    @foreach($years as $option)
                                                        <option value="{{ $option }}" {{ old('target_end_year') == $option ? 'selected' : '' }}>{{ $option }}</option>
                                                    @endforeach
                                                </select>
                                                @error('target_end_year')<span class="error invalid-feedback">{{ $message }}</span>@enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--/. Implementation Period -->

                    <!-- Approval Status -->
                    <div class="col-md-12">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">{{ __("Approval Status") }}</h3>
                            </div>
                            <div class="card-body">
                                <div class="form-group row">
                                    <label for="iccable" class="col-form-label col-sm-2">Is the Project ICC-able? <i class="text-danger fas fa-flag"></i></label>
                                    <div class="col-sm-10">
                                        <div class="form-check-inline">
                                            <input type="radio" class="form-check-input" value="1" name="iccable" {{ old('iccable') == 1 ? 'checked' : '' }}>
                                            <label class="form-check-label">Yes</label>
                                        </div>
                                        <div class="form-check-inline">
                                            <input type="radio" class="form-check-input" value="0" name="iccable" {{ old('iccable') == 0 ? 'checked' : '' }}>
                                            <label class="form-check-label">No</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="approval_level_id" class="col-form-label col-sm-2">Level of Approval (For ICCable only)</label>
                                    <div class="col-sm-10">
                                        <select class="form-control @error('approval_level_id') is-invalid @enderror" name="approval_level_id">
                                            <option value="" disabled selected>Select Approval Level</option>
                                            @foreach($approval_levels as $option)
                                                <option value="{{ $option->id }}" {{ old('approval_level_id') == $option->id ? 'selected' : '' }}>{{ $option->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('approval_level_id')<span class="error invalid-feedback">{{ $message }}</span>@enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="approval_date" class="col-form-label col-sm-2">Date of Submission/Approval</label>
                                    <div class="col-sm-4">
                                        <input type="date" class="form-control @error('approval_date') is-invalid @enderror" name="approval_date" value="{{ old('approval_date') }}">
                                        @error('approval_date')<span class="error invalid-feedback">{{ $message }}</span>@enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="gad_id" class="col-form-label col-sm-2">Gender &amp; Responsiveness <i class="text-danger fas fa-flag"></i></label>
                                    <div class="col-sm-10">
                                        <select class="form-control @error('gad_id') is-invalid @enderror" name="gad_id">
                                            <option value="" disabled selected>Select Approval Level</option>
                                            @foreach($gads as $option)
                                                <option value="{{ $option->id }}" {{ old('gad_id') == $option->id ? 'selected' : '' }}>{{ $option->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('gad_id')<span class="error invalid-feedback">{{ $message }}</span>@enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--/. Approval Status -->

                    <!--/. Regional Development Investment Program -->
                    <div class="col-md-12">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Regional Development Investment Program</h3>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-form-label col-sm-2" for="rdip">Regional Development Investment Program <i class="text-danger fas fa-flag"></i></label>
                                            <div class="col-sm-10">
                                                <div class="form-check-inline">
                                                    <label class="form-check-label">
                                                        <input class="form-check-input" type="radio" name="rdip" value="1" @if(old('rdip') == 1) checked @endif>
                                                        Yes
                                                    </label>
                                                </div>
                                                <div class="form-check-inline">
                                                    <label class="form-check-label">
                                                        <input class="form-check-input" type="radio" name="rdip" value="0" @if(old('rdip') == 0) checked @endif>
                                                        No
                                                    </label>
                                                </div>
                                                @error('rdip')<span class="error invalid-feedback">{{ $message }}</span>@enderror
                                            </div>
                                        </div>
                                        <div class="form-group row ml-4">
                                            <label class="col-form-label col-sm-2" for="rdc_endorsement_required">Is RDC endorsement required? <i class="text-danger fas fa-flag"></i></label>
                                            <div class="col-sm-10">
                                                <div class="form-check-inline">
                                                    <label class="form-check-label">
                                                        <input class="form-check-input" type="radio" name="rdc_endorsement_required" value="1" @if(old('rdc_endorsement_required') == 1) checked @endif>
                                                        Yes
                                                    </label>
                                                </div>
                                                <div class="form-check-inline">
                                                    <label class="form-check-label">
                                                        <input class="form-check-input" type="radio" name="rdc_endorsement_required" value="0" @if(old('rdc_endorsement_required') == 0) checked @endif>
                                                        No
                                                    </label>
                                                </div>
                                                @error('rdc_endorsement_required')<span class="error invalid-feedback">{{ $message }}</span>@enderror
                                            </div>
                                        </div>
                                        <div class="form-group row ml-4">
                                            <label class="col-form-label col-sm-2" for="rdc_endorsed">Has the project been endorsed?</label>
                                            <div class="col-sm-10">
                                                <div class="form-check-inline">
                                                    <label class="form-check-label">
                                                        <input class="form-check-input" type="radio" name="rdc_endorsed" value="1" @if(old('rdc_endorsed') == 1) checked @endif>
                                                        Yes
                                                    </label>
                                                </div>
                                                <div class="form-check-inline">
                                                    <label class="form-check-label">
                                                        <input class="form-check-input" type="radio" name="rdc_endorsed" value="0" @if(old('rdc_endorsed') == 0) checked @endif>
                                                        No
                                                    </label>
                                                </div>
                                                @error('rdc_endorsement_required')<span class="error invalid-feedback">{{ $message }}</span>@enderror
                                            </div>
                                        </div>
                                        <div class="form-group row ml-4">
                                            <label class="col-form-label col-sm-2" for="rdc_endorsed_date">RDC Endorsement Date</label>
                                            <div class="col-sm-10">
                                                <input type="date" class="form-control @error('rdc_endorsed_date') is-invalid @enderror" name="rdc_endorsed_date" value="{{ old('rdc_endorsed_date') }}">
                                                @error('rdc_endorsed_date')<span class="error invalid-feedback">{{ $message }}</span>@enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--/. Regional Development Investment Program -->

                    <!-- Project Preparation Details -->
                    <div class="col-md-12">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">{{ __("Project Preparation Details") }}</h3>
                            </div>
                            <div class="card-body">
                                <div class="form-group row">
                                    <label for="preparation_document_id" class="col-form-label col-sm-2">Project Preparation Document</label>
                                    <div class="col-sm-10">
                                        <select name="preparation_document_id" id="preparation_document_id" class="form-control">
                                            <option value="" selected disabled>Select document</option>
                                            @foreach($preparation_documents as $option)
                                                <option value="{{ $option->id }}">{{ $option->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="iccable" class="col-form-label col-sm-2">Does the project require feasibility study? <i class="text-danger fas fa-flag"></i></label>
                                    <div class="col-sm-10">
                                        <div class="form-check-inline">
                                            <label class="form-check-label">
                                                <input type="radio" class="form-check-input" value="1" name="has_fs" {{ old('has_fs') == 1 ? 'checked' : '' }}>
                                                Yes
                                            </label>
                                        </div>
                                        <div class="form-check-inline">
                                            <label class="form-check-label">
                                                <input type="radio" class="form-check-input" value="0" name="has_fs" {{ old('has_fs') == 0 ? 'checked' : '' }}>
                                                No
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="fs_status_id" class="col-form-label col-sm-2">Status of Feasibility Study</label>
                                    <div class="col-sm-10">
                                        <select name="feasibility_study[fs_status_id]" id="fs_status_id" class="form-control">
                                            <option value="" selected disabled>Select Status</option>
                                            @foreach($fs_statuses as $option)
                                                <option value="{{ $option->id }}">{{ $option->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="iccable" class="col-form-label col-sm-2">Does the conduct of feasibility study need assistance?</label>
                                    <div class="col-sm-10">
                                        <div class="form-check-inline">
                                            <label class="form-check-label">
                                                <input type="radio" class="form-check-input" value="1" name="feasibility_study[needs_assistance]" @if(old('feasibility_study[need_assistance]') == 1) checked @endif>
                                                Yes
                                            </label>
                                        </div>
                                        <div class="form-check-inline">
                                            <label class="form-check-label">
                                                <input type="radio" class="form-check-input" value="0" name="feasibility_study[needs_assistance]" @if(old('feasibility_study[need_assistance]') == 0) checked @endif>
                                                No
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="fs_cost">Schedule of Feasibility Study Cost (in absolute PhP)</label>
                                    <table id="fs_cost">
                                        <thead>
                                            <tr>
                                                <th class="text-sm text-center">2017</th>
                                                <th class="text-sm text-center">2018</th>
                                                <th class="text-sm text-center">2019</th>
                                                <th class="text-sm text-center">2020</th>
                                                <th class="text-sm text-center">2021</th>
                                                <th class="text-sm text-center">2022</th>
                                                <th class="text-sm text-center">Total</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>
                                                    <input type="text" class="money fs form-control text-right" name="feasibility_study[y2017]" value="{{ old('feasibility_study.y2017', 0) }}">
                                                </td>
                                                <td>
                                                    <input type="text" class="money fs form-control text-right" name="feasibility_study[y2018]" value="{{ old('feasibility_study.y2018', 0) }}">
                                                </td>
                                                <td>
                                                    <input type="text" class="money fs form-control text-right" name="feasibility_study[y2019]" value="{{ old('feasibility_study.y2019', 0) }}">
                                                </td>
                                                <td>
                                                    <input type="text" class="money fs form-control text-right" name="feasibility_study[y2020]" value="{{ old('feasibility_study.y2020', 0) }}">
                                                </td>
                                                <td>
                                                    <input type="text" class="money fs form-control text-right" name="feasibility_study[y2021]" value="{{ old('feasibility_study.y2021', 0) }}">
                                                </td>
                                                <td>
                                                    <input type="text" class="money fs form-control text-right" name="feasibility_study[y2022]" value="{{ old('feasibility_study.y2022', 0) }}">
                                                </td>
                                                <td>
                                                    <input type="text" class="money form-control text-right" id="fs_total" readonly>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="form-group row">
                                    <label for="feasibility_study[completion_date]" class="col-form-label col-sm-2">Expected/Target Date of Completion of FS</label>
                                    <div class="col-sm-10">
                                        <input type="date" class="form-control" name="feasibility_study[completion_date]" value="{{ old('feasibility_study.completion_date') }}">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--/. Project Preparation Details -->

                    <!-- Employment Generation -->
                    <div class="col-md-12">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">{{ __("Employment Generation") }}</h3>
                            </div>
                            <div class="card-body">
                                <div class="form-group row">
                                    <label for="employment_generated" class="col-sm-2">No. of persons to be employed after completion of the project</label>
                                    <div class="col-sm-10">
                                        <input class="form-control @error('employment_generated') is-invalid @enderror" type="number" name="employment_generated" value="{{ old('employment_generated') }}">
                                        @error('employment_generated')<span class="error invalid-feedback">{{ $message }}</span>@enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--/. Employment Generation -->

                    <!-- Philippine Development Plan Chapter -->
                    <div class="col-md-12">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">{{ __("Philippine Development Plan") }}</h3>
                            </div>
                            <div class="card-body">
                                <div class="form-group row">
                                    <label for="pdp_chapter_id" class="col-form-label col-sm-2">Main philippine Development Chapter <i class="text-danger fas fa-flag"></i></label>
                                    <div class="col-sm-10">
                                        <select id="pdp_chapter_id" name="pdp_chapter_id" class="form-control @error('pdp_chapter_id') is-invalid @enderror">
                                            <option value="" disabled selected>Select Main PDP Chapter</option>
                                            @foreach($pdp_chapters as $option)
                                                <option value="{{ $option->id }}" @if(old('pdp_chapter_id') == $option->id) selected @endif>{{ $option->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="infrastructure_sectors" class="col-sm-2">Other PDP Chapters</label>
                                    <div class="col-sm-10">
                                        @foreach($pdp_chapters as $option)
                                            <div class="form-check">
                                                <label class="form-check-label" for="pdp_chapter_{{ $option->id }}">
                                                    <input id="pdp_chapter_{{ $option->id }}" type="checkbox" value="{{ $option->id }}" class="form-check-input" name="pdp_chapters[]" @if(in_array($option->id, old('pdp_chapters') ?? [])) checked @endif>
                                                    {{ $option->name }}
                                                </label>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--/. Philippine Development Plan Chapter -->

                    <!-- Philippine Development Plan Indicators -->
                    <div class="col-md-12">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">{{ __("Philippine Development Results Matrices (PDP-RM) Indicators") }}</h3>
                            </div>
                            <!-- TODO: PDP Indicators as Vue component -->
                            <div class="card-body">
                                <div class="form-check">
                                    <label for="no_pdp_indicator" class="form-check-label">
                                        <input type="checkbox" value="1" id="no_pdp_indicator" name="no_pdp_indicator" class="form-check-input">
                                        No PDP Indicator applicable
                                    </label>
                                </div>

                                <div id="pdp_indicators_group" class="form-group mt-2">
                                    @foreach ($pdp_indicators as $pi1)
                                        <div id="pdp_chapter_{{$pi1->id}}" class="pdp_chapters" style="display: none;">
                                            <span class="font-weight-bold">{{ $pi1->name }}</span>
                                            @foreach($pi1->children as $pi2)
                                                <div class="ml-4">
                                                    <div class="form-check">
                                                        <label class="form-check-label" for="pdp_outcome_{{$pi2->id}}">
                                                            <input type="checkbox" class="form-check-input pdp_indicators" value="{{$pi2->id}}" name="pdp_indicators[]" @if(in_array($pi2->id, old('pdp_indicators') ?? [])) checked @endif>
                                                            {{ $pi2->name }}
                                                        </label>
                                                    </div>
                                                    <div>
                                                    @foreach($pi2->children as $pi3)
                                                        <div class="ml-4">
                                                            <div class="form-check">
                                                                <label class="form-check-label" for="pdp_suboutcome_{{$pi3->id}}">
                                                                    <input type="checkbox" class="form-check-input pdp_indicators" value="{{$pi3->id}}" name="pdp_indicators[]" @if(in_array($pi3->id, old('pdp_indicators') ?? [])) checked @endif>
                                                                    {{ $pi3->name }}
                                                                </label>
                                                            </div>
                                                            @foreach($pi3->children as $pi4)
                                                                <div class="ml-4">
                                                                    <div class="form-check">
                                                                        <label class="form-check-label" for="pdp_output_{{$pi4->id}}">
                                                                            <input type="checkbox" class="form-check-input pdp_indicators" value="{{$pi4->id}}" name="pdp_indicators[]" @if(in_array($pi4->id, old('pdp_indicators') ?? [])) checked @endif>
                                                                            {{ $pi4->name }}
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                    @endforeach
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--/. Philippine Development Plan Indicators -->

                    <!-- Sustainable Development Goals -->
                    <div class="col-md-12">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">{{ __("Sustainable Development Goals") }}</h3>
                            </div>
                            <div class="card-body">
                                <div class="form-group row">
                                    <label for="sdgs" class="col-form-label col-sm-2">Sustainable Development Goals</label>
                                    <div class="col-sm-10">
                                        @foreach($sdgs as $option)
                                            <div class="form-check">
                                                <label class="form-check-label" for="sdg_{{ $option->id }}">
                                                    <input id="sdg_{{ $option->id }}" type="checkbox" value="{{ $option->id }}" class="form-check-input" name="sdgs[]">
                                                    {{ $option->name }}
                                                    <p class="text-xs">{{ $option->description }}</p>
                                                </label>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--/. Sustainable Development Goals -->

                    <!-- Ten Point Agenda -->
                    <div class="col-md-12">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">{{ __("Ten Point Agenda") }}</h3>
                            </div>
                            <div class="card-body">
                                <div class="form-group row">
                                    <label for="ten_point_agendas" class="col-form-label col-sm-2">Ten Point Agenda</label>
                                    <div class="col-sm-10">
                                        @foreach($ten_point_agendas as $option)
                                            <div class="form-check">
                                                <label class="form-check-label" for="tpa_{{ $option->id }}">
                                                    <input id="tpa_{{ $option->id }}" type="checkbox" value="{{ $option->id }}" class="form-check-input" name="ten_point_agendas[]">
                                                    {{ $option->name }}
                                                    <p class="text-xs">{{ $option->description }}</p>
                                                </label>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--/. Ten Point Agenda -->

                    <!-- Financial Information -->
                    <div class="col-md-12">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">{{ __("Financial Information") }}</h3>
                            </div>
                            <div class="card-body">
                                <div class="form-group row">
                                    <label for="funding_source_id" class="col-form-label col-sm-2">Main Funding Source <i class="text-danger fas fa-flag"></i></label>
                                    <div class="col-sm-10">
                                        <select class="form-control @error('funding_source_id') is-invalid @enderror" name="funding_source_id">
                                            <option value="" disabled selected>Select Funding Source</option>
                                            @foreach($funding_sources as $option)
                                                <option value="{{ $option->id }}" @if(old('funding_source_id') == $option->id) selected @endif>{{ $option->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="funding_sources" class="col-form-label col-sm-2">Other Funding Sources</label>
                                    <div class="col-sm-10">
                                        @foreach($funding_sources as $option)
                                            <div class="form-check">
                                                <label class="form-check-label" for="fs_{{ $option->id }}">
                                                    <input id="fs_{{ $option->id }}" type="checkbox" value="{{ $option->id }}" class="form-check-input" name="ten_point_agendas[]">
                                                    {{ $option->name }}
                                                </label>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="other_fs" class="col-form-label col-sm-2">Other Funding Source (specify)</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="other_fs" id="other_fs" placeholder="Other funding source (please specify)" value="{{ old('other_fs') }}">
                                        @error('other_fs')<span class="error invalid-feedback">{{ $message }}</span>@enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="implementation_mode_id" class="col-form-label col-sm-2">Mode of Implementation <i class="text-danger fas fa-flag"></i></label>
                                    <div class="col-sm-10">
                                        <select class="form-control @error('implementation_mode_id') is-invalid @enderror" name="implementation_mode_id">
                                            <option value="" disabled selected>Select Implementation Mode</option>
                                            @foreach($implementation_modes as $option)
                                                <option value="{{ $option->id }}" @if(old('implementation_mode_id') == $option->id) selected @endif>{{ $option->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('implementation_mode_id')<span class="error invalid-feedback">{{ $message }}</span>@enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="funding_institution_id" class="col-form-label col-sm-2">Funding Institution</label>
                                    <div class="col-sm-10">
                                        <select class="form-control" name="funding_institution_id" @error('funding_institution_id') is-invalid @enderror>
                                            <option value="" disabled selected>Select Funding Institution</option>
                                            @foreach($funding_institutions as $option)
                                                <option value="{{ $option->id }}" @if(old('funding_institution_id') == $option->id) selected @endif>{{ $option->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="tier_id" class="col-form-label col-sm-2">Budget Tier <i class="text-danger fas fa-flag"></i></label>
                                    <div class="col-sm-10">
                                        <select class="form-control @error('tier_id') is-invalid @enderror" name="tier_id">
                                            <option value="" disabled selected>Select Budget Tier</option>
                                            @foreach($tiers as $option)
                                                <option value="{{ $option->id }}" @if(old('tier_id') == $option->id) selected @enderror>{{ $option->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('tier_id')<span class="error invalid-feedback">{{ $message }}</span>@enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="uacs_code" class="col-form-label col-sm-2">UACS Code</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control @error('uacs_code') is-invalid @enderror" name="uacs_code" id="uacs_code" placeholder="UACS Code" value="{{ old('uacs_code') }}">
                                        @error('uacs_code')<span class="error invalid-feedback">{{ $message }}</span>@enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--/. Financial Information -->

                    <!-- Status & Updates -->
                    <div class="col-md-12">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">{{ __("Status & Updates") }}</h3>
                            </div>
                            <div class="card-body">
                                <div class="form-group row">
                                    <label for="updates" class="col-form-label col-sm-2">Updates <i class="text-danger fas fa-flag"></i></label>
                                    <div class="col-sm-10">
                                        <textarea rows="4" style="resize: none;" class="form-control @error('updates') is-invalid @enderror" id="updates" name="updates">{{ old('updates') }}</textarea>
                                        @error('updates')<span class="error invalid-feedback">{{ $message }}</span>@enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="updates_date" class="col-form-label col-sm-2">As of <i class="text-danger fas fa-flag"></i></label>
                                    <div class="col-sm-10">
                                        <input type="date" class="form-control @error('updates_date') is-invalid @enderror" id="updates_date" name="updates_date" value="{{ old('updates_date') }}">
                                        @error('updates_date')<span class="error invalid-feedback">{{ $message }}</span>@enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--/. Status & Updates -->

                    <!-- Funding Source Breakdown -->
                    <div class="col-md-12">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">{{ __("Investment Required by Funding Source") }} </h3>
                            </div>
                            <div class="card-body">
                                <div class="row px-2 pb-2">
                                    <i class="text-danger fas fa-flag"></i> All fields are required.
                                </div>
                                <table class="table table-responsive table-sm">
                                    <thead>
                                    <tr>
                                        <th></th>
                                        <th class="text-sm text-center">2016 &amp; Prior</th>
                                        <th class="text-sm text-center">2017</th>
                                        <th class="text-sm text-center">2018</th>
                                        <th class="text-sm text-center">2019</th>
                                        <th class="text-sm text-center">2020</th>
                                        <th class="text-sm text-center">2021</th>
                                        <th class="text-sm text-center">2022</th>
                                        <th class="text-sm text-center">2023 &amp; Beyond</th>
                                        <th class="text-sm text-center">Total</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($funding_sources as $fs)
                                        <tr>
                                            <th class="text-sm">
                                                <input type="hidden" name="fs_investments[{{$fs->id}}][fs_id]" value="{{ $fs->id }}">
                                                {{ $fs->name }}
                                            </th>
                                            <td><input type="text" class="fs_investments fs_investments_2016 fs_investments_{{$fs->id}} money form-control text-right" name="fs_investments[{{$fs->id}}][y2016]" value="{{ old("fs_investments.{$fs->id}.y2016", 0) }}"></td>
                                            <td><input type="text" class="fs_investments fs_investments_2017 fs_investments_{{$fs->id}} money form-control text-right" name="fs_investments[{{$fs->id}}][y2017]" value="{{ old("fs_investments.{$fs->id}.y2017", 0) }}"></td>
                                            <td><input type="text" class="fs_investments fs_investments_2018 fs_investments_{{$fs->id}} money form-control text-right" name="fs_investments[{{$fs->id}}][y2018]" value="{{ old("fs_investments.{$fs->id}.y2018", 0) }}"></td>
                                            <td><input type="text" class="fs_investments fs_investments_2019 fs_investments_{{$fs->id}} money form-control text-right" name="fs_investments[{{$fs->id}}][y2019]" value="{{ old("fs_investments.{$fs->id}.y2019", 0) }}"></td>
                                            <td><input type="text" class="fs_investments fs_investments_2020 fs_investments_{{$fs->id}} money form-control text-right" name="fs_investments[{{$fs->id}}][y2020]" value="{{ old("fs_investments.{$fs->id}.y2020", 0) }}"></td>
                                            <td><input type="text" class="fs_investments fs_investments_2021 fs_investments_{{$fs->id}} money form-control text-right" name="fs_investments[{{$fs->id}}][y2021]" value="{{ old("fs_investments.{$fs->id}.y2021", 0) }}"></td>
                                            <td><input type="text" class="fs_investments fs_investments_2022 fs_investments_{{$fs->id}} money form-control text-right" name="fs_investments[{{$fs->id}}][y2022]" value="{{ old("fs_investments.{$fs->id}.y2022", 0) }}"></td>
                                            <td><input type="text" class="fs_investments fs_investments_2023 fs_investments_{{$fs->id}} money form-control text-right" name="fs_investments[{{$fs->id}}][y2023]" value="{{ old("fs_investments.{$fs->id}.y2023", 0) }}"></td>
                                            <td><input type="text" class="form-control text-right" id="fs_investments_{{$fs->id}}_total" readonly></td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>Total</th>
                                            <th>
                                                <input type="text" class="form-control money text-right" id="fs_investments_2016_total" readonly>
                                            </th>
                                            <th>
                                                <input type="text" class="form-control money text-right" id="fs_investments_2017_total" readonly>
                                            </th>
                                            <th>
                                                <input type="text" class="form-control money text-right" id="fs_investments_2018_total" readonly>
                                            </th>
                                            <th>
                                                <input type="text" class="form-control money text-right" id="fs_investments_2019_total" readonly>
                                            </th>
                                            <th>
                                                <input type="text" class="form-control money text-right" id="fs_investments_2020_total" readonly>
                                            </th>
                                            <th>
                                                <input type="text" class="form-control money text-right" id="fs_investments_2021_total" readonly>
                                            </th>
                                            <th>
                                                <input type="text" class="form-control money text-right" id="fs_investments_2022_total" readonly>
                                            </th>
                                            <th>
                                                <input type="text" class="form-control money text-right" id="fs_investments_2023_total" readonly>
                                            </th>
                                            <th>
                                                <input type="text" class="form-control text-right" id="fs_investments_total" readonly>
                                            </th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!--/. Funding Source Breakdown -->

                    <!-- Regional Breakdown -->
                    <div class="col-md-12">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">{{ __("Investment Required by Region") }} </h3>
                            </div>
                            <div class="card-body">
                                <div class="row px-2 pb-2">
                                    <i class="text-danger fas fa-flag"></i> All fields are required.
                                </div>
                                <table class="table table-responsive table-sm">
                                    <thead>
                                    <tr>
                                        <th></th>
                                        <th class="text-sm text-center">2016 &amp; Prior</th>
                                        <th class="text-sm text-center">2017</th>
                                        <th class="text-sm text-center">2018</th>
                                        <th class="text-sm text-center">2019</th>
                                        <th class="text-sm text-center">2020</th>
                                        <th class="text-sm text-center">2021</th>
                                        <th class="text-sm text-center">2022</th>
                                        <th class="text-sm text-center">2023 &amp; Beyond</th>
                                        <th class="text-sm text-center">Total</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($regions->sortBy('order') as $fs)
                                        {{-- Exclude not applicable --}}
                                        @if($fs->id !== 100)
                                        <tr>
                                            <th class="text-sm">
                                                <input type="hidden" name="region_investments[{{$fs->id}}][region_id]" value="{{ $fs->id }}">
                                                {{ $fs->name }}
                                            </th>
                                            <td><input type="text" class="region_investments region_investments_2016 region_investments_{{$fs->id}} form-control money text-right" name="region_investments[{{$fs->id}}][y2016]" value="{{ old("region_investments.{$fs->id}.y2016", 0) }}"></td>
                                            <td><input type="text" class="region_investments region_investments_2017 region_investments_{{$fs->id}} form-control money text-right" name="region_investments[{{$fs->id}}][y2017]" value="{{ old("region_investments.{$fs->id}.y2017", 0) }}"></td>
                                            <td><input type="text" class="region_investments region_investments_2018 region_investments_{{$fs->id}} form-control money text-right" name="region_investments[{{$fs->id}}][y2018]" value="{{ old("region_investments.{$fs->id}.y2018", 0) }}"></td>
                                            <td><input type="text" class="region_investments region_investments_2019 region_investments_{{$fs->id}} form-control money text-right" name="region_investments[{{$fs->id}}][y2019]" value="{{ old("region_investments.{$fs->id}.y2019", 0) }}"></td>
                                            <td><input type="text" class="region_investments region_investments_2020 region_investments_{{$fs->id}} form-control money text-right" name="region_investments[{{$fs->id}}][y2020]" value="{{ old("region_investments.{$fs->id}.y2020", 0) }}"></td>
                                            <td><input type="text" class="region_investments region_investments_2021 region_investments_{{$fs->id}} form-control money text-right" name="region_investments[{{$fs->id}}][y2021]" value="{{ old("region_investments.{$fs->id}.y2021", 0) }}"></td>
                                            <td><input type="text" class="region_investments region_investments_2022 region_investments_{{$fs->id}} form-control money text-right" name="region_investments[{{$fs->id}}][y2022]" value="{{ old("region_investments.{$fs->id}.y2022", 0) }}"></td>
                                            <td><input type="text" class="region_investments region_investments_2023 region_investments_{{$fs->id}} form-control money text-right" name="region_investments[{{$fs->id}}][y2023]" value="{{ old("region_investments.{$fs->id}.y2023", 0) }}"></td>
                                            <td><input type="text" class="form-control money text-right" id="region_investments_{{$fs->id}}_total" readonly></td>
                                        </tr>
                                        @endif
                                    @endforeach
                                    </tbody>
                                    <tfoot>
                                    <tr>
                                        <th>Total</th>
                                        <th>
                                            <input type="text" class="form-control money text-right" id="region_investments_2016_total" readonly>
                                        </th>
                                        <th>
                                            <input type="text" class="form-control money text-right" id="region_investments_2017_total" readonly>
                                        </th>
                                        <th>
                                            <input type="text" class="form-control money text-right" id="region_investments_2018_total" readonly>
                                        </th>
                                        <th>
                                            <input type="text" class="form-control money text-right" id="region_investments_2019_total" readonly>
                                        </th>
                                        <th>
                                            <input type="text" class="form-control money text-right" id="region_investments_2020_total" readonly>
                                        </th>
                                        <th>
                                            <input type="text" class="form-control money text-right" id="region_investments_2021_total" readonly>
                                        </th>
                                        <th>
                                            <input type="text" class="form-control money text-right" id="region_investments_2022_total" readonly>
                                        </th>
                                        <th>
                                            <input type="text" class="form-control money text-right" id="region_investments_2023_total" readonly>
                                        </th>
                                        <th>
                                            <input type="text" class="form-control money text-right" id="region_investments_total" readonly>
                                        </th>
                                    </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!--/. Regional Breakdown -->

                    <!-- Financial Status -->
                    <div class="col-md-12">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">{{ __("Financial Status") }}</h3>
                            </div>
                            <div class="card-body">
                                <div class="row px-2 pb-2">
                                    <i class="text-danger fas fa-flag"></i> All fields are required.
                                </div>
                                <table class="table table-responsive table-sm">
                                    <thead>
                                    <tr>
                                        <th></th>
                                        <th class="text-sm text-center">2016 &amp; Prior</th>
                                        <th class="text-sm text-center">2017</th>
                                        <th class="text-sm text-center">2018</th>
                                        <th class="text-sm text-center">2019</th>
                                        <th class="text-sm text-center">2020</th>
                                        <th class="text-sm text-center">2021</th>
                                        <th class="text-sm text-center">2022</th>
                                        <th class="text-sm text-center">2023 &amp; Beyond</th>
                                        <th class="text-sm text-center">Total</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <th class="text-sm">National Expenditure Program (NEP)</th>
                                        <td><input type="text" class="nep money form-control text-right" name="nep[y2016]" value="{{ old("nep.y2016", 0) }}"></td>
                                        <td><input type="text" class="nep money form-control text-right" name="nep[y2017]" value="{{ old("nep.y2017", 0) }}"></td>
                                        <td><input type="text" class="nep money form-control text-right" name="nep[y2018]" value="{{ old("nep.y2018", 0) }}"></td>
                                        <td><input type="text" class="nep money form-control text-right" name="nep[y2019]" value="{{ old("nep.y2019", 0) }}"></td>
                                        <td><input type="text" class="nep money form-control text-right" name="nep[y2020]" value="{{ old("nep.y2020", 0) }}"></td>
                                        <td><input type="text" class="nep money form-control text-right" name="nep[y2021]" value="{{ old("nep.y2021", 0) }}"></td>
                                        <td><input type="text" class="nep money form-control text-right" name="nep[y2022]" value="{{ old("nep.y2022", 0) }}"></td>
                                        <td><input type="text" class="nep money form-control text-right" name="nep[y2023]" value="{{ old("nep.y2023", 0) }}"></td>
                                        <td><input type="text" class="form-control text-right" id="nep_total" readonly></td>
                                    </tr>
                                    <tr>
                                        <th class="text-sm">General Appropriations Act (GAA)</th>
                                        <td><input type="text" class="allocation money form-control text-right" name="allocation[y2016]" value="{{ old("allocation.y2016", 0) }}"></td>
                                        <td><input type="text" class="allocation money form-control text-right" name="allocation[y2017]" value="{{ old("allocation.y2017", 0) }}"></td>
                                        <td><input type="text" class="allocation money form-control text-right" name="allocation[y2018]" value="{{ old("allocation.y2018", 0) }}"></td>
                                        <td><input type="text" class="allocation money form-control text-right" name="allocation[y2019]" value="{{ old("allocation.y2019", 0) }}"></td>
                                        <td><input type="text" class="allocation money form-control text-right" name="allocation[y2020]" value="{{ old("allocation.y2020", 0) }}"></td>
                                        <td><input type="text" class="allocation money form-control text-right" name="allocation[y2021]" value="{{ old("allocation.y2021", 0) }}"></td>
                                        <td><input type="text" class="allocation money form-control text-right" name="allocation[y2022]" value="{{ old("allocation.y2022", 0) }}"></td>
                                        <td><input type="text" class="allocation money form-control text-right" name="allocation[y2023]" value="{{ old("allocation.y2023", 0) }}"></td>
                                        <td><input type="text" class="form-control text-right" id="allocation_total" readonly></td>
                                    </tr>
                                    <tr>
                                        <th class="text-sm">Actual Disbursement</th>
                                        <td><input type="text" class="disbursement money form-control text-right" name="disbursement[y2016]" value="{{ old("disbursement.y2016", 0) }}"></td>
                                        <td><input type="text" class="disbursement money form-control text-right" name="disbursement[y2017]" value="{{ old("disbursement.y2017", 0) }}"></td>
                                        <td><input type="text" class="disbursement money form-control text-right" name="disbursement[y2018]" value="{{ old("disbursement.y2018", 0) }}"></td>
                                        <td><input type="text" class="disbursement money form-control text-right" name="disbursement[y2019]" value="{{ old("disbursement.y2019", 0) }}"></td>
                                        <td><input type="text" class="disbursement money form-control text-right" name="disbursement[y2020]" value="{{ old("disbursement.y2020", 0) }}"></td>
                                        <td><input type="text" class="disbursement money form-control text-right" name="disbursement[y2021]" value="{{ old("disbursement.y2021", 0) }}"></td>
                                        <td><input type="text" class="disbursement money form-control text-right" name="disbursement[y2022]" value="{{ old("disbursement.y2022", 0) }}"></td>
                                        <td><input type="text" class="disbursement money form-control text-right" name="disbursement[y2023]" value="{{ old("disbursement.y2023", 0) }}"></td>
                                        <td><input type="text" class="form-control text-right" id="disbursement_total" readonly></td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!--/. Financial Status -->
                </div>

                <div class="card-footer">
                    <div class="btn-group">
                        <button type="submit" class="btn btn-primary" dusk="submit-button">Submit</button>
                        <button type="button" class="btn btn-primary dropdown-toggle dropdown-icon" data-toggle="dropdown" aria-expanded="false">
                            <span class="sr-only">Toggle Dropdown</span>
                        </button>
                        <div class="dropdown-menu" role="menu" style="">
                            <button type="submit" name="new" class="dropdown-item" href="#">Submit &amp; Create Another</button>
                            <button type="submit" name="view" class="dropdown-item" href="#">Submit &amp; View</button>
                            <button type="submit" name="edit" class="dropdown-item" href="#">Submit &amp; Edit</button>
                            <button type="submit" name="back" class="dropdown-item" href="#">Submit &amp; Back to List</button>
                        </div>
                    </div>
                </div>

            </form>
        </div>
    </section>

    <a id="back-to-top" href="#" class="btn btn-primary back-to-top" role="button" aria-label="Scroll to top">
        <i class="fas fa-chevron-up"></i>
    </a>
@endsection

@include('projects.partials.script')