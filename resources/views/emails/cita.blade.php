<!DOCTYPE html>
<html>
<head>
    <title>SqlapioTechnology LLC.</title>
    <style>
        table,
        th {
            border: 1px solid black;
        }
    </style>
</head>
<body>
    <img style="
            display: block;
            margin-left: auto;
            margin-right: auto;
            width: 600px;
            height: auto;" src="{{ asset('img/notification_email/notificaciones_img_3.png') }}">
    <div style="margin: auto; width: 600px; padding: 10px;">
        <p style="text-align: justify; margin-left: 20px;">
            <h2 style="text-align: justify; margin-left: 20px;">@lang('messages.emails.cita_medica')</h2>
            <h2 style="text-align: justify; margin-left: 20px;">@lang('messages.emails.sr'). {{ $mailData['patient_name'] }}</h2>
        </p>
        <p style="text-align: justify; margin-left: 20px;">
            @lang('messages.emails.agendada')
            <br>
            <strong> @lang('messages.emails.detalles_cita'):</strong>
        </p>
        <p style="text-align: justify; margin-left: 20px;">
            <h3 style="text-align: justify; margin-left: 20px;">
                @lang('messages.emails.doctor'): {{ $mailData['dr_name'] }}
                <br>
                @lang('messages.emails.fecha'): {{ $mailData['fecha'] }}
                <br>
                @lang('messages.emails.hora'): {{ $mailData['horario'] }}
                <br>
                @lang('messages.emails.centro_salud'): {{ $mailData['centro'] }}
                <br>
                @lang('messages.emails.piso'): {{ $mailData['piso'] }} - @lang('messages.emails.num_consultorio'): {{ $mailData['consultorio'] }}
                <br>
                @lang('messages.emails.telefono'): {{ $mailData['telefono'] }}
            </h3>
        </p>

        <p style="text-align: justify; margin-left: 20px;">
            @lang('messages.emails.gracias')
        </p>
             <p style="text-align: justify; margin-left: 20px;">
                @lang('messages.emails.confirmar_cita'):
            <br>
            {{ $mailData['link'] }}
        </p>
        <a href="{{ $mailData['ubication'] }}" style="text-decoration: none">
            <button style="
                background-image: linear-gradient(-180deg, #37AEE2 0%, #1E96C8 100%);
                border-radius: .5rem;
                box-sizing: border-box;
                color: #FFFFFF;
                display: flex;
                font-size: 16px;
                justify-content: center;
                margin-left: 20px;
                padding: 1rem 1.75rem;
                text-decoration: none;
                width: 26%;
                border: 0;
                cursor: pointer;
                user-select: none;
                -webkit-user-select: none;
                touch-action: manipulation;" role="button">@lang('messages.emails.ubicacion')
            </button>
        </a>
        <p style="text-align: justify; margin-left: 20px;">
            @lang('messages.emails.atentamente'),
            <br>
            <br>
            <img style="
                    display: block;
                    margin-left: 0px;
                    width: 128px;
                    height: auto;" src="{{ asset('img/notification_email/fir_jm.png') }}">
            Ing. Jhonny Martinez<br>CEO
        </p>
        <p style="text-align: justify; font-style: italic; margin-left: 20px;">
            @lang('messages.emails.comunicate') soporte@sqlapio.com
        </p>
    </div>
    <img style="
            display: block;
            margin-left: auto;
            margin-right: auto;
            width: 600px;
            height: auto;" src="{{ asset('img/notification_email/footer.png') }}">

</body>
</html>
