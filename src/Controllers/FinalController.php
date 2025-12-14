<?php

namespace Meetahir\LaravelWebInstaller\Controllers;

use Illuminate\Routing\Controller;
use Meetahir\LaravelWebInstaller\Helpers\InstalledFileManager;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\File;

class FinalController extends Controller
{
    /**
     * Update installed file and display finished view.
     *
     * @param InstalledFileManager $fileManager
     * @return \Illuminate\View\View
     */
    public function finish(InstalledFileManager $fileManager, Request $request)
    {
        // Mark installation as finished
        $fileManager->update();

        // Determine fields to show based on installer config
        $fields = Config::get('installer.super_admin.fields', []);
        $fieldNames = collect($fields)->pluck('name')->filter()->values()->all();

        // Prefer values saved in session during SuperAdminController@store
        $details = (array) session('install_super_admin', []);

        // Fallback to temp JSON file persisted during store()
        if (empty($details)) {
            try {
                $path = storage_path('app/install_super_admin.json');
                if (File::exists($path)) {
                    $json = json_decode(File::get($path), true);
                    if (is_array($json)) {
                        $details = $json;
                    }
                }
            } catch (\Throwable $e) {
                // ignore
            }
        }

        // Final fallback to current request query params
        if (empty($details)) {
            $details = $request->only($fieldNames);
        } else {
            // Ensure we only keep configured fields
            $details = collect($details)->only($fieldNames)->toArray();
        }

        return view('vendor.installer.finished', [
            'fields' => $fields,
            'details' => $details,
        ]);
    }
}
