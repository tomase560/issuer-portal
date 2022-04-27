<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Patient;
use Livewire\WithPagination;

class Patients extends Component
{
    use WithPagination;

    public $search;
    public $sortBy = 'id';
    public $sortAsc = true;
    public $confirmingPatientDeletion = false;
    public $patient;
    public $confirmingPatientAdd = false;

    protected $queryString = [
        'search' => ['except' => ''],
        'sortBy' => ['except' => 'id'],
        'sortAsc' => ['except' => true],
    ];

    protected $rules = [
        'patient.name' => 'required|string',
        'patient.email' => 'required|string',
        'patient.phone_number' => 'required',
    ];

    public function render()
    {
        $patients = Patient::where('user_id', auth()->user()->id)
            ->when($this->search, function($query) {
                return $query->where(function($query) {
                    $query->where('name', 'like', '%'.$this->search.'%')
                        ->orWhere('email', 'like', '%'.$this->search.'%');
                });
            })
            ->orderBy($this->sortBy, $this->sortAsc ? 'ASC' : 'DESC');
        
        $patients = $patients->paginate(5);
        return view('livewire.patients', [
            'patients' => $patients,
        ]);
    }

    public function updatingSearch() {
        $this->resetPage();
    }

    public function sortBy($field) {
        if($field == $this->sortBy) {
            $this->sortAsc = !$this->sortAsc;
        }
        $this->sortby = $field;
    }

    public function confirmPatientDeletion($id) {
        $this->confirmingPatientDeletion = $id;
    }

    public function deletePatient(Patient $patient) {
        $patient->delete();
        $this->confirmingPatientDeletion = false;
        session()->flash('message', 'Patient deleted successfully.');
    }

    public function confirmPatientAdd() {
        $this->reset(['patient']);
        $this->confirmingPatientAdd = true;
    }

    public function confirmPatientEdit(Patient $patient) {
        $this->patient = $patient;
        $this->confirmingPatientAdd = true;
    }

    public function savePatient() {
        $this->validate();

        if (isset($this->patient->id)) {
            $this->patient->save();
            session()->flash('message', 'Patient saved successfully.');
        } else {
            $id = auth()->user()->id;
            auth()->user()->patients()->create([
            'user_id' => $id,
            'name' => $this->patient['name'],
            'email' => $this->patient['email'],
            'phone_number' => $this->patient['phone_number'],
            ]);
            session()->flash('message', 'Patient added successfully.');
        }
        $this->confirmingPatientAdd = false;
    }
}
