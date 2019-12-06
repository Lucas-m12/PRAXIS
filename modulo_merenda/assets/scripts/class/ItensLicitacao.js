class ItensLicitacao{

	constructor(formEl, array, rotaPesquisaUnidadeMedida, rotaSalvarProduto, rotaRemoverProduto){

		this.formEl 					= document.getElementById(formEl);
		this.array 						= array;
		this.rotaPesquisaUnidadeMedida 	= rotaPesquisaUnidadeMedida;
		this.rotaSalvarProduto			= rotaSalvarProduto;
		this.rotaRemoverProduto			= rotaRemoverProduto

		this.onSubmit();
		this.onChange();

	}

	onSubmit(){

		document.querySelector("#addProduto").addEventListener("click", event =>{

			let values = this.getValues(this.formEl);

			if (!values) {

				swal.fire({

					text:  `Preencha os campos em vermelho!`,
					icon: "error",

				});

			}else{
				// this.formEl.submit();
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

			}else{

				if(field.name == 'produtos'){

					let divisao = field.value.split('/');
					data[field.name] = divisao[0];
					data['nomeProduto'] = divisao[1];

				}else{
					data[field.name] = field.value;
				}

			}

		});

		data['unidadeMedida'] = document.querySelector("#unidadeMedida").innerHTML;

		return !isValid ? false : data;

	}

	onChange(){

		let produto = this.formEl.querySelector("#produtos");



		produto.addEventListener("change", event => {

			this.searchUnidadeMedidaProduto(produto.value);

		});

	}

	searchUnidadeMedidaProduto(idProduto){

		$.ajax({

			type: "POST",
			url: this.rotaPesquisaUnidadeMedida,
			data: {idProduto, type: 3},
			success: data =>{
				let dados = JSON.parse(data);

				document.querySelector("#unidadeMedida").innerHTML = dados.SIGLA_UNIDADE_MEDIDA;
			}

		});

	}

	sendData(values){

		$.ajax({

			type: "POST",
			url: this.rotaSalvarProduto,
			data: values,
			success: data =>{
				let dados = JSON.parse(data);
				if (dados == "campos") {
					swal.fire({
						text: "Preencha os campos em branco",
						icon: "error"
					});
				} else {
					this.addLineTable(values);
				}
				// if (dados.id != undefined && dados.id != "") {
				// 	
				// }
			}

		});

	}

	addLineTable(values){

		let tr = document.createElement("tr");
		tr.innerHTML = 
			`
			<tr id="tr">
				<td class="idProduto">${values.produtos}</td>
				<td>${values.nomeProduto}</td>
				<td>${values.quantidade} ${values.unidadeMedida}</td>
				<td><button type='button' class='btn btn-danger btn-xs btn-delete'>Excluir</button></td>
			</tr>

			`;
		document.getElementById('corpoTabela').appendChild(tr);

		this.removeProduct(tr);

	}

	removeProduct(tr){

		tr.querySelector(".btn-delete").addEventListener("click", event =>{

			let idProduto 		= tr.querySelector(".idProduto").innerHTML;
			let codigoLicitacao = $("#codigoLicitacao").val();


			$.ajax({

				type: "POST",
				url: this.rotaRemoverProduto,
				data: {idProduto, codigoLicitacao},
				success: data =>{
					tr.remove();

				}

			});


		});

	}

}