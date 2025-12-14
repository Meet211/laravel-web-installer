<?php

namespace Meetahir\LaravelWebInstaller\Controllers;

use Illuminate\Routing\Controller;
use Meetahir\LaravelWebInstaller\Helpers\EnvironmentManager;
use Meetahir\LaravelWebInstaller\Request\UpdateRequest;

/**
 * Class EnvironmentController
 */
class EnvironmentController extends Controller
{

    /**
     * @var EnvironmentManager
     */
    protected $environmentManager;

    /**
     * @param EnvironmentManager $environmentManager
     */
    public function __construct(EnvironmentManager $environmentManager)
    {
        $this->environmentManager = $environmentManager;
    }

    /**
     * Display the Environment page.
     *
     * @return \Illuminate\View\View
     */
    public function environment()
    {
        $envConfig = $this->environmentManager->getEnvContent();

        return view('vendor.installer.environment', compact('envConfig'));
    }

    /**
     * @param UpdateRequest $request
     * @return string
     */
    public function save(UpdateRequest $request)
    {
        $message = $this->environmentManager->saveFile($request);
        return $message;

    }

}
