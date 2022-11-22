<!DOCTYPE html>
<html lang="es">
<head><meta http-equiv="Content-Type" content="text/html; charset=big5">
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

        @font-face {
            font-family: 'Courier';
            font-style: normal;
            font-weight: 700;
            src: url('../../../libraries/dompdf/fonts/Courier.ttf') format('truetype'),
            url('../../../../libraries/dompdf/fonts/Courier.ttf') format('truetype');
            }

        *{
            font-family: 'Courier';
        }

html, body{
            margin:3px 10px;
        }

        body{
            padding: 15px;
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
</head><body>
<table  width="100%">
        <tbody>
            <tr>
                <td class="text-center">
                    <img width="190px" src="<?php base_url() ?>assets/img/logo.jpeg">
                </td>
                <td class="">
                    <h3 style="margin: 4px; color: #1E88E5; font-size:24px;">Dr. Yeiner H. Alzate I.</h3>
                    <p style="margin: 4px;">Geront&oacute;logo U. Quindio ReTHUS 4265.</p>
                    <p style="margin: 4px;">M&aacute;ster Tratamiento del Dolor en la Pr&aacute;ctica Cl&iacute;nica; U. Salamanca, Reg. 22/633.</p>                    
                    <p style="margin: 4px;">Especialista en terapias en enfermedades comunes. Registro F5654 U.E.A</p>
                    <p style="margin: 4px;">Esp. M&eacute;todos Biol&oacute;gicos - Naturistas UNINI Reg CEC 14-1365.</p>
                    <p style="margin: 4px;">Master Md Biol&oacute;gica U.E.M.C. Reg 1669 FUI.</p>
                    <p style="margin: 4px;">Experto universitario en Terap&eacute;utica Homeop&aacute;tica U.E.A Registro f4841</p>
                    <h3 style="margin: 4px; color: #36a3f7;">dryeineralzate.com</h3>
                    <h3 style="margin: 4px; color: #F44336;">Tel&eacute;fono: 313 695 7462  <img width="40px" style="display:inline-block; vertical-align:middle;margin-top:7px;" src="<?php base_url() ?>assets/img/wp.jpg"></h3>
                </td>
            </tr>
        </tbody>
    </table>

    <div style="position: relative;z-index:9;">
        <hr style="margin: 20px 0;">
        <p style="margin: 3px 0;font-size:20px;"><strong>Fecha: <?php echo date('Y-m-d') ?></strong></p>
        <p style="margin: 3px 0 0px 0;font-size:20px;"><strong>Nombre: <?php echo strtoupper($ap['nombre_persona']. ' ' .$ap['apellidos_persona']) ?></strong></p>
    </div>

    <h3 style="margin-top: 0px; font-size:23px;">Rx:</h3>
    <div style="margin-top: 0;position: relative;z-index:9;font-weight:bold !important;">
        <?php echo $ap['detalles_recetario']; ?>
    </div>
    <img style="position: absolute; width: 550px;opacity: 0.5;left:80px; top: 300px;z-index:1;" src="<?php base_url() ?>assets/img/medicina.jpg">
   </body></html>