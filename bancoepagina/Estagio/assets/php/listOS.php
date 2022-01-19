<!DOCTYPE html>
<?php
include_once("conexao/banco.php");
?>
<html lang="pt-br">

<head>
    <title>Ordens de serviço</title>

    <!--==================== UNICONS ====================-->
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">

    <!--========== BOX ICONS ==========-->
    <link href='https://cdn.jsdelivr.net/npm/boxicons@2.0.5/css/boxicons.min.css' rel='stylesheet'>

    <!-- Required meta tags -->
    <meta charset="utf-8" name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

    <!--==================== CSS ====================-->
    <link rel="stylesheet" href="../css/card_style.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/menu_card.css">
    <link rel="stylesheet" href="../css/tableOS.css">

    <!--==================== JS ====================-->
    <script src="../js/menu_card.js" defer></script>
    <script src="../js/darklightmode.js" defer></script>
    <script src="../js/vanilla-masker.js"></script>
    <script src="../js/index.js" defer></script>

    <!-- Font Awesome CSS Links -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" integrity="sha512-5A8nwdMOWrSz20fDsjczgUidUBR8liPYU+WymTZP1lmY9G6Oc7HlZv156XqnsgNUzTyMefFTcsFH/tnJE/+xBg==" crossorigin="anonymous" />

    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
    <link href="//cdn.syncfusion.com/ej2/ej2-base/styles/material.css" rel="stylesheet">
    <link href="//cdn.syncfusion.com/ej2/ej2-buttons/styles/material.css" rel="stylesheet">
    <link href="//cdn.syncfusion.com/ej2/ej2-inputs/styles/material.css" rel="stylesheet">
    <link href="//cdn.syncfusion.com/ej2/ej2-popups/styles/material.css" rel="stylesheet">
    
    
<script src="https://cdn.syncfusion.com/ej2/dist/ej2.min.js" type="text/javascript"></script>

</head>

<body>

    <div class="barraPesquisa">
        <div id="pesquisa">
            <select onchange="mudou()" id="geral">
                <option value="0">TODOS</option>
                <option value="1">ABERTO</option>
                <option value="2">FECHADO</option>
            </select>

            <?php
                $query = ("SELECT * FROM departamentos");
                $result = $con->query($query);
            ?>
            <select onchange="mudou()" id="depts" required>
                <option value="0">Mostrar todos </option>
                <?php
                if ($result->num_rows > 0) {
                    while ($reg = $result->fetch_assoc()) {
                        echo '<option value="' . $reg["codigocampi"] . '">' . $reg["codigocampi"] . ' - ' . $reg["descricaocampi"] . '</option>';
                    }
                }
                ?>
            </select>
            
        </div>
    </div>

    <div id="tabelaOS">

    </div>

    <div id="container" style="visibility: hidden">
        <div id="dialog"></div>
    </div>

    <script type="text/javascript">
        window.onload = mudou();


        function mudou(){
            
            var cond = document.getElementById('geral').value;
            var dep = document.getElementById('depts').value;
            $.ajax({
                type: 'POST',
                url: 'config_listOS.php',
                async: 'false',
                data:{
                    condicao_AF: cond,
                    Departamento: dep,
                },
                success: function(data){
                    document.getElementById("tabelaOS").innerHTML = data;
                }
            })
        }

        function searchOS(){
            
        }


    </script>

</body> 

