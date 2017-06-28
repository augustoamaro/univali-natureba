<!DOCTYPE html>

<html>
	<head>
		<title>Natureba</title>
	</head>

	<style>
		table {
    		font-family: arial, sans-serif;
    		border-collapse: collapse;
    		width: 100%;
		}

		td, th {
   		 border: 1px solid #dddddd;
    	 text-align: left;
   	 	 padding: 8px;
		}

		tr:nth-child(even) {
		background-color: #dddddd;
		}
	</style>

		<body>
			<center>

		<?php

		if ($_POST) {
			$precoProduto = $_POST['produtos'];
			$unidades = $_POST['unidades'];
			$quantidadeProdutos = $_POST['quantidadeProdutos'];

			foreach ($precoProduto as $key => $value) {
				$explode = explode('::', $value);
				$produtos[] = $explode[0];
				$valores[] = $explode[1];
			}
			
			$total = 0;

			require_once("funcoes.php");
		} 
	?>

	<h1>Natureba, produtos naturais.</h1>
	<hr>
	
		<p>Finalização da compra</p>
	
		<table>
			<thead style="width:100%">
				<tr>
					<th>Produto</th>
					<th>Valor unitário</th>
					<th>Quantidade</th>
					<th>Total</th>
				</tr>
			</thead>
			<tbody>

			<?php
				
				$registro = PHP_EOL . '====================================';
				historico($registro);
				$registro = PHP_EOL . 'Quantidade de Produtos: '. "$quantidadeProdutos";
				historico($registro);

				for ($i = 0; $i < $quantidadeProdutos; $i++) {
					
					$valorUnidade = number_format($valores[$i], '2', ',', '.');
					$totalItem = number_format($valores[$i] * $unidades[$i], '2', ',', '.');
					$total = number_format($total, '2', ',', '.');
					
					$total += $valores[$i] * $unidades[$i];
				
					$registro = PHP_EOL . 'Produto: ' . "$produtos[$i]";
					historico($registro);
					$registro = PHP_EOL . 'Valor Unitário: ' . "$valorUnidade";

					$registro = PHP_EOL . 'Unidade(s): ' . "$unidades[$i]";
					historico($registro);

					$registro = PHP_EOL . 'Total Item(s): R$' . "$totalItem";
					historico($registro);

					$registro = PHP_EOL . 'Valor Total: R$' . "$total";
					historico($registro);

					if ($i % 2 == 0) {
						echo 	"
									<tr>
										<td>$produtos[$i]</td>
										<td>R$ $valorUnidade</td>
										<td>$unidades[$i]</td>
										<td>R$ $totalItem</td>
									</tr>
								";
					} else {
						echo 	"
									<tr>
										<td>$produtos[$i]</td>
										<td>R$ $valorUnidade</td>
										<td>$unidades[$i]</td>
										<td>R$ $totalItem</td>
									</tr>
								";
							}
					}
			?>

			</tbody>
			
		</table>

				<?php

				$total = number_format($total, '2', ',', '.');
					
					if ($quantidadeProdutos % 2 == 0) {
						echo "
								<strong>
									Total Geral: R$ 
									$total
								</strong>
							";

					}else {
						echo "
								<strong>
									Total Geral: R$ 
									$total
								</strong>
							";
					}
				?>
			
		<form method="GET" action="index.html"><br>
    		<button type="submit">Realizar nova venda</button>
		</form>
	</center>
	
	</div>

</body>
</html>
