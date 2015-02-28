$(document).ready(function(){
	$("input[type=submit]").click(function(){
		var msg = $("input[name=postar]").val();
		var login = $("input[name=login]").val();
		var email = $("input[name=email]").val();
		var website = $("input[name=website]").val();

		$.post("ajax-config.php",{
			acao: 'inserir',
			login: login,
			msg: msg,
			email: email,
			website: website
		});
	});

	setInterval(function(){
		$.post("ajax-config.php",{
			acao: 'atualizar',
		}, function(x){
			$('#msg').html(x)
		}, 'jSON');
	},2000);
})