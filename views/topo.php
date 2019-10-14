<a accesskey="0" href="#content" title="Ir para conteúdo" class="acesso">Ir para conteúdo <span>0</span ></a>
<noscript>
Habilite o JavaScript do navegador para que o site funcione corretamente.
</noscript>

<?php include("barra-governo.php"); ?>

<div class="fundo-topo" id="topo">
	<div class="conteudo-topo">

        <ul class="ir-para">
            <li><a accesskey="1" href="#content" title="Ir para conteúdo">Ir para conteúdo <span>1</span ></a></li>
            <li><a accesskey="2" href="#navigation" title="Ir para o menu">Ir para o menu <span>2</span></a></li>
            <li><a accesskey="3" href="#busca" title="Ir para a busca">Ir para a busca <span>3</span></a></li>
            <li><a accesskey="4" href="#rodape" title="Ir para o rodapé">Ir para o rodapé <span>4</span></a></li>
        </ul>

        <ul class="idioma">
            <li><div id="google_translate_element"></div></li>
        </ul>
    
        <ul class="acessibilidade" >
            <li>
            	<a href="/navegacao/acessibilidade.php" title="Acesse Acessibilidade">ACESSIBILIDADE</a>
            </li>		
            <li>
            	<input type="checkbox" name="cont" id="contraste" checked="checked" />
                <label for="contraste" class="contraste">ALTO CONTRASTE</label>                
                <a class="contraste" id="contraste-link" title="Altere o Contraste">ALTO CONTRASTE</a>
            </li>
            <li>
            	<a href="/navegacao/mapa-site.php" title="Acesse Mapa do Site">MAPA DO SITE</a>
            </li>
        </ul>
    
        <br />
    
        <div class="topo-logotipo">
            <div>Instituto Nacional de Pesquisas Espaciais</div>
            <a href="/" title="Ir para Home">
                <span class="portal-title">Exposure Time Calculator</span>
            </a>
            <div class="ministerio">Ministério da Ciência, Tecnologia, Inovações e Comunicações</div>
        </div>
    
        <br />
    
        <div class="topo-facilidades">    		
        
        <div id="portal-searchbox">
            <form id="nolivesearchGadget_form" action="/busca.php" method="get">
                <fieldset class="LSBox">                	
                    <legend class="hiddenStructure">Buscar no Portal</legend>
                    <label class="hiddenStructure" for="busca">Buscar no Portal</label>
                    
                    <input name="q" type="text" size="18" title="Buscar no portal" placeholder="Buscar no Portal" class="searchField" id="busca" value="<?php if (isset($chave)) echo $chave; ?>" />
                    <span class="buscaerror"></span>
                    <input id="buscageral" class="searchButton" type="submit" value="Buscar no portal" alt="Buscar no Portal" />
        
                </fieldset>
            </form>        
        </div>
        
        	<div class="clear"><!-- --></div>
            <ul>
                <li><a href="http://www.facebook.com/pages/Instituto-Nacional-de-Pesquisas-Espaciais/124907444261208" title="Acesse Facebook" target="_blank"><img src="../img/facebookIcon.png" alt="Facebook"></a></li>
                <li><a href="https://twitter.com/inpe_mct" title="Acesse Twitter" target="_blank"><img src="../img/twitterIcon.png" alt="Twitter"></a></li>
                <li><a href="http://www.youtube.com/user/inpemct" title="Acesse Youtube" target="_blank"><img src="../img/youtubeIcon.png" alt="Youtube"></a></li>
                <li><a href="/rss.php" title="Acesse RSS" target="_blank"><img src="../img/rssIcon.png" alt="RSS"></a></li>
            </ul>
        </div>
        
        <div class="clear"><!-- --></div>
	
	</div>

</div>


<div class="faixa-topo">	
	<div class="conteudo-topo">
        <ul>
            <li><a href="/" title="Ir para Home"><img src="/img/logotipoInpe-menor.png" alt="Imagem do INPE" /><span class="none">INPE</span></a></li>  
            <li><a href="/faq/" title="Acesse Perguntas Frequentes">Perguntas Frequentes</a></li>
            <li><a href="/noticias/" title="Acesse Notícias">Notícias</a></li>
            <li><a href="/dados_abertos/" title="Acesse os Dados Abertos">Dados Abertos</a></li>
            <li><a href="/contato/" title="Acesse o Contato INPE">Contato</a></li>
        </ul>
        
        <div class="clear"><!-- --></div>
	</div>
</div>

<!-- VALIDACAO FORMULARIO -->

<script>
$("#nolivesearchGadget_form").submit(function( event ) {
	if ($("#busca").val().length < 3){
		$(".buscaerror").text( "3 caracteres!" ).show();
		event.preventDefault();
	} else {
		$("#nolivesearchGadget_form").submit();
	}
});
</script>
<noscript>
Habilite o JavaScript do navegador para que a busca no site funcione corretamente.
</noscript>




