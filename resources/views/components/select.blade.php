<select name="{{ $name ?? 'select' }}" id="{{ $id }}" class="{{ $class }}" placeholder="{{ $placeholder }}" {{ $attributes }}>
    {{ $slot }}
    @foreach($options as $option)
        <option value="{{ $option[$valueKey] }}">{{ $option[$textKey] }}</option>
    @endforeach
</select>
