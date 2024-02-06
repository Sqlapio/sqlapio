    <style>
        ul {
            list-style-type: none;
        }
    </style>
    <div>
        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 mt-2" id="search-patients-show">
            <div class="form-group">
                <div class="Icon-inside">
                    <label for="id_select" class="form-label"
                        style="font-size: 13px; margin-bottom: 5px; margin-top: 4px">@lang('messages.placeholder.buscar_paciente')</label>
                    <select style="width:100% !important " name="id_select" id="id_select"
                        class="form-control combo-textbox-input select_dos_dairy">
                        <option value="">@lang('messages.placeholder.seleccione')...</option>
                        @foreach ($data as $item)
                            <option value="{{ $item }}">
                                {{ $item->patient_code . ' - ' . $item->name . ' ' . $item->last_name }} </option>
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(() => {
            $(".select_dos_dairy").select2({
                dropdownParent: "#exampleModal",
                matcher: matchCustom

            }).on("change", function(e) {
                searchPatients(JSON.parse(e.target.value));
            });
        });

        function search(e) {
            let value = e.target.value.toLowerCase();
            $('#search_data li').filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(e.target.value) > -1);
            });
        }
    </script>
