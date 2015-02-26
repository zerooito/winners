<!DOCTYPE html>
<div id="formulariocadastro">
<form action="cadastrar" name="cadastro" method="POST">
	<input type="text" name="cadastro[nome]" required placeholder="Nome" /><br>
	<input type="email" name="cadastro[email]" required placeholder="Email" /><br>
	<input type="password" name="cadastro[senha]" required placeholder="Senha" /><br><br>
	<input type="submit" value="cadastrar" name="cadastro[cadastrar]" />
</form>
</div>
<table>
	<thead>
		<th>Teste view Cake</th>
		<th>Acoes</th>
	</thead>
	<tbody>
		<tr>
			<td>View1</td>
			<td>Excluir | Editar | Enviar E-mail</td>
		<tr>
	</tbody>
</table>
