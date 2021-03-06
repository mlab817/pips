@extends('layouts.header-only')

@section('content')
    <div class="container-xl mx-auto">
        <div class="d-flex">
            <div class="flex-auto"></div>
            <input type="text" class="col-6 form-control input-contrast" placeholder="Search" id="search" name="search">
        </div>

        <div class="Box mt-3">
            <div class="Box-header">
                <h3 class="Box-title">Updating Periods</h3>
            </div>
            <div class="Box-body p-0">
                @foreach($updating_periods as $updating_period)
                    <div class="Box-row clearfix position-relative pr-6">
                        <details class="details-reset details-overlay dropdown position-static">
                            <summary class="color-text-secondary position-absolute right-0 top-0 mt-3 px-3" aria-haspopup="menu" role="button">
                                <svg aria-hidden="true" viewBox="0 0 16 16" version="1.1" height="16" width="16" class="octicon octicon-kebab-horizontal">
                                    <path d="M8 9a1.5 1.5 0 100-3 1.5 1.5 0 000 3zM1.5 9a1.5 1.5 0 100-3 1.5 1.5 0 000 3zm13 0a1.5 1.5 0 100-3 1.5 1.5 0 000 3z"></path>
                                </svg>
                            </summary>
                            <div class="dropdown-menu dropdown-menu-sw mt-6 mr-1 top-0" role="menu">
                                <a class="btn-link dropdown-item">Edit</a>
                                <a class="btn-link dropdown-item">Delete</a>
                            </div>
                        </details>
                        <div class="col pr-2 float-left">
                            <h4 class="mb-1">
                                <!-- Title-->
                                {{ $updating_period->name }}
                            </h4>
                            <div class="f6 pr-sm-5 mb-2 mb-md-0 color-text-tertiary">
                                <!-- updated at -->
                                <svg aria-hidden="true" viewBox="0 0 16 16" version="1.1" data-view-component="true" height="16" width="16" class="octicon octicon-clock">
                                    <path fill-rule="evenodd" d="M1.5 8a6.5 6.5 0 1113 0 6.5 6.5 0 01-13 0zM8 0a8 8 0 100 16A8 8 0 008 0zm.5 4.75a.75.75 0 00-1.5 0v3.5a.75.75 0 00.471.696l2.5 1a.75.75 0 00.557-1.392L8.5 7.742V4.75z"></path>
                                </svg>
                                {{ $updating_period->updated_at->diffForHumans(null, null, true) }}
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@stop
