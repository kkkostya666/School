<div class="form-group">
    <label for="{{ $id }}">{{ $label }}</label>
    <select class="form-control" id="{{ $id }}" name="{{ $name }}" {{ $attributes }}>
        @foreach($options as $value => $option)
            <option value="{{ $value }}" @selected($value == old($name, $selected))>
                {{ $option->name }}
            </option>
        @endforeach
    </select>
</div>
