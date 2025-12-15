@extends('vendor.installer.layouts.master')

@section('title', trans('installer_messages.environment.title'))
@section('style')
    <link href="{{ asset('installer/helper/helper.css') }}" rel="stylesheet"/>
    <style>
        .has-error {
            color: #dc2626;
        }

        .has-error input {
            color: #0f172a;
            border: 1px solid #dc2626;
            /* Tailwind focus mimic */
            outline: none;
        }

        .has-error input:focus {
            border-color: #dc2626; /* focus:border-red-500 */
            box-shadow: 0 0 0 0; /* remove default glow */
        }

        /* help-block similar to Tailwind small red text */
        .help-block {
            color: #ef4444; /* text-red-500 */
            font-size: 0.75rem; /* text-xs */
            margin-top: 0.25rem; /* mt-1 */
            font-style: italic;
        }
    </style>
@endsection
@section('container')
    <div id="form-messages"></div>
    <form method="get" action="{{ route('LaravelInstaller::environmentSave') }}" id="env-form" class="space-y-5" onsubmit="checkEnv();return false">
        <x-installer-input
                name="hostname"
                label="{{ trans('installer_messages.environment.fields.hostname.label') }}"
                placeholder="{{ trans('installer_messages.environment.fields.hostname.placeholder') }}"
        />

        <x-installer-input
                name="username"
                label="{{ trans('installer_messages.environment.fields.username.label') }}"
                placeholder="{{ trans('installer_messages.environment.fields.username.placeholder') }}"
        />

        <x-installer-input
                name="password"
                label="{{ trans('installer_messages.environment.fields.password.label') }}"
                placeholder="{{ trans('installer_messages.environment.fields.password.placeholder') }}"
                type="password"
        />

        <x-installer-input
                name="database"
                label="Database"
        />

        <div class="pt-2">
            <button
                    class="inline-flex items-center rounded-lg bg-indigo-600 px-5 py-2.5 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus-visible:ring-2 focus-visible:ring-indigo-500"
                    onclick="checkEnv();return false">
                {{ trans('installer_messages.next') }}
            </button>
        </div>
    </form>
    <script>
        function checkEnv() {
            $.easyAjax({
                url: "{!! route('LaravelInstaller::environmentSave') !!}",
                type: "GET",
                data: $("#env-form").serialize(),
                container: "#env-form",
                messagePosition: "inline"
            });
        }
    </script>
@stop
@section('scripts')
    <script src="{{ asset('installer/js/jQuery-2.2.0.min.js') }}"></script>
    <script src="{{ asset('installer/helper/helper.js')}}"></script>
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name=\"csrf-token\"]').attr('content')
            }
        });
    </script>
@endsection
