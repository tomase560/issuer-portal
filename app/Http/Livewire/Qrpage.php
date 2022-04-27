<?php

namespace App\Http\Livewire;

use Livewire\Component;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class Qrpage extends Component
{
    public function render()
    {
        return view('livewire.qrpage');
    }
}
