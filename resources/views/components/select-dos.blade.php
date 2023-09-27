    <style>
        ul {
            list-style-type: none;
        }
    </style>
    <div>
        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 mt-3">
            <div class="form-floating mb-3">
                <input onkeyup="search(event)" type="text" class="form-control" placeholder="" id="floatingInputt">
                <label for="floatingInputt">Buscar paciente</label>
            </div>
            <div class="overflow-auto p-3 bg-light" style="max-width: 100%; max-height: 200px;">
                @foreach ($data as $key => $item)
                    <ul id="search_data">
                        <li>
                            <input onclick="handlerRadio({{$item}})" value="{{ $item->patient_code }}" class="form-check-input"
                                type="radio" name="flexRadioDefault" id="flexRadioDefault2" checked>
                            <label class="form-check-label" for="flexRadioDefault2">
                                {{ $item->patient_code . '-' . $item->name . ' ' . $item->name }}
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
