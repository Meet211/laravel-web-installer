<?php

namespace Meetahir\LaravelWebInstaller\Views\Components;

use Illuminate\View\Component;

class InstallerInput extends Component
{
    public string $name;
    public string $type;
    public string $label;
    public ?string $placeholder;
    public $value;

    public function __construct(
        string $name,
        string $label,
        string $type = 'text',
        string $placeholder = null,
               $value = null
    ) {
        $this->name = $name;
        $this->label = $label;
        $this->type = $type;
        $this->placeholder = $placeholder;
        $this->value = $value ?? old($name);
    }

    public function render(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Support\Htmlable|\Closure|string
    {
        return view('installer::components.installer-input');
    }
}
