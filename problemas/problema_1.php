<?php 

    $envPath = realpath(dirname(__FILE__,2).'/env.ini');
    $env = parse_ini_file($envPath);
    $conn = new mysqli($env['host'],$env['username'],$env['password'],$env['database']);

    if($conn->connect_error){
        die("Erro: ".$conn->connect_error);
    }
    
    $sql = "SELECT Tb_contrato.data_inclusao, Tb_contrato.prazo, Tb_contrato.valor, Tb_contrato.codigo, Tb_convenio.verba, Tb_banco.nome
            FROM Tb_contrato
            INNER JOIN Tb_convenio_servico ON Tb_contrato.convenio_servico = Tb_convenio_servico.codigo
            INNER JOIN Tb_convenio ON Tb_convenio_servico.convenio = Tb_convenio.codigo
            INNER JOIN Tb_banco ON Tb_convenio.banco = Tb_banco.codigo";

    $result = $conn->query($sql);
    $conn->close();
    /*while ($row = mysqli_fetch_array($result)){
        var_dump($row);
        //var_dump("</br>");
    }*/
    return $result;
    