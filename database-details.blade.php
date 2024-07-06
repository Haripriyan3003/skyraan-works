<div>


    <table class="min-w-full bg-white">
        <thead>
            <tr>

                <th class="py-2 px-4 border-b">ID</th>
                <th class="py-2 px-4 border-b">Input Operation</th>
                <th class="py-2 px-4 border-b">Operation</th>
                <th class="py-2 px-4 border-b">Result</th>
                <th class="py-2 px-4 border-b">Created_at</th>
                <th class="py-2 px-4 border-b">Updated_at</th>
            </tr>
        </thead>
        <tbody>
            @foreach($operations as $operation)
                <tr>
                    <td class="py-2 px-4 border-b">{{ $operation->id }}</td>
                    <td class="py-2 px-4 border-b">{{ $operation->inputs_operations }}</td>
                    <td class="py-2 px-4 border-b">{{ $operation->operation }}</td>
                    <td class="py-2 px-4 border-b">{{ $operation->answer }}</td>
                    <td class="py-2 px-4 border-b">{{ $operation->created_at }}</td>
                    <td class="py-2 px-4 border-b">{{ $operation->updated_at }}</td>

                </tr>
            @endforeach
        </tbody>
    </table>
    {{-- @if($newRecord)
    <div class="bg-green-100 p-4 mb-4">
        <h3 class="font-bold">New Record Added:</h3>
        <p>Operation: {{ $newRecord['inputs_operations'] }}</p>
        <p>Result: {{ $newRecord['answer'] }}</p>
    </div>
@endif --}}
</div>
