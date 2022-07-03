<table class="table table-striped table-hover table-bordered" id="population-table">
    <thead class="text-center">
    <tr>
        <th scope="col">Year</th>
        <th scope="col">Population</th>
    </tr>
    </thead>
    <tbody class="text-end">
    @isset($population)
        @foreach($population as $item)
            <tr>
                <td>{{$item->year}}</td>
                <td>{{$item->population}}</td>
            </tr>
        @endforeach
    @endisset
    </tbody>
</table>
<script>const initialPopulation = @json($population);</script>
