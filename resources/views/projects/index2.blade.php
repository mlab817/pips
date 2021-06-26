@extends('layouts.app')

@section('content')
    <div>

        <div class="position-relative">

            <div id="user-projects-list" class="mt-3">
                <div class="container-lg clearfix mb-3">
                    <div class="d-none d-md-block col-6 float-right mb-2 mb-md-0">
                        <a href="{{ route('projects.create') }}" class="btn btn-primary d-block d-md-inline-block float-md-right text-center">New PAP</a>
                    </div>

                    <form class="col-12 col-md-6" data-pjax="true" action="/users/mlab817/projects" accept-charset="UTF-8" method="get">
                        <div class="auto-search-group float-left width-full">
                            <input type="text" name="query" id="query" value="is:open sort:created-desc " class="form-control form-control subnav-search-input input-contrast width-full" placeholder="Search all projects" aria-label="Search all projects" data-hotkey="Control+/,Meta+/">
                            <svg class="octicon octicon-search color-text-tertiary" viewBox="0 0 16 16" version="1.1" width="16" height="16" aria-hidden="true"><path fill-rule="evenodd" d="M11.5 7a4.499 4.499 0 11-8.998 0A4.499 4.499 0 0111.5 7zm-.82 4.74a6 6 0 111.06-1.06l3.04 3.04a.75.75 0 11-1.06 1.06l-3.04-3.04z"></path></svg>
                        </div>
                    </form>
                </div>

                @if($projects->total() > 0)
                <div class="container-lg clearfix border rounded-1 color-bg-canvas">
                    <div class="color-bg-tertiary p-3 border-bottom">
                        <div class="float-right table-list-header-toggle states">
                            <!-- '"` --><!-- </textarea></xmp> --><form action="" accept-charset="UTF-8" method="get">
                                <details class="details-reset details-overlay select-menu">
                                    <summary class="btn-link select-menu-button icon-only" aria-haspopup="menu" role="button">
                                        Sort
                                    </summary>

                                    <details-menu class="select-menu-modal position-absolute right-0" style="z-index: 99;" aria-label="Sort options" role="menu">
                                        <div class="select-menu-header">
                                            <span class="select-menu-title">Sort by</span>
                                        </div>

                                        <div class="select-menu-list">
                                            <a href="/users/mlab817/projects?query=is%3Aopen" class="select-menu-item" role="menuitemradio" aria-checked="true">
                                                <svg aria-hidden="true" viewBox="0 0 16 16" version="1.1" data-view-component="true" height="16" width="16" class="octicon octicon-check select-menu-item-icon">
                                                    <path fill-rule="evenodd" d="M13.78 4.22a.75.75 0 010 1.06l-7.25 7.25a.75.75 0 01-1.06 0L2.22 9.28a.75.75 0 011.06-1.06L6 10.94l6.72-6.72a.75.75 0 011.06 0z"></path>
                                                </svg>
                                                <div class="select-menu-item-text">Newest</div>
                                            </a>
                                            <a href="/users/mlab817/projects?query=is%3Aopen+sort%3Acreated-asc" class="select-menu-item" role="menuitemradio" aria-checked="false">
                                                <svg aria-hidden="true" viewBox="0 0 16 16" version="1.1" data-view-component="true" height="16" width="16" class="octicon octicon-check select-menu-item-icon">
                                                    <path fill-rule="evenodd" d="M13.78 4.22a.75.75 0 010 1.06l-7.25 7.25a.75.75 0 01-1.06 0L2.22 9.28a.75.75 0 011.06-1.06L6 10.94l6.72-6.72a.75.75 0 011.06 0z"></path>
                                                </svg>
                                                <div class="select-menu-item-text">Oldest</div>
                                            </a>
                                            <a href="/users/mlab817/projects?query=is%3Aopen+sort%3Aupdated-desc" class="select-menu-item" role="menuitemradio" aria-checked="false">
                                                <svg aria-hidden="true" viewBox="0 0 16 16" version="1.1" data-view-component="true" height="16" width="16" class="octicon octicon-check select-menu-item-icon">
                                                    <path fill-rule="evenodd" d="M13.78 4.22a.75.75 0 010 1.06l-7.25 7.25a.75.75 0 01-1.06 0L2.22 9.28a.75.75 0 011.06-1.06L6 10.94l6.72-6.72a.75.75 0 011.06 0z"></path>
                                                </svg>
                                                <div class="select-menu-item-text">Recently updated</div>
                                            </a>
                                            <a href="/users/mlab817/projects?query=is%3Aopen+sort%3Aupdated-asc" class="select-menu-item" role="menuitemradio" aria-checked="false">
                                                <svg aria-hidden="true" viewBox="0 0 16 16" version="1.1" data-view-component="true" height="16" width="16" class="octicon octicon-check select-menu-item-icon">
                                                    <path fill-rule="evenodd" d="M13.78 4.22a.75.75 0 010 1.06l-7.25 7.25a.75.75 0 01-1.06 0L2.22 9.28a.75.75 0 011.06-1.06L6 10.94l6.72-6.72a.75.75 0 011.06 0z"></path>
                                                </svg>
                                                <div class="select-menu-item-text">Least recently updated</div>
                                            </a>
                                            <a href="/users/mlab817/projects?query=is%3Aopen+sort%3Aname-asc" class="select-menu-item" role="menuitemradio" aria-checked="false">
                                                <svg aria-hidden="true" viewBox="0 0 16 16" version="1.1" data-view-component="true" height="16" width="16" class="octicon octicon-check select-menu-item-icon">
                                                    <path fill-rule="evenodd" d="M13.78 4.22a.75.75 0 010 1.06l-7.25 7.25a.75.75 0 01-1.06 0L2.22 9.28a.75.75 0 011.06-1.06L6 10.94l6.72-6.72a.75.75 0 011.06 0z"></path>
                                                </svg>
                                                <div class="select-menu-item-text">Name</div>
                                            </a>
                                        </div>
                                    </details-menu>
                                </details>
                            </form>
                        </div>

                        <div class="table-list-header-toggle states">
                            <a href="/users/mlab817/projects?query=is%3Aopen" class="btn-link selected">
                                <svg aria-hidden="true" viewBox="0 0 16 16" version="1.1" data-view-component="true" height="16" width="16" class="octicon octicon-project">
                                    <path fill-rule="evenodd" d="M1.75 0A1.75 1.75 0 000 1.75v12.5C0 15.216.784 16 1.75 16h12.5A1.75 1.75 0 0016 14.25V1.75A1.75 1.75 0 0014.25 0H1.75zM1.5 1.75a.25.25 0 01.25-.25h12.5a.25.25 0 01.25.25v12.5a.25.25 0 01-.25.25H1.75a.25.25 0 01-.25-.25V1.75zM11.75 3a.75.75 0 00-.75.75v7.5a.75.75 0 001.5 0v-7.5a.75.75 0 00-.75-.75zm-8.25.75a.75.75 0 011.5 0v5.5a.75.75 0 01-1.5 0v-5.5zM8 3a.75.75 0 00-.75.75v3.5a.75.75 0 001.5 0v-3.5A.75.75 0 008 3z"></path>
                                </svg> 2 Open
                            </a>
                            <a href="/users/mlab817/projects?query=is%3Aclosed" class="btn-link">
                                <svg aria-hidden="true" viewBox="0 0 16 16" version="1.1" data-view-component="true" height="16" width="16" class="octicon octicon-check">
                                    <path fill-rule="evenodd" d="M13.78 4.22a.75.75 0 010 1.06l-7.25 7.25a.75.75 0 01-1.06 0L2.22 9.28a.75.75 0 011.06-1.06L6 10.94l6.72-6.72a.75.75 0 011.06 0z"></path>
                                </svg> 0 Closed
                            </a>
                        </div>
                    </div>

                    <div id="projects-results">
                        @foreach($projects as $project)
                        <div class="Box-row clearfix position-relative pr-6">
                            <details class="details-reset details-overlay dropdown position-static">
                                <summary class="color-text-secondary position-absolute right-0 top-0 mt-3 px-3" aria-label="Project menu" aria-haspopup="menu" role="button">
                                    <svg aria-hidden="true" viewBox="0 0 16 16" version="1.1" data-view-component="true" height="16" width="16" class="octicon octicon-kebab-horizontal">
                                        <path d="M8 9a1.5 1.5 0 100-3 1.5 1.5 0 000 3zM1.5 9a1.5 1.5 0 100-3 1.5 1.5 0 000 3zm13 0a1.5 1.5 0 100-3 1.5 1.5 0 000 3z"></path>
                                    </svg>
                                </summary>

                                <details-menu class="dropdown-menu dropdown-menu-sw mt-6 mr-1 top-0" role="menu">
                                    <a href="{{ route('projects.edit', $project) }}" class="btn-link dropdown-item" role="menuitem">
                                        Edit
                                    </a>
                                    <!-- '"` --><!-- </textarea></xmp> -->
                                    <form action="/users/mlab817/projects/2/state" accept-charset="UTF-8" method="post"><input type="hidden" name="_method" value="put"><input type="hidden" name="authenticity_token" value="XGcFjVLHZZHOQuGV+O4WOGcNo53+8A60ot7N25QZxwO3hdTEwL2xmF5oaccPMoClHMl1nRqC5L1GlOV+9wRuJg==">
                                        <button type="submit" class="btn-link dropdown-item" name="state" value="closed" role="menuitem">
                                            Close
                                        </button>
                                    </form>                <div role="none" class="dropdown-divider"></div>

                                    <a href="/users/mlab817/projects/2/settings" class="btn-link dropdown-item" role="menuitem">
                                        Settings
                                    </a>
                                </details-menu>
                            </details>

                            <div class="col-12 col-md-6 col-lg-4 pr-2 float-left">
                                <h4 class="mb-1">
                                    <a href="{{ route('projects.show', $project) }}" class="Link--primary mr-1">
                                        {{ $project->title }}
                                    </a>
                                    <div class="d-inline no-wrap">
                                        <span class="Label Label--secondary v-align-middle mr-1 mb-1">Private</span>
                                    </div>
                                </h4>

                                <div class="f6 pr-sm-5 mb-2 mb-md-0 color-text-tertiary">
                                    <svg aria-hidden="true" viewBox="0 0 16 16" version="1.1" data-view-component="true" height="16" width="16" class="octicon octicon-clock">
                                        <path fill-rule="evenodd" d="M1.5 8a6.5 6.5 0 1113 0 6.5 6.5 0 01-13 0zM8 0a8 8 0 100 16A8 8 0 008 0zm.5 4.75a.75.75 0 00-1.5 0v3.5a.75.75 0 00.471.696l2.5 1a.75.75 0 00.557-1.392L8.5 7.742V4.75z"></path>
                                    </svg> Updated
                                    <relative-time datetime="{{ $project->updated_at }}" class="no-wrap" title="Jul 5, 2020, 10:20 PM GMT+8">
                                        on {{ $project->updated_at->format('M d, Y') }}
                                    </relative-time>
                                </div>

                                <div class="mt-1 pr-5 mb-2 mb-md-0">
                                    <div class="tooltipped tooltipped-n" aria-label="tasks: 80 done, 14 in progress, 6 open">
                                        <span class="Progress">
                                            <span class="Progress-item color-bg-success-inverse" style="width: 50%;"></span>
                                            <span class="Progress-item color-bg-warning-inverse" style="width: 25%;"></span>
                                            <span class="Progress-item color-bg-danger-inverse" style="width: 15%;"></span>
                                            <span class="Progress-item color-bg-info-inverse" style="width: 10%;"></span>
                                        </span>
                                    </div>

                                </div>

                            </div>

                            <div class="col-12 col-md-6 col-lg-8 float-left">
                                <p class="text-muted text-sm color-text-tertiary">
                                    {!! strip_tags(Str::limit($project->description->description ?? '', 160)) !!}
                                </p>
                                <p class="f5">
                                    <svg aria-hidden="true" viewBox="0 0 16 16" version="1.1" data-view-component="true" height="16" width="16" class="octicon octicon-link">
                                        <path fill-rule="evenodd" d="M7.775 3.275a.75.75 0 001.06 1.06l1.25-1.25a2 2 0 112.83 2.83l-2.5 2.5a2 2 0 01-2.83 0 .75.75 0 00-1.06 1.06 3.5 3.5 0 004.95 0l2.5-2.5a3.5 3.5 0 00-4.95-4.95l-1.25 1.25zm-4.69 9.64a2 2 0 010-2.83l2.5-2.5a2 2 0 012.83 0 .75.75 0 001.06-1.06 3.5 3.5 0 00-4.95 0l-2.5 2.5a3.5 3.5 0 004.95 4.95l1.25-1.25a.75.75 0 00-1.06-1.06l-1.25 1.25a2 2 0 01-2.83 0z"></path>
                                    </svg> Linked repositories:
                                    <a href="/mlab817/ipms-docs">ipms-docs</a>,
                                    <a href="/mlab817/ipms-docs-v2">ipms-docs-v2</a>,
                                    <a href="/mlab817/q-contacts">q-contacts</a>,
                                    <a href="/mlab817/ipms-reports">ipms-reports</a>,
                                    <a href="/mlab817/qpipol">qpipol</a>
                                </p>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="paginate-container d-none d-sm-flex flex-sm-justify-center">
                {!! $projects->links() !!}
            </div>

            @else

            <div class="blankslate">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" class="octicon octicon-octoface blankslate-icon">
                    <path d="M7.25 6a.75.75 0 00-.75.75v7.5a.75.75 0 001.5 0v-7.5A.75.75 0 007.25 6zM12 6a.75.75 0 00-.75.75v4.5a.75.75 0 001.5 0v-4.5A.75.75 0 0012 6zm4 .75a.75.75 0 011.5 0v9.5a.75.75 0 01-1.5 0v-9.5z"/><path fill-rule="evenodd" d="M3.75 2A1.75 1.75 0 002 3.75v16.5c0 .966.784 1.75 1.75 1.75h16.5A1.75 1.75 0 0022 20.25V3.75A1.75 1.75 0 0020.25 2H3.75zM3.5 3.75a.25.25 0 01.25-.25h16.5a.25.25 0 01.25.25v16.5a.25.25 0 01-.25.25H3.75a.25.25 0 01-.25-.25V3.75z"/>
                </svg>
                <h3 class="mb-1">You don’t seem to have any programs/projects.</h3>
                <p>Programs and projects added to {{ config('app.name','Laravel') }} are reviewed and evaluated
                    for inclusion in the NEDA PIP Online (PIPOL) System. Add your program/project now.</p>
                <a class="btn btn-primary my-3" role="button" href="{{ route('projects.create') }}">New PAP</a>
                {{--                <p><button class="btn-link" type="button">Learn more</button></p>--}}
            </div>

            @endif
        </div>
    </div>
@stop

@section('styles')
    <style lang="scss">
        .auto-search-group {
            position:relative;
        }

        .auto-search-group .auto-search-input {
            padding-left:30px;
        }

        .auto-search-group .spinner, .auto-search-group>.octicon {
            height:16px;
            left:10px;
            position:absolute;
            width:16px;
            z-index:5;
        }

        .auto-search-group .spinner{
            background-color:var(--color-bg-primary);
            top:9px;
        }

        .auto-search-group>.octicon{
            color:var(--color-icon-secondary);
            font-size: 14px;
            text-align: center;
            top: 10px;
        }
    </style>
@stop
