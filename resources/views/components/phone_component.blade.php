<script>
    const countries = [{

            name: 'Venezuela',
            prefix: 58,
            url_img: '{{ asset('img/icons_tlf/ve.png') }}'


        },
        {

            name: 'Republica Dominicana',
            prefix: 1809,
            url_img: '{{ asset('img/icons_tlf/do.png') }}'
        }

    ];

    $(document).ready(() => {
        createList();

        let phone = @json($phone);

        if(phone){
            // setiar valores componente telefono
            let prefix = phone.substring(0, phone.lastIndexOf("-("));
            let contrie = countries.find((e) => e.prefix == Number(prefix.replace('+', '')));
            $('#phone').val(phone.substring(phone.indexOf("-") + 1));
            $('#pn-input__prefix').val(prefix);
            $("#js_selected-flag").attr('src', contrie.url_img);
            //end
        }
    });

    const createList = () => {

        countries.map((country, countries) => {

            const {
                name,
                prefix,
                flag,
                url_img
            } = country;

            let elem = JSON.stringify(country);

            const element = `<li class="pn-list-item ${flag === "nl" ? "pn-list-item--selected" : ""}
                                js_pn-list-item" data-flag="${flag}" data-prefix="${prefix}" tabindex="0" role="button" aria-pressed="false">
                                <img class="pn-list-item__flag" src="${url_img}" />
                                <span  onclick='handlerSelectContry(${elem});'  class="pn-list-item__country js_country-name">${name}</span>
                                <span  onclick='handlerSelectContry(${elem});' class="pn-list-item__prefix js_country-prefix">(+${prefix})</span>
                            </li>`;

            $("#js_list").append(element);
        });
    }


    const handlerSelectContry = (item) => {

        $("#pn-input__prefix").val(`+${item.prefix}`);

        $("#js_selected-flag").attr('src', item.url_img);

        closeDropdown();

    }


    const openDropdownNew = () => {

        const isOpen = $("#js_pn-select").addClass("pn-select--open");
    }

    const closeDropdown = () => {

        $('#js_pn-select').removeClass("pn-select--open");
        $('#js_list').scrollTop = 0;
        $('.pn-input__phonenumber').val("");
        $(".pn-input__phonenumber").focus();
    }
</script>
<style>
    .pn-input {
        background: transparent !important;
        padding: 5px 15px !important;
    }

    .pn-select {
        font-size: 1rem !important;
        border-radius: 30px !important;
        padding: 0.375rem 30px 0.375rem 15px !important;
        box-shadow: 2px 3px 9px -4px rgba(0, 0, 0, 0.77);
        -webkit-box-shadow: 2px 3px 9px -4px rgba(0, 0, 0, 0.77);
        -moz-box-shadow: 2px 3px 9px -4px rgba(0, 0, 0, 0.77);
        padding: 3px !important;
        max-width: 100% !important;
    }

    .pn-select:focus,
    .pn-select:focus-within {
        color: var(--bs-body-color);
        background-color: var(--bs-body-bg);
        border-color: #86b7fe;
        outline: 0;
        box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25);
    }
</style>
<div>
    <label for="phone" class="form-label" style="font-size: 13px; margin-bottom: 5px; margin-top: 4px">@lang('messages.form.telefono')</label>
    <div class="pn-select" id="js_pn-select" style="--prefix-length: 2">
        <button class="pn-selected-prefix" aria-label="Select phonenumber prefix" id="js_trigger-dropdown" onclick="openDropdownNew();" tabindex="1" type="button">
            <img class="pn-selected-prefix__flag" id="js_selected-flag" src="{{ asset('img/icons_tlf/ve.png') }}" />
        </button>
        <div class="pn-input">
            <div class="pn-input__container">
                <input class="pn-input__prefix input-telelfono-class" id="pn-input__prefix" value="+58" type="text" name="phonenumber_prefix" id="js_number-prefix" />
                <input class="pn-input__phonenumber input-telelfono-class phone input-phone-class" id="phone" type="tel" name="phone" value="" max="10" autocomplete="nope" />
            </div>
        </div>
        <div class="pn-dropdown" id="js_dropdown">
            <ul class="pn-list list" id="js_list"></ul>
        </div>
    </div>
</div>
