
<div class="container mt-5">
    <form wire:submit='store' class="bg-light p-5 rounded">
        <h1 class="mb-4">Mathematical Operations</h1>
        <div class="form-group">
            <label for="operation">Select the Operation</label>
            <select wire:model.live='selectedOperation' id="operation" class="form-control">
                <option value="+">Addition</option>
                <option value="-">Subtraction</option>
                <option value="*">Multiplication</option>
                <option value="/">Division</option>
            </select>
        </div>
        <div class="form-group">
            <label for="value-1">Value-1</label>
            <input type="text" id="value-1" wire:model.live='value_1' class="form-control">
        </div>
        <div class="form-group">
            <label for="value-2">Value-2</label>
            <input type="text" id="value-2" wire:model.live='value_2' class="form-control">
        </div>
        <div class="form-group">
            <label for="value-3">Value-3</label>
            <input type="text" id="value-3" wire:model.live='value_3' class="form-control">
        </div>
        <br>
        <button type="submit" class="btn btn-primary">Calculate</button>
         <h1>Answer : {{$this->answer}}</h1>

        {{-- @if ($answer !== null)
            <div class="mt-4 alert alert-info">
                <h4>Answer: {{ $answer }}</h4>
            </div>
        @endif --}}
    </form>


</div>

