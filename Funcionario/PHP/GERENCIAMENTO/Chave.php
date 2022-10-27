<?php

    include_once ('insertChaves.php');

    if(isset($_POST['tipo'])){
        $tipo = $_POST['tipo'];
        if($tipo === "AddChave"){
            cadastroChave();
        }else if($tipo === 'excluirChave'){
            remover();
        }else if($tipo === "alterarChave"){
            alterar();
        }
    }

    function cadastroChave(){
        $idChave = $_POST['idChave'];
        $Situacao = 0;
        $idPredio = $_POST['idPredio'];
        $Descricao = $_POST['DescriChave'];
        $chave = new Chave($idChave, $Situacao, $idPredio, $Descricao);
        $chave -> inserirChave();
        $chave -> inserirSala();
        header("Location: http://localhost/SISTEMACHAVES/Funcionario/Gerenciamento.php");
    }

    function exibirChaves(){
        $banco = new Banco();
        $conn = $banco -> conectar();
        $sql = $conn->prepare("SELECT * FROM chave");
        $sql -> execute();
            $dadosChave = $sql->fetchAll(PDO::FETCH_ASSOC);
            echo json_encode($dadosChave);
    }
    print_r(exibirChaves());

    //if(isset($_POST) && isset($_POST[ 'numChave']) && isset($_POST[ 'numPredio'])) { 
            
   // }

    function alterar(){
        $numChave=strip_tags($_POST[ 'numChave']);
        $numPredio=strip_tags($_POST[ 'numPredio']);

        
        $idChave = $_POST['idChave'];
        $Situacao = 0;
        $idPredio = $_POST['idPredio'];
        $Descricao = 'Sala';
        //$Descricao = $_POST['descriChave'];
        //echo $Descricao;
        // echo $numChave. '<br>';
        // echo $numPredio. '<br>';
        // echo $idChave. '<br>';
        // echo $idPredio. '<br>';
        
        $chave = new Chave($idChave, $Situacao, $idPredio, $Descricao);
        $chave -> alterarChave($numChave, $numPredio);
        header("Location: http://localhost/SISTEMACHAVES/Funcionario/Gerenciamento.php");
    }

    function remover(){
        $idChave = $_POST['idChave'];
        $Situacao = 0;
        $idPredio = $_POST['idPredio'];
        $Descricao = $_POST['DescriChave'];
        $chave = new Chave($idChave, $Situacao, $idPredio, $Descricao);
        $chave -> excluirChave();
        header("Location: http://localhost/SISTEMACHAVES/Funcionario/Gerenciamento.php");
    }

    