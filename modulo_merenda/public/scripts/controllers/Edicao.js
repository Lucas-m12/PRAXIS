class Edicao{

	constructor(formEl, array = array(), urlCadastro, tipoCadastro){

		this.formEl = document.getElementById(formEl);

		this.array = array;

		this.urlCadastro = urlCadastro;

		this.tipo = tipoCadastro;

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

			}

		});
	}

	getValues(){

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
			url: this.urlEdicao,
			data,
			success: data =>{
				swal({
					title: "Bom Trabalho",
					text: `${this.tipoEdicao} atualizado com sucesso`,
					icon: "success",
					button: "OK"
				}).then(value =>{
					
					window.location.reload();
					
				});
				
			}
		});
	}

}