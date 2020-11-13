<div class="d-flex align-items-center">
    <span class="mr-2">{{ $name }}</span>
    @if (request()->get('sort_by') == $asc)
        <i class="fas fa-sort-alpha-down"></i>
    @endif
    @if (request()->get('sort_by') == $desc)
        <i class="fas fa-sort-alpha-down-alt"></i>
    @endif
</div>
