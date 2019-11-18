class Programa{

	constructor(formEl, array, rotaCadastro, rotaDestino = ""){

		this.formEl 		= document.getElementById(formEl);
		this.rotaCadastro 	= rotaCadastro;
		this.array 			= array;
		this.rotaDestino	= rotaDestino;

		this.onSubmit();

	}


	onSubmit(){

		this.formEl.addEventListener("submit", event => {

			event.preventDefault();

			let values = this.getValues(this.formEl);

			if (!values) {
				
				swal.fire({
					text:  `Preencha os campos em vermelho!`,
					icon: "error",
				});
			
			}else{

				if (this.formEl.id.split("-")[2] == "edit") {
					this.sendDataEdit(values);
				}else{
					this.sendData(values);
				}

				this.formEl.reset();


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
				if (field.type == "checkbox") {
					if (field.checked) {
						data[field.name] = 2
					}else{
						data[field.name] = 1
					}
				}else{
					data[field.name] = field.value;
				}
			}

		});

		return !isValid ? false : data;

	}



	sendData(values){

		let data = values;
		$.ajax({

			type:"POST",
			url: this.rotaCadastro,
			data,
			success: data =>{
				let dados = JSON.parse(data);

				if (dados.id != undefined || dados.id != null){ 
					swal.fire({
						title: "Bom Trabalho",
						text:  `Programa cadastrado com sucesso`,
						icon: "success",
						button: "OK"
					}).then(value =>{
						
						window.location.reload();
						
					});
					
				}else {
					swal.fire(`Erro ao cadastrar o programa`)
				}
			}
		});
	}

	sendDataEdit(values){

		let data = values;
		$.ajax({

			type:"POST",
			url: this.rotaCadastro,
			data,
			success: data =>{
				let dados = JSON.parse(data);
				if (dados.id != undefined || dados.id != null){ 
					swal.fire({
						title: "Bom Trabalho",
						text:  `Programa atualizado com sucesso`,
						icon: "success",
						button: "OK"
					}).then(value =>{
						
						window.location.href=this.rotaDestino;
						
					});
					
				}else {
					swal.fire(`Erro ao atualizar o programa`)
				}

			}
			
		});
	}


}
