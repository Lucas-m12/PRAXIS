class Produto{

	constructor(formEl, array, rotaCadastro, tipo = "cadastrado", rotaDestino = ""){

		this.formEl = document.getElementById(formEl);

		this.array = array;

		this.rotaCadastro = rotaCadastro;

		this.rotaDestino = rotaDestino;

		this.onSubmit();

	}

	onSubmit(){

		this.formEl.addEventListener("submit", event =>{

			event.preventDefault();

			let btn = this.formEl.querySelector("[type=submit]");

			let values = this.getValues(this.formEl);

			if (!values) {

				swal.fire({

					text:  `Preencha todos os campos!`,
					icon: "error",

				})

			}else{
				if (this.formEl.id.split("-")[2] == "edicao") {
					this.sendDataEdit(values);
				}else{
					this.sendData(values);
				}
			}


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

		$.ajax({

			type: "POST",
			url: this.rotaCadastro,
			data: values,
			success: data =>{

				swal.fire({
					title: "Bom Trabalho",
					text: `Produto ${this.tipo} com sucesso`,
					icon: "success",
					button: "OK"
				}).then(value =>{

					if (this.tipo == 'atualizado') {
						// window.location.href=this.rotaDestino;
						console.log(JSON.parse(data))
					}
					window.location.reload();
					
				});

				

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
						text:  `Produto atualizado com sucesso`,
						icon: "success",
						button: "OK"
					}).then(value =>{
						
						window.location.href=this.rotaDestino;
						
					});
					
				}else {
					swal.fire(`Erro ao atualizar o produto`);
					console.log(dados)
				}

			}
			
		});
	}

}