<?php

namespace Meetahir\LaravelWebInstaller\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Controller;
use Meetahir\LaravelWebInstaller\Helpers\DatabaseManager;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Config;

class DatabaseController extends Controller
{

    /**
     * @var DatabaseManager
     */
    private $databaseManager;

    /**
     * @param DatabaseManager $databaseManager
     */
    public function __construct(DatabaseManager $databaseManager)
    {
        $this->databaseManager = $databaseManager;
    }

    /**
     * Migrate and seed the database.
     *
     * @return RedirectResponse
     */
    public function database(): RedirectResponse
    {
        set_time_limit(0);

        // -------------------------------
        // 1. Load Super Admin Install Data
        // -------------------------------
        $details = session('install_super_admin');

        // Fallback: read from storage if session missing
        if (empty($details)) {
            $path = storage_path('app/install_super_admin.json');
            if (File::exists($path)) {
                $decoded = json_decode(File::get($path), true);
                if (is_array($decoded)) {
                    $details = $decoded;
                }
            }
        }
        if (empty($details)) {
            return redirect()->route('LaravelInstaller::superAdmin')->with('error', 'Super admin details missing.');
        }
        // ------------------------------------
        // 2. Run Migration + Seeder
        // ------------------------------------
        $response = $this->databaseManager->migrateAndSeed();

        // ------------------------------------
        // 3. Create or Update Super Admin User
        // ------------------------------------
        if (!empty($details['email'])) {
            $this->createOrUpdateSuperAdmin($details);
        }

        // ------------------------------------
        // 4. Redirect to Final Step
        // ------------------------------------
        $userDetails = [
            'name'     => $details['name'] ?? null,
            'email'    => $details['email'] ?? null,
            'mobile'   => $details['mobile'] ?? null,
            'password' => $details['password'] ?? null,
        ];


        // ------------------------------------
        // Update SESSION_DRIVER in .env
        // ------------------------------------
        $envPath = base_path('.env');
        if (file_exists($envPath)) {
            $envContent = file_get_contents($envPath);
            $envContent = preg_replace('/SESSION_DRIVER=.*/', 'SESSION_DRIVER=database', $envContent);
            file_put_contents($envPath, $envContent);
        }

        return redirect()
            ->route('LaravelInstaller::final', $userDetails)
            ->with(['message' => $response]);
    }


    private function createOrUpdateSuperAdmin(array $details): void
    {
        try {
            // Create if not exists
            $user = User::firstOrCreate(
                ['email' => $details['email']],
                [
                    'name'         => $details['name'] ?? 'super admin',
                    'status'       => 'active',
                    'password'     => bcrypt($details['password'] ?? ''),
                    'mobile'       => $details['mobile'] ?? null,
                ]
            );

            // Update existing
            if (!$user->wasRecentlyCreated) {
                $user->fill([
                    'name'         => $details['name'] ?? $user->name,
                    'status'       => 'active',
                    'mobile'       => $details['mobile'] ?? $user->mobile,
                ]);

                if (!empty($details['password'])) {
                    $user->password = bcrypt($details['password']);
                }

                $user->save();
            }

        } catch (\Throwable $e) {
            // Optional: Log::error($e);
        } finally {
            // Cleanup
            session()->forget('install_super_admin');
            $path = storage_path('app/install_super_admin.json');
            if (File::exists($path)) {
                File::delete($path);
            }
        }
    }

}
