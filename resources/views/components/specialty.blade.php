@php
    
    use App\Models\MedicalSpeciality;
    use Illuminate\Support\Facades\DB;
    use Illuminate\Support\Facades\Auth;
    
    $specialties = MedicalSpeciality::all();
    
@endphp

<div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 mt-2">
    <div class="form-group">
        <div class="Icon-inside">
            <select name="specialty" id="specialty" placeholder="Seleccione"
                class="form-control @error('specialty') is-invalid @enderror" class="form-control combo-textbox-input">
                <option value=''>Seleccione...</option>
                @foreach ($specialties as $item)
                    <option value={{ $item->description }}>{{ $item->description }}
                    </option>
                @endforeach
            </select>
            <i class="bi bi-gender-ambiguous"></i>
        </div>
    </div>
</div>