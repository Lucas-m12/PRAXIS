class EditarPedido{

	constructor(formEl){
		this.formEl = document.getElementById(formEl);

		this.onSubmit();
	}

	onSubmit(){

		this.formEl.addEventListener("submit", event =>{

			event.preventDefault();

			let values = this.getValues(this.formEl);

			if (!values) {
				
				return false;

			} else if (values != false && values.statusPedido != 3) {

				this.sendDataStatus(values);

			} else if (values != false && values.statusPedido == 3){

				this.sendDataStatus(values);
				this.sendDataEstoque(values.codigoPedido);

			}

			window.location.href = "/praxis/modulo_merenda/pedidos";

		});

	}

	getValues(formEl){

		let data = {};
		let isValid = true;

		[...formEl.elements].forEach((field, index) =>{

			if (["codigoPedido", "programa", "statusPedido", "fornecedor"].indexOf(field.name) > -1 && !field.value) {

				field.parentElement.classList.add('has-error');

				isValid = false;

			}
			if (field.name == "statusPedido" || field.name == "codigoPedido") {

				data[field.name] = field.value;
			}

		});

		return !isValid ? false : data;

	}

	sendDataStatus(values){

		$.ajax({

			type: "POST",
			url: "/praxis/modulo_merenda/editar/situacaoPedido",
			data: values,
			success: data =>{

			}

		});

	}

	sendDataEstoque(codigoPedido){

		$.ajax({

			type: "POST",
			url: "/praxis/modulo_merenda/estoque/entrada",
			data: {codigoPedido},
			success: data =>{

				console.log(JSON.parse(data));

			}

		});

	}



}