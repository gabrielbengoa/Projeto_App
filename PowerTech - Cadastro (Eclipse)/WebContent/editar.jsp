<%@ page language="java" contentType="text/html; charset=utf-8"
	pageEncoding="utf-8"%>
<%
	String idcliente = (String) request.getAttribute("idcliente");
	String nomecliente = (String) request.getAttribute("nomecliente");
	String email = (String) request.getAttribute("email");
	String sexo = (String) request.getAttribute("sexo");
	String telefone = (String) request.getAttribute("telefone");
	String cpf = (String) request.getAttribute("cpf");
	String usuario = (String) request.getAttribute("usuario");
	String senha = (String) request.getAttribute("senha");
%>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Lista de clientes cadastrados</title>
<link rel="stylesheet" href="style.css">
</head>
<body>
	<form name="frmCadastro" action="update2">
		<h1>Editar cadastro</h1>
		<table>
		<tr>
				<td><input type="text" name ="idcliente" value="<%=idcliente%>" readonly id="caixa2"></td>
			</tr>
			<tr>
				<td><input type="text" name="nomecliente" value="<%=nomecliente%>" class="Caixa1"></td>
			</tr>
			<tr>
				<td><input type="text" name="email" value="<%=email%>" class="Caixa1"></td>
			</tr>
			<tr>
				<td><input type="text" name="sexo" value="<%=sexo%>" class="Caixa1"></td>
			</tr>
			
			<tr>
				<td><input type="text" name="telefone" value="<%=telefone%>" class="Caixa1"></td>
			</tr>
			<tr>
				<td><input type="text" name="cpf" value="<%=cpf%>" class="Caixa1"></td>
			</tr>
			<tr>
				<td><input type="text" name="usuario" value="<%=usuario%>" class="Caixa1"></td>
			</tr>
			<tr>
				<td><input type="text" name="senha" value="<%=senha%>" class="Caixa1"></td>
			</tr>
		</table>
		<input type="button" value="Salvar" onclick="validar2()" class="Botao1">
	</form>
	<script src="validador2.js"></script>
</body>
</html>