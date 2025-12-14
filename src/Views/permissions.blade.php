@extends('vendor.installer.layouts.master')

@section('title', trans('installer_messages.permissions.title'))
@section('container')
    <div class="space-y-6">
        @if (isset($permissions['errors']))
            <div class="rounded-md bg-rose-50 p-4 text-sm text-rose-700 border border-rose-200">
                {{ trans('installer_messages.permissions.fix_issues', ['action' => trans('installer_messages.checkPermissionAgain')]) }}
            </div>
        @endif

        <ul class="divide-y divide-slate-100 rounded-xl border border-slate-200 bg-white">
            @foreach($permissions['permissions'] as $permission)
                <li class="flex items-center justify-between p-4">
                    <span class="text-sm text-slate-700">{{ $permission['folder'] }}</span>
                    <div class="flex items-center gap-3">
                        <span class="text-xs text-slate-500">{{ $permission['permission'] }}</span>
                        <span class="inline-flex items-center rounded-full px-2 py-0.5 text-xs font-medium {{ $permission['isSet'] ? 'bg-emerald-100 text-emerald-700' : 'bg-rose-100 text-rose-700' }}">
                            {{ $permission['isSet'] ? trans('installer_messages.permissions.ok') : trans('installer_messages.permissions.fix') }}
                        </span>
                    </div>
                </li>
            @endforeach
        </ul>

        <div>
            @if ( ! isset($permissions['errors']))
                <a class="inline-flex items-center rounded-lg bg-indigo-600 px-5 py-2.5 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus-visible:ring-2 focus-visible:ring-indigo-500" href="{{ route('LaravelInstaller::database') }}">
                    {{ trans('installer_messages.next') }}
                </a>
            @else
                <a class="inline-flex items-center rounded-lg bg-slate-700 px-5 py-2.5 text-sm font-medium text-white shadow-sm hover:bg-slate-800 focus:outline-none focus-visible:ring-2 focus-visible:ring-slate-500" href="javascript:window.location.href='';">
                    {{ trans('installer_messages.checkPermissionAgain') }}
                </a>
            @endif
        </div>
    </div>
@stop
