class Cadastro {

	constructor(formEl, array = array(), urlCadastro, tipoCadastro, btnSubmit = "#submitCadastrar"){

		this.formEl = document.getElementById(formEl);

		this.array = array;

		this.urlCadastro = urlCadastro;

		this.tipo = tipoCadastro;

		this.btnSubmit = btnSubmit;

		this.onSubmit();

	}

	onSubmit(){

		this.formEl.addEventListener("submit", event => {

			event.preventDefault();

			let btn = document.querySelector(this.btnSubmit);

			btn.disabled = true;

			let values = this.getValues(this.formEl);

			if (!values) {
				
				return false;
			
			}else{

				this.sendData(values);

				this.formEl.reset();

				btn.disabled = false;


			}

		});

	}

	getValues(formEl){

		let data = {};
		let isValid = true;

		[...formEl.elements].forEach((field, index) => {


			if (this.array.indexOf(field.name) > -1 && !field.value) {

                field.parentElement.classList.add('has-error');

				isValid = false;

			}

			if (field.type != "button" && field.type != "submit" && field.type != "reset") {
				data[field.name] = field.value;
			}

		});

		return !isValid ? false : data;

	}

	sendData(values){

		let data = values;
		$.ajax({

			type:"POST",
			url: this.urlCadastro,
			data,
			success: data =>{
				let dados = JSON.parse(data);

				if (dados.id != undefined || dados.id != null){ 
					swal({
						title: "Bom Trabalho",
						text:  `${this.tipo} cadastrado com sucesso`,
						icon: "success",
						button: "OK"
					}).then(value =>{
						
						window.location.reload();
						
					});
					
				}else {
					swal(`Erro ao cadastrar ${this.tipo}!`)
				}
			}
		});
	}

}