<?php

namespace App\Livewire;
use App\Models\Tudo;
use Livewire\Component;
use Livewire\WithPagination;

class TudoList extends Component

{
    // use WithPagination;
    public $name;

    public $editing_tudoId ;
    public $editedname ;

    protected function rules()
    {
        return [
            'name' => 'required|min:3|max:50',
            'editedname' => 'required|min:3|max:50',
        ];
    }

    public function create()
    {
        $validatedData = $this->validateOnly('name');

        Tudo::create(['name' =>$this->validatedData['name']]);
        $this->reset('name');
        session()->flash('success', "Created");
    }

    public function render()
    {
        return view('livewire.tudo-list',[
            'tudos' =>Tudo::latest()->paginate()
        ]);
    }

    public function delete($tudoID)
    {
        Tudo::find($tudoID)->delete();
    }

    public function toggle($tudoID)
    {
       $tudo =Tudo::find($tudoID);
       $tudo->completed = !$tudo->completed;
       $tudo->save();
    }

    public function edit($tudoID)
    {
        $this->editing_tudoId =$tudoID ;
        $this->editedname =Tudo::find($tudoID)->name;
    }

    public function cancel()
    {
       $this->reset('editedname' , 'editing_tudoId');
    }

    public function update()
    {
         $validatedData = $this->validateOnly('editedname');
        Tudo::find($this->editing_tudoId)->update(
            [
                'name' =>$validatedData['editedname']
            ]
            );

            $this->cancel();
    }

}

/*

{
    #[Rule('required|min:3|max:50')]
     public $name;

     public function create()
     {
       $validated = $this->validateOnly('name');

        Todo::create($validated);
        this->reset('name');
        session()->flash('success',"Created");
     }

    public function render()
    {
        return view('livewire.tudo-list');
    }
}
*/






