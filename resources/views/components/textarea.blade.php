<textarea 
    @if($name) name="{{ $name }}" @endif
    @if($class) class="{{ $class }}" @endif
    @if($placeholder) placeholder="{{ $placeholder }}" @endif
    @if($rows) rows="{{ $rows }}"  @endif
    @if($cols) cols="{{ $cols }}"  @endif
    @if($id) id="{{ $id }}" @endif
    @if($readonly) readonly @endif
>{{ $value ?? '' }}</textarea>
