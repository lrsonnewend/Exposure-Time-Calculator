<?php 		
function rastro(){	
	$url = $_SERVER['PHP_SELF'];
	$url = explode (".php", $url);
	$url = explode ("/", $url[0]);
	
	
	$qtdePastas = sizeof($url);	
	$caminhoServidor = $_SERVER['DOCUMENT_ROOT'].$url[0];	
	$link = "/";	
	$arquivo = "";	
	$rastro = "<a href=\"".$link."\" title=\"Acesse INPE\">INPE</a> / ";
	
	
	for ($i=1; $i<$qtdePastas-1; $i++)
	{	
		$caminhoServidor = $caminhoServidor."/".$url[$i];
		$caminhoServidor = str_replace("//", "/", $caminhoServidor);
		$arquivo = $caminhoServidor."/!.txt";
		
		if (file_exists($arquivo)) {
			$fp = fopen($arquivo,'r');
			$texto = fread($fp, filesize($arquivo));
			$texto = nl2br($texto);			
			//$rastro = $rastro." / ";			
			$link = $link.$url[$i]."/";
			
			$texto = explode(";", $texto);
			$tam = sizeof($texto);
			
			for ($j=0; $j < $tam; $j++){				
				
				if (isset($texto[$j]) && !empty($texto[$j])){					
					$verificaLink = explode(".php", $texto[$j]);	
					
					if (sizeof($verificaLink) == 1){											
						$textoOfi = $texto[$j];		
						
						if (isset($texto[$j+1]) && !empty($texto[$j+1])){
							$verificaLink2 = explode(".php", $texto[$j+1]);			
										
							if (sizeof($verificaLink2) > 1){
								$teste = explode("/", $texto[$j+1]);						
								
								if (sizeof($teste) > 1){$linkOfi = $texto[$j+1];}
								else {$linkOfi = $link.$texto[$j+1];}							
								
								$textoOfi = "<a href=\"".$linkOfi."\" title=\"Acesse ".$texto[$j]."\">".$texto[$j]."</a>";									
							}
						}
						$rastro = $rastro.$textoOfi." / ";	
					}	
				}
			}
		}	
		
	}
	
	return $rastro;
}

function dataModificacao(){	
	$url = $_SERVER['PHP_SELF'];
	$url = explode ("/", $url);	
	$qtdePastas = sizeof($url);	
	$filename = $url[$qtdePastas-1];
	$dtMod = "";
	
	if (file_exists($filename)) {
		setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
		date_default_timezone_set('America/Sao_Paulo');
		$dtMod = "<br /><span class=\"documentModified\"><span>Última Modificação: ". strftime('%b %d, %Y %Hh%M', filectime($filename))."</span></span>";
	}
	
	return $dtMod;
}
?>