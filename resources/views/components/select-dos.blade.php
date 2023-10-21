    <style>
        ul {
            list-style-type: none;
        }
    </style>
    <div>
        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 mt-3">
            <div class="form-floating mb-3">
                <div class="Icon-inside">
                    <label for="name" class="form-label"
                        style="font-size: 13px; margin-bottom: 5px; margin-top: 4px">Buscar paciente</label>
                    <input onkeyup="search(event)" type="text" class="form-control" placeholder="" id="floatingInputt">
                    <i class="bi bi-search st-icon"></i>
                </div>
            </div>
            <div class="overflow-auto p-3 bg-light" style="max-width: 100%; max-height: 200px; border-radius: 7px; border: 1px solid #dee2e6;">
                @foreach ($data as $key => $item)
                    <ul id="search_data" style="padding-left: 0">
                        <li>
                            <input onclick="handlerRadio({{$item}})" value="{{ $item->patient_code }}" class="form-check-input"
                                type="radio" name="flexRadioDefault" id="flexRadioDefault2" checked>
                            <label class="form-check-label text-capitalize" for="flexRadioDefault2" style="font-size: 14px; margin-top: 9px; width: 87%;">
                                {{ $item->patient_code . ' - ' . $item->name . ' ' . $item->last_name }}
                            </label>
                            <br>
                        </li>
                    </ul>
                @endforeach
            </div>
        </div>
    </div>
    <script>
        function search(e) {
            let value = e.target.value.toLowerCase();
            $('#search_data li').filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(e.target.value) > -1);
            });
        }
    </script>
