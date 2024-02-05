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
            height: auto;" src="{{ asset('img/notification_email/notificaciones_img_3.jpg') }}">
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
                <br>
                Piso: {{ $mailData['piso'] }} - Consultorio: {{ $mailData['consultorio'] }}
                <br>
                Telefono: {{ $mailData['telefono'] }}
            </h3>
        </p>

        <p style="text-align: justify; margin-left: 20px;">
            Gracias por ser parte de nosotros, Sqlapio.com, innovando para el futuro.
        </p>
             <p style="text-align: justify; margin-left: 20px;">
            Para confirmar su cita puede hacerlo a traves del siguiente link:
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
                touch-action: manipulation;" role="button">Ver ubicación
            </button>
        </a>
        <p style="text-align: justify; margin-left: 20px;">
            Atentamente,
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
            Para mayor información puede comunicarse 24/7 con nuestro equipo a traves de soporte@sqlapio.com
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
