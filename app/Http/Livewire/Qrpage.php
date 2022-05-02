<?php

namespace App\Http\Livewire;

use Livewire\Component;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class Qrpage extends Component
{

    public $confirmingConnectionAdd = false;
    public $confirmingSchemaAdd = false;
    public $confirmingCertificateIssue = false;

    public function render()
    {
        return view('livewire.qrpage');
    }

    public function confirmConnectionAdd() {
        $this->confirmingConnectionAdd = true;
    }

    public function confirmSchemaAdd() {
        $this->confirmingSchemaAdd = true;
    }

    public function confirmCertificateIssue() {
        $this->confirmingCertificateIssue = true;
    }

    public function saveConnection() {
        //To Do
    }

    public function saveSchema() {
        //To Do
    }

    public function issueCertificate() {
        //To Do  
    }
}
