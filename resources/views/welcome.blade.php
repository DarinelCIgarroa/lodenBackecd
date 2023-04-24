<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Loden</title>
    <style>
        body {
            background-color: #d6eaf8;
        }

        .content {
            width: 100%;
            padding-right: 15px;
            padding-left: 15px;
            margin-right: auto;
            margin-left: auto;
        }

        .estruct {
            padding-right: 25%;
            padding-left: 25%;
            align-items: center;
            align-content: center;
            text-align: center;
        }

        .img {
            width: 80%;
            display: block;
            margin-left: auto;
            margin-right: auto;
        }

        .message {
            padding-left: 18px;
            padding-right: 18px;
            text-align:  justify;
        }

        .descrition {
            color: #fff;
            background-color: #7569ad;
            border-bottom-left-radius: 17px;
            border-bottom-right-radius: 17px;
            font-family: Arial, Helvetica, Verdana, sans-serif;
        }

        .contenido-img {
            background-color: #fff;
            border-top-left-radius: 17px;
            border-top-right-radius: 17px;

        }

        .mail {
            color: rgb(194, 241, 241);
        }

        .nombre {
            font-family: "Homer Simpson UI";
            font-size: 17.5px;
        }

        @media (min-width: 64px) and (max-width: 750px) {
            .estruct {
                padding-right: 5%;
                padding-left: 5%;
                align-items: center;
                align-content: center;
                text-align: center;
            }
        }

    </style>
</head>

<body>
    <div class="content">
        <div class="estruct">
            <div class="contenido-img">
                <img class="img" src="{{ asset('img/atent.png') }}" srcset="">
            </div>
            <div class="descrition">
                <br>
                <span> Nombre de la empresa </span>
                <h3> Datos del suscriptor </h3>
                <p class="nombre">Nombre:
                    <span style=" padding:10px"> dfdfsasasa asdasd asadas</span>
                </p>
                <br>
                <span> Correo electronico </span>
                <p> <a class="mail" href="mailto: subscritos@gmail.com"> subscritos@gmail.com</a></p>
                <span> Número tel</span>
                <p><a class="mail" href="tel:+">9614106795</a> </p>
                    <p class="message"> Facilita a las personas conectarse y compartir sus mensajes e información, sin la interferencia
                        de un tercero. También permite que una persona envíe el mismo mensaje a varias personas en todo
                        el mundo. Es un medio de conectividad altamente convencional y popular.
                        A diferencia de la mensajería instantánea o los chats, a través de correos electrónicos, los
                        usuarios pueden aceptar mensajes, reenviarlos a otras personas y también almacenarlos en su
                        servidor a través de la función de alojamiento web.</p>

                <br>
            </div>
            <br>
        </div>
    </div>
</body>

</html>
