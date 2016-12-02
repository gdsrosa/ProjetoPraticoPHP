<?php include('conexao.php'); ?>
<!DOCTYPE html>
<html>
<head>
	<title>ATUALIZA CONTATOS</title>
	<meta charset="utf-8">
	<link href="css/bootstrap.min.css" rel="stylesheet">
    <script src="js/bootstrap.min.js"></script>
</head>
	<body>
		<h1>Atualiza Contatos</h1>
		 <?php 
		 	$id = $_GET['id'];
		 	$query = "SELECT * FROM contatos WHERE id = $id;";
		 	$result = mysql_query($query, $conexao) or die(mysql_error());

		 	if ($result) {
		 		$result = mysql_fetch_assoc($result);
		 		$nome = $result['nome'];
		 		$email = $result['email'];
		 		$endereco = $result['endereco'];

		 	}else{
		 		echo "<script>alert('Contato inexistente.');window.location.href='index.php'</script>";
		 	}

		 	if (isset($_POST['submit'])) {
		 		$nome = $_POST['nome'];
		 		$email = $_POST['email'];
		 		$endereco = $_POST['endereco'];
		 		$telefone = $_POST['telefone'];

		 		$query = "UPDATE contatos SET nome = '$nome', email = '$email', endereco = '$endereco' WHERE id = $id";
		 		$result = mysql_query($query, $conexao);
		 		$contato_id = mysql_insert_id();

		 		if ($result) {
		 				foreach ($telefone as $chave => $telefone) {
		 					$query = "UPDATE telefone_contatos SET telefone = '$telefone' WHERE contado_id = $contato_id ";
		 					$result = mysql_query($query, $conexao);		
		 			}
		 				echo"<script>alert('Contato Atualizado com sucesso!');window.location.href='index.php';</script>";
		 		}else{
		 			echo"<script>alert('Não foi possível atualizar contato.');</script>";
		 		}
		 	}

		  ?>
		 <form method="post" action="atualiza_contatos.php?id=<?=$id?>">
		 	<fieldset>
			 	<legend>Atualização de Contatos</legend>

			 	<p>
			 		<label>Nome:</label>
			 		<input type='text' name='nome' value="<?=$nome?>">
			 	</p>
			 	<p>
			 		<label>E-mail:</label>
			 		<input type='text' name='email' value="<?=$email?>">
			 	</p>
			 	<p>
			 		<label>Endereço:</label>
			 		<input type='text' name='endereco' value="<?=$endereco?>">
			 	</p>
			 	<p>
			 	<?php 
			 		$query1 = "SELECT * FROM telefone_contatos WHERE contato_id = $id";
					$result1 = mysql_query($query1, $conexao) or die(mysql_error()); 

					if ($result1){
						$cont = 1;
						while($exibe = mysql_fetch_assoc($result1)){
			    			echo"<p>";
			    			echo"<label>Telefone ".$cont." </label>";
			    			echo"<input type='text' name='telefone[]' value='{$exibe['telefone']}'/>";
			    			echo "</p>";
			    			$cont++;
						}
					}
 				?>
			 	<p>
			 		<input type="submit" name="submit">
			 	</p>	 	
		 	</fieldset>
		 </form>	
	</body>
</html>