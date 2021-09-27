@if($icon)
    <label for="" class="label-input">
    <i class="fas {{ $icon }} icons"></i>
@endif

<input
    type="{{ $type }}"
    name="{{ $name }}"
    placeholder="{{ $placeholder }}"
    @if($onlyRead) disabled @endif
    @if($value)
        value="{{ $value }}"
    @else
        value="{{ old($name) }}"
    @endif
/>
@if($icon)
    </label>
@endif

@error($name)
    <small style="color: red;">{{ $message }}</small>
@enderror
