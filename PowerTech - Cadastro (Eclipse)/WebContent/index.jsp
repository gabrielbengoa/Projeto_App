<%@ page language="java" contentType="text/html; charset=utf-8"
	pageEncoding="utf-8"%>
<%@page import="model.DAO"%>
<%@page import="java.util.ArrayList"%>
<%@page import="model.JavaBeans"%>
<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="utf-8">
<title>Lista de clientes cadastrados</title>
<link rel="stylesheet" href="style.css">
</head>
<body>
	<h1>Lista de clientes cadastrados</h1>
	<a href="cadastro.jsp" class="Botao1">Novo cadastro</a>
	<table id="estilo">
		<thead>
			<tr>
				<th>Id</th>
				<th>Nome</th>
				<th>E-mail</th>
				<th>Sexo</th>
				<th>Telefone</th>
				<th>Cpf</th>
				<th>Usuario</th>
				<th>Senha</th>
				<th>Ações</th>
			</tr>
		</thead>
		<tbody>
			<%
				DAO dao = new DAO();
			ArrayList<JavaBeans> cadastro = dao.listarCadastro();
			for (int i = 0; i < cadastro.size(); i++) {
			%>
			<tr>
				<td><%=cadastro.get(i).getId()%></td>
				<td><%=cadastro.get(i).getNome()%></td>
				<td><%=cadastro.get(i).getEmail()%></td>
				<td><%=cadastro.get(i).getSexo()%></td>
				<td><%=cadastro.get(i).getTelefone()%></td>
				<td><%=cadastro.get(i).getCpf()%></td>
				<td><%=cadastro.get(i).getUsuario()%></td>
				<td><%=cadastro.get(i).getSenha()%></td>
				<td><a href="update1?idcliente=<%=cadastro.get(i).getId()%>"
					class="Botao1">Editar</a><a
					href="delete?idcliente=<%=cadastro.get(i).getId()%>" id="botao2">Excluir</a></td>
			</tr>
			<%
				}
			%>

		</tbody>
	</table>


</body>
</html>