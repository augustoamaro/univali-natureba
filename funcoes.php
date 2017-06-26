<?php

	function gravarHistorico($registro) {
		$manipulador = fopen('historico.txt', 'a');
		if ($manipulador === false) {

		}
		
		fwrite($manipulador, $registro);
		fclose($manipulador);
	}
?>