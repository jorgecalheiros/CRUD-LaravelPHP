
<input
    type="{{ $type }}"
    name="{{ $name }}"
    id="{{ $name }}"
    class="{{ $class }}"
    spellcheck="false"
    placeholder="{{ $placeholder }}"
    @if($onlyRead) disabled @endif
    @if($value)
        value="{{ $value }}"
    @else
        value="{{ old($name) }}"
    @endif
/>

@error($name)
    <small style="color: red;">{{ $message }}</small>
@enderror
