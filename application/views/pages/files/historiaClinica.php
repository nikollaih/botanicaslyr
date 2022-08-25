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
            margin: 20px;
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
            margin: 0 0 10px 0;
        }

        .contenedor-informacion > p{
            margin-bottom: 0;
            margin-top: 0;
            font-size: 10px !important;
        }

        table{
            margin-bottom: 15px;
            padding-bottom: 15px;
            border-bottom: 1px solid;
        }

        h4 {
            margin-bottom: 0;
            margin-top: 0;
        }
    </style>
</head><body>
    <table  width="100%">
        <tbody>
            <tr>
                <td class="text-center">
                    <img width="120px" id="logo" src="<?php base_url() ?>assets/img/logo_nuevo.jpg">
                </td>
                <td class="">
                    <h3 style="margin: 4px; color: #1E88E5; font-size:20px;">Botánicas Lucrecia y Rosa</h3>
                    <p style="margin: 4px;">Consultorio Gerontológico NIT: 41958718-0.</p>
                    <p style="margin: 4px;">Dr. Yeiner H. Alzate I. ReTHUS 4265.</p>
                    <h3 style="margin: 4px; color: #36a3f7;">dryeineralzate.com</h3>
                    <h3 style="margin: 4px; color: #F44336;">Tel&eacute;fono: 313 695 7462  <img width="30px" style="display:inline-block; vertical-align:middle;margin-top:7px;" src="<?php base_url() ?>assets/img/wp.jpg"></h3>
                </td>
            </tr>
        </tbody>
    </table>
    <div style="margin-top: 0;position: relative;z-index:9;font-weight:bold !important;">
        <h4 style="text-align:center;font-size:20px;margin-top: 0;margin-bottom:0">HISTORIA CLÍNICA GERONTOLÓGICA</h4>
        <div style="margin-bottom:10px;" class="contenedor-informacion">
            <label><strong>Fecha:</strong> <?= date("Y-m-d") ?></label><br>
            <label><strong>Hora:</strong> <?= date("h:i a") ?></label><br>
            <label><strong>Identificación:</strong> <?= $persona["numero_documento"] ?></label><br>
            <label><strong>Nombre del paciente:</strong> <?= $persona["nombre_persona"] . " " . $persona["apellidos_persona"] ?></label><br>
            <label><strong>Edad:</strong> <?= $persona["peso_persona"] ?></label><br>
        </div>

        <div class="contenedor-informacion">
            <strong style="font-size:16px;">I. ALERGIAS: </strong><?= $historia_clinica["alergias"] ?>
        </div>

        <div class="contenedor-informacion">
            <strong style="font-size:16px;">II. MEDICAMENTOS QUE CONSUME: </strong><?= $historia_clinica["medicamentos"] ?>
        </div>

        <div class="contenedor-informacion">
            <strong style="font-size:16px;">III. MOTIVO DE CONSULTA: </strong><?= $historia_clinica["motivo_consulta"] ?>
        </div>

        <div class="contenedor-informacion">
            <strong style="font-size:16px;">IV. FACTORES DE RIESGO Y ANTECEDENTES: </strong><?= $historia_clinica["factores_riesgo"] ?>
        </div>

        <div class="contenedor-informacion">
        <strong style="font-size:16px;">V. I.D.D.: </strong><?= $historia_clinica["idd"] ?>
        </div>

        <div class="contenedor-informacion">
            <strong style="font-size:16px;">VI. SIGNOS VITALES: </strong>
            <label><strong>Saturación:</strong> <?= $historia_clinica["saturacion"].', ' ?></label>
            <label><strong>Frecuencia cardiaca:</strong> <?= $historia_clinica["frecuencia_cardiaca"].', ' ?></label>
            <label><strong>Frecuencia respiratoria:</strong> <?= $historia_clinica["frecuencia_respiratoria"].', ' ?></label>
            <label><strong>Tensión arterial:</strong> <?= $historia_clinica["tension_arterial"].', ' ?></label>
            <label><strong>Temperatura:</strong> <?= $historia_clinica["temperatura"].', ' ?></label>
            <label><strong>Dolor EVA:</strong> <?= $historia_clinica["dolor_eva"] ?></label><br>
        </div>

        <div class="contenedor-informacion">
        <strong style="font-size:16px;">VII. ANÁLISIS, PLAN DE MANEJO Y RECOMENDACIONES GENERALES: </strong><?= $historia_clinica["analisis_manejo_recomendaciones"] ?>
        </div>
    </div>
   </body></html>