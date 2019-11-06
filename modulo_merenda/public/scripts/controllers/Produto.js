class Produto{

	constructor(formEl, array){
		this.formEl = document.getElementById(formEl);
		this.array 	= array;

		this.onSubmit();
	}

	onSubmit(){

		this.formEl.addEventListener("submit", event =>{

			event.preventDefault();

			let btn = this.formEl.querySelector("[type=submit]");

			let values = this.getValues(this.formEl);

			if (values != false) this.sendData(values);

		});

	}

	getValues(formEl){

		let isValid = true;
		let data = {};

		[...formEl.elements].forEach((field, index)=>{

			if (this.array.indexOf(field.name) > -1 && !field.value) {

				field.parentElement.classList.add("has-error");

				isValid = false;

			}

			data[field.name] = field.value

		});

		return !isValid ? false : data;

	}

	sendData(values){

		$.ajax({

			type: "POST",
			url: "/praxis/modulo_merenda/cadastrar/produto",
			data: values,
			success: data =>{

				swal({
					title: "Bom Trabalho",
					text: "Produto cadastrado com sucesso",
					icon: "success",
					button: "OK"
				}).then(value =>{

					window.location.href='/praxis/modulo_merenda/cadastro/produtos';
					
				});

				

			}

		});

	}

}