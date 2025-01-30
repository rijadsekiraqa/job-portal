<a {{ $attributes->merge(['href' => $href, 'class' => $class]) }}>
    {{ $slot }}
    @if($label)
        {{ $label }}
    @endif
</a>
