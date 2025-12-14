@extends('vendor.installer.layouts.master')

@section('title', trans('installer_messages.welcome.title'))
@section('container')
    <div class="text-center space-y-6">
        <p class="text-slate-600 text-base">{{ trans('installer_messages.welcome.message') }}</p>
        <div>
            <a href="{{ route('LaravelInstaller::environment') }}" class="inline-flex items-center rounded-lg bg-indigo-600 px-5 py-2.5 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus-visible:ring-2 focus-visible:ring-indigo-500">
                {{ trans('installer_messages.next') }}
            </a>
        </div>
    </div>
@stop
