<!doctypehtml>
<html lang="{{str_replace('_', '-', app()->getLocale())}}">
<meta charset=utf-8>
<meta content="width=device-width,initial-scale=1" name=viewport>
<title>{{__('Početna | Online biblioteka')}}</title>
<link href="{{asset('library-favicon.ico')}}" rel=icon type=image/x-icon>
<meta charset=UTF-8>
<meta content="IE=edge" http-equiv=X-UA-Compatible>
<meta content="width=device-width,initial-scale=1,shrink-to-fit=no,user-scalable=0"
      name=viewport>
<meta content=en http-equiv=content-language>
<meta content="tim nullable()" name=author>
<meta content="Online biblioteka - projekat namijenjen srednjoškolcima..."
      name=description>
<meta content="ict cortex, cortex, coinis, srednjoškolci, učenici, programiranje, kodiranje, biblioteka"
      name=keywords>
<meta content=#D22336 name=theme-color>
<style>
    body {
        font-family: Nunito, sans-serif
    }

    a {
        text-decoration: none !important
    }

    .background {
        background-image: url(login.jpg);
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        width: 100%;
        height: 100%
    }

    .no-select {
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none
    }

    .transition-custom {
        transition: .25s ease-out
    }

    /*! normalize.css v8.0.1 | MIT License | github.com/necolas/normalize.css */

    html {
        line-height: 1.15;
        -webkit-text-size-adjust: 100%
    }

    body {
        margin: 0
    }

    a {
        background-color: transparent
    }

    [hidden] {
        display: none
    }

    html {
        font-family: system-ui, -apple-system, BlinkMacSystemFont, Segoe UI, Roboto, Helvetica Neue, Arial, Noto Sans, sans-serif, Apple Color Emoji, Segoe UI Emoji, Segoe UI Symbol, Noto Color Emoji;
        line-height: 1.5
    }

    *,
    :after,
    :before {
        box-sizing: border-box;
        border: 0 solid #e2e8f0
    }

    a {
        color: inherit;
        text-decoration: inherit
    }

    svg,
    video {
        display: block;
        vertical-align: middle
    }

    video {
        max-width: 100%;
        height: auto
    }

    .bg-white {
        --bg-opacity: 1;
        background-color: #fff;
        background-color: rgba(255, 255, 255, var(--bg-opacity))
    }

    .bg-gray-100 {
        --bg-opacity: 1;
        background-color: #f7fafc;
        background-color: rgba(247, 250, 252, var(--bg-opacity))
    }

    .border-gray-200 {
        --border-opacity: 1;
        border-color: #edf2f7;
        border-color: rgba(237, 242, 247, var(--border-opacity))
    }

    .border-t {
        border-top-width: 1px
    }

    .flex {
        display: flex
    }

    .grid {
        display: grid
    }

    .hidden {
        display: none
    }

    .items-center {
        align-items: center
    }

    .justify-center {
        justify-content: center
    }

    .font-semibold {
        font-weight: 600
    }

    .h-5 {
        height: 1.25rem
    }

    .h-8 {
        height: 2rem
    }

    .h-16 {
        height: 4rem
    }

    .text-sm {
        font-size: .875rem
    }

    .text-lg {
        font-size: 1.125rem
    }

    .leading-7 {
        line-height: 1.75rem
    }

    .mx-auto {
        margin-left: auto;
        margin-right: auto
    }

    .ml-1 {
        margin-left: .25rem
    }

    .mt-2 {
        margin-top: .5rem
    }

    .mr-2 {
        margin-right: .5rem
    }

    .ml-2 {
        margin-left: .5rem
    }

    .mt-4 {
        margin-top: 1rem
    }

    .ml-4 {
        margin-left: 1rem
    }

    .mt-8 {
        margin-top: 2rem
    }

    .ml-12 {
        margin-left: 3rem
    }

    .-mt-px {
        margin-top: -1px
    }

    .max-w-6xl {
        max-width: 72rem
    }

    .min-h-screen {
        min-height: 100vh
    }

    .overflow-hidden {
        overflow: hidden
    }

    .p-6 {
        padding: 1.5rem
    }

    .py-4 {
        padding-top: 1rem;
        padding-bottom: 1rem
    }

    .px-6 {
        padding-left: 1.5rem;
        padding-right: 1.5rem
    }

    .pt-8 {
        padding-top: 2rem
    }

    .fixed {
        position: fixed
    }

    .relative {
        position: relative
    }

    .top-0 {
        top: 0
    }

    .right-0 {
        right: 0
    }

    .shadow {
        box-shadow: 0 1px 3px 0 rgba(0, 0, 0, .1), 0 1px 2px 0 rgba(0, 0, 0, .06)
    }

    .text-center {
        text-align: center
    }

    .text-gray-200 {
        --text-opacity: 1;
        color: #edf2f7;
        color: rgba(237, 242, 247, var(--text-opacity))
    }

    .text-gray-300 {
        --text-opacity: 1;
        color: #e2e8f0;
        color: rgba(226, 232, 240, var(--text-opacity))
    }

    .text-gray-400 {
        --text-opacity: 1;
        color: #cbd5e0;
        color: rgba(203, 213, 224, var(--text-opacity))
    }

    .text-gray-500 {
        --text-opacity: 1;
        color: #a0aec0;
        color: rgba(160, 174, 192, var(--text-opacity))
    }

    .text-gray-600 {
        --text-opacity: 1;
        color: #718096;
        color: rgba(113, 128, 150, var(--text-opacity))
    }

    .text-gray-700 {
        --text-opacity: 1;
        color: #4a5568;
        color: rgba(74, 85, 104, var(--text-opacity))
    }

    .text-gray-900 {
        --text-opacity: 1;
        color: #1a202c;
        color: rgba(26, 32, 44, var(--text-opacity))
    }

    .underline {
        text-decoration: underline
    }

    .antialiased {
        -webkit-font-smoothing: antialiased;
        -moz-osx-font-smoothing: grayscale
    }

    .w-5 {
        width: 1.25rem
    }

    .w-8 {
        width: 2rem
    }

    .w-auto {
        width: auto
    }

    .grid-cols-1 {
        grid-template-columns: repeat(1, minmax(0, 1fr))
    }

    @media (min-width: 640px) {
        .sm\:rounded-lg {
            border-radius: .5rem
        }

        .sm\:block {
            display: block
        }

        .sm\:items-center {
            align-items: center
        }

        .sm\:justify-start {
            justify-content: flex-start
        }

        .sm\:justify-between {
            justify-content: space-between
        }

        .sm\:h-20 {
            height: 5rem
        }

        .sm\:ml-0 {
            margin-left: 0
        }

        .sm\:px-6 {
            padding-left: 1.5rem;
            padding-right: 1.5rem
        }

        .sm\:pt-0 {
            padding-top: 0
        }

        .sm\:text-left {
            text-align: left
        }

        .sm\:text-right {
            text-align: right
        }

        .border-gray-700 {
            --border-opacity: 1;
            border-color: #4a5568;
            border-color: rgba(74, 85, 104, var(--border-opacity))
        }
    }

    @media (min-width: 768px) {
        .md\:border-t-0 {
            border-top-width: 0
        }

        .md\:border-l {
            border-left-width: 1px
        }

        .md\:grid-cols-2 {
            grid-template-columns: repeat(2, minmax(0, 1fr))
        }
    }

    @media (min-width: 1024px) {
        .lg\:px-8 {
            padding-left: 2rem;
            padding-right: 2rem
        }
    }

    @media (prefers-color-scheme: dark) {
        .dark\:bg-gray-800 {
            --bg-opacity: 1;
            background-color: #2d3748;
            background-color: rgba(45, 55, 72, var(--bg-opacity))
        }

        .dark\:bg-gray-900 {
            --bg-opacity: 1;
            background-color: #1a202c;
            background-color: rgba(26, 32, 44, var(--bg-opacity))
        }

        .dark\:border-gray-700 {
            --border-opacity: 1;
            border-color: #4a5568;
            border-color: rgba(74, 85, 104, var(--border-opacity))
        }

        .dark\:text-white {
            --text-opacity: 1;
            color: #fff;
            color: rgba(255, 255, 255, var(--text-opacity))
        }

        .dark\:text-gray-400 {
            --text-opacity: 1;
            color: #cbd5e0;
            color: rgba(203, 213, 224, var(--text-opacity))
        }

        .dark\:text-gray-500 {
            --tw-text-opacity: 1;
            color: #6b7280;
            color: rgba(107, 114, 128, var(--tw-text-opacity))
        }
    }
