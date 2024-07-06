<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Math_operation;

class Inputarea extends Component
{
    public $selectedOperation = '+';
    public $value_1;
    public $value_2;
    public $value_3;
    public $answer;
    public $str_operation;

    public function updated($propertyName)
    {
        $this->finalanswer();
    }

    public function finalanswer()
    {
        $value1 = (float) $this->value_1;
        $value2 = (float) $this->value_2;
        $value3 = (float) $this->value_3;

        switch ($this->selectedOperation) {
            case '+':
                $this->answer = $value1 + $value2 + $value3;
                $this->str_operation = "{$value1} + {$value2} + {$value3}";
                break;
            case '-':
                $this->answer = $value1 - $value2 - $value3;
                $this->str_operation = "{$value1} - {$value2} - {$value3}";
                break;
            case '*':
                $this->answer = $value1 * $value2 * $value3;
                $this->str_operation = "{$value1} * {$value2} * {$value3}";
                break;
            case '/':
                $this->answer = ($value2 != 0 && $value3 != 0) ? ($value1 / $value2 / $value3) : 'Division by zero error';
                $this->str_operation = "{$value1} / {$value2} / {$value3}";
                break;
            default:
                $this->answer = 'Invalid operation';
                break;
        }
    }

    public function store()
    {
        $this->finalanswer();

        $operation = Math_operation::create([
            'inputs_operations' => $this->str_operation,
            'operation' => $this->selectedOperation,
            'answer' => $this->answer,
        ]);
       

        $this->dispatch('newRecordAdded', $operation->toArray());


        $this->reset(['value_1', 'value_2', 'value_3', 'answer', 'str_operation']);
    }

    public function render()
    {
        return view('livewire.inputarea', [
            'answer' => $this->answer,
        ]);
    }
}
