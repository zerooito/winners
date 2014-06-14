$(document).ready(function(){
	/*funções gerais para o site winners*/
	//cadastrar instituicao
	$("#enviar").click(function(){
		//pega os dados dos input para passa na viariavel
		var nome  = $("#nome_cadastro").val();
		var email = $("#email_cadastro").val();
		var senha = $("#senha_cadastro").val();
		var erp = $("#erp").val();
		var ead = $("#ead").val()
		var site = $("#site").val();
		alert(site);
		//verificar as variaveis digitadadas
		if(nome != '' && senha != '' && senha.length > 5 && email.indexOf("@") >= 0 && email.indexOf(".") >= 0){
			//da o comando post
			$.ajax({
				type: "post",
				dataType: "json",
				url: "usuario/novo_cadastro",
				async: true,
				data: {
					acao: 'inserir',
					nome: nome,
					email: email,
					senha: senha,
					erp: erp,
					ead: ead,
					site: site
				},				
				error: function(x){
					console.log(x);
					//alert("Não Foi !");
				},
				success: function(x){
					console.log(x);
					if(x == true){
						//aplicar o resultado no formulario se o retorno for verdadeiro
						$("#enviar").html("Sucesso !").css("background","green");
						$("#enviar").prop('disabled', true);
						$("#nome_cadastro").prop('disabled', true);
						$("#email_cadastro").prop('disabled', true);
						$("#senha_cadastro").prop('disabled', true);

						$("#sucesso").fadeIn("slow",function(){
							$(this).css("display","block");
							$(this).css("position","fixed");
							$(".conteudo_alert").append("Verique seu e-mail!");

						});

						console.log(x);
					}else{
						$("#enviar").html("Ocorreu algum erro tente novamente !").css("background","red");
					}
				}
			});
		}else{
			$("#nome_cadastro").attr('placeholder','Insira seu nome').css("border-color","#069").val();
			$("#email_cadastro").attr('placeholder','Email invalido').css("border-color","#069").val();
			$("#senha_cadastro").attr('placeholder','Sua senha precisa de 6 caracteres ou mais').css("border-color","#069").val();
		}
	});

	$("#logar").click(function(){
		//passa os dados para as variaveis
		var email = $("#login_email").val();
		var senha = $("#login_senha").val();
		var acao = 'logar';

		if(email != '' && email.indexOf("@") >= 0 && senha != '' && senha.length > 5){
			$.ajax({
				type: "post",
				dataType: "json",
				url: "usuario/login",
				async: true,
				data: {acao: acao, email: email, senha: senha},				
				error: function(x){
					console.log(x);
					alert("Não Foi !");
				},
				success: function(x){
					console.log(x);
					if(x == true){
						//$("#sucesso").fadeIn("slow",function(){
							//$(this).css("display","block");
							//$(".conteudo_alert").append("Os dados corretos!");
						//});
						
						var novaURL = "wAdmin";
						$(window.document.location).attr('href',novaURL);
					}else{
						alert("Login invalido");
					}					
				}
			});
		}else{
			$("#login_email").attr('placeholder','Email invalido').css("border-color","#069").val("");
			$("#login_senha").attr('placeholder','Senha invalida').css("border-color","#069").val("");
		}
	});

	//funções diversas
	//função que verifica email
	$("#email_cadastro").bind("input keyup paste", function(){
		var acao = 'verifica_email';
		var email = $(this).val();

			$.ajax({
				type: "post",
				dataType: "json",
				url: "usuario/verificar_email_ajax",
				async: true,
				data: {acao: acao, email: email},				
				error: function(x){
					console.log(x);
					//alert("Não Foi !");
				},
				success: function(x){
					console.log(x);
					if(x == false){

					}else{						
						$("#email_cadastro").attr('placeholder','Email Já Cadastrado').val("");
					}
				}
			});
	});

	//função que esconde o campo de alerta
	$("#ok").click(function(){
		$("#sucesso").fadeOut("slow",function(){
			$(this).css("display","none");
		});
	});
	/*fim das funções gerais para o site winners*/

	//funções para editar, cadastrar a pagina home do site_front
	$("#atualizar_texto_home").click(function(){
		$("#texto_pagina_home").fadeIn(1000);
	});
	$("#atualizar_dados_home").click(function(){

		var acao = 'atualizar_dados_pagina_home';
		var title_home = $("#title_home").val();
		var description_home = $("#description_home").val();
		var keywords_home = $("#keywords_home").val();
		var empresa_home = $("#empresa_home").val();
		var id_usuario = $("#id_usuario").val();

		$.ajax({
				type: "post",
				dataType: "json",
				url: "atualizar_dados_home",
				async: true,
				data: {acao: acao,
					   title_home: title_home,
					   description_home: description_home,
					   keywords_home: keywords_home,
					   empresa_home: empresa_home,
					   id_usuario: id_usuario
					},				
				error: function(x){
					//console.log(x);
					$("#home").removeClass("panel panel-danger").addClass("panel panel-danger");
					$("#home").removeClass("btn btn-danger").addClass("btn btn-danger");
				},
				success: function(x){
					$("#home").removeClass("panel panel-primary").addClass("panel panel-success");
					$("#atualizar_dados_home").removeClass("btn btn-primary").addClass("btn btn-success");
				}
		});
	});
	$("#texto_home").click(function(){
		var acao = 'atualizar_texto_home';
		var titulo_1 = $("input[name=titulo_1]").val();
		var texto_1 = $("#texto_1").val();
		var titulo_2 = $("input[name=titulo_2]").val();
		var texto_2 = $("#texto_2").val();
		var background_color = $("input[name=background_color]").val();
		var id_usuario = $("input[name=id_usuario]").val();

		$.ajax({
				type: "post",
				dataType: "json",
				url: "../requisicoes.php",
				async: true,
				data: {acao: acao,
					   titulo_1: titulo_1,
					   texto_1: texto_1,
					   titulo_2: titulo_2,
					   texto_2: texto_2,
					   id_usuario: id_usuario,
					   background_color: background_color
					},				
				error: function(x){
					//console.log(x);
					alert("Ocorreu algum erro, tente novamente"+x);
				},
				success: function(x){
					alert("Os dados foram salvos corretamente.");
				}
		});
	});
	//fim das funções para editar, cadastrar a pagina home do site_front

	$("#atualizar_dados_blog").click(function(){
		var acao = 'atualizar_dados_pagina_blog';
		var title_blog = $("input[name=title_blog]").val();
		var description_blog = $("input[name=description_blog]").val();
		var keywords_blog = $("input[name=keywords_blog]").val();
		var empresa_blog = $("input[name=empresa_blog]").val();
		var id_usuario = $("input[name=id_usuario]").val();

		$.ajax({
				type: "post",
				dataType: "json",
				url: "../requisicoes.php",
				async: true,
				data: {acao: acao,
					   title_blog: title_blog,
					   description_blog: description_blog,
					   keywords_blog: keywords_blog,
					   empresa_blog: empresa_blog,
					   id_usuario: id_usuario
					},				
				error: function(x){
					//console.log(x);
					$("#blog").removeClass("panel panel-danger").addClass("panel panel-danger");
					$("#blog").removeClass("btn btn-danger").addClass("btn btn-danger");
				},
				success: function(x){
					$("#blog").removeClass("panel panel-primary").addClass("panel panel-success");
					$("#atualizar_dados_blog").removeClass("btn btn-primary").addClass("btn btn-success");
				}
		});
	});

	$("#atualizar_dados_quem_somos").click(function(){
		var acao = 'atualizar_dados_pagina_quem_somos';
		var title_quem_somos = $("input[name=title_quem_somos]").val();
		var description_quem_somos = $("input[name=description_quem_somos]").val();
		var keywords_quem_somos = $("input[name=keywords_quem_somos]").val();
		var empresa_quem_somos = $("input[name=empresa_quem_somos]").val();
		var id_usuario = $("input[name=id_usuario]").val();

		$.ajax({
				type: "post",
				dataType: "json",
				url: "../requisicoes.php",
				async: true,
				data: {acao: acao,
					   title_quem_somos: title_quem_somos,
					   description_quem_somos: description_quem_somos,
					   keywords_quem_somos: keywords_quem_somos,
					   empresa_quem_somos: empresa_quem_somos,
					   id_usuario: id_usuario
					},				
				error: function(x){
					//console.log(x);
					$("#quem_somos").removeClass("panel panel-danger").addClass("panel panel-danger");
					$("#quem_somos").removeClass("btn btn-danger").addClass("btn btn-danger");
				},
				success: function(x){
					$("#quem_somos").removeClass("panel panel-primary").addClass("panel panel-success");
					$("#atualizar_dados_quem_somos").removeClass("btn btn-primary").addClass("btn btn-success");
				}
		});
	});
	$("#bt_texto_quem_somos").click(function(){
		$("#oculta").css("display","block");

		var acao = 'atualizar_texto_quem_somos';
		var titulo_1 = $("input[name=titulo_quem_somos]").val();
		var texto_1 = $("#texto_quem_somos").val();
		var id_usuario = $("input[name=id_usuario]").val();

			$.ajax({
					type: "post",
					dataType: "json",
					url: "../requisicoes.php",
					async: true,
					data: {acao: acao,
						   titulo_1: titulo_1,
						   texto_1: texto_1,
						   id_usuario: id_usuario
						},				
					error: function(x){
						console.log(x);
						alert("Ocorreu algum erro, se persistir chame o suporte");
					},
					success: function(x){
						alert("Alterações feitas com sucesso");
					}
		});
	});
	$("#atualizar_dados_contato").click(function(){
		var acao = 'atualizar_dados_pagina_contato';
		var title_contato = $("input[name=title_contato]").val();
		var description_contato = $("input[name=description_contato]").val();
		var keywords_contato = $("input[name=keywords_contato]").val();
		var empresa_contato = $("input[name=empresa_contato]").val();
		var id_usuario = $("input[name=id_usuario]").val();

		$.ajax({
				type: "post",
				dataType: "json",
				url: "../requisicoes.php",
				async: true,
				data: {acao: acao,
					   title_contato: title_contato,
					   description_contato: description_contato,
					   keywords_contato: keywords_contato,
					   empresa_contato: empresa_contato,
					   id_usuario: id_usuario
					},				
				error: function(x){
					//console.log(x);
					$("#contato").removeClass("panel panel-danger").addClass("panel panel-danger");
					$("#contato").removeClass("btn btn-danger").addClass("btn btn-danger");
				},
				success: function(x){
					$("#contato").removeClass("panel panel-primary").addClass("panel panel-success");
					$("#atualizar_dados_contato").removeClass("btn btn-primary").addClass("btn btn-success");
				}
		});
	});
	/*
	Funções jquery para o site_front dinamico
	feito por Reginaldo Luis
	Ultima atualização: 03/05/14
	*/
	function getParam(n){
	     return (location.search.match(new RegExp(n + '=([^?&=]+)')) || [])[1] || '';
	}
	setInterval(function(){
		var acao = 'atualizar_blog';
		var id = getParam('id');
		//alert(id);
		$.ajax({
				type: "post",
				dataType: "json",
				url: "../requisicoes.php",
				async: true,
				data: {acao: acao, id_usuario: id},				
				error: function(x){
					//console.log(x);
					//alert("Não Foi !");
				},
				success: function(x){
					$("#posts").html(x).show( "slow" );
				}
		});
	},2000);


	$("#enviar_email").click(function(){
		var acao = 'enviar_email';
		var email_remetente = $("input[name=email_remetente]").val();
		var email_destinario = $("input[name=email_destinario]").val();
		var nome = $("input[name=nome]").val();
		var telefone = $("input[name=telefone]").val();
		var mensagem = $("#mensagem").val();

		$.ajax({
				type: "post",
				dataType: "json",
				url: "../requisicoes.php",
				async: true,
				data: {acao: acao, email_remetente: email_remetente, email_destinario: email_destinario, nome: nome, telefone: telefone, mensagem: mensagem},				
				error: function(x){
					console.log(x);
					$("#enviar_email").html('Tente novamente').css('background','red');
				},
				success: function(x){
					$("#enviar_email").html('Email enviando com sucesso').css('background','green');
				}
		});
	});
});