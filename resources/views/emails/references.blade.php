<!DOCTYPE html>
<html>
<head>
    <title>SqlapioTechnology LLC.</title>
    <style>
        table, th{
            border: 1px solid black;
        }
    </style>
</head>
<body>
    <h2 style="text-align: justify; margin-left: 20px;">@lang('messages.emails.referencia_med')</h2>
    <img style="
            display: block;
            margin-left: auto;
            margin-right: auto;
            width: 600px;
            height: auto;"
        src="{{ asset('img/notification_email/notificaciones_img_3.png') }}">
        <div style="margin: auto;
                    width: 600px;
                    padding: 10px;">
            <p style="text-align: justify; margin-left: 20px;">
                <h2 style="text-align: justify; margin-left: 20px;">@lang('messages.emails.sr'). {{ $mailData['patient_name'] }}</h2>
            </p>
            <p style="text-align: justify; margin-left: 20px;">
                @lang('messages.emails.consulta_med') <strong>@lang('messages.emails.doctor'): {{ $mailData['dr_name'] }}</strong>, @lang('messages.emails.en_centro_med'): <strong>{{ $mailData['center'] }}</strong>.
            </p>
            <p style="text-align: justify; margin-left: 20px;">
                <strong>@lang('messages.emails.el') @lang('messages.emails.doctor'): {{ $mailData['dr_name'] }}</strong> <br> @lang('messages.emails.genero'):
            </p>
            <table style="width: 600px; margin-left: 20px;">
                <tr>
                  <th style="text-align: center; padding: 10px">
                    @lang('messages.emails.referencia'): {{ $mailData['reference_code'] }}
                    <br>
                    @lang('messages.emails.fecha'): {{ $mailData['reference_date'] }}
                    <br>
                    @lang('messages.emails.examenes'):
                    <br>
                        @foreach ($mailData['patient_exam'] as $item)
                                {{ $item->description}}<br>
                        @endforeach

                    <br>
                    @lang('messages.emails.estudios'):
                    <br>
                        @foreach ($mailData['patient_study'] as $item)
                        {{ $item->description}}<br>
                        @endforeach
                  </th>
                </tr>
              </table>
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
