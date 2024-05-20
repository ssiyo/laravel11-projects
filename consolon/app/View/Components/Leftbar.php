<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Leftbar extends Component
{
    public $type; // Example: 'success', 'error', 'warning'
    public $message;

    public function __construct($type, $message)
    {
        $this->type = $type;
        $this->message = $message;
    }

    public function render()
    {
        return view('components.leftbar');
    }
}
