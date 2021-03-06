@php
    $route = Route::currentRouteName();
@endphp
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', config('app.name', 'Laravel'))</title>

    @favicon

    <!-- CSS -->
    <link href="{{ mix('css/app.css') }}" rel="stylesheet"/>

    <link href="https://unpkg.com/@github/details-dialog-element/dist/index.css" rel="stylesheet" />

    <link rel="stylesheet" href="{{ asset('css/custom.css') }}" />
    @livewireStyles

    @yield('styles')
</head>
<body>

    @include('includes.header')

    @if(Session::has('error'))
        <x-dismissable-flash-message :message="Session::get('error')" type="error"></x-dismissable-flash-message>
    @endif

    @if(session()->has('success'))
        <x-dismissable-flash-message :message="Session::get('success')" type="success"></x-dismissable-flash-message>
    @endif

    @if(session()->has('errors'))
        <x-dismissable-flash-message message="Form validation error. Check your inputs for errors." type="error"></x-dismissable-flash-message>
    @endif

    <main>
        @if ($baseProject->isArchived())
            <div class="flash flash-warn flash-full border-top-0 text-center text-bold py-2">
                This PAP has been archived by the owner. It is now read-only.
            </div>
        @endif
        @if ($project->isArchived())
            <div class="flash flash-warn flash-full border-top-0 text-center text-bold py-2">
                This branch has been archived by the owner. It can no longer be edited. Please see the list of branches if there is a later branch created.
            </div>
        @endif
        <div class="hx_page-header-bg pt-3 hide-full-screen mb-5 color-bg-secondary">
            <div class="d-flex mb-3 px-3 px-md-4 px-lg-5">
                <div class="flex-auto min-width-0 width-fit mr-3">
                    <h1 class="d-flex flex-wrap flex-items-center break-word f3 text-normal">
                        <svg class="octicon octicon-repo color-text-secondary mr-2" viewBox="0 0 16 16" version="1.1"
                             width="16" height="16" aria-hidden="true">
                            <path fill-rule="evenodd"
                                  d="M2 2.5A2.5 2.5 0 014.5 0h8.75a.75.75 0 01.75.75v12.5a.75.75 0 01-.75.75h-2.5a.75.75 0 110-1.5h1.75v-2h-8a1 1 0 00-.714 1.7.75.75 0 01-1.072 1.05A2.495 2.495 0 012 11.5v-9zm10.5-1V9h-8c-.356 0-.694.074-1 .208V2.5a1 1 0 011-1h8zM5 12.25v3.25a.25.25 0 00.4.2l1.45-1.087a.25.25 0 01.3 0L8.6 15.7a.25.25 0 00.4-.2v-3.25a.25.25 0 00-.25-.25h-3.5a.25.25 0 00-.25.25z"></path>
                        </svg>
                        <span class="flex-self-stretch">
                            <a class="url fn" rel="author" href="{{ route('users.show', $baseProject->owner ?? '#') }}">
                                {{ $baseProject->owner->username ?? $baseProject->owner->first_name }}
                            </a>
                        </span>
                        <span class="mx-1 flex-self-stretch color-text-secondary">/</span>
                        <strong class="mr-2 flex-self-stretch Truncate">
                            <a href="{{ route('base-projects.show', $baseProject) }}" class="Truncate-text">
                                {{ $baseProject->title }}
                            </a>
                        </strong>
                        <span class="branch-name">
                            <!-- <%= octicon("git-branch", width:16, height:16) %> -->
                            <svg width="10" height="16" viewBox="0 0 10 16" class="octicon octicon-git-branch" aria-hidden="true">
                                <path
                                    fill-rule="evenodd"
                                    d="M10 5c0-1.11-.89-2-2-2a1.993 1.993 0 0 0-1 3.72v.3c-.02.52-.23.98-.63 1.38-.4.4-.86.61-1.38.63-.83.02-1.48.16-2 .45V4.72a1.993 1.993 0 0 0-1-3.72C.88 1 0 1.89 0 3a2 2 0 0 0 1 1.72v6.56c-.59.35-1 .99-1 1.72 0 1.11.89 2 2 2 1.11 0 2-.89 2-2 0-.53-.2-1-.53-1.36.09-.06.48-.41.59-.47.25-.11.56-.17.94-.17 1.05-.05 1.95-.45 2.75-1.25S8.95 7.77 9 6.73h-.02C9.59 6.37 10 5.73 10 5zM2 1.8c.66 0 1.2.55 1.2 1.2 0 .65-.55 1.2-1.2 1.2C1.35 4.2.8 3.65.8 3c0-.65.55-1.2 1.2-1.2zm0 12.41c-.66 0-1.2-.55-1.2-1.2 0-.65.55-1.2 1.2-1.2.65 0 1.2.55 1.2 1.2 0 .65-.55 1.2-1.2 1.2zm6-8c-.66 0-1.2-.55-1.2-1.2 0-.65.55-1.2 1.2-1.2.65 0 1.2.55 1.2 1.2 0 .65-.55 1.2-1.2 1.2z"
                                />
                            </svg>
                            {{ optional($project->branch)->label }}
                        </span>
                    </h1>
                </div>
            </div>

            <nav  class="overflow-hidden UnderlineNav px-3 px-md-4 px-lg-5">
                <ul  class="UnderlineNav-body list-style-none">
                    <li  class="d-flex">
                        <a href="{{ route('base-projects.branches.show', ['base_project' => $baseProject, 'branch' => $project->branch]) }}"
                           class="UnderlineNav-item no-wrap @if(in_array($route,['base-projects.branches.index','base-projects.branches.show'])) selected @endif">
                            <svg class="octicon octicon-code UnderlineNav-octicon d-none d-sm-inline" viewBox="0 0 16 16" version="1.1" width="16" height="16" aria-hidden="true">
                                <path fill-rule="evenodd" d="M4.72 3.22a.75.75 0 011.06 1.06L2.06 8l3.72 3.72a.75.75 0 11-1.06 1.06L.47 8.53a.75.75 0 010-1.06l4.25-4.25zm6.56 0a.75.75 0 10-1.06 1.06L13.94 8l-3.72 3.72a.75.75 0 101.06 1.06l4.25-4.25a.75.75 0 000-1.06l-4.25-4.25z"></path>
                            </svg>
                            <span>Profile</span>
                            <span title="Not available" class="Counter"></span>
                        </a>
                    </li>

                    @if($baseProject->has_infra)
                    <li class="d-flex">
                        <a href="{{ route('trips.edit', $project) }}"
                           class="UnderlineNav-item no-wrap @if($route == 'trips.edit') selected @endif">
                            <svg class="octicon octicon-tools UnderlineNav-octicon d-none d-sm-inline" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" width="16" height="16" aria-hidden="true">
                                <path fill-rule="evenodd" d="M5.433 2.304A4.494 4.494 0 003.5 6c0 1.598.832 3.002 2.09 3.802.518.328.929.923.902 1.64v.008l-.164 3.337a.75.75 0 11-1.498-.073l.163-3.33c.002-.085-.05-.216-.207-.316A5.996 5.996 0 012 6a5.994 5.994 0 012.567-4.92 1.482 1.482 0 011.673-.04c.462.296.76.827.76 1.423v2.82c0 .082.041.16.11.206l.75.51a.25.25 0 00.28 0l.75-.51A.25.25 0 009 5.282V2.463c0-.596.298-1.127.76-1.423a1.482 1.482 0 011.673.04A5.994 5.994 0 0114 6a5.996 5.996 0 01-2.786 5.068c-.157.1-.209.23-.207.315l.163 3.33a.75.75 0 11-1.498.074l-.164-3.345c-.027-.717.384-1.312.902-1.64A4.496 4.496 0 0012.5 6a4.494 4.494 0 00-1.933-3.696c-.024.017-.067.067-.067.16v2.818a1.75 1.75 0 01-.767 1.448l-.75.51a1.75 1.75 0 01-1.966 0l-.75-.51A1.75 1.75 0 015.5 5.282V2.463c0-.092-.043-.142-.067-.159zm.01-.005z"></path>
                            </svg>
                            <span>TRIP</span>
                        </a>
                    </li>
                    @endif

                    <li  class="d-flex">
                        <!-- TODO: review create -->
                        <a href="{{ route('projects.reviews.index', $project) }}"
                           class="UnderlineNav-item no-wrap @if($route == 'projects.reviews.index') selected @endif">

                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" class="octicon octicon-git-pull-request UnderlineNav-octicon d-none d-sm-inline">
                                <path fill-rule="evenodd" d="M3.75 1.5a.25.25 0 00-.25.25v11.5c0 .138.112.25.25.25h8.5a.25.25 0 00.25-.25V6H9.75A1.75 1.75 0 018 4.25V1.5H3.75zm5.75.56v2.19c0 .138.112.25.25.25h2.19L9.5 2.06zM2 1.75C2 .784 2.784 0 3.75 0h5.086c.464 0 .909.184 1.237.513l3.414 3.414c.329.328.513.773.513 1.237v8.086A1.75 1.75 0 0112.25 15h-8.5A1.75 1.75 0 012 13.25V1.75z"/>
                            </svg>
                            <span>Review</span>
                            <span title="0" hidden="hidden"  class="Counter">0</span>

                        </a>
                    </li>

                    <li  class="d-flex">
                        <a href="{{ route('projects.pipols.index', $project) }}"
                           class="UnderlineNav-item no-wrap @if($route == 'projects.pipols.index') selected @endif">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" class="octicon octicon-git-pull-request UnderlineNav-octicon d-none d-sm-inline">
                                <path fill-rule="evenodd" d="M3.75 1.5a.25.25 0 00-.25.25v11.5c0 .138.112.25.25.25h8.5a.25.25 0 00.25-.25V6H9.75A1.75 1.75 0 018 4.25V1.5H3.75zm5.75.56v2.19c0 .138.112.25.25.25h2.19L9.5 2.06zM2 1.75C2 .784 2.784 0 3.75 0h5.086c.464 0 .909.184 1.237.513l3.414 3.414c.329.328.513.773.513 1.237v8.086A1.75 1.75 0 0112.25 15h-8.5A1.75 1.75 0 012 13.25V1.75z"/>
                            </svg>
                            <span>PIPOL</span>
                            <span title="0" hidden="hidden"  class="Counter">0</span>
                        </a>
                    </li>

                    <li  class="d-flex">
                        <a href="{{ route('projects.files', $project) }}"
                           class="UnderlineNav-item no-wrap @if($route == 'projects.files') selected @endif">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" class="octicon octicon-git-pull-request UnderlineNav-octicon d-none d-sm-inline">
                                <path fill-rule="evenodd" d="M3.75 1.5a.25.25 0 00-.25.25v11.5c0 .138.112.25.25.25h8.5a.25.25 0 00.25-.25V6H9.75A1.75 1.75 0 018 4.25V1.5H3.75zm5.75.56v2.19c0 .138.112.25.25.25h2.19L9.5 2.06zM2 1.75C2 .784 2.784 0 3.75 0h5.086c.464 0 .909.184 1.237.513l3.414 3.414c.329.328.513.773.513 1.237v8.086A1.75 1.75 0 0112.25 15h-8.5A1.75 1.75 0 012 13.25V1.75z"/>
                            </svg>
                            <span>Files</span>
                            <span title="0" hidden="hidden"  class="Counter">0</span>

                        </a>
                    </li>

                    <li  class="d-flex">
                        <a href="{{ route('projects.history', $project) }}"
                           class="UnderlineNav-item no-wrap @if($route == 'projects.history') selected @endif">

                            <svg class="octicon octicon-git-pull-request UnderlineNav-octicon d-none d-sm-inline"
                                 viewBox="0 0 16 16" version="1.1" width="16" height="16" aria-hidden="true">
                                <path fill-rule="evenodd"
                                      d="M7.177 3.073L9.573.677A.25.25 0 0110 .854v4.792a.25.25 0 01-.427.177L7.177 3.427a.25.25 0 010-.354zM3.75 2.5a.75.75 0 100 1.5.75.75 0 000-1.5zm-2.25.75a2.25 2.25 0 113 2.122v5.256a2.251 2.251 0 11-1.5 0V5.372A2.25 2.25 0 011.5 3.25zM11 2.5h-1V4h1a1 1 0 011 1v5.628a2.251 2.251 0 101.5 0V5A2.5 2.5 0 0011 2.5zm1 10.25a.75.75 0 111.5 0 .75.75 0 01-1.5 0zM3.75 12a.75.75 0 100 1.5.75.75 0 000-1.5z"></path>
                            </svg>
                            <span data-content="History">History</span>
                        </a>
                    </li>

                    <li  class="d-flex">
                        <a href="{{ route('base-projects.branches.issues', ['base_project' => $baseProject, 'branch' => $project->branch]) }}"
                           class="UnderlineNav-item no-wrap @if($route == 'base-projects.branches.issues') selected @endif">

                            <svg class="octicon octicon-issue-opened UnderlineNav-octicon d-none d-sm-inline"
                                 viewBox="0 0 16 16" version="1.1" width="16" height="16" aria-hidden="true">
                                <path d="M8 9.5a1.5 1.5 0 100-3 1.5 1.5 0 000 3z"></path>
                                <path fill-rule="evenodd"
                                      d="M8 0a8 8 0 100 16A8 8 0 008 0zM1.5 8a6.5 6.5 0 1113 0 6.5 6.5 0 01-13 0z"></path>
                            </svg>
                            <span>Issues</span>
                            <span title="{{ $project->issues->count() }}"  class="Counter">
                                {{ $project->issues->count() }}
                            </span>
                        </a>
                    </li>

                    <li  class="d-flex">
                        <a href="{{ route('base-projects.settings', $baseProject) }}" class="UnderlineNav-item no-wrap @if($route == 'base-projects.settings') selected @endif">
                            <!-- TODO: Add Settings page -->
                            <svg class="octicon octicon-gear UnderlineNav-octicon d-none d-sm-inline" viewBox="0 0 16 16" version="1.1" width="16" height="16" aria-hidden="true"><path fill-rule="evenodd" d="M7.429 1.525a6.593 6.593 0 011.142 0c.036.003.108.036.137.146l.289 1.105c.147.56.55.967.997 1.189.174.086.341.183.501.29.417.278.97.423 1.53.27l1.102-.303c.11-.03.175.016.195.046.219.31.41.641.573.989.014.031.022.11-.059.19l-.815.806c-.411.406-.562.957-.53 1.456a4.588 4.588 0 010 .582c-.032.499.119 1.05.53 1.456l.815.806c.08.08.073.159.059.19a6.494 6.494 0 01-.573.99c-.02.029-.086.074-.195.045l-1.103-.303c-.559-.153-1.112-.008-1.529.27-.16.107-.327.204-.5.29-.449.222-.851.628-.998 1.189l-.289 1.105c-.029.11-.101.143-.137.146a6.613 6.613 0 01-1.142 0c-.036-.003-.108-.037-.137-.146l-.289-1.105c-.147-.56-.55-.967-.997-1.189a4.502 4.502 0 01-.501-.29c-.417-.278-.97-.423-1.53-.27l-1.102.303c-.11.03-.175-.016-.195-.046a6.492 6.492 0 01-.573-.989c-.014-.031-.022-.11.059-.19l.815-.806c.411-.406.562-.957.53-1.456a4.587 4.587 0 010-.582c.032-.499-.119-1.05-.53-1.456l-.815-.806c-.08-.08-.073-.159-.059-.19a6.44 6.44 0 01.573-.99c.02-.029.086-.075.195-.045l1.103.303c.559.153 1.112.008 1.529-.27.16-.107.327-.204.5-.29.449-.222.851-.628.998-1.189l.289-1.105c.029-.11.101-.143.137-.146zM8 0c-.236 0-.47.01-.701.03-.743.065-1.29.615-1.458 1.261l-.29 1.106c-.017.066-.078.158-.211.224a5.994 5.994 0 00-.668.386c-.123.082-.233.09-.3.071L3.27 2.776c-.644-.177-1.392.02-1.82.63a7.977 7.977 0 00-.704 1.217c-.315.675-.111 1.422.363 1.891l.815.806c.05.048.098.147.088.294a6.084 6.084 0 000 .772c.01.147-.038.246-.088.294l-.815.806c-.474.469-.678 1.216-.363 1.891.2.428.436.835.704 1.218.428.609 1.176.806 1.82.63l1.103-.303c.066-.019.176-.011.299.071.213.143.436.272.668.386.133.066.194.158.212.224l.289 1.106c.169.646.715 1.196 1.458 1.26a8.094 8.094 0 001.402 0c.743-.064 1.29-.614 1.458-1.26l.29-1.106c.017-.066.078-.158.211-.224a5.98 5.98 0 00.668-.386c.123-.082.233-.09.3-.071l1.102.302c.644.177 1.392-.02 1.82-.63.268-.382.505-.789.704-1.217.315-.675.111-1.422-.364-1.891l-.814-.806c-.05-.048-.098-.147-.088-.294a6.1 6.1 0 000-.772c-.01-.147.039-.246.088-.294l.814-.806c.475-.469.679-1.216.364-1.891a7.992 7.992 0 00-.704-1.218c-.428-.609-1.176-.806-1.82-.63l-1.103.303c-.066.019-.176.011-.299-.071a5.991 5.991 0 00-.668-.386c-.133-.066-.194-.158-.212-.224L10.16 1.29C9.99.645 9.444.095 8.701.031A8.094 8.094 0 008 0zm1.5 8a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM11 8a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                            <span>Settings</span>
                            <span class="Counter"></span>
                        </a>
                    </li>
                </ul>
            </nav>

        </div>
            @yield('content')
        </div>
    </main>

    <script src="{{ mix('js/app.js') }}" type="text/javascript"></script>
    @livewireScripts
    <script defer src="https://unpkg.com/alpinejs@3.1.1/dist/cdn.min.js"></script>
    @stack('scripts')

</body>
</html>
