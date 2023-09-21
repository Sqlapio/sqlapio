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
    <h2 style="text-align: justify; margin-left: 20px;">Cita Medica agendada</h2>
    <img style="
            display: block;
            margin-left: auto;
            margin-right: auto;
            width: 600px;
            height: auto;"
        src="{{ asset('img/notification_email/cita_header.jpg') }}">
        <div style="margin: auto;
                    width: 600px;
                    padding: 10px;">
            <p style="text-align: justify; margin-left: 20px;">
                <h2 style="text-align: justify; margin-left: 20px;">Sr(a). {{ $mailData['name'] }}</h2>
            </p>
            <p style="text-align: justify; margin-left: 20px;">
                Nos complace informarle que usted acaba de agendar una cita exitosamente,bajo su supervision.
            </p>
            <table style="width: 600px; margin-left: 20px;">
                <tr>
                  <th style="text-align: center; padding: 10px">
                    Dr.(a): {{ $mailData['dr_name'] }}
                    <br>
                    Fecha: {{ $mailData['fecha'] }}
                    <br>
                    Hora: {{ $mailData['horario'] }}
                    <br>
                    Lugar: {{ $mailData['centro'] }}
                  </th>
                </tr>
              </table>
            <p style="text-align: justify; margin-left: 20px;">
                Le agradecemos de antemano su colaboracion en ser puntual y confirmar su cita medica. <br>
                Para confirmar la cita, le invitamos a hacer click en el siguiente enlace: <br>
                {{ $mailData['link'] }}
            </p>
            <p style="text-align: justify; margin-left: 20px;">
                Agradecemos enormemente su confianza en nuestros servicios. No dude en ponerse en contacto con nosotros si tiene alguna
                pregunta o necesita asistencia adicional
            </p>
            <p style="text-align: justify; margin-left: 20px;">
                <strong style="color: red";>Importante:</strong>
                <br>
                <strong>Al recibir este correo, dispone de 24 horas para confirmar tu cita. En caso de no realizar la confirmación, será necesario que solicite reagendara</strong>
            </p>
            <p style="text-align: justify; margin-left: 20px;">
                ¡Gracias por su confianza!
            </p>
            <p style="text-align: justify; font-style: italic; margin-left: 20px;">
                La información contenida en este mensaje y sus anexos tiene carácter confidencial, 
                y está dirigida únicamente al destinatario de la misma.
                Si usted ha recibido este mensaje por error, 
                por favor notifique inmediatamente al remitente por este mismo medio y borre el mensaje de su sistema. 
                La información por correo electrónico, no garantiza que la misma sea segura o esté libre de error, 
                por consiguiente, se recomienda
                su verificación.
            </p>
        </div>
    <img style="
            display: block;
            margin-left: auto;
            margin-right: auto;
            width: 600px;
            height: auto;"
        src="{{ asset('img/notification_email/footer.jpg') }}">
    
</body>
</html>