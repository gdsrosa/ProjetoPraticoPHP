<?php include('conexao.php')  ?>
<!DOCTYPE html>
<html>
<head>
	<title>Cadastro contatos</title>
	<meta charset="utf-8">
	<link href="css/bootstrap.min.css" rel="stylesheet">
    <script src="js/bootstrap.min.js"></script>
</head>
	<body>
		  <div class="container">
     
                <div class="span10 offset1">
                    <div class="row">
                        <h3>Cadastro Contatos</h3>
                    </div>
             
                    <form class="form-horizontal" action="cadastro_contatos.php" method="post">
                      <div class="control-group">
                        <label class="control-label">Nome</label>
                        <div class="controls">
                            <input name="nome" type="text"  placeholder="Nome">
                        </div>
                      </div>
                      <div class="control-group">
                        <label class="control-label">Email</label>
                        <div class="controls">
                            <input name="email" type="text" placeholder="Email">
                        </div>
                      </div>
                      <div class="control-group">
                        <label class="control-label">Telefone 1:</label>
                        <div class="controls">
                            <input name="telefone[]" type="text"  placeholder="Telefone">
                        </div>
                      </div>
                      <div class="control-group">
                        <label class="control-label">Telefone 2:</label>
                        <div class="controls">
                            <input name="telefone[]" type="text"  placeholder="Telefone">
                        </div>
                      </div>
                      <div class="control-group">
                        <label class="control-label">Telefone 3:</label>
                        <div class="controls">
                            <input name="telefone[]" type="text"  placeholder="Telefone">
                        </div>
                      </div>
                      <div class="control-group">
                        <label class="control-label">Telefone 4:</label>
                        <div class="controls">
                            <input name="telefone[]" type="text"  placeholder="Telefone">
                        </div>
                      </div>
                      <div class="control-group">
                        <label class="control-label">Endereço</label>
                        <div class="controls">
                            <input name="endereco" type="text"  placeholder="Endereço">
                        </div>
                      </div>
                      <div class="form-actions">
                          <input type="submit" name="submit" value="Cadastrar" class="btn btn-success">
                          <a class="btn" href="index.php">Voltar</a>
                        </div>
                    </form>
                </div>    
    </div> <!-- /container -->
		 <?php //Verifying if the POST are finished
			if (isset($_POST['submit'])) {
				$nome = $_POST['nome'];
				$email = $_POST['email'];
				$endereco = $_POST['endereco'];
				$telefones = $_POST['telefone'];

				//Verifing if all the fields are fulled
				$erros = array();

				if (empty($nome)) {
					$erros[] = "Campo NOME obrigatório";
				}

				if(empty($email)){
					$erros[] = "Campo EMAIL obrigatório";
				}

				if(empty($endereco)){
					$erros[] = "Campo ENDEREÇO obrigatório";
				}

				if(count($telefones) < 1){
					$erros[] = "Informe ao menos um telefone.";
				}

				//Verifying if the email field is already exists
				if($email){
				    $sql = "SELECT id FROM contatos WHERE `email`='".$email."'";
				    $result = mysql_query($sql) or die(mysql_error());
				            
				    if(mysql_num_rows($result) > 0){
				        $erros[] = "Contato com este email ja existe, por favor, cadastre um diferente.";
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
					$query = "INSERT INTO contatos(nome, email, endereco) ";
					$query = $query . "VALUES ('$nome', '$email', '$endereco');";
					$result = mysql_query($query, $conexao);
					$contato_id = mysql_insert_id();
					$usuario_id = $_SESSION['usuario_id'];


					 if ($result){
					 	$query = "INSERT INTO usuarios_contatos(usuario_id, contato_id) VALUES ('$usuario_id, '$contato_id')";
      					$result = mysql_query($query, $conexao);
      					if ($result) {
      						foreach ($telefones as $chave => $telefone) {
	      						if (!empty($telefone)) {
									$query = "INSERT INTO telefone_contatos(telefone, contato_id) VALUES ('$telefone', $contato_id)";
	      							$result = mysql_query($query, $conexao);

								}
      						}
      						echo "<script type='text/javascript'>alert('Contato cadastrado com sucesso!');window.location.href='index.php'</script>";
      					}

		      		}else{
		      			echo"<script type='text/javascript'>alert('Não foi possível cadastrar o Contato.');window.location.href='index.php'</script>";
      				}
				}


			} ?>
	</body>
</html>

