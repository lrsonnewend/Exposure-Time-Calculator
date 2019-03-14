<?php
	$arquivo = file_get_contents('./static/CCD105.json');
	$json = json_decode($arquivo);
	print_r($json);

	//pegando eficiencia quantica
	$filter = 'U';
	echo $json->QuantumEfficiency->$filter;

	//pegando pixel size
	echo "<br>".$json->PixelSize;


	//pegando attributos do modo
	$numberMode = "2";
	echo "<br>".$json->Modes->$numberMode->readoutNoise;
	echo "<br>".$json->Modes->$numberMode->gain;


?>