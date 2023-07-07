@php
    use App\Models\State;
    $states = State::all();
@endphp
<div class="Icon-inside">
    <select name="state" id="state" class="form-control">
        <option value="">Seleccione el estado</option>
        @foreach ($states as $item)
            <option value={{ $item->description }}>{{ $item->description }}</option>
        @endforeach
    </select>
    <i class="bi bi-gender-ambiguous"></i>
</div>