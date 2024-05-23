<style>
    .parent {
        height: 100%;
        width: 100%;
        border: 3px solid black;
    }

    .child {
        text-align: center;
        height: 25px;
        width: 125px;
        background-color: rgb(30, 202, 245);
        border-radius: 50px;
        padding: 2px;
    }
</style>
<script>

    $(document).ready(() => {

        $(".child").draggable({
            revert: true
        });

        $(".parent").droppable({
            accept: '.child',
            drop: function(event, ui) {

                let valueFilter = ui.draggable[0].id;
                console.log(ui.draggable);

                $(this).append($(ui.draggable));
            }
        });
    });
</script>
<div class="row">

    <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-lg-6">
        <h4 class="mb-4 mt-2" style="color: #ffff">Filtrar por mes</h4>
        <div class="parent">
            @php
                $item = [
                    0 => [
                        'text' => 'Enero',
                        'id' => 'enero',
                    ],
                    1 => [
                        'text' => 'Febrero',
                        'id' => 'febrero',
                    ],
                    2 => [
                        'text' => 'Marzo',
                        'id' => 'marzo',
                    ],
                    3 => [
                        'text' => 'Abril',
                        'id' => 'abril',
                    ],
                    4 => [
                        'text' => 'Mayo',
                        'id' => 'mayo',
                    ],
                    5 => [
                        'text' => 'Junio',
                        'id' => 'junio',
                    ],
                    6 => [
                        'text' => 'Julio',
                        'id' => 'marzo',
                    ],
                    7 => [
                        'text' => 'Agosto',
                        'id' => 'agosto',
                    ],
                    8 => [
                        'text' => 'Septiembre',
                        'id' => 'septiembre',
                    ],
                    9 => [
                        'text' => 'Octubre',
                        'id' => 'octubre',
                    ],
                    10 => [
                        'text' => 'Noviembre',
                        'id' => 'noviembre',
                    ],
                    11 => [
                        'text' => 'Diciembre',
                        'id' => 'diciembre',
                    ],
                ];

            @endphp
            <div class="row" style="max-width: 94%;padding-left: 30px">
                @foreach ($item as $e)
                    <div class="child col-sm-2 col-md-2 col-lg-2 col-xl-2 col-lg-2 mt-3" id="{{ $e['id'] }}">
                        <div id="{{ $e['id'] }}">{{ $e['text'] }}</div>
                    </div>
                @endforEach
            </div>

        </div>

    </div>

    <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-lg-6">
        <h4 class="mb-4 mt-2" style="color: #ffff">Arrastra aqui el mes</h4>
        <div class="parent">
            <div class="row" style="max-width: 94%;padding-left: 30px">

            </div>
        </div>
    </div>
</div>
