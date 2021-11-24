<?php

include_once("conexao.php");

if((isset($_POST['email'])) && (isset($_POST['senha']))){
    $email = addslashes($conn, $_POST['email']);
    $senha = addslashes($conn, $_POST['senha']);
    $senha = md5($senha);
    $nome = '';  


    $id = validaAcesso($email,$senha);

    if($id > 0)(
        $nome = getNome($id);
    );
    
    // var_dump('nome: '$nome);
    // die();
    
    function validaAcesso($e,$s){

        $idUsuario = 0;

        //validar se o usuário existe
        $sql = "SELECT id FROM usuarios "
        ." WHERE email = '".$e."' "
        ." AND senha = '".$s."';";

        $result = mysqli_query($conn,$sql);
        mysqli_close($conn);


        //Valida se retornou linha
        if(mysqli_num_rows($result) > 0){

            $arrayemail = array();

            //Descarregar dados no array
            while($linha = mysqli_fetch_array($result, MYSQLI_ASSOC)){
                //Gravação no array
                array_push($arrayemail,$linha);
            }

            //Validar dados 
            foreach($arrayemail as $campo){  
                $idUsuario = $campo['id'];                  
                
            }
                    
        }
        return $idUsuario;
    }

    function getNome($id){
        $sql = "SELECT nome FROM usuarios "
        ." WHERE email = '".$e."' "
        ." AND senha = '".$s."';";

        $result = mysqli_query($conn,$sql);
        mysqli_close($conn);


        //Valida se retornou linha
        if(mysqli_num_rows($result) > 0){

            $arrayemail = array();

            //Descarregar dados no array
            while($linha = mysqli_fetch_array($result, MYSQLI_ASSOC)){
                //Gravação no array
                array_push($arrayemail,$linha);
            }

            //Validar dados 
            foreach($arrayemail as $campo){  
                $nome = $campo['nome'];                  
                
            }
                    
        }
        return $nome;
    }
}else{
	$_SESSION['emailErro'] = "Usuário ou senha inválido";
    header("Location: index.php");
    }


?>