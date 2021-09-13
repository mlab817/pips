@php
    $announcement = \App\Models\Announcement::orderByDesc('created_at')->first();
    $content = $announcement ? $announcement->content : null;
@endphp

@if($announcement)
<div class="Box position-relative rounded-2 mb-4 p-3 color-border-danger" action="/settings/dismiss-notice/dashboard_promo_universe_21" accept-charset="UTF-8" method="post"><input type="hidden" name="authenticity_token" value="Ll55iFCy1Dxm3qQEGsUi47T9h8fJKb+SkPmID0RxkXonAK2kSJmF82jVfsDfBSU+r6VBbF1xvgqO9ThlHRl3SQ==">
    <h3 class="h4">
        <svg aria-hidden="true" height="16" viewBox="0 0 16 16" version="1.1" width="16" data-view-component="true" class="octicon octicon-megaphone mr-1 color-text-tertiary">
            <g fill-rule="evenodd"><path d="M3.25 9a.75.75 0 01.75.75c0 2.142.456 3.828.733 4.653a.121.121 0 00.05.064.207.207 0 00.117.033h1.31c.085 0 .18-.042.258-.152a.448.448 0 00.075-.366A16.74 16.74 0 016 9.75a.75.75 0 011.5 0c0 1.588.25 2.926.494 3.85.293 1.113-.504 2.4-1.783 2.4H4.9c-.686 0-1.35-.41-1.589-1.12A16.42 16.42 0 012.5 9.75.75.75 0 013.25 9z"></path><path d="M0 6a4 4 0 014-4h2.75a.75.75 0 01.75.75v6.5a.75.75 0 01-.75.75H4a4 4 0 01-4-4zm4-2.5a2.5 2.5 0 000 5h2v-5H4z"></path><path d="M15.59.082A.75.75 0 0116 .75v10.5a.75.75 0 01-1.189.608l-.002-.001h.001l-.014-.01a5.829 5.829 0 00-.422-.25 10.58 10.58 0 00-1.469-.64C11.576 10.484 9.536 10 6.75 10a.75.75 0 110-1.5c2.964 0 5.174.516 6.658 1.043.423.151.787.302 1.092.443V2.014c-.305.14-.669.292-1.092.443C11.924 2.984 9.713 3.5 6.75 3.5a.75.75 0 110-1.5c2.786 0 4.826-.484 6.155-.957.665-.236 1.154-.47 1.47-.64a5.82 5.82 0 00.421-.25l.014-.01a.75.75 0 01.78-.061zm-.78.06zm.44 11.108l-.44.607.44-.607z"></path></g>
        </svg>
        <a href="https://githubuniverse.com" target="_blank" class="ml-1 color-text-primary">
            Announcement
        </a>
    </h3>
    <p class="my-3 text-small">
        {{ $content }}
    </p>
</div>
@endif
