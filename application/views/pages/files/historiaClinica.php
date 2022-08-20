<!DOCTYPE html>
<html lang="es">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=big5">
    <meta http-equiv="content-language" content="es" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Historia Clinica -  <?= $persona["nombre_persona"]." ".$persona["apellidos_persona"] ?></title>
    <style>
        *{
            font-family: 'Courier';
        }

        @page {
            margin: 40px;
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

        #logo{
            padding: 0 40px;
            z-index: 9;
        }

        p{
            font-size: 17px;
        }

        .contenedor-informacion{
            margin: 0px 10px 30px 10px;
        }

        .contenedor-informacion > p{
            margin-bottom: 0;
            font-size: 10px !important;
        }

        table{
            margin-bottom: 15px;
            padding-bottom: 15px;
            border-bottom: 1px solid;
        }
    </style>
</head><body>
    <table  width="100%">
        <tbody>
            <tr>
                <td class="text-center">
                    <img width="190px" id="logo" src="<?php base_url() ?>assets/img/logo.jpeg">
                </td>
                <td class="">
                    <h3 style="margin: 4px; color: #1E88E5; font-size:25px;">Dr. Yeiner H. Alzate I.</h3>
                    <p style="margin: 4px;">Geront&oacute;logo U. Quindio ReTHUS 4265.</p>
                    <p style="margin: 4px;">Esp. M&eacute;todos Biol&oacute;gicos - Naturistas UNINI Reg CEC 14-1365.</p>
                    <p style="margin: 4px;">Master Md Biol&oacute;gica U.E.M.C. Reg 1669 FUI.</p>
                    <p style="margin: 4px;">Especialista en terapias en enfermedades comunes. Registro F5654 U.E.A</p>
                    <p style="margin: 4px;">Experto universitario en Terap&eacute;utica Homeop&aacute;tica U.E.A Registro f4841</p>
                    <h3 style="margin: 4px; color: #36a3f7;">dryeineralzate.com</h3>
                    <h3 style="margin: 4px; color: #F44336;">Tel&eacute;fono: 313 695 7462  <img width="30px" style="display:inline-block; vertical-align:middle;margin-top:7px;" src="<?php base_url() ?>assets/img/wp.jpg"></h3>
                </td>
            </tr>
        </tbody>
    </table>
    <div style="margin-top: 0;position: relative;z-index:9;font-weight:bold !important;">
        <h4 style="text-align:center;font-size:20px;">HISTORIA CLÍNICA GERONTOLÓGICA</h4>
        <div class="contenedor-informacion">
            <label><strong>Fecha:</strong> <?= date("Y-m-d") ?></label><br>
            <label><strong>Hora:</strong> <?= date("H:i a") ?></label><br>
            <label><strong>Identificación:</strong> <?= $persona["numero_documento"] ?></label><br>
            <label><strong>Nombre del paciente:</strong> <?= $persona["nombre_persona"] . " " . $persona["apellidos_persona"] ?></label><br>
            <label><strong>Edad:</strong> <?= $persona["peso_persona"] ?></label><br>
        </div>

        <h4 style="text-align:center;">I. ALERGIAS</h4>
        <div class="contenedor-informacion">
            <?= $historia_clinica["alergias"] ?>
        </div>

        <h4 style="text-align:center;">I. MEDICAMENTOS QUE CONSUME</h4>
        <div class="contenedor-informacion">
            <?= $historia_clinica["medicamentos"] ?>
        </div>

        <h4 style="text-align:center;">III. MOTIVO DE CONSULTA</h4>
        <div class="contenedor-informacion">
            <?= $historia_clinica["motivo_consulta"] ?>
        </div>

        <h4 style="text-align:center;">IV. SIGNOS VITALES</h4>
        <div class="contenedor-informacion">
            <label><strong>Saturación:</strong> <?= $historia_clinica["saturacion"] ?></label><br>
            <label><strong>Frecuencia cardiaca:</strong> <?= $historia_clinica["frecuencia_cardiaca"] ?></label><br>
            <label><strong>Frecuencia respiratoria:</strong> <?= $historia_clinica["frecuencia_respiratoria"] ?></label><br>
            <label><strong>Tensión arterial:</strong> <?= $historia_clinica["tension_arterial"] ?></label><br>
            <label><strong>Temperatura:</strong> <?= $historia_clinica["temperatura"] ?></label><br>
            <label><strong>Dolor EVA:</strong> <?= $historia_clinica["dolor_eva"] ?></label><br>
        </div>

        <h4 style="text-align:center;">V. I.D.D.</h4>
        <div class="contenedor-informacion">
            <?= $historia_clinica["idd"] ?>
        </div>

        <h4 style="text-align:center;">VI. ANÁLISIS, PLAN DE MANEJO Y RECOMENDACIONES GENERALES</h4>
        <div class="contenedor-informacion">
            <?= $historia_clinica["analisis_manejo_recomendaciones"] ?>
        </div>
    </div>
   </body></html>