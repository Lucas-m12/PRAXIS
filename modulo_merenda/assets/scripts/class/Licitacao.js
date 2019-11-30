class Licitacao{

	constructor(formEl, array, rotaCadastro, rotaDestino){

		this.formEl 		= document.getElementById(formEl);
		this.array 			= array;
		this.rotaCadastro 	= rotaCadastro;
		this.rotaDestino	= rotaDestino;

		this.onSubmit();

	}

	onSubmit(){

		this.formEl.addEventListener("submit", event =>{

			event.preventDefault();

			let values = this.getValues(this.formEl);

			if (!values) {

				swal.fire({

					title: "ERRO!",
					text: "Preencha os campos em vermelho",
					icon: "error"

				});

			} else{

				this.sendData(values);

			}

		});

	}

	getValues(formEl){

		let data = {};
		let isValid = true;

		[...formEl.elements].forEach((field, index) =>{

			if (this.array.indexOf(field.name) > -1 && !field.value) {

				field.parentElement.classList.add('has-error');

				isValid = false;

			}

			data[field.name] = field.value;

		});


		return !isValid ? false : data;


	}

	sendData(values){

		$.ajax({

			type: "POST",
			url: this.rotaCadastro,
			data: values,
			success: data =>{

				let dados = JSON.parse(data);

				if (dados == "campos") {
					swal.fire({
						title: "ERRO!",
						text: "Preencha os campos vazios",
						icon: "error"
					});
				}else{

					window.location.href=`${this.rotaDestino}/${dados}`;

				}

			}

		});

	}

}