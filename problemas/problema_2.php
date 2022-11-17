<?php

    $envPath = realpath(dirname(__FILE__,2).'/env.ini');
    $env = parse_ini_file($envPath);
    $conn = new mysqli($env['host'],$env['username'],$env['password'],$env['database']);

    if($conn->connect_error){
        die("Erro: ".$conn->connect_error);
    }
 
    $sql = "SELECT Tb_convenio.verba, Tb_banco.nome,
            MIN(Tb_contrato.data_inclusao) AS 'mais_antigo',
            MAX(Tb_contrato.data_inclusao) AS 'mais_recente',
            SUM(Tb_contrato.valor) AS 'total_valor'
            FROM Tb_contrato
            INNER JOIN Tb_convenio_servico ON Tb_contrato.convenio_servico = Tb_convenio_servico.codigo
            INNER JOIN Tb_convenio ON Tb_convenio_servico.convenio = Tb_convenio.codigo
            INNER JOIN Tb_banco ON Tb_convenio.banco = Tb_banco.codigo
            GROUP BY Tb_banco.nome, Tb_convenio.verba";

    $result = $conn->query($sql);

    $conn->close();
    /*while ($row = mysqli_fetch_array($result)){
        var_dump($row);
        var_dump("</br>");
    }*/
    return $result;