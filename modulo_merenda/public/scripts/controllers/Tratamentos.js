class Tratamentos{

	constructor(formEl){
		this.formEl = document.getElementById(formEl);
		this.idForm = formEl;

		this.numeros();
		this.mascara();
	}


	numeros(){

		[...this.formEl.elements].forEach((field, index) => {

			if(field.name.substr(0, 4) == "cnpj"){

				field.addEventListener("keypress", event => {

					let er = /[^0-9]/
					
					er.lastIndex = 0;

					if (er.test(event.key)) {
						console.log(event)
					}

				});

			}

		});

	}

	mascara(){
		
		[...this.formEl.elements].forEach((field, index) => {

			if(field.name.substr(0, 4) == "cnpj"){

				field.addEventListener("keyup", event => {

					field.value.replace(/^(\d{2})(\d{3})?(\d{3})?(\d{4})?(\d{2})?/, "$1 $2 $3/$4-$5");

				});

			}

		});

	}

}