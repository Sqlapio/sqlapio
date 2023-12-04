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
            height: auto;" src="{{ asset('img/notification_email/cita_header.jpg') }}">
    <div style="margin: auto; width: 600px; padding: 10px;">
        <p style="text-align: justify; margin-left: 20px;">
            <h2 style="text-align: justify; margin-left: 20px;">Cita Médica agendada</h2>
            <h2 style="text-align: justify; margin-left: 20px;">Sr(a). {{ $mailData['patient_name'] }}</h2>
        </p>
        <p style="text-align: justify; margin-left: 20px;">
            Le informamos que tiene una cita médica agendada en Sqlapio.com
            <br>
            <strong>Detalles de la cita:</strong>
        </p>
        <p style="text-align: justify; margin-left: 20px;">
            <h3 style="text-align: justify; margin-left: 20px;">
                Dr(a): {{ $mailData['dr_name'] }}
                <br>
                Fecha: {{ $mailData['fecha'] }}
                <br>
                Hora: {{ $mailData['horario'] }}
                <br>
                Centro: {{ $mailData['centro'] }}
            </h3>
        </p>
        <p style="text-align: justify; margin-left: 20px;">
            Gracias por ser parte de nosotro, Sqlapio.com, innovando para el futuro.
        </p>
        {{-- <p style="text-align: justify; margin-left: 20px;">
            Para confirmar su cita puede hacerlo a traves del siguiente link:
            <br>
            {{ $mailData['link'] }}
        </p> --}}
        <p style="text-align: justify; margin-left: 20px;">
            Atentamente,
            <br>
            <br>
            <img style="
                    display: block;
                    margin-left: 0px;
                    width: 100px;
                    height: auto;" src="{{ asset('img/notification_email/fir_jm.png') }}">
            Ing. Jhonny Martinez<br>CEO
        </p>
        <p style="text-align: justify; font-style: italic; margin-left: 20px;">
            Para mayor información puede comunicarse 24/7 con nuestro equipo a traves de sqlapiotechnology@sqlapio.com
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
