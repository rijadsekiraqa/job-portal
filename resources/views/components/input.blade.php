@if (!empty($label))
    <label for="{{ $id }}">{{ $label }}</label>
@endif
<input 
type="{{ $type }}" 
name="{{ $name }}" 
@if (!empty($value)) value="{{ $value }}" @endif
class="{{ $class}}" 
id="{{ $id }}" 
placeholder="{{ $placeholder }}" 
@if($type === 'checkbox' && !empty($checked)) checked @endif
/>
