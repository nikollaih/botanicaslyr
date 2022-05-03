<!DOCTYPE html>
<html lang="es">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
    <meta http-equiv="content-language" content="es" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Recetario</title>
    <style>
        @font-face {
            font-family: 'simpson';
            src: url('../../../../assets/fonts/simpson_normal-webfont.woff2') format('woff2'),
                url('../../../../assets/fonts/simpson_normal-webfont.woff') format('woff'),
                url('../../../../assets/fonts/simpson_normal-webfont.ttf') format('truetype');
            font-weight: normal;
            font-style: normal;

        }

        *{
            font-family: 'Courier';
        }

        body{
            padding: 5px;
        }
html, body{
margin:3px 10px;
}

        
        .text-center{
            text-align: center;
        }

        .text-right{
            text-align: right;
        }

        .table-products td{
            border: 1px solid #000;
            padding: 5px;
        }

        .table-products{
            border-collapse: collapse;
            margin-top: 30px;
        }
    </style>
</head>
<body>
    <table  width="100%">
        <tbody>
            <tr>
                <td class="text-center">
                    <img width="180px" src="<?php base_url() ?>assets/img/logo.jpeg">
                </td>
                <td class="">
                    <h3 style="margin: 4px; color: #1E88E5; font-size:24px;">Dr. Yeiner H. Alzate I.</h3>
                    <p style="margin: 4px;">Geront&oacute;logo U. Quindio ReTHUS 4265.</p>
                    <p style="margin: 4px;">Esp. M&eacute;todos Biol&oacute;gicos - Naturistas UNINI Reg CEC 14-1365.</p>
                    <p style="margin: 4px;">Master Md Biol&oacute;gica U.E.M.C. Reg 1669 FUI.</p>
                    <p style="margin: 4px;">Especialista en terapias en enfermedades comunes. Registro F5654 U.E.A</p>
                    <p style="margin: 4px;">Experto universitario en Terap&eacute;utica Homeop&aacute;tica U.E.A Registro f4841</p>
                    <h3 style="margin: 4px; color: #F44336;">Tel&eacute;fono: 313 695 7462  <img width="25px" style="display:inline-block; vertical-align:middle;margin-top:7px;" src="<?php base_url() ?>assets/img/wp.jpg"></h3>
                </td>
            </tr>
        </tbody>
    </table>

    <div style="position: relative;z-index:9;">
        <hr style="margin: 10px 0;">
        <p style="margin: 3px 0;font-size:20px;"><strong>Fecha: <?php echo $recipe['fecha_recetario'] ?></strong></p>
        <p style="margin: 3px 0 0px 0;font-size:20px;"><strong>Nombre: <?php echo strtoupper($recipe['paciente_recetario']) ?></strong></p>
    </div>

    <h3 style="margin-top: 0px; font-size:24px;">Rx:</h3>
    <div style="margin-top: 0; position: relative;z-index:9;">
        <?php echo $recipe['texto_recetario']; ?>
    </div>
    <img style="position: absolute; width: 600px;opacity: 0.5;left:100px; top: 260px;z-index:1;" src="<?php base_url() ?>assets/img/medicina.jpeg">
   </body>
</html>