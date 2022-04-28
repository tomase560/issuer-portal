<?php

namespace App\Http\Livewire;

use Livewire\Component;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class Qrpage extends Component
{

    public bool $confirmingConnectionAdd = false;
    public $issueCredential = false;

    public function render()
    {
        return view('livewire.qrpage');
    }

    public function confirmConnectionAdd() {
        $this->confirmingConnectionAdd = true;
    }

    public function saveConnection() {

    }

    // public function issueCredential() {
    //     $this->msg = "Testing successful.";
    // }
}
