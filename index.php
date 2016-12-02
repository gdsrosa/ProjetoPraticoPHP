<?php include('conexao.php'); ?>

<?php 
session_start();

	$usuario_id = $_SESSION['usuario_id'];

	if (!isset($usuario_id)) {
		echo"<script>alert('Você não está logado, por favor faça o login.');window.location.href='login.php'</script>";
	}

 ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <link   href="css/bootstrap.min.css" rel="stylesheet">
    <script src="js/bootstrap.min.js"></script>
</head>
 
<body>
    <div class="container">
            <div class="row">
                <h3>Bem-vindo, <?php echo $_SESSION['usuario'];?> (<a href="logout.php">Sair</a>) </h3>

            </div>
            <div class="row">
                 <p>
                    <a href="cadastro_contatos.php" class="btn btn-success">Cadastrar</a>
                </p>
                <table class="table table-striped table-bordered">
                  <thead>
                    <tr>
                      <th>Nome</th>
                      <th>Email</th>
                      <th>Endereço</th>
                      <th>Telefone</th>
                      <th>Função</th>
                    </tr>
                  </thead>
                  <tbody>
                  	<?php 
                  		    $query = "SELECT * FROM contatos";
							$result1 = mysql_query($query, $conexao);

						while ($exibe = mysql_fetch_array($result1)) {

                  			$query = "SELECT telefone FROM telefone_contatos WHERE contato_id = {$exibe['id']}";
							$result = mysql_query($query, $conexao);

							$telefones_string = "";

							while($telefones = mysql_fetch_array($result)){
								$telefones_string = $telefones_string.", ".$telefones['telefone'];
							}

							echo "
								<tr>	
									<td> {$exibe['nome']}</td>
									<td> {$exibe['email']}</td>
									<td> {$exibe['endereco']}</td>
									<td> {$telefones_string}</td>

							<td width=160>
 
                                <a class='btn btn-success' href='atualiza_contatos.php?id={$exibe['id']}'>Atualizar</a>
                              
                                <a class='btn btn-danger' href='deleta_contatos.php?id={$exibe['id']}'>Deletar</a>
                                </td>
								</tr>";
						}
                   ?>
                  </tbody>
            </table>
        </div>
    </div> <!-- /container -->
  </body>
</html>
