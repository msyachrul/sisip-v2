<div class="form-group">
    <label for="sort_by">Sort By</label>
    <select name="sort_by" id="sort_by" class="form-control">
        <option value="" hidden>Sort By</option>
        @foreach ($sortables as $name => $value)
            <option value="{{ $value }}" @if(request()->get('sort_by') === $value) selected @endif>{{ $name }}</option>
        @endforeach
    </select>
</div>
