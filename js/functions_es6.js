const domain = 'http://portalnovo.sir.inpe.br';


function googleTranslateElementInit() {
	new google.translate.TranslateElement({pageLanguage: 'pt', includedLanguages: 'en,pt', layout: google.translate.TranslateElement.FloatPosition.TOP_RIGHT}, 'google_translate_element');
}	


var scriptGoogleAnalytics = document.createElement('script');
scriptGoogleAnalytics.src = "//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit";	
scriptGoogleAnalytics.type = "application/javascript";
document.head.appendChild(scriptGoogleAnalytics);




/* CARREGAMENTO DEPOIS DAS PÁGINAS ABRIREM */
$( document ).ready(function() {
	/* FUNCAO PARA ADICIONAR A BARRA DO GOVERNO NOS SITES */   
	var barraGoverno = document.createElement('script');
	barraGoverno.src = "/js/barra-governo.js";	
	barraGoverno.type = "application/javascript";
	barraGoverno.id = "scriptBarraGoverno";
	document.head.appendChild(barraGoverno);

	$('#contraste-link').click(function(e) {
		cont = document.getElementById("contraste").checked;
		contRodape = document.getElementById("contrasteRodape").checked;
		
		if (cont == true || contRodape == true) {		
			$.cookie("contraste", "contraste" ,{expires: 365, path: '/'});	
			$("body").addClass("contraste");			
			$(".inpe-rodape").attr("src","/img/logo-governo/logoINPE-branco.png");
			document.getElementById("contraste").checked = false;
			document.getElementById("contrasteRodape").checked = false;
		} else {   	
			$.cookie("contraste", "" ,{expires: 365, path: '/'});
			$("body").removeClass("contraste");			
			$(".inpe-rodape").attr("src","/img/logo-governo/logoINPE.png");
			document.getElementById("contraste").checked = true;
			document.getElementById("contrasteRodape").checked = true;
		}
	});
	
	$('#contraste-link-rodape').click(function(e) {
		cont = document.getElementById("contraste").checked;
		contRodape = document.getElementById("contrasteRodape").checked;
		
		if (cont == true || contRodape == true) {		
			$.cookie("contraste", "contraste" ,{expires: 365, path: '/'});	
			$("body").addClass("contraste");			
			$(".inpe-rodape").attr("src","/img/logo-governo/logoINPE-branco.png");
			document.getElementById("contraste").checked = false;
			document.getElementById("contrasteRodape").checked = false;
		} else {   	
			$.cookie("contraste", "" ,{expires: 365, path: '/'});
			$("body").removeClass("contraste");
			$(".inpe-rodape").attr("src","/img/logo-governo/logoINPE.png");
			document.getElementById("contraste").checked = true;
			document.getElementById("contrasteRodape").checked = true;
		}
	});

	
	/* VERIFICA SE ALTO CONTRASTE ESTÁ LIGADO */
	if($.cookie("contraste") == "contraste") {
		$("body").addClass("contraste");	
		$(".inpe-rodape").attr("src","/img/logo-governo/logoINPE-branco.png");
		document.getElementById("contraste").checked = false;
		document.getElementById("contrasteRodape").checked = false;
	} else {
		$("body").removeClass("contraste");		
		$(".inpe-rodape").attr("src","/img/logo-governo/logoINPE.png");
		document.getElementById("contraste").checked = true;
		document.getElementById("contrasteRodape").checked = true;
	}

	let menuEhIgualUrl = (href, url) => {
		url = url.split('?')[0];
		return (url == href || 
				url == href+"index.php" ||
				url+"index" == href || 
				url+"index" == href+"index.php");
	}
	
	
	/* VERIFICA MENU ABERTO */	
	var abreMenu = function abreMenu(url) {
		let found = false;
		let isEvento = $('#navigation').hasClass("evento");
		let idInput = undefined;
		$('#navigation li a').each(function() {	
			href = $(this).attr('href');
			href = href.split(".php");
			href = href[0];
			if (menuEhIgualUrl(href, url)) {	
				parents = $(this).parents('li');
				parents.each(function() {
					if(!isEvento) $(this).find('input:first').prop('checked', true);
					idInput = $(this).find('input:first').attr('id');
				});
				found = true;
				let label =  $('label[for="'+idInput+'"]');
				$(this).addClass('on');				
				if(isEvento && label){
					$(label).addClass('on');
				}
			} else {
				$(this).removeClass('on');
			}
		});
		return found;
	}

	var url = document.URL;
	var width = $(window).width();
	if (width > 768) {
		const finalUrl = url.replace(domain, "").replace("index.php", "").replace(".php", "");
		let found = abreMenu(finalUrl);
		if(!found){
			const urlWithoutEnd = finalUrl.substr(0, finalUrl.lastIndexOf("\/")+1);
			let found = abreMenu(urlWithoutEnd);
		}
	}
	
	
	/* ABRE EMAIL TO */
	$('.mailto').on('click', function (event) {
		var user = $(this).attr('data-user');
		var site = $(this).attr('data-website');		
		var complemento = site.split('.');	
		if (site != 'inpe' && complemento.length <= 1){
			site = site+'.inpe.br';
		} else if (site == 'inpe'){
			site = site+".br";
		} else {
			site = site;
		}		
		var email = user+"@"+site;
		window.location = 'mailto:' + email;
  	});

});



