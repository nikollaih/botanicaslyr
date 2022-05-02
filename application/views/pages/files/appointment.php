<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Factura</title>
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
            padding: 25px;
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
                <td>
                    <img width="150px" src="<?php base_url() ?>assets/img/logo.jpeg">
                </td>
                <td class="text-center">
                    <h1 style="font-size: 29px;">Consultorio Gerontol&oacute;gico</h1>
                    <h2 style="font-size:20px;">M&eacute;todos Biol&oacute;gicos-Naturistas</h2>
                    <p>Yeinr H. Alzate I. - NIT 94.463.653-0</p>
                </td>
            </tr>
        </tbody>
    </table>
    <div style="padding-left: 300px;">
        <table width="100%">
            <tbody>
                <tr>
                    <td style="width:500px;"></td>
                    <td class="text-center">
                        <table style="border: 1px solid #000;width:100%;border-radius:4px;">
                            <thead>
                                <tr>
                                    <th colspan="3" class="text-center" style="font-size:7px;font-weigth:100;">R&Eacute;GIMEN SIMPLIFICADO</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="text-center"><strong>D&Iacute;A</strong></td>
                                    <td class="text-center"><strong>MES</strong></td>
                                    <td class="text-center"><strong>A&Ntilde;O</strong></td>
                                </tr>
                                <tr>
                                    <td class="text-center"><?php echo date('d') ?></td>
                                    <td class="text-center"><?php echo date('m') ?></td>
                                    <td class="text-center"><?php echo date('Y') ?></td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                    <td>
                        <table style="border: 1px solid #000;width:100%;padding: 4px;border-radius:4px;">
                            <thead>
                                <tr>
                                    <th class="text-center" style="font-size:10px;font-weigth:100;">FACTURA DE VENTA</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                <td class="text-center" style="font-size: 25px;">No <strong><span style="color: #F44336;"><?php echo invoiceNumber($ap['id_consulta']) ?></span></strong></td>
                                </tr>
                            </tbody>
                        </table></td>
                </tr>
            </tbody>
        </table>
    </div>

    <div>
        <p style="margin: 3px 0;"><strong>Nombre</strong>: <?php echo $ap['nombre_persona']. ' ' .$ap['apellidos_persona'] ?></p>
        <p style="margin: 3px 0;"><strong>C.C./NIT.</strong>: <?php echo $ap['numero_documento'] ?></p>
        <p style="margin: 3px 0;"><strong>TEL./CEL.</strong>: <?php echo $ap['telefono_persona'] ?></p>
    </div>

    <table width="100%" class="table-products">
        <thead>
            <tr>
                <td class="text-center" style="background: #91D6FF;"><strong>Descripción</strong></td>
                <td class="text-center" style="background: #91D6FF;"><strong>Cant.</strong></td>
                <td class="text-center" style="background: #91D6FF;"><strong>Precio Unidad</strong></td>
                <td class="text-center" style="background: #91D6FF;"><strong>Total</strong></td>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>
                    Consulta
                </td>
                <td class="text-center">
                    1
                </td>
                <td class="text-right">
                    $<?php echo number_format($ap['valor_consulta'],0,',','.') ?>
                </td>
                <td class="text-right">
                    $<?php echo number_format($ap['valor_consulta'],0,',','.') ?>
                </td>
            </tr>
            <tr>
                <td colspan="3">
                    <strong>TOTAL</strong>
                </td>
                <td class="text-right">
                    <strong>$<?php echo number_format($ap['valor_consulta'],0,',','.') ?></strong>
                </td>
            </tr>
        </tbody>
    </table>
    <p style="font-size: 9px;">Esta Factura de Venta se asimila a un titulo valor según Art. 3 ley 1231 de 2008</p>
    <p style="position: absolute; bottom: 0; border-top:1px solid #000; width:40%; left: 0; text-align:center; padding-top: 4px;">Firma Comprador</p>
    <p style="position: absolute; bottom: 0; border-top:1px solid #000; width:40%; right: 0; text-align:center; padding-top: 4px;">Firma Vendedor</p>
</body>
</html>