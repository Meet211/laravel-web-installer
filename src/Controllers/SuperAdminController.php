<?php

namespace Meetahir\LaravelWebInstaller\Controllers;

use Meetahir\LaravelWebInstaller\Helpers\Reply;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\File;

class SuperAdminController extends Controller
{
    /**
     * Show the Super Admin details form.
     *
     * @return \Illuminate\View\View
     */
    public function form()
    {
        return view('installer::super_admin');
    }

    /**
     * Validate and store Super Admin details in session. Actual user creation
     * happens after migrations (final step).
     *
     * @param Request $request
     * @return array
     */
    public function store(Request $request)
    {
        // Build validation rules dynamically from config
        $fields = Config::get('installer.super_admin.fields', []);
        $rules = [];
        foreach ($fields as $field) {
            $name = $field['name'] ?? null;
            if (!$name) { continue; }
            $rule = $field['rules'] ?? 'nullable';
            $rules[$name] = $rule;
        }

        $validated = $request->validate($rules);

        // Save all configured fields to session
        session(['install_super_admin' => $validated]);

        // Fallback: persist to a temporary file so installer continues to work without session persistence
        try {
            $payload = $validated;
            $payload['saved_at'] = now()->toIso8601String();
            $dir = storage_path('app');
            if (!File::exists($dir)) {
                File::makeDirectory($dir, 0755, true);
            }
            File::put(storage_path('app/install_super_admin.json'), json_encode($payload));
        } catch (\Throwable $e) {
            // ignore file persistence errors so user can still proceed
        }

        return Reply::redirect(route('LaravelInstaller::requirements'), 'Super admin details saved. Continue installation.');
    }
}
