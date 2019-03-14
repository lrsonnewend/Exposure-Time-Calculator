
	// Alteracao feita para funcionamento de paginas que ja possuiam jQuery com
	// o jQuery que da campanha do Zika virus

	// Script para carregar jQuery 1.8.2
	var script     = document.createElement('script');
	script.src = "/js/jquery/jquery-1.8.2.min.js";

	// Script para carregar a barra do Governo
	var scriptBarra     = document.createElement('script');
	scriptBarra.src = "//barra.brasil.gov.br/barra.js";
	scriptBarra.type = "text/javascript";
	scriptBarra.defer = "defer";

	// Only do anything if jQuery isn't defined
	if (typeof jQuery == 'undefined') {
		document.head.appendChild(script);
		document.head.appendChild(scriptBarra);
	// Possui jQuery anterior ao 1.7
	} else if (jQuery.fn.jquery < "1.7") {
		// Aguarda o documento carregar
		$(document).ready(function() {
			$.noConflict();

			document.head.appendChild(script);
			document.head.appendChild(scriptBarra);
		});
	// Possui jQuery igual ou posterior ao 1.7
	} else {
		document.head.appendChild(scriptBarra);
	}
	