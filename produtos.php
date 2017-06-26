<!DOCTYPE html>

<html>
	<head>
		<title>Natureba</title>
	</head>

	<body>

	<?php
		if ($_POST) {
			$quantidadeProdutos = $_POST['quantidadeProdutos'];

			$linhas = file('produtos.txt');

			foreach ($linhas as $key => $value) {
				$explode = explode('::', $value);

				$produtos[] = ucwords(strtolower($explode[0]));

				$letras = strlen($explode[1]);
				$valores[] = substr($explode[1], 0, $letras - 2);
			}

			$produtos_cadastrados = count($linhas);
			if ($quantidadeProdutos > $produtos_cadastrados) {
				$quantidadeProdutos = $produtos_cadastrados;
			} elseif ($quantidadeProdutos == 0) {
				$quantidadeProdutos = 1;
			}

		} else {
			echo 	"
						<div class='erro'>
							<p>Nenhum dado recebido pelo servidor.</p>
							<a href='index.php'>Retornar ao index.</a>
						</div>
					";
			die();
		}
	?>

	<center>
		<h1>Natureba, produtos naturais.</h1>
	</center>
	<hr>

		<form action="nota.php" method="POST">
			<b>Informe os produtos</b><br>

			<?php
				
				for ($i = 0; $i < $quantidadeProdutos; $i++) {
					echo $i+1 . 'º';
					echo 	"
								
									<select name='produtos[] value='0'>
									<option>Produto</option>
								
							";
					foreach ($produtos as $key => $value) {
						echo "<option value='$produtos[$key]::$valores[$key]'>$value</option>";
					}
					echo 	"
								</select>
								<input type='number' name='unidades[]' id='unidades'><br>
								
							";
				}
			?>
			
			<center>
				<input type="hidden" value="<?php echo $quantidadeProdutos; ?>" name="quantidadeProdutos">
				<button type="submit">Continuar</button>
			</center>
		</form>
	</div>
	
</body>
</html>