</style>

<body class=antialiased>
<div class="relative flex justify-center min-h-screen py-4 bg-gray-100 sm:items-center background items-top sm:pt-0">
    @if (Route::has('login'))
    <div class="fixed top-0 right-0 hidden px-6 py-4 sm:block">@auth <a
                href="{{route('dashboard')}}" class="ml-4 text-sm text-white"
                style=color:#fff>Dashboard</a> @else <a
                href="{{route('login')}}" class=text-sm style=color:#fff>Uloguj
            se</a> @if (Route::has('register')) <a href="{{route('register')}}"
                                                   class="ml-4 text-sm text-white dark:text-white">Registruj
            se</a> @endif @endauth
    </div>
    @endif
    <div class="max-w-6xl mx-auto lg:px-8 sm:px-6">
        <div class="flex justify-center pt-3 sm:pt-0 sm:justify-start">
            <h3 style=color:#fff>Online biblioteka - <a target="_blank"
                                                        href="https://perisicnikola37.github.io/nullable/">nullable()</a>
            </h3>
        </div>
        <div class="mt-1 overflow-hidden sm:rounded-lg"
             style=background:#2d3748;color:#fff>
            <div class="grid grid-cols-1 md:grid-cols-2">
                <div class=p-6>
                    <div class="flex items-center"><img alt="GitHub Logo"
                                                        height=25
                                                        src="{{asset('img/welcome/github_logo.png')}}"
                                                        title="GitHub Logo"
                                                        width=25>
                        <div class="ml-4 text-lg font-semibold leading-7"><a
                                    class=text-white
                                    target=_blank>Dokumentacija</a></div>
                    </div>
                    <div class=ml-12>
                        <div class="mt-2 text-sm text-white">Online biblioteka
                            predstavlja projekat ICT Cortex akademije namijenjen
                            učenicima srednjih škola, kako bi se što bolje i
                            efikasnije spremili za sve buduće izazove koje ih
                            čekaju. Kod je dostupan na sledećem linku: <a
                                    href=https://github.com/ca-tim4-22/library
                                    target=_blank style=color:#df1d2d>Source
                                Code</a></div>
                    </div>
                </div>
                {{-- Border left and top --}}
                <div class="p-6 border-t border-gray-700 md:border-l md:border-t-0">
                    <div class="flex items-center">
                        <div class="ml-4 text-lg font-semibold leading-7"><a
                                    href=https://laravel.com/ class="text-gray-900 dark:text-white" target=_blank><img
                                    alt="Laravel Logo" height=25
                                    src="{{asset('img/welcome/laravel_logo.webp')}}"
                                    title="Laravel Logo" width=85></a></div>
                    </div>
                    <div class=ml-12>
                        <div class="mt-2 text-sm text-white dark:text-white">
                            Laravel je jedan od najpopularnijih PHP framework-a,
                            koji se koristi širom svijeta za pravljenje web
                            aplikacija, kako za male, tako i za velike projekte.
                            Laravel je izbor programera zbog svojih performansi,
                            karakteristika i
                            skalabilnosti.
                        </div>
                    </div>
                </div>
                <div class="p-6 border-t border-gray-700">
                    <div class="flex items-center">
                        <div class="ml-4 text-lg font-semibold leading-7"><a
                                    href=https://coinis.com/ class="dark:text-white text-white-900" target=_blank><img
                                    alt="Coinis Logo" height=18
                                    src="{{asset('img/welcome/coinis_logo_2.png')}}"
                                    title="Coinis Logo" width=65></a></div>
                    </div>
                    <div class=ml-12>
                        <div class="mt-2 text-sm text-white dark:text-white">
                            Coinis je priznati izdavač iz prošlosti koji sada
                            koristi to isto iskustvo u službi webmastera,
                            programera aplikacija i drugih izdavača. Coinis je
                            kompanija koja broji više od 90 zaposlenih koji
                            djeluju i dišu kao jedno u AdTech
                            industriji.
                        </div>
                    </div>
                </div>
                {{-- Border right and bottom --}}
                <div class="p-6 border-t border-gray-700 md:border-l">
                    <div class="flex items-center">
                        <div class="ml-4 text-lg font-semibold leading-7 text-gray-900 dark:text-white">
                            <a href=https://ictcortex.me/ target=_blank><img
                                        alt="Cortex Logo" height=18
                                        src="{{asset('img/welcome/cortex_logo.svg')}}"
                                        title="Cortex Logo" width=70></a></div>
                    </div>
                    <div class=ml-12>
                        <div class="mt-2 text-sm text-white dark:text-white">ICT
                            Cortex namjerava da bude sinonim za mehanizam koji
                            će podsticati povjerenje, sinergiju, razmjenu
                            znanja i tehnologije među svojim članovima, što će
                            dalje stvoriti prostor za bolje poslovanje IT
                            sektora Crne Gore, stvarajući,
                            prateći i postavljajući svjetske profesionalne IT
                            trendove.
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="flex justify-center mt-4 sm:items-center sm:justify-between">
            <div class="text-sm text-center sm:text-left"></div>
            <div class="ml-4 text-sm text-center sm:ml-0 sm:text-right"
                 style=color:#fff>Laravel
                v{{Illuminate\Foundation\Application::VERSION}}(PHP
                v{{PHP_VERSION}})
            </div>
        </div>
    </div>
</div>
