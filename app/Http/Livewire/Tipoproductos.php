<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Tipoproducto;

class Tipoproductos extends Component
{
    use WithPagination;

	protected $paginationTheme = 'bootstrap';
    public $selected_id, $keyWord, $descripion;
    public $updateMode = false;

    public function render()
    {
		$keyWord = '%'.$this->keyWord .'%';
        return view('livewire.tipoproductos.view', [
            'tipoproductos' => Tipoproducto::latest()
						->orWhere('descripion', 'LIKE', $keyWord)
						->paginate(10),
        ]);
    }
	
    public function cancel()
    {
        $this->resetInput();
        $this->updateMode = false;
    }
	
    private function resetInput()
    {		
		$this->descripion = null;
    }

    public function store()
    {
        $this->validate([
		'descripion' => 'required',
        ]);

        Tipoproducto::create([ 
			'descripion' => $this-> descripion
        ]);
        
        $this->resetInput();
		$this->emit('closeModal');
		session()->flash('message', 'Tipoproducto Successfully created.');
    }

    public function edit($id)
    {
        $record = Tipoproducto::findOrFail($id);

        $this->selected_id = $id; 
		$this->descripion = $record-> descripion;
		
        $this->updateMode = true;
    }

    public function update()
    {
        $this->validate([
		'descripion' => 'required',
        ]);

        if ($this->selected_id) {
			$record = Tipoproducto::find($this->selected_id);
            $record->update([ 
			'descripion' => $this-> descripion
            ]);

            $this->resetInput();
            $this->updateMode = false;
			session()->flash('message', 'Tipoproducto Successfully updated.');
        }
    }

    public function destroy($id)
    {
        if ($id) {
            $record = Tipoproducto::where('id', $id);
            $record->delete();
        }
    }
}
