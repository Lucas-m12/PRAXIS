class ItensPedido{

	constructor(formEl){

		this.formEl = document.getElementById(formEl);

		this.onChange();
		this.saveProduct();
		this.onSubmit();

	}


	onSubmit(){
		
		this.formEl.addEventListener("submit", event =>{

			event.preventDefault();

			[...this.formEl.elements].filter(element =>{

				if(element.name == "statusPedido"){

					$.ajax({
						type: "POST",
						url: "/praxis/modulo_merenda/editar/situacaoPedido",
						data: {statusPedido: element.value, codigoPedido: $("#codigoPedido").val()},
						success: data =>{

							window.location.href="/praxis/modulo_merenda/pedidos";

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

			if (["quantidade", "produtos", "idUnidadeMedida", "categoria"].indexOf(field.name) > -1 && !field.value) {

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

				alert("Produto já existe no pedido");

				return true;

			}

		});

		return !isValid ? false : data;

	}


	onChange(){

		let categoria 	= this.formEl.querySelector("#categoria");
		let fornecedor 	= this.formEl.querySelector("#fornecedor");
		let produto 	= this.formEl.querySelector("#produtos");
		let programa 	= this.formEl.querySelector("#programa");
		let avancar 	= document.querySelector("#btn-avancar");

		categoria.addEventListener("change", event => {
			$("#produtos").empty();
			this.searchProdutosFornecedor(categoria.value);

		});

		fornecedor.addEventListener("change", event => {

			$("#categoria").empty();
			this.searchCategoriaProduto(fornecedor.value);

		});

		produto.addEventListener("change", event => {

			this.searchUnidadeMedidaProduto(produto.value);

		});

	}

	searchUnidadeMedidaProduto(dado){

		$.ajax({

			type: "POST",
			url: "/praxis/modulo_merenda/pedidos/pesquisa/fornecedores",
			data: {dado, type: 3},
			success: data =>{
				let dados = JSON.parse(data);
				$("#idUnidadeMedida").val(dados.ID_UNIDADE_MEDIDA);
				document.querySelector("#unidadeMedida").innerHTML = dados.SIGLA_UNIDADE_MEDIDA;
			}

		});

	}

	searchCategoriaProduto(dado){

		$.ajax({

			type: "POST",
			url:"/praxis/modulo_merenda/pedidos/pesquisa/fornecedores",
			data: {dado, type: 1},
			success: data =>{
				let dados = JSON.parse(data);
				let categoria = $("#categoria");

				categoria.append("<option value='' disabled selected></option>");

				dados.forEach((field, index) => {

					categoria.append(
						`<option value="${field.ID_CATEGORIA}">${field.DESC_CATEGORIA}</option>`
					);

				});

			}

		});

	}
		
	searchProdutosFornecedor(dado){

		$.ajax({

			type: "POST",
			url: "/praxis/modulo_merenda/pedidos/pesquisa/fornecedores",
			data: {dado, type: 2},
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

	}

	sendDataProduct(values){

		$.ajax({

			type: "POST",
			url: "/praxis/modulo_merenda/pedidos/item",
			data: values,
			success: data =>{
				this.addLineTable(values);
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
				url: `/praxis/modulo_merenda/excluir/produto-pedido`,
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