/* FUNCAO PARA ALTERAR A IMAGEM DE DESTAQUE */   
/*function mudaImagem(titulo, url) {   
	document.getElementById('slider-image').src=url;
	document.getElementById('slider-link').title=titulo;
}*/

$( document ).ready(function() {
	const elementos = $('.button-holder').children();
	const indexInicial = elementos.length-1;
	const tempoDelayMs = 10*1000;
	const timeFade = tempoDelayMs / 20;

	let index = indexInicial-1;


	var desativaOutrosBanners = function desativaOutrosBanners() {
		$('.slider-change').removeClass("on");
	};

	var ativaBannerAtual = function ativaBannerAtual(botao) {
		$(botao).addClass("on");
	};

	var setBanner = function setBanner(botao) {
		$(".slider-image").fadeOut(timeFade, function(){
			//$(".slider-image").attr("src", $(botao).attr('data-rel')).bind('onreadystatechange load', function(){
			$(".slider-image").attr("src", $(botao).attr('data-rel')).load(function(){	
				if($(botao).attr('data-id')==='#') {
					$("#slider-link").removeAttr("href");
					$("#slider-link").removeAttr('target');
					$("#slider-link").removeAttr('title');
				} else {
					$("#slider-link").attr("target", "_blank");
					$("#slider-link").attr("href", $(botao).attr('data-id'));				 
					$("#slider-link").attr("title", "Acesse "+$(botao).attr('title'));	
				}
				$("#slider-titulo").html($(botao).attr('title'));
				desativaOutrosBanners();
				ativaBannerAtual(botao);
				if (this.complete) $(".slider-image").fadeIn(timeFade);
			});

		});
	};


	var passaElementos = function passaElementos() {
		if(elementos.length>1){
			if(index<0) index = indexInicial;
			let elementoAtual = elementos[index];
			setBanner(elementoAtual);
			index--;
		}
	};

	//passaElementos();
	var correBanners = setInterval(passaElementos, tempoDelayMs);


	$('.slider-holder').mouseover(function() {
		clearInterval(correBanners);
	})
	.mouseout(function() {
		correBanners = setInterval(passaElementos, tempoDelayMs);
	});

	$('.slider-change').mouseover(function() {
		index = $(this).index()-1;
		if(index<=0)
			index = indexInicial;
		setBanner(this);
	});
 




});