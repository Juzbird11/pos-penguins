@props(['name', 'title', 'type' => 'text', 'value' => null])

<div class="form-group">
    <label for="{{ $name }}" >{{ $title }}</label>
    <input type="{{ $type }}" name="{{ $name }}" value="{{ $value }}" class="form-control" id="{{ $name }}" placeholder="{{ $title }}" autocomplete="off">
</div>