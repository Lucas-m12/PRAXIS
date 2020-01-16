class ItensPedido{

	constructor(formEl, pesquisaProduto, pesquisaUnidadeMedida, salvarProduto, removerProduto, editarStatus = "", rotaPedido = ""){

		this.formEl 					= document.getElementById(formEl);
		this.rotaPesquisaProduto 		= pesquisaProduto;
		this.rotaPesquisaUnidadeMedida 	= pesquisaUnidadeMedida;
		this.rotaSalvarProduto 			= salvarProduto;
		this.rotaremoverProduto			= removerProduto;
		this.rotaEdicaoStatus			= editarStatus;
		this.rotaPedido					= rotaPedido;

		this.onSubmit();
		this.saveProduct();
		this.onChange();

	}


	onSubmit(){
		
		this.formEl.addEventListener("submit", event =>{

			event.preventDefault();

			[...this.formEl.elements].filter(element =>{

				if(element.name == "statusPedido"){
					$.ajax({
						type: "POST",
						url: this.rotaEdicaoStatus,
						data: {statusPedido: element.value, codigoPedido: $("#codigoPedido").val()},
						success: data =>{

							window.location.href=this.rotaPedido;

						}

					});

				}

			});

		});

	}


	saveProduct(){

		document.querySelector("#addProduto").addEventListener("click", event =>{

			let values = this.getValuesProducts(this.formEl);
			if (values != false) {
				this.sendDataProduct(values);
			}

		});

	}

	getValuesProducts(formEl){

		let data = {};
		let isValid = true;
		let produtoTabela = document.querySelectorAll("#tr");

		

		[...formEl.elements].forEach((field, index) =>{

			if (["quantidade", "produtos"].indexOf(field.name) > -1 && !field.value) {

				field.parentElement.classList.add('has-error');

				isValid = false;

			}

			if (field.name != "fornecedor" && field.name != "programa" && field.name != "addProduto") {

				if(field.name == 'produtos'){

					let divisao 			= field.value.split('/');
					data[field.name] 		= divisao[0];
					data['nomeProduto'] 	= divisao[1];
					data['unidadeMedida']	= divisao[2];

				}else{
					data[field.name] = field.value;
				}

			}

		});

		[...produtoTabela].filter(elem=>{

			if (elem.childNodes[1].innerHTML == data.produtos){
				
				isValid = false;

				swal.fire({
					text:"Produto já existe no pedido",
					icon:"error"
				});

			}

		});

		return !isValid ? false : data;

	}

	onChange(){

		let produto 	= document.querySelector("#produtos");
		let quantidade	= document.querySelector("#quantidade");
		let saldoEl		= document.querySelector("#saldo");
		let btn 		= document.querySelector("#addProduto");

		produto.addEventListener("change", event =>{

			let dados		 	= produto.value.split('/');
			let saldo 			= dados[3];
			let unidadeMedida 	= dados[2];

			document.querySelector("#unidadeMedida").innerHTML 	= unidadeMedida;
			saldoEl.value = saldo;

		});

		quantidade.addEventListener("keyup", event =>{

			if (parseFloat(quantidade.value) > parseFloat(saldoEl.value)) {

				swal.fire({
					text: "Quantidade excede o limite licitado",
					icon: "error"
				})
				quantidade.parentElement.classList.remove('has-success');
				quantidade.parentElement.classList.add('has-error');
				btn.disabled = true;

			} else if (parseFloat(quantidade.value) < parseFloat(saldoEl.value)) {
				quantidade.parentElement.classList.remove('has-error');
				quantidade.parentElement.classList.add('has-success');
				btn.disabled = false;

			}
			

		});



		// let produto 	= this.formEl.querySelector("#produtos");
		// let avancar 	= document.querySelector("#btn-avancar");

		// produto.addEventListener("change", event => {

		// 	this.searchUnidadeMedidaProduto(produto.value);

		// });

	}

	/*searchUnidadeMedidaProduto(idProduto){

		$.ajax({

			type: "POST",
			url: this.rotaPesquisaUnidadeMedida,
			data: {idProduto, type: 3},
			success: data =>{
				let dados = JSON.parse(data);
				$("#idUnidadeMedida").val(dados.ID_UNIDADE_MEDIDA);
				document.querySelector("#unidadeMedida").innerHTML = dados.SIGLA_UNIDADE_MEDIDA;
			}

		});

	}*/

	// searchCategoriaProduto(dado){

	// 	$.ajax({

	// 		type: "POST",
	// 		url:"/praxis/modulo_merenda/pedidos/pesquisa/fornecedores",
	// 		data: {dado, type: 1},
	// 		success: data =>{
	// 			let dados = JSON.parse(data);
	// 			let categoria = $("#categoria");

	// 			categoria.append("<option value='' disabled selected></option>");

	// 			dados.forEach((field, index) => {

	// 				categoria.append(
	// 					`<option value="${field.ID_CATEGORIA}">${field.DESC_CATEGORIA}</option>`
	// 				);

	// 			});

	// 		}

	// 	});

	// }
		
	/*searchProdutosFornecedor(idCategoria){

		$.ajax({

			type: "POST",
			url: this.rotaPesquisaProduto,
			data: {idCategoria, type: 2},
			success: data =>{
				let dados = JSON.parse(data);

				let produtos = $("#produtos");

				produtos.append("<option value='' disabled selected></option>");

				dados.forEach((field, index) => {
					produtos.append(
						`
						<option value="${field.ID_PRODUTO}/${field.DESC_PRODUTO}">${field.DESC_PRODUTO}</option>

						`
					);

				});

			}

		});

	}*/

	sendDataProduct(values){

		$.ajax({

			type: "POST",
			url: this.rotaSalvarProduto,
			data: values,
			success: data =>{

				let dados = JSON.parse(data);
				if (dados.ID_PRODUTO != undefined && dados.ID_PRODUTO != "") {
					this.addLineTable(values);
				}
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
				<td class="quantidadeProduto">${values.quantidade} ${values.unidadeMedida}</td>
				<td><button type='button' class='btn btn-danger btn-xs btn-delete'>Excluir</button></td>
			</tr>

			`;
		document.getElementById('corpoTabela').appendChild(tr);

		this.removeProduct(tr);

	}

	removeProduct(tr){

		tr.querySelector(".btn-delete").addEventListener("click", event =>{

			let idProduto 	= tr.querySelector(".idProduto").innerHTML;
			let codigoPedido= $("#codigoPedido").val();
			let quantidade 	= tr.querySelector(".quantidadeProduto").innerHTML.split(" ")[0];


			$.ajax({

				type: "POST",
				url: this.rotaremoverProduto,
				data: {idProduto, codigoPedido, quantidade},
				success: data =>{
					console.log(data);
					tr.remove();

				}

			});


		});

	}

	resetForm(){

		$("#produtos").empty();
		$("#quantidade").empty();
		$("#idUnidadeMedida").empty();

	}

}