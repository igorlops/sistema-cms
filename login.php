<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login projeto banco</title>
</head>
<body>
    <form method="post">
        <label for="">Login: </label>
        <input type="text" name="login" id="login"/><br/>
        <label for="">Senha: </label>
        <input type="password" name="senha" id="senha"><br/>
        <input type="submit" value="Cadastrar" id="cadastrar" name="cadastrar"/>
    </form>

    <div>Não tem conta? Crie agora, apenas <a href="registrar.php">clique aqui</a></div>
</body>
</html>
<?php


require "conexao.php";

    session_start();


    
    
    
    if(isset($_POST['cadastrar'])){
        $login = trim($_POST['login']);
        $senha = trim($_POST['senha']);
        if(empty(trim($login)) and empty(trim($senha))){
            echo '<script type="text/javascript">alert("Nenhum nome de usuário digitado");</script>';
            exit;
        }elseif(!preg_match('/^[a-zA-Z0-9_]+$/',trim($login))){
            echo '<script type="text/javascript">alert("O nome de usuário deve conter apenas letras, números e sublinhados.")</script>';
            exit;
        }
        else{
            $sql = $pdo->prepare('SELECT * FROM usuario');
            $sql->execute();
            $dados = $sql->fetchAll();
            echo '<pre>';
            print_r($dados);
            echo '</pre>';

            foreach ($dados as $key => $value) {
                if($login==$value['login'] and $senha==$value['senha']){
                    $_SESSION["id"]= $value["id"];
                    $_SESSION["login"] = $value["login"];
                    $_SESSION['nome'] = $value['nome'];
                    header("Location: index.php");
    
                }else{
                    header('Location: registrar.php');
                    echo '<script type="text/javascript">alert("Usuário não encontrado")</script>';
                    exit;
                }
            }
        }
    }

?>
