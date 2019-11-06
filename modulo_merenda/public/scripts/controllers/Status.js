class Status{

	constructor(tipoCadastro){
		
		this.tipoCadastro = tipoCadastro;

		this.ativar();
		this.inativar();

	}

	ativar(){

		let btn = document.querySelectorAll("#btnAtivar");

		btn.forEach((field, index)=>{

			field.addEventListener("click", event =>{
				let confirmar = confirm("Tem Certeza que Deseja Alterar a Situação atual ?");
				if (confirmar == true) this.alterarStatus(field.value, 1);
			});

		});

	}

	inativar(){

		let btn = document.querySelectorAll("#btnInativar");

		btn.forEach((field, index)=>{

			field.addEventListener("click", event =>{
				let confirmar = confirm("Tem Certeza que Deseja Alterar a Situação atual ?");
				if(confirmar == true) this.alterarStatus(field.value, 2);
			});

		});

	}

	alterarStatus(id, novoStatus){
		$.ajax({

			type:"POST",
			url:"/praxis/modulo_merenda/status",
			data: {id, novoStatus, tipoCadastro: this.tipoCadastro},
			success: data =>{
				alert("Situação Alterada com Sucesso");
				window.location.reload();
			}

		});
	}



}