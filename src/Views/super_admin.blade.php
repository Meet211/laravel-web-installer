@extends('vendor.installer.layouts.master')

@section('title', trans('installer_messages.steps.superAdmin.title'))
@section('style')
    <link href="{{ asset('installer/helper/helper.css') }}" rel="stylesheet"/>
    <style>
        .has-error{ color: #dc2626; }
        .has-error input{ color: #0f172a; border:1px solid #dc2626; }
    </style>
@endsection

@section('container')
    <?php $fields = config('installer.super_admin.fields', []); ?>
    <form method="get" action="{{ route('LaravelInstaller::superAdmin.store') }}" id="super-admin-form" class="space-y-5" onsubmit="submitForm();return false">
        @foreach($fields as $field)
            <?php
                $fname = $field['name'];
                $flabel = $field['label'] ?? ucfirst($fname);
                $ftype = $field['type'] ?? 'text';
                $fplaceholder = $field['placeholder'] ?? '';
                $fdefault = $field['default'] ?? '';
                $fvalue = old($fname, $fdefault);
            ?>
            <x-installer-input
                name="{{ $fname }}"
                label="{{ $flabel }}"
                type="{{ $ftype }}"
                placeholder="{{ $fplaceholder }}"
                value="{{ $fvalue }}"
            />
        @endforeach
        <div class="pt-2">
            <button class="inline-flex items-center rounded-lg bg-indigo-600 px-5 py-2.5 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus-visible:ring-2 focus-visible:ring-indigo-500" onclick="submitForm();return false">
                {{ trans('installer_messages.next') }}
            </button>
        </div>
    </form>
    <script>
        function submitForm() {
            $.easyAjax({
                url: "{!! route('LaravelInstaller::superAdmin.store') !!}",
                type: "GET",
                data: $("#super-admin-form").serialize(),
                container: "#super-admin-form",
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
