@extends('vendor.installer.layouts.master')

@section('title', trans('installer_messages.final.title'))
@section('container')
    <div class="text-center space-y-4">
        <h3 class="text-xl font-semibold text-slate-900">{{ trans('installer_messages.final.heading') }}</h3>
        <p class="text-slate-600">{{ trans('installer_messages.final.helper') }}</p>

        <?php
            // Normalize inputs
            $fields = isset($fields) && is_array($fields) ? $fields : [];
            $details = isset($details) && is_array($details) ? $details : [];
        ?>

        <div class="mx-auto max-w-md text-left">
            <dl class="divide-y divide-slate-100 rounded-xl border border-slate-200 bg-white">
                @foreach($fields as $field)
                    <?php
                        $fname = $field['name'] ?? '';
                        $flabel = $field['label'] ?? ucfirst($fname);
                        $value = $details[$fname] ?? '';
                    ?>
                    <div class="px-4 py-3 grid grid-cols-3 gap-4">
                        <dt class="text-sm font-medium text-slate-500">{{ $flabel }}</dt>
                        <dd class="text-sm text-slate-800 col-span-2">{{ $value !== '' ? $value : '-' }}</dd>
                    </div>
                @endforeach
            </dl>
        </div>
        <div class="pt-2">
            <a href="{{ url('/') }}" class="inline-flex items-center rounded-lg bg-indigo-600 px-5 py-2.5 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus-visible:ring-2 focus-visible:ring-indigo-500">{{ trans('installer_messages.final.exit') }}</a>
        </div>
    </div>
@stop
