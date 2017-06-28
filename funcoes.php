<?php

	function historico($registro) {
		$manipulador = fopen('bancodados/historico.txt', 'a');
		if ($manipulador === false) {

		}
		
		fwrite($manipulador, $registro);
		fclose($manipulador);
	}
?>