

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login projeto banco</title>
</head>
<body>
    <form method="post">
        <label>Nome: </label>
        <input required type="text" name="nome" id="nome"/>
        <label>Email: </label>
        <input required type="email" name="email" id="email"/>
        <label>Login: </label>
        <input required type="text" name="login" id="login_registro"/><br/>
        <label> Senha: </label>
        <input required type="password" name="senha" id="senha_registro"><br/>
        <label>Confirme a senha: </label>
        <input type="password" name="senha" id="senha_confirma"><br/>
        <input required type="submit" value="Cadastrar" id="cadastrar_registro" name="cadastrar"/>
    </form>


</body>
</html>

<?php

    require "conexao.php";

    
    
    if(isset($_POST['cadastrar'])){

        $verificaLogin = $pdo->prepare("SELECT * FROM `usuario`");
        $verificaLogin->execute();
        $valoresBanco = $verificaLogin->fetchAll();

        echo '<pre>';
        
        print_r($valoresBanco);
        
        echo '</pre>';

        $login=$_POST['login'];
        $senha=$_POST['senha'];
        $nome = $_POST['nome'];
        $email = $_POST['email'];

        foreach ($valoresBanco as $key => $value) {


            if(empty(trim($login)) or empty(trim($senha))){
                echo "Preencha todos os campos";
                exit;
            }elseif($login==$value['login']){
                echo "<div>Usuario já está em uso<div>";
                exit;
            
            }else{
                $query=$pdo->prepare("INSERT INTO `usuario` VALUES(null,?,?,?,?)");
                $query->execute(array($login,$senha,$nome,$email));
                echo '<script type="text/javascript">alert("Usuário cadastrado com sucesso"); window.location.href="index.php"</script>';
            }
        }
    }


?>