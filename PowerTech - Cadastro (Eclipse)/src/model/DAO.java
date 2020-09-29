package model;

import java.sql.Connection;
import java.sql.DriverManager;
import java.sql.PreparedStatement;
import java.sql.ResultSet;
import java.util.ArrayList;

public class DAO {

	private String driver = "com.mysql.cj.jdbc.Driver";
	private String url = "jdbc:mysql://127.0.0.1:3310/dbpwrtch?useTimezone=true&serverTimezone=UTC";
	private String user = "root";
	private String password = "";

	private Connection conectar() {
		Connection con = null;
		try {
			Class.forName(driver);
			con = DriverManager.getConnection(url, user, password);
			return con;
		} catch (Exception e) {
			System.out.println(e);
			return null;
		}
	}


	public void novoCadastro(JavaBeans cadastro) {
		String create = "insert into cadastrocli (nomecliente,email,sexo,telefone,cpf,usuario,senha) values (?,?,?,?,?,?,?)";
		try {
			Connection con = conectar();
			PreparedStatement pst = con.prepareStatement(create);
			pst.setString(1, cadastro.getNome());
			pst.setString(2, cadastro.getEmail());
			pst.setString(3, cadastro.getSexo());
			pst.setString(4, cadastro.getTelefone());
			pst.setString(5, cadastro.getCpf());
			pst.setString(6, cadastro.getUsuario());
			pst.setString(7, cadastro.getSenha());
			pst.executeUpdate();
			con.close();
		} catch (Exception e) {
			System.out.println(e);
		}
	}

	public ArrayList<JavaBeans> listarCadastro() {
		ArrayList<JavaBeans> cadastro = new ArrayList<>();
		String read = "select * from cadastrocli order by nomecliente";
		try {
			Connection con = conectar();
			PreparedStatement pst = con.prepareStatement(read);
			ResultSet rs = pst.executeQuery();
			while (rs.next()) {
				String idcliente = rs.getString(1);
				String nomecliente = rs.getString(2);
				String email = rs.getString(3);
				String sexo = rs.getString(4);
				String telefone = rs.getString(5);
				String cpf = rs.getString(6);
				String usuario = rs.getString(7);
				String senha = rs.getString(8);			
				cadastro.add(new JavaBeans(idcliente,nomecliente,email,sexo,telefone,cpf,usuario,senha));
			}
			return cadastro;
		} catch (Exception e) {
			System.out.println(e);
			return null;
		}
	}
	
	public void listarCadastro(JavaBeans cadastro) {
		String update1 = "select * from cadastrocli where idcliente=?";
		try {
			Connection con = conectar();
			PreparedStatement pst = con.prepareStatement(update1);
			pst.setString(1, cadastro.getId());
			ResultSet rs = pst.executeQuery();
			while (rs.next()) {
				cadastro.setId(rs.getString(1));
				cadastro.setNome(rs.getString(2));
				cadastro.setEmail(rs.getString(3));
				cadastro.setSexo(rs.getString(4));	
				cadastro.setTelefone(rs.getString(5));
				cadastro.setCpf(rs.getString(6));
				cadastro.setUsuario(rs.getString(7));
				cadastro.setSenha(rs.getString(8));	
			}

		} catch (Exception e) {
			System.out.println(e);
		}
	}

	
	public void alterarCadastro(JavaBeans cadastro) {
		String update2 = "update cadastrocli set nomecliente=?,email=?,sexo=?,telefone=?,cpf=?,usuario=?,senha=? where idcliente=?";
		try {
			Connection con = conectar();
			PreparedStatement pst = con.prepareStatement(update2);
			pst.setString(1, cadastro.getNome());
			pst.setString(2, cadastro.getEmail());
			pst.setString(3, cadastro.getSexo());
			pst.setString(4, cadastro.getTelefone());
			pst.setString(5, cadastro.getCpf());
			pst.setString(6, cadastro.getUsuario());
			pst.setString(7, cadastro.getSenha());
			pst.setString(8, cadastro.getId());
			pst.executeUpdate();
			con.close();
		} catch (Exception e) {
			System.out.println(e);
		}

	}
	
	public void excluirCadastro(JavaBeans cadastro) {
		String delete = "delete from cadastrocli where idcliente=?";
		try {
			Connection con = conectar();
			PreparedStatement pst = con.prepareStatement(delete);
			pst.setString(1, cadastro.getId());
			pst.executeUpdate();
			con.close();
		} catch (Exception e) {
			System.out.println(e);
		}
	}
}