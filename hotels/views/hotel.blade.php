
    <form class="form-horizontal" method="POST" action="{{action('\Hotels\Http\Controllers\HotelController@convert')}}">
        
        <h1>Convert Hotels Data</h1>

        <h2># Files</h2>
        <hr />
        <label for>Source File</label>
        <select name="read_from">
            @foreach($sourceFiles as $file)
                <option value="{{ $file['filepath'] }}">{{ $file['filename'] }}</option>
            @endforeach
        </select>

        &rarr;

        <label for>Convert to</label>
        <select name="write_to">
            <option value="csv">CSV</option>
            <option value="json">JSON</option>
            <option value="html">HTML</option>
            <option value="xml">XML</option>
        </select>

        <br /><br />

        <h2># Sort</h2>
        <hr />
        <label for>Stars</label>
        <select name="sort[stars]">
            <option value="4">Ascending</option>
            <option value="3">Descending</option>
        </select>

        <br /><br />

        <label for>Hotel Names</label>
        <select name="sort[name]">
            <option value="4">A -> Z</option>
            <option value="3">Z -> A</option>
        </select>

        <br /><br />

        <h2># Filter</h2>
        <hr />
        <label for>Stars</label><br />
        <input type="hidden" name="filter[stars]" />
        @for($i=1; $i<=5; $i++)
            <input type="checkbox" checked name="filter[stars][{{ $i }}]" value="{{ $i }}" id="checkbox_{{ $i }}" />
            <label for="checkbox_{{ $i }}">{{ $i }} Star</label>
        @endfor


        <br /><br /><br />


        <button>Convert Data!</button>
    </form>
