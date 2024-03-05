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
<div>
    <div class="pn-select" id="js_pn-select" style="--prefix-length: 2">
        <button class="pn-selected-prefix" aria-label="Select phonenumber prefix" id="js_trigger-dropdown"
            onclick="openDropdownNew();" tabindex="1" type="button">
            <img class="pn-selected-prefix__flag" id="js_selected-flag" src="{{ asset('img/icons_tlf/ve.png') }}" />
        </button>
        <div class="pn-input">
            <div class="pn-input__container">
                <input class="pn-input__prefix input-telelfono-class" id="pn-input__prefix" value="+58"
                    type="text" name="phonenumber-prefix" id="js_number-prefix" />
                <input class="pn-input__phonenumber input-telelfono-class phone input-phone-class" id="phone"
                    type="tel" name="phone" value="" placeholder="@lang('messages.form.telefono')" max="10"
                    onclick="closeDropdown();" autocomplete="nope" />
            </div>
        </div>
        <div class="pn-dropdown" id="js_dropdown">
            {{-- <div class="pn-search">
                <svg class="pn-search__icon" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                    viewBox="0 0 24 24" fill="none" stroke="#103155" stroke-width="2" stroke-linecap="round"
                    stroke-linejoin="round">
                    <circle cx="11" cy="11" r="8"></circle>
                    <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                </svg>
                <input placeholder="Buscar pais" class="pn-search__input search input-telelfono-class" type="search"
                    id="jj" autocomplete="nope" />
            </div> --}}
            <ul class="pn-list list" id="js_list"></ul>
        </div>
    </div>
</div>
