var is_chrome = navigator.userAgent.indexOf('Chrome') > -1;
	var is_explorer = navigator.userAgent.indexOf('MSIE') > -1;
	var is_firefox = navigator.userAgent.indexOf('Firefox') > -1;
	var is_safari = navigator.userAgent.indexOf("Safari") > -1;
	var is_opera = navigator.userAgent.toLowerCase().indexOf("op") > -1;
	if ((is_chrome)&&(is_safari)) {is_safari=false;}
	if ((is_chrome)&&(is_opera)) {is_chrome=false;}

	if (is_safari){
		$.getScript("js/polyfiller.js", function(){
			$.webshims.polyfill();
		});
	}

	$(document).ready(function() {
		carregaCidades();
		var login = $("#val-login").val();
		if(login != ""){
		checaLogin(login, 'ready');
		}
		var error_status = $(".signup-wrapper").attr("data-status");
		var error_msg = $(".signup-wrapper").attr("data-msg");
		if(parseInt(error_status)==1){
			notif({
			  type: "error",
			  msg: error_msg,
			  position: "center",
			  width: 200,
			  multiline: true
			});
		}

		

		$(".pais").hide();
		$("#pais").removeAttr("required");
		$(".estado").show();
		$(".selectEstado").attr("required", "true");
		$("#telContato").attr("pattern", "[0-9]{3} [0-9]{3} [0-9]{3}");
		$("#telContatoDDD").attr("required", "true");
		$("#dataNascimento").mask("0000/00/00");


		var SPMaskBehavior = function (val) {
		  return val.replace(/\D/g, '').length === 9 ? '000 000 000' : '009 009 009';
		},
		spOptions = {
		  onKeyPress: function(val, e, field, options) {
			  field.mask(SPMaskBehavior.apply({}, arguments), options);
			}
		};

		$('#telContato').mask(SPMaskBehavior, spOptions);


		
		$(document).on("change",".pessoa",function(){
			if($(this).val() == "J") {
				$(".nomeContato").show();
				$("#nomeContato").attr("required", "true");
				$("#lbl-nome").text("Empresa:");
				$("#nome").attr("placeholder", "Nome da empresa");
				$("#telContatoDDD").hide();
                $("#bi-container").hide();
                $("#nasc-container").hide();
                $("#genero-container").hide();
				$("#telContato").addClass("telContatoFora");
                $("#nivel-container").hide();
                ;

			} else {
				$(".nomeContato").hide();
				$("#nomeContato").removeAttr("required");
				$("#lbl-nome").text("Nome:");
				$("#nome").attr("placeholder", "Seu nome");
                $("#bi-container").show();
                $("#nasc-container").show();
                $("#genero-container").show();
				$("#telContato").addClass("telContatoFora");
                $("#nivel-container").show();

			}
		});

		$(document).on("blur","#val-login", function(){
			var login = $(this).val();
			checaLogin(login, 'blur');
		});
		$(document).on("blur","#email", function(){
			var email = $(this).val();
			checaMail(email, 'blur');
		});
		$(document).on("click","#email", function(){
			$("#email").removeClass("invalid");
		});
		$(document).on("focusout","#email", function(){
			$("#email").removeClass("invalid");
			$("#email-error").text("");

		});
		$(document).on("click","#val-login", function(){
			$("#aviso-login").text("");
			$("#val-login").removeClass("invalid");
		});
		$(document).on("focusout","#val-login", function(){
			$("#aviso-login").text("");
			$("#val-login").removeClass("invalid");
		});
		$(document).on("change",".place",function(){
			verificaPais($(this).val());
		});
		function verificaPais(place){
			if(place == "F") {
				$('#telContato').unmask();
				$(".pais").show();
				$("#pais").attr("required", "true");
				$(".estado").show();
				$("#estado").removeAttr("required");
				$(".cidade").hide();
				$("#cidade").removeAttr("required");
				$("#telContato").removeAttr("required");
				$("#telContato").attr("pattern", "[0-9]{3} [0-9]{3} [0-9]{3}");
				$("#telContato").attr("maxlength", "40");
				$("#telContato").addClass("telContatoFora");
				$("#telContatoDDD").removeAttr("required");
				$("#telContatoDDD").hide();
			} else {
				$(".pais").hide();
				$("#pais").removeAttr("required");
				$(".estado").show();
				$("#estado").attr("required", "required");
				$(".selectEstado").attr("required", "true");
				$("#telContato").attr("required", "true");
				$("#telContato").attr("pattern", "[0-9]{3} [0-9]{3} [0-9]{3}");
				$("#telContato").removeClass("telContatoFora");
				$("#telContatoDDD").attr("required", "true");
				$("#telContatoDDD").show();
				
				if($("#cidade option").length > 0){
					$(".cidade").show();
					$("#cidade").attr("required", "true");
				}
				
				$('#telContato').mask(SPMaskBehavior, spOptions);
			}
		}
		$(document).on("change","#estado",function(){
			carregaCidades();
		});
		function carregaCidades(){
			var uf = $("#estado").val();
			if(uf!="0"){
				$.ajax({
					type: "POST",
					url: "scripts/funcoes.php",
					data: "uf="+ uf + "&funcao=pegaMunicipios",
					beforeSend:function(){
						var html = '<img src="images/loading2.gif" style="position:absolute; margin:0 0 0 10px;" class="carregaCidades" alt="loading" title="loading" />';
						$(html).insertAfter("#estado");
					},
					success:function(data){
						data = $.parseJSON(data);
						$(".selectCidades option").remove();
						if(data.status == 1){
							var n = data.retorno.length;
							var dadosUF = estadoCapital(uf);
							var capital = dadosUF["capital"];
							var ddd = dadosUF["ddd"];
							$("#telContatoDDD").val(ddd);
							for(var i=0;i < n;i++){
								if (capital == data.retorno[i].texto ) {
									$(".selectCidades").append($('<option>', { 
										value: data.retorno[i].valor,
										text : data.retorno[i].texto,
										selected: 'true'
									}));
									$("#nomeCidade").val(capital);
								} else {
									$(".selectCidades").append($('<option>', { 
										value: data.retorno[i].valor,
										text : data.retorno[i].texto
									}));
								}
							}
							
							$(".cidade").show();
							$("#cidade").attr("required", "true");
							
						} else {
							notif({
							  type: "error",
							  msg: data.retorno,
							  position: "center",
							  width: 200,
							  multiline: true
							});
						}
						
						$(".carregaCidades").remove();
					},
	                error:function(data){
						$(".carregaCidades").remove();
	                }
				});
			}else{
				$(".selectCidades option").remove();

			}
		}
		$(document).on("change",".selectCidades",function(){
			var nomeCidade = $(".selectCidades option:selected").text();
			$("#nomeCidade").val(nomeCidade);
		});
		$("#error-link-login").on("click", function(){
			$("#form-header-login").click();
			if($(window).width()>899){
				$("#usuario").focus();
			}	
		})
		$("#form-header-login").on("click", function(){
			if($(window).width()>899){
				exibeForms();
			}else{
					$("#login-form").addClass("exibe-item");
					$("#novoChamadoForm").removeClass("exibe-item");
					$("#novoChamadoForm").addClass("esconde-item");
			}
			// $("#usuario").focus();
			$('html, body').stop().animate({
				scrollTop: 0
			}, 400);
		});	
		$("#form-header-cadastro").on("click", function(){
			if($(window).width()>899){
				exibeForms();
			}else{
				$("#novoChamadoForm").addClass("exibe-item");
				$("#login-form").removeClass("exibe-item");
				$("#login-form").addClass("esconde-item");
			}
			// $("#nome").focus();
			$('html, body').stop().animate({
				scrollTop: 0
			}, 400);
		});
		function checaLogin(login, acao){
			if(login==""){
				// $("#aviso-login").text("Digite um nome para login.");
				// $("#val-login").addClass("invalid");				
			}
			$.ajax({
				type: "POST",
				url: "checa_login.php",
				data: "login="+ login + "&funcao=verificaLogin",
				success:function(data){
					if (data) {
						if (acao == 'blur') {
							$("#val-login").addClass("invalid");	
							if($("#val-login").val()==""){
								// $("#aviso-login").text("Digite um nome para login.");
								$("#aviso-login").text("");
								$("#val-login").removeClass("invalid");
							}else{
								$("#aviso-login").text("Login já existente.");
								$("#val-login").addClass("invalid");
							}
						} else {
							//  $("#val-login").val('');
						}
					} else {
						$("#aviso-login").text("");
						$("#val-login").removeClass("invalid");
					}
				}
			});
		}
		function checaMail(email, acao){
			if(email==""){
				$("#aviso-login").text("");
				$("#val-login").removeClass("invalid");				
				$("#container-email-links").addClass("esconde-item");
			}else{
				$.ajax({
					type: "POST",
					url: "../inc/join/controller/join_controller.php",
					data: "email="+ email + "&funcao=verificaEmail",
					success:function(data){
						if (data) {
							if (acao == 'blur') {
								$("#aviso-email").text("Email j� existente.");
								$("#container-email-links").removeClass("esconde-item");
								$("#email").addClass("invalid");	
							} else {
								 $("#email").val('');
								$("#container-email-links").addClass("esconde-item");
							}
						} else {
							$("#aviso-email").text("");
							$("#email").removeClass("invalid");
							$("#container-email-links").addClass("esconde-item");
						}
					}
				});
			}
		}
		

		function estadoCapital(uf) { 
			switch (uf) {
				case 'AC': 
					var arrayCapital = {capital: "Rio Branco", ddd: "68"};
					return arrayCapital;
					break;
				case 'AL': 
					var arrayCapital = {capital: "Macei�", ddd: "82"};
					return arrayCapital;
					break;
				case 'AP': 
					var arrayCapital = {capital: "Macap�", ddd: "96"};
					return arrayCapital;
					break;
				case 'AM': 
					var arrayCapital = {capital: "Manaus", ddd: "92"};
					return arrayCapital;
					break;
				case 'BA': 
					var arrayCapital = {capital: "Salvador", ddd: "71"};
					return arrayCapital;
					break;
				case 'CE': 
					var arrayCapital = {capital: "Fortaleza", ddd: "85"};
					return arrayCapital;
					break;
				case 'DF': 
					var arrayCapital = {capital: "Bras�lia", ddd: "61"};
					return arrayCapital;
					break;
				case 'ES': 
					var arrayCapital = {capital: "Vit�ria", ddd: "27"};
					return arrayCapital;
					break;
				case 'GO': 
					var arrayCapital = {capital: "Goi�nia", ddd: "62"};
					return arrayCapital;
					break;
				case 'MA': 
					var arrayCapital = {capital: "S�o Lu�s", ddd: "98"};
					return arrayCapital;
					 break;
				case 'MT': 
					var arrayCapital = {capital: "Cuiab�", ddd: "65"};
					return arrayCapital;
					break;
				case 'MS': 
					var arrayCapital = {capital: "Campo Grande", ddd: "67"};
					return arrayCapital;
					 break;
				case 'MG': 
					var arrayCapital = {capital: "Belo Horizonte", ddd: "31"};
					return arrayCapital;
					 break;
				case 'PA': 
					var arrayCapital = {capital: "Bel�m", ddd: "91"};
					return arrayCapital;
					break;
				case 'PB': 
					var arrayCapital = {capital: "Jo�o Pessoa", ddd: "83"};
					return arrayCapital;
					 break;
				case 'PR': 
					var arrayCapital = {capital: "Curitiba", ddd: "41"};
					return arrayCapital;
					break;
				case 'PE': 
					var arrayCapital = {capital: "Recife", ddd: "81"};
					return arrayCapital;
					break;
				case 'PI': 
					var arrayCapital = {capital: "Teresina", ddd: "86"};
					return arrayCapital;
					break;
				case 'RJ': 
					var arrayCapital = {capital: "Rio de Janeiro", ddd: "21"};
					return arrayCapital;
					 break;
				case 'RN': 
					var arrayCapital = {capital: "Natal", ddd: "84"};
					return arrayCapital;
					break;
				case 'RS': 
					var arrayCapital = {capital: "Porto Alegre", ddd: "51"};
					return arrayCapital;
					 break;
				case 'RO': 
					var arrayCapital = {capital: "Porto Velho", ddd: "69"};
					return arrayCapital;
					 break;
				case 'RR': 
					var arrayCapital = {capital: "Boa Vista", ddd: "95"};
					return arrayCapital;
					 break;
				case 'SC': 
					var arrayCapital = {capital: "Florian�polis", ddd: "48"};
					return arrayCapital;
					break;
				case 'SP': 
					var arrayCapital = {capital: "S�o Paulo", ddd: "11"};
					return arrayCapital;
					 break;
				case 'SE': 
					var arrayCapital = {capital: "Aracaju", ddd: "79"};
					return arrayCapital;
					break;
				case 'TO': 
					var arrayCapital = {capital: "Palmas", ddd: "63"};
					return arrayCapital;
					break;
				default: 
					var arrayCapital =  {capital:"", ddd: ""};
					return arrayCapital;
					break;
			}
		}
		verificaPais($(".international").attr('data-verifica'));
		var email = $("#email").val();
		if(email!= ""){
			checaMail(email, 'blur');
		}
		$(window).resize(function(){
			if($(window).width()>899){
				exibeForms();
			}else{
			}
	});	
		function exibeForms(){
			$("#login-form").addClass("exibe-item");
			$("#login-form").removeClass("esconde-item");
			$("#novoChamadoForm").addClass("exibe-item");
			$("#novoChamadoForm").removeClass("esconde-item");
		}
	});