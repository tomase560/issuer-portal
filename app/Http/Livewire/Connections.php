<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Connection;
use App\Models\Patient;
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;

class Connections extends Component
{
    use WithPagination;

    public $confirmingConnectionDeletion = false;

    public function render()
    {
        // $connections = Connection::all();
        $connections = DB::table('connections')
            ->join('patients', 'patients.email', '=', 'connections.email')
            ->get();
        // $connections = $connections->paginate(5);

        return view('livewire.connections', [
            'connections' => $connections,
        ]);
    }

    public function confirmConnectionDeletion($id) {
        $this->confirmingConnectionDeletion = $id;
    }

    public function deleteConnection(Connection $connection) {
        $connection->delete();
        $this->confirmingConnectionDeletion = false;
        session()->flash('message', 'Connection deleted successfully.');
    }

}
