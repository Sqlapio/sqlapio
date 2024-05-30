<!DOCTYPE html>
<html>
<head>
    <title>SqlapioTechnology LLC.</title>
</head>
<body>

    <img style="
            display: block;
            margin-left: auto;
            margin-right: auto;
            width: 600px;
            height: auto;"
        src="{{ asset('img/notification_email/notificaciones_img_1.png') }}">
        <div style="margin: auto;
                    width: 600px;
                    padding: 10px;">
            <p style="text-align: justify; margin-left: 20px;">
                <h1 style="text-align: justify; margin-left: 20px;">{{ $mailData['laboratory_name'] }}</h1>
            </p>

            <p style="text-align: justify; margin-left: 20px;">
                @lang('messages.emails.saludo').
                <br>
                 @lang('messages.emails.registarse') @lang('messages.emails.corporativo') @lang('messages.emails.nuestro_sis').
                <br>
                <br>
                @lang('messages.emails.verify_email'):
                <br>
                <br>
                {{ env('APP_URL') }}/verify/{{ $mailData['verify_code'] }}
            </p>

            <p style="text-align: justify; margin-left: 20px;">
                @lang('messages.emails.gracias')
            </p>
            <p style="text-align: justify; margin-left: 20px;">
                @lang('messages.emails.atentamente'),
                <br>
                <br>
                <img style="
                    display: block;
                    margin-left: 0px;
                    width: 128px;
                    height: auto;"
                src="{{ asset('img/notification_email/fir_jm.png') }}">
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
            height: auto;"
        src="{{ asset('img/notification_email/footer.png') }}">

</body>
</html>
