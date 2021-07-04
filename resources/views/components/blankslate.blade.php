<div class="blankslate blankslate-spacious">
    <!-- <%= octicon "octoface", :height = 24, :class => "blankslate-icon" %> -->
    <svg class="octicon blankslate-icon" version="1.0" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 160 160" preserveAspectRatio="xMidYMid meet">
        <g transform="translate(0.000000,160.000000) scale(0.100000,-0.100000)" fill="currentColor" stroke="none">
            <path fill-rule="evenodd" d="M595 1585 c-212 -46 -425 -223 -525 -436 -95 -205 -96 -482 0 -686 100 -214 296 -379 521 -438 89 -24 329 -24 418 0 225 59 421 224 521 438 96 204 95 481 0 686 -101 216 -314 391 -529 437 -83 17 -325 17 -406 -1z m-57 -419 l64 -39 61 19 c81 25 193 25 274 0 l61 -19 84 51 83 51 3 -68 c2 -41 -3 -85 -11 -110 -14 -38 -13 -43 4 -66 46 -57 63 -116 64 -210 0 -82 -3 -96 -33 -157 -87 -177 -307 -275 -499 -224 -86 23 -144 56 -206 117 -84 84 -112 150 -112 264 1 94 18 153 64 210 17 22 17 28 5 62 -7 21 -13 71 -14 112 l0 73 23 -14 c12 -8 51 -31 85 -52z"/>
            <path fill-rule="evenodd" d="M727 804 c-15 -15 -6 -51 18 -74 14 -13 25 -34 25 -47 0 -19 -5 -23 -28 -23 -32 0 -52 16 -52 42 0 11 -7 18 -20 18 -34 0 -20 -55 23 -92 29 -26 185 -26 214 0 43 37 57 92 23 92 -13 0 -20 -7 -20 -18 0 -26 -20 -42 -52 -42 -23 0 -28 4 -28 23 0 13 11 34 25 47 17 16 25 33 23 50 -3 24 -6 25 -73 28 -39 1 -74 0 -78 -4z"/>
            <path fill-rule="evenodd" d="M560 910 c-45 -45 -13 -130 50 -130 41 0 70 31 70 75 0 44 -29 75 -70 75 -17 0 -39 -9 -50 -20z"/>
            <path fill-rule="evenodd" d="M950 910 c-45 -45 -13 -130 50 -130 41 0 70 31 70 75 0 44 -29 75 -70 75 -17 0 -39 -9 -50 -20z"/>
        </g>
    </svg>

    <h3>{{ $title ?? 'Wow, such empty.' }}</h3>
    @if($message)
        <p>{{ $message }}</p>
    @endif
</div>
