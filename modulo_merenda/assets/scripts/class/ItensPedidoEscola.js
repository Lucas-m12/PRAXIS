class ItensPedidoEscola{

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

							swal.fire({
								title: "Pedido atualizado com sucesso",
								icon: "success"
							}).then(pedido => {
								window.location.href=this.rotaPedido;
							});

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

					let divisao = field.value.split('/');
					data[field.name] = divisao[0];
					data['nomeProduto'] = divisao[1];

				}else{
					data[field.name] = field.value;
				}

			}

		});

		data["unidadeMedida"] = this.formEl.querySelector("#unidadeMedida").innerHTML;

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

		let produto 	= this.formEl.querySelector("#produtos");
		let quantidade	= this.formEl.querySelector("#quantidade");
		let avancar 	= document.querySelector("#btn-avancar");

		if (this.formEl.id != "form-pedidos-edicao") {
			let categoria 	= this.formEl.querySelector("#categoria");
			categoria.addEventListener("change", event => {
				$("#produtos").empty();
				this.searchProdutosFornecedor(categoria.value);

			});
		}

		produto.addEventListener("change", event => {

			// $("#idUnidadeMedida").val()
			let dados = produto.value.split("/");
			document.querySelector("#unidadeMedida").innerHTML = dados[2];
			$("#saldo").val(dados[3]);

			this.searchUnidadeMedidaProduto(dados[0])

		});

		quantidade.addEventListener("keyup", event => {

			let saldo = this.formEl.querySelector("#saldo").value;
			if (parseFloat(quantidade.value) > parseFloat(saldo)) {

				quantidade.parentElement.classList.add('has-error');

				this.formEl.querySelector("#addProduto").disabled = true;

				console.log(saldo)

			} else {

				quantidade.parentElement.classList.remove('has-error');
				quantidade.parentElement.classList.add('has-success');

				this.formEl.querySelector("#addProduto").disabled = false;

			}

		});

	}

	searchUnidadeMedidaProduto(idProduto){

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

	}

		
	searchProdutosFornecedor(idCategoria){

		$.ajax({

			type: "POST",
			url: this.rotaPesquisaProduto,
			data: {idCategoria, type: 2},
			success: data =>{
				let dados = JSON.parse(data);

				let produtos = $("#produtos");

				produtos.append("<option value='' selected></option>");

				dados.forEach((field, index) => {
					produtos.append(
						`
						<option value="${field.ID_PRODUTO}/${field.DESC_PRODUTO}">${field.DESC_PRODUTO}</option>

						`
					);

				});

			}

		});

	}

	sendDataProduct(values){

		$.ajax({

			type: "POST",
			url: this.rotaSalvarProduto,
			data: values,
			success: data =>{

				let dados = JSON.parse(data);
				if (dados.id != undefined && dados.id != "") {
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
				<td>${values.quantidade} ${values.unidadeMedida}</td>
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


			$.ajax({

				type: "POST",
				url: this.rotaremoverProduto,
				data: {idProduto, codigoPedido},
				success: data =>{
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