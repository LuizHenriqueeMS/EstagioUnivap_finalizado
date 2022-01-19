<?php

    include("conexao/banco.php");
    $cont = 0;
    if(isset($_POST['condicao_AF'], $_POST['Departamento'])){
        
        $cont = 0;
        echo '<div style="overflow: auto">';
        echo '<table class="tabelaOS tabelaItens" style="align-items: center;" id="OS" frame=void rules=rows>';
        echo "<tr>";
            echo "<th>Número OS</th>";
            echo "<th>Data</th>";
            echo "<th>Departamento</th>";
            echo "<th>Prioridade</th>";
            echo "<th>Estado (Aberto/Fechado)</th>";
        echo "<tr>";

        if($_POST['condicao_AF'] != null && $_POST['condicao_AF'] != 0){
            if($_POST['Departamento'] != null && $_POST['Departamento'] != 0){
                if($_POST['condicao_AF'] == 1){
                    $query = "SELECT * from ordemservico where condicao_abertaFechada = 'Aberta' AND fk_codigoCampi = ".$_POST['Departamento']." order by dataRequisicao"; 
                }else{
                    $query = "SELECT * from ordemservico where condicao_abertaFechada = 'Fechado' AND fk_codigoCampi = ".$_POST['Departamento']." order by dataRequisicao"; 
                }
               
            }else{
                if($_POST['condicao_AF'] == 1){
                    $query = "SELECT * from ordemservico where condicao_abertaFechada = 'Aberta' order by dataRequisicao"; 
                }else{
                    $query = "SELECT * from ordemservico where condicao_abertaFechada = 'Fechado' order by dataRequisicao"; 
                }
            }
            
        }else{     
            if($_POST['Departamento'] != null && $_POST['Departamento'] != 0){
                $query = "SELECT * from ordemservico WHERE fk_codigoCampi = ".$_POST['Departamento']." order by dataRequisicao";
            }else{
                $query = "SELECT * from ordemservico order by dataRequisicao";
            }
        }

        $result = $con->query($query);
        if($result !== false && $result->num_rows > 0){
            while($reg = $result->fetch_array()){
                echo '<tr>';
                echo '<td name="OSn">'.$reg["NumeroOS"].'<button name="targetButton" onclick="buttonclick(this.value)" value="'.$cont.'" type="button" e-ripple="true" style="margin-left: 5px; margin-bottom: 2px; font-size: 12px; padding: 1px 7px;">Visualizar</button> </td>';
                echo '<td>'.$reg["dataRequisicao"].'</td>';
                echo '<td name="departamento">'.$reg["fk_codigoCampi"].'</td>';
                echo '<td>
                    <select> 
                        <option>'.$reg["prioridade"].'</option>
                        <option value="1">Normal</option>
                        <option value="2">Urgente</option>
                        <option value="3">Emergencial</option>
                        <option value="4">Preventiva</option>
                    </select>
                </td>';
                echo '<td>'.$reg["condicao_abertaFechada"].'<button style="margin-left: 5px; margin-bottom: 2px; font-size: 12px; padding: 1px 7px;">Fechar</button></td>';
                echo '<tr>';
                $cont++;
            }
        }
        echo "</table>";
        echo "</div>";
    }
        

?>