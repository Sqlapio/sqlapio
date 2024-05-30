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
            <h2 style="text-align: justify; margin-left: 20px;">Sr(a). {{ $mailData['dr_name'] }}</h2>
        </p>
        <p style="text-align: justify; margin-left: 20px;">
            @lang('messages.emails.act_mail')<br>
             @lang('messages.emails.validacion'):<br>
            <strong><h1 style="text-align: justify; margin-left: 20px;">{{ $mailData['code'] }}</h1></strong>
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
