<?php

namespace App\Livewire;
use Livewire\Attributes\On;
use Livewire\Component;
use App\Models\Math_operation;

class DatabaseDetails extends Component
{
    public $operations;
    public $newRecord;

    public function mount()
    {
        $this->operations = Math_operation::latest()->get();
    }

    #[On('newRecordAdded')]
    public function handleNewRecord($record)
    {
        $this->newRecord = $record;
        $this->operations = Math_operation::latest()->get();
    }

    public function render()
    {
        return view('livewire.database-details', [
            'operations' => $this->operations,
            'newRecord' => $this->newRecord,
        ]);
    }

}





