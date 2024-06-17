    <style>
        ul {
            list-style-type: none;
        }

        .select2-container .select2-selection {
            border-radius: 30px !important;
            font-size: 1rem !important;
            font-weight: 400;
            line-height: 1.5;
            color: var(--bs-body-color);
            appearance: none;
            background-color: var(--bs-body-bg);
            background-clip: padding-box;
            border: var(--bs-border-width) solid var(--bs-border-color);
            box-shadow: 2px 3px 9px -4px rgba(0, 0, 0, 0.77);
            -webkit-box-shadow: 2px 3px 9px -4px rgba(0, 0, 0, );
            padding: 0.375rem 30px 0.375rem 15px !important;
        }

        .select2-container .select2-selection--single {
            height: 40px;
        }

        .select2-container .select2-selection--single .select2-selection__rendered {
            padding-left: 0px;
        }

        .select2-container--default .select2-selection--single .select2-selection__arrow {
            top: 7px;
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
                                {{ $callBack == 'dairy' ? $item->patient_code . ' - ' . $item->name . ' ' . $item->last_name : $item->description }}
                            </option>
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(() => {
            
            let callBack = @json($callBack);

            $(".select_dos_dairy").select2({
                dropdownParent: (callBack == "dairy") ? "#exampleModal" : "",
                // matcher: matchCustom

            }).on("change", function(e) {

                if (callBack == "dairy") {
                    searchPatients(JSON.parse(e.target.value));
                } else {
                    handlerSelect2(JSON.parse(e.target.value));
                }
            });
        });

        // function search(e) {
        //     let value = e.target.value.toLowerCase();
        //     $('#search_data li').filter(function() {
        //         $(this).toggle($(this).text().toLowerCase().indexOf(e.target.value) > -1);
        //     });
        // }
    </script>
