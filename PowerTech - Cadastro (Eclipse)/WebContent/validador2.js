function validar2() {
	let usuario = frmCadastro.usuario.value
	let senha = frmCadastro.senha.value
	if (usuario === "") {
		alert ('Preencher o campo Usuario')
		frmCadastro.usuario.focus()
		return false
	} else if (senha === "") {
		alert ('Preencher o campo Senha')
		frmCadastro.senha.focus()
		return false
	} else {
		document.forms["frmCadastro"].submit()
	}
}