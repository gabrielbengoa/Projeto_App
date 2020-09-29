package model;

public class JavaBeans {
	private String idcliente;
	private String nomecliente;
	private String email;
	private String sexo;
	private String telefone;
	private String cpf;
	private String usuario;
	private String senha;
	
	
	public JavaBeans() {
		
	}
	
	public JavaBeans(String idcliente, String nomecliente, String email, String sexo, String telefone, String cpf, String usuario, String senha) {
		this.idcliente = idcliente;
		this.nomecliente = nomecliente;
		this.email = email;
		this.sexo = sexo;
		this.telefone = telefone;
		this.cpf = cpf;
		this.usuario = usuario;
		this.senha = senha;
	}

	public String getId() {
		return idcliente;
	}

	public void setId(String idcliente) {
		this.idcliente = idcliente;
	}

	public String getNome() {
		return nomecliente;
	}

	public void setNome(String nomecliente) {
		this.nomecliente = nomecliente;
	}

	public String getEmail() {
		return email;
	}

	public void setEmail(String email) {
		this.email = email;
	}
	
	public String getSexo() {
		return sexo;
	}

	public void setSexo(String sexo) {
		this.sexo = sexo;
	}

	public String getTelefone() {
		return telefone;
	}

	public void setTelefone(String telefone) {
		this.telefone = telefone;
	}
	
	public String getCpf() {
		return cpf;
	}

	public void setCpf(String cpf) {
		this.cpf = cpf;
	}
	
	public String getUsuario() {
		return usuario;
	}

	public void setUsuario(String usuario) {
		this.usuario = usuario;
	}
	
	public String getSenha() {
		return senha;
	}

	public void setSenha(String senha) {
		this.senha = senha;
	}

}
