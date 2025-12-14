<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title') | {{ config('app.name') }}</title>
    <link rel="icon" type="image/png" href="{{ asset('installer/img/favicon/favicon.png') }}" sizes="16x16"/>
    <link rel="icon" type="image/png" href="{{ asset('installer/img/favicon/favicon.png') }}" sizes="32x32"/>
    <link rel="icon" type="image/png" href="{{ asset('installer/img/favicon/favicon.png') }}" sizes="96x96"/>

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>

    @yield('style')
    <style>
        /* Minor overrides */
        .form-control { font-size: 0.875rem !important; }
    </style>
</head>
<body class="min-h-screen bg-slate-50 text-slate-800 antialiased">
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <!-- Header -->
    <div class="flex items-center gap-4 mb-8">
        <img src="{{ asset('installer/img/logo.png') }}" class="h-12 w-auto" alt="Installer Logo">
        <div>
            <h1 class="text-2xl font-semibold text-slate-900">{{ trans('installer_messages.title') }}</h1>
            <p class="text-sm text-slate-500">{{ trans('installer_messages.tagline') }}</p>
        </div>
    </div>

    <!-- Layout -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">
        <!-- Vertical Step Wizard -->
        <aside class="lg:col-span-4 xl:col-span-3">
            <?php
                $steps = [
                    [
                        'key' => 'LaravelInstaller::welcome',
                        'title' => trans('installer_messages.steps.welcome.title'),
                        'subtitle' => trans('installer_messages.steps.welcome.subtitle'),
                        'icon' => 'home',
                    ],
                    [
                        'key' => 'LaravelInstaller::environment',
                        'title' => trans('installer_messages.steps.environment.title'),
                        'subtitle' => trans('installer_messages.steps.environment.subtitle'),
                        'icon' => 'server',
                    ],
                    [
                        'key' => 'LaravelInstaller::superAdmin',
                        'title' => trans('installer_messages.steps.superAdmin.title'),
                        'subtitle' => trans('installer_messages.steps.superAdmin.subtitle'),
                        'icon' => 'user',
                    ],
                    [
                        'key' => 'LaravelInstaller::requirements',
                        'title' => trans('installer_messages.steps.requirements.title'),
                        'subtitle' => trans('installer_messages.steps.requirements.subtitle'),
                        'icon' => 'checklist',
                    ],
                    [
                        'key' => 'LaravelInstaller::permissions',
                        'title' => trans('installer_messages.steps.permissions.title'),
                        'subtitle' => trans('installer_messages.steps.permissions.subtitle'),
                        'icon' => 'lock',
                    ],
                    [
                        'key' => 'LaravelInstaller::final',
                        'title' => trans('installer_messages.steps.final.title'),
                        'subtitle' => trans('installer_messages.steps.final.subtitle'),
                        'icon' => 'flag',
                    ],
                ];
            ?>
            <nav aria-label="Progress" class="bg-white border border-slate-200 rounded-xl p-4">
                <ol class="relative">
                    @foreach($steps as $index => $s)
                        <?php $active = isActive($s['key']) ? true : false; ?>
                        <li class="pl-8 pb-6 last:pb-0 relative">
                            <div class="absolute left-3 top-0 bottom-0 w-px bg-slate-200 {{ $loop->last ? 'hidden' : '' }}"></div>
                            <div class="absolute left-0 mt-0.5">
                                <span class="flex h-6 w-6 items-center justify-center rounded-full ring-1 ring-inset {{ $active ? 'bg-indigo-600 ring-indigo-600 text-white' : 'bg-white ring-slate-300 text-slate-400' }}">
                                    @if($s['icon']==='home')
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 9l9-7 9 7"/><path d="M9 22V12h6v10"/></svg>
                                    @elseif($s['icon']==='server')
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="2" width="20" height="8" rx="2"/><rect x="2" y="14" width="20" height="8" rx="2"/><path d="M6 6h.01M6 18h.01"/></svg>
                                    @elseif($s['icon']==='checklist')
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 11l3 3L22 4"/><path d="M21 12v7a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h11"/></svg>
                                    @elseif($s['icon']==='lock')
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="11" width="18" height="11" rx="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
                                    @elseif($s['icon']==='user')
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                                    @else
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 15s1-1 4-1 5 2 8 2 4-1 4-1V4H4z"/><path d="M22 22H2"/></svg>
                                    @endif
                                </span>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium {{ $active ? 'text-indigo-700' : 'text-slate-700' }}">{{ $s['title'] }}</p>
                                <p class="text-xs {{ $active ? 'text-indigo-500' : 'text-slate-400' }}">{{ $s['subtitle'] }}</p>
                            </div>
                        </li>
                    @endforeach
                </ol>
            </nav>
        </aside>

        <!-- Main Content -->
        <main class="lg:col-span-8 xl:col-span-9">
            <div class="bg-white border border-slate-200 rounded-xl p-6 shadow-sm">
                @yield('container')
            </div>
        </main>
    </div>
</div>
@yield('scripts')
</body>
</html>
