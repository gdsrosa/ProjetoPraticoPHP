<?php 
include('conexao.php');
session_start();

if (isset($_SESSION['usuario'])) {
	header("Location: index.php");
}
?>

<!DOCTYPE html>
<html>
	<head>
		<title>AGENDA DE CONTATOS</title>
		<meta charset="utf-8">
		<link href="css/bootstrap.min.css" rel="stylesheet">
    	<script src="js/bootstrap.min.js"></script>
	</head>
	<body>		
		<h1>Login</h1>
		 <form class="form-horizontal" action="login.php" method="post">
		 	<div class="control-group">
                <label class="control-label">Usuário</label>
                     <div class="controls">
                        <input name="usuario" type="text"  placeholder="Usuário">
                    </div>
            </div>
		 	<div class="control-group">
                <label class="control-label">Senha</label>
                     <div class="controls">
                        <input name="senha" type="password"  placeholder="Senha">
                    </div>
            </div>
            <div class="form-actions">
                <input type="submit" name="submit" value="Login" class="btn btn-success">
             </div>
				<p>
					Não possui cadastro? <a href="cadastro_usuario.php"> Cadastre-se</a>
				</p>				
        </form> 
        <?php 
        	if (isset($_POST['submit'])) {
        		$usuario = $_POST['usuario'];
				$senha = md5($_POST[ 'senha']);
				$query = "SELECT id, usuario FROM usuarios WHERE `usuario`='$usuario' AND `senha`='$senha'";
				$result = mysql_query($query) or die(mysql_error());

				if (mysql_num_rows($result) > 0) {
					//Redirect user to index page
					$linha = mysql_fetch_assoc($result);
					$_SESSION['usuario_id'] = $linha['id'];
					$_SESSION['usuario'] = $linha['usuario'];
					header("location: index.php");
				}else{
					echo "<script>alert('Usuario ou senha invalidos.');</script>";
				}
        	}
     		
			
         ?>
	</body>
</html>