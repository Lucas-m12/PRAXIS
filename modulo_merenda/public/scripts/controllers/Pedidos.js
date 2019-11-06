class Pedidos{

	constructor(formEl, array){

		this.formEl = document.getElementById(formEl);
		this.array 	= array;

		this.save();

	}


	save(){

		document.querySelector("#btn-avancar").addEventListener("click", event =>{

			let values = this.getValues(this.formEl);
			
			if (values != false) {
				this.sendData(values);
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
			if (field.name != "produtos" && field.name != "quantidade" && field.name != "idUnidadeMedida" && field.name != "addProduto" && field.name != "categoria") {
				data[field.name] = field.value;
			}

		});


		return !isValid ? false : data;
	}

	sendData(values){

		$.ajax({

			type: "POST",
			url: "/praxis/modulo_merenda/pedidos/novo",
			data: values,
			success: data =>{
				let dados = JSON.parse(data);
				this.avancar();
			}

		});

	}

	

	avancar(){

		let cod = $("#codigoPedido").val();

		window.location.href=`/praxis/modulo_merenda/cadastro/pedido/produto/${cod}`;

	}




	

}