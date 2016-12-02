<?php include('conexao.php') ?>
<!DOCTYPE html>
<html>
<head>
	<title>DELETA CONTATOS</title>
	<meta charset="utf-8">
	<link href="css/bootstrap.min.css" rel="stylesheet">
    <script src="js/bootstrap.min.js"></script>
</head>
	<body>
		<?php 
				$id = $_GET['id'];

				if (!empty($_GET['id'])) {
					$id = $_REQUEST['id'];
				}

				if (isset($_POST['submit'])) {
					//Delete data from telefone_contatos
					$query = "DELETE FROM telefone_contatos WHERE contato_id = $id";
					$result = mysql_query($query, $conexao);

					if ($result) {
						//Delete data from contatos
						$query = "DELETE FROM contatos WHERE id = $id";
						$result = mysql_query($query, $conexao);

						if ($result) {
							echo"<script type='text/javascript'>alert('Contato apagado com sucesso!');window.location.href='index.php';</script>";
						}
					}else{
						echo"<script type='text/javascript'>alert('Erro ao excluir o contato.')</script>";
					}
				}

			 ?>
		<h1>Deletar contato</h1>
		    <div class="container">
     
                <div class="span10 offset1">
                    <div class="row">
                        <h3>Deletar Contato</h3>
                    </div>
                     
                    <form class="form-horizontal" action="deleta_contatos.php?id=<?=$id?>" method="post">
                      <input type="hidden" name="id" value="<?php echo $id;?>"/>
                      <p class="alert alert-error">Tem certeza que quer deletar este contato?</p>
                      <div class="form-actions">
                          <button type="submit" class="btn btn-danger" name="submit">Sim</button>
                          <a class="btn" href="index.php">Não</a>
                        </div>
                    </form>
                </div>
            </div> <!--container-->
	</body>	
</html>
