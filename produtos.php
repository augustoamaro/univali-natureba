<!DOCTYPE html>

<html>
	<head>
		<title>Natureba</title>
	</head>

	<body>

	<?php
		if ($_POST) {
			$quantidadeProdutos = $_POST['quantidadeProdutos'];

			$itens = file('bancodados/produtos.txt');

			foreach ($itens as $key => $value) {
				$explode = explode('::', $value);

				$produtos[] = ucwords(strtolower($explode[0]));

				$tamanho = strlen($explode[1]);
				$valores[] = substr($explode[1], 0, $tamanho - 2);
			}

			$cadastroProduto = count($itens);
			if ($quantidadeProdutos > $cadastroProduto) {
				$quantidadeProdutos = $cadastroProduto;
			} elseif ($quantidadeProdutos == 0) {
				$quantidadeProdutos = 1;
			}
		} 
	?>

	<center>
		<h1>Natureba, produtos naturais.</h1>
	
	<hr>

		<form action="total.php" method="POST">
			<p>Informe os produtos</p><br>

			<?php
				
				for ($i = 0; $i < $quantidadeProdutos; $i++) {
					echo $i+1 . "&nbsp&nbsp&nbsp";
					echo 	"
									<select name='produtos[] value='0'>
									<option>Produto</option>
							";
					foreach ($produtos as $key => $value) {
						echo "<option value='$produtos[$key]::$valores[$key]'>$value</option>";
					}
					echo 	"
								</select>
								<input type='number' name='unidades[]' placeholder='Quantidade'><br>	
							";
				}
			?>
			
				<input type="hidden" value="<?php echo $quantidadeProdutos; ?>" name="quantidadeProdutos"><br>
				<button type="submit">Continuar</button>
			</center>
		</form>
	</div>
	
</body>
</html>
