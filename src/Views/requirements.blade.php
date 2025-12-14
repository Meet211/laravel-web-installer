@extends('vendor.installer.layouts.master')

@section('title', trans('installer_messages.requirements.title'))
@section('container')
    <div class="space-y-6">
        <ul class="divide-y divide-slate-100 rounded-xl border border-slate-200 bg-white">
            <li class="flex items-center justify-between p-4">
                <span class="text-sm text-slate-700">{{ trans('installer_messages.requirements.php', ['min' => $phpSupportInfo['minimum']]) }}</span>
                <span class="inline-flex items-center rounded-full px-2 py-0.5 text-xs font-medium {{ $phpSupportInfo['supported'] ? 'bg-emerald-100 text-emerald-700' : 'bg-rose-100 text-rose-700' }}">
                    {{ $phpSupportInfo['supported'] ? trans('installer_messages.requirements.ok') : trans('installer_messages.requirements.missing') }}
                </span>
            </li>
            @foreach($requirements['requirements'] as $extention => $enabled)
                <li class="flex items-center justify-between p-4">
                    <span class="text-sm text-slate-700">{{ $extention }}</span>
                    <span class="inline-flex items-center rounded-full px-2 py-0.5 text-xs font-medium {{ $enabled ? 'bg-emerald-100 text-emerald-700' : 'bg-rose-100 text-rose-700' }}">
                        {{ $enabled ? trans('installer_messages.requirements.enabled') : trans('installer_messages.requirements.missing') }}
                    </span>
                </li>
            @endforeach
        </ul>

        @if ( ! isset($requirements['errors']) && $phpSupportInfo['supported'] == 'success')
            <div>
                <a class="inline-flex items-center rounded-lg bg-indigo-600 px-5 py-2.5 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus-visible:ring-2 focus-visible:ring-indigo-500" href="{{ route('LaravelInstaller::permissions') }}">
                    {{ trans('installer_messages.next') }}
                </a>
            </div>
        @endif
    </div>
@stop
