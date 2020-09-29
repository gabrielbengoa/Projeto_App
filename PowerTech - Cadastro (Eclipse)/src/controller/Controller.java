package controller;

import java.io.IOException;

import javax.servlet.RequestDispatcher;
import javax.servlet.ServletException;
import javax.servlet.annotation.WebServlet;
import javax.servlet.http.HttpServlet;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;

import model.DAO;
import model.JavaBeans;

@WebServlet(urlPatterns = { "/Controller", "/insert", "/update1", "/update2", "/delete"})
public class Controller extends HttpServlet {
	private static final long serialVersionUID = 1L;
	JavaBeans cadastro = new JavaBeans();
	DAO dao = new DAO();
	
	public Controller() {
		super();
	}

	protected void doGet(HttpServletRequest request, HttpServletResponse response)
			throws ServletException, IOException {
		String action = request.getServletPath();
		if (action.equals("/insert")) {
			novoCadastro(request, response);
		} else if (action.contentEquals("/update1")) {
			alterarCadastro(request, response);
		} else if (action.contentEquals("/update2")) {
			alterarCadastro2(request, response);
		} else if (action.contentEquals("/delete")) {
			deletarCadastro(request, response);
		}
	}
	
	protected void novoCadastro(HttpServletRequest request, HttpServletResponse response)
			throws ServletException, IOException {
		String nomecliente = request.getParameter("nomecliente");
		String email = request.getParameter("email");
		String sexo = request.getParameter("sexo");
		String telefone = request.getParameter("telefone");
		String cpf = request.getParameter("cpf");
		String usuario = request.getParameter("usuario");
		String senha = request.getParameter("senha");
		cadastro.setNome(nomecliente);
		cadastro.setEmail(email);
		cadastro.setSexo(sexo);
		cadastro.setTelefone(telefone);
		cadastro.setCpf(cpf);
		cadastro.setUsuario(usuario);
		cadastro.setSenha(senha);
		dao.novoCadastro(cadastro);
		response.sendRedirect("index.jsp");
	}
	
	protected void alterarCadastro(HttpServletRequest request, HttpServletResponse response)
			throws ServletException, IOException {
		String idcliente = request.getParameter("idcliente");
		cadastro.setId(idcliente);
		dao.listarCadastro(cadastro);
		request.setAttribute("idcliente", cadastro.getId());
		request.setAttribute("nomecliente", cadastro.getNome());
		request.setAttribute("email", cadastro.getEmail());
		request.setAttribute("sexo", cadastro.getSexo());
		request.setAttribute("telefone", cadastro.getTelefone());
		request.setAttribute("cpf", cadastro.getCpf());
		request.setAttribute("usuario", cadastro.getUsuario());
		request.setAttribute("senha", cadastro.getSenha());
		RequestDispatcher rd = request.getRequestDispatcher("editar.jsp");
		rd.forward(request, response);
	}
	
		protected void alterarCadastro2(HttpServletRequest request, HttpServletResponse response)
				throws ServletException, IOException {
			cadastro.setId(request.getParameter("idcliente"));
			cadastro.setNome(request.getParameter("nomecliente"));
			cadastro.setEmail(request.getParameter("email"));
			cadastro.setSexo(request.getParameter("sexo"));
			cadastro.setTelefone(request.getParameter("telefone"));
			cadastro.setCpf(request.getParameter("cpf"));
			cadastro.setUsuario(request.getParameter("usuario"));
			cadastro.setSenha(request.getParameter("senha"));
			dao.alterarCadastro(cadastro);
			response.sendRedirect("index.jsp");
		}

		protected void deletarCadastro(HttpServletRequest request, HttpServletResponse response)
				throws ServletException, IOException {
			String idcliente = request.getParameter("idcliente");
			cadastro.setId(idcliente);
			dao.excluirCadastro(cadastro);
			response.sendRedirect("index.jsp");
		}



}
