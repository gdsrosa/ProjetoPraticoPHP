<?php include('conexao.php')  ?>
<!DOCTYPE html>
<html>
<head>
	<title>Cadastro usuários</title>
	<meta charset="utf-8">
	<link href="css/bootstrap.min.css" rel="stylesheet">
    <script src="js/bootstrap.min.js"></script>
</head>
	<body>
		<h1>Cadastro de Usuários</h1>

		 <form class="form-horizontal" action="cadastro_usuario.php" method="post">
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
                <input type="submit" name="submit" value="Cadastrar" class="btn btn-success">
                    <a class="btn" href="login.php">Voltar</a>
            </div>			
        </form> 
		 <?php //Verifying if the POST
			if (isset($_POST['submit'])) {
				$usuario = $_POST['usuario'];
				$senha = $_POST['senha'];


				//Verifing if all the fields are fulled
				$erros = array();

				if (empty($usuario)) {
					$erros[] = "Campo USUARIO obrigatório";
				}

				if(empty($senha)){
					$erros[] = "Campo SENHA obrigatório";
				}
				//Verifying if user field is already exists
				if($usuario){   
					$sql = "SELECT id FROM usuarios WHERE `usuario`='".$usuario."'";
				       
					$result = mysql_query($sql) or die(mysql_error());
				       
					if(mysql_num_rows($result) > 0){
						$erros[] = "Vendedor com este usuario ja existe";
					}
				}
				//Verify the numbers of errors
				if (count($erros) > 0) {
					echo "<p> Erros encontrados: </p>\n";
					echo "<ul>";
					foreach ($erros as $erro) {
						echo "<li>". $erro. " </li>\n";
					}
					echo "</ul>";
				}else{

					$senha = md5($senha);

					$query = "INSERT INTO usuarios(usuario, senha) ";
					$query = $query . "VALUES ('$usuario', '$senha');";
					$result = mysql_query($query, $conexao) or die(mysql_errno($conexao). ": ".mysql_error($conexao));

					if ($result){
     					echo "<script type='text/javascript'>alert('Usuário cadastrado com sucesso!');window.location.href='login.php'</script>";
		     		}else{
		     			echo"<script type='text/javascript'>alert('Não foi possível cadastrar o Usuário.');</script>";
     				}
				}
			} ?>
	</body>
</html>
