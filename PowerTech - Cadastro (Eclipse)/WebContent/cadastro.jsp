<%@ page language="java" contentType="text/html; charset=utf-8"
	pageEncoding="utf-8"%>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Lista de clientes cadastrados</title>
	<link rel="stylesheet" href="style.css">
</head>
<body>
	<form name="frmCadastro" action="insert">
	<h1>Novo cadastro</h1>
		<table>
			<tr>
				<td><input type="text" name="nomecliente" placeholder="Nome" class="Caixa1"></td>
			</tr>
			<tr>
				<td><input type="text" name="email" placeholder="Email" class="Caixa1"></td>
			</tr>
			<tr>
				<td><input type="text" name="sexo" placeholder="Sexo (M ou F)" class="Caixa1"></td>
			</tr>
			
			<tr>
				<td><input type="text" name="telefone" placeholder="Fone" class="Caixa1"></td>
			</tr>
			<tr>
				<td><input type="text" name="cpf" placeholder="Cpf" class="Caixa1"></td>
			</tr>
			<tr>
				<td><input type="text" name="usuario" placeholder="Usuário" class="Caixa1"></td>
			</tr>
			<tr>
				<td><input type="text" name="senha" placeholder="Senha" class="Caixa1"></td>
			</tr>
		</table>
		<input type="button" value="Cadastrar" onclick="validar2()" class="Botao1">		
	</form>
	<script src="validador2.js"></script>
</body>
</html>