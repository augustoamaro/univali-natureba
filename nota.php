<!DOCTYPE html>

<html>
	<head>
		<title>Natureba</title>
	</head>
		<body>

		<?php

		if ($_POST) {
			$precoProduto = $_POST['produtos'];
			$unidades = $_POST['unidades'];
			$quantidadeProdutos = $_POST['quantidadeProdutos'];

			//INICIO - separando os produtos dos precos recebidos pelo select
			foreach ($precoProduto as $key => $value) {
				$explode = explode('::', $value);
				$produtos[] = $explode[0];
				$valores[] = $explode[1];
			}
			//INICIO - declarando uma variavel para armazenar o total da compra
			$total = 0;

			//INICIO - incluindo a funcao para gravar os dados no historico
			require_once("funcoes.php");
			//FIM
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

	<h1>Natureba, produtos naturais.</h1>
	<hr>
	<div id="nota">
		<p>Finalização da compra</p>
		<table>
			<thead>
				<tr>
					<th>Produto</th>
					<th>Valor unitário</th>
					<th>Quantidade</th>
					<th>Total</th>
				</tr>
			</thead>
			<tbody>
			<?php
				//INICIO - criando um historico das operacoes relizadas
				$registro = PHP_EOL . 'NOVA_OPERACAO';
				gravarHistorico($registro);
				$registro = PHP_EOL . "$quantidadeProdutos";
				gravarHistorico($registro);
				//FIM
				for ($i = 0; $i < $quantidadeProdutos; $i++) {
					//INICIO - formatando os valores
					$valor_unidade = number_format($valores[$i], '2', ',', '.');
					$total_item = number_format($valores[$i] * $unidades[$i], '2', ',', '.');
					//FIM

					//INICIO - somando o total da compra
					$total += $valores[$i] * $unidades[$i];
					//FIM

					//INICIO - criando um historico das operacoes realizadas
					$registro = PHP_EOL . "$produtos[$i]::$valor_unidade::$unidades[$i]::$total_item";
					gravarHistorico($registro);
					//FIM
					if ($i % 2 == 0) {
						echo 	"
									<tr class='cor02'>
										<td>$produtos[$i]</td>
										<td>R$ $valor_unidade</td>
										<td>$unidades[$i]</td>
										<td>R$ $total_item</td>
									</tr>
								";
					} else {
						echo 	"
									<tr class='cor03'>
										<td>$produtos[$i]</td>
										<td>R$ $valor_unidade</td>
										<td>$unidades[$i]</td>
										<td>R$ $total_item</td>
									</tr>
								";
					}
				}
			?>
			</tbody>
			<tfoot>
				<?php
					
					$total = number_format($total, '2', ',', '.');
					

					//INICIO - criando um historico das operacoes realizadas
					$registro = PHP_EOL . "$total";
					gravarHistorico($registro);
					//FIM
					if ($quantidadeProdutos % 2 == 0) {
						echo $total;

					} else {
						echo $total;

					}
				?>
			</tfoot>
		</table>
		<a href="index.php">Realizar nova compra</a>
	</div>

</body>
</html>
