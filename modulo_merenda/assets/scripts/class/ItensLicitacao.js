class ItensLicitacao{

	constructor(formEl, array){

		this.formEl = document.getElementById(formEl);
		this.array = array;

		this.onSubmit();

	}

	onSubmit(){

		this.formEl.addEventListener("submit", event =>{

			event.preventDefault();

			let values = this.getValues(this.formEl);

			if (!values) {

				swal.fire({

					text:  `Preencha os campos em vermelho!`,
					icon: "error",

				});

			}else{
				this.formEl.submit();
			}


		});

	}

	getValues(formEl){

		let isValid = true;

		[...formEl.elements].forEach((field, index) => {

			if (this.array.indexOf(field.name) > -1 && !field.value) {

                field.parentElement.classList.add('has-error');

				isValid = false;

			}

		});

		return isValid;

	}

}