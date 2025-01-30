<button type="{{ $type ?? 'button' }}" 
     class="{{ $class }}" 
     {{ $attributes }}
     @if($style) style="{{ $style }}" @endif
     @if($id) id="{{ $id }}" 
     @endif>

    {{ $slot }}
    {{ $label }}
</button>



