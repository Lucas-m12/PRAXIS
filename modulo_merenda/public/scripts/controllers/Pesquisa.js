class Pesquisa{

	constructor(formEl, urlBusca, typeSearch){

		this.formEl = document.getElementById(formEl);

		this.urlBusca = urlBusca;

		this.typeSearch = typeSearch;

		this.search();
		// this.codPedido();
		// this.codFornecedor();

	}


	search(){

		let btn = this.formEl.querySelector("[type=button]");

		btn.addEventListener("click", event => {
			let values = this.getValues(this.formEl, btn);

			switch(this.typeSearch){

				case 1:
					this.searchDataProduto(values);
				break;

				case 2:
					this.searchDataFornecedor(values);
					this.codFornecedor();
				break;

				case 3:
					this.searchDataPedidos(values);
					this.codPedido();
				break;

			}

		});

	}

	getValues(formEl, btn){

		let data = {};

		[...formEl.elements].forEach((field, index) => {

			if (field.name != btn.name) {

				data[field.name] = field.value;

			}

		});

		return data;

	}


	searchDataProduto(values){
		let data = values;
		let corpo = $("#corpoTabela");
		$.ajax({

			type: "POST",
			url: this.urlBusca,
			data,
			success: data => {
				let dados = JSON.parse(data);

				let status;
				
				dados.forEach((field, index) => {
					status = field.STATUS == 1 ? "ATIVO" : "INATIVO";
					
					corpo.append(
						`<tr>
							<td>${field.ID_PRODUTO}</td>
							<td>${field.TIPO_PRODUTO}</td>
							<td>${field.DESC_CATEGORIA}</td>
							<td>${field.DESC_PRODUTO}</td>
							<td>${field.SIGLA_UNIDADE_MEDIDA}</td>
							<td>${status}</td>
							<td><a href='/praxis/modulo_merenda/edicao/produto/${field.ID_PRODUTO}' class="btn btn-default btn-xs">Editar<a></td>
						</tr>`
						);
					
				});
			}

		});

	}

	searchDataFornecedor(values){
		let data = values;
		let corpo = $("#corpoTabela");
		$.ajax({

			type: "POST",
			url: this.urlBusca,
			data,
			success: data => {
				let dados = JSON.parse(data);
				
				dados.forEach((field, index) => {
					corpo.append(

						`<tr>
							<td>${field.ID_FORNECEDOR}</td>
							<td>${field.NOME_FORNECEDOR}</td>
							<td>${field.CNPJ_FORNECEDOR}</td>
							<td><a href='/praxis/modulo_merenda/edicao/fornecedor/${field.CODIGO_FORNECEDOR}' type='button' class='btn btn-default'>Editar</a></td>
						</tr>`
						);
					
				});
				$("#btn-novo").prop("disabled", false);
			}

		});

	}


	searchDataPedidos(values){

		let data 	= values;
		let corpo 	= $("#corpoTabela");

		$.ajax({

			type: "POST",
			url: this.urlBusca,
			data,
			success: data =>{
				let dados = JSON.parse(data);

				corpo.empty();
				dados.forEach((field, index) => {
					let editar = "";

					if (field.ID_STATUS != false && field.ID_STATUS != 4) {
						editar = `<a href='/praxis/modulo_merenda/edicao/pedido/${field.CODIGO_PEDIDO}' class='btn btn-default btn-xs'>editar</a>`
					}
					


					let tr = document.createElement("tr");

					tr.innerHTML = 
						`<tr>
					 		<td>${field.CODIGO_PEDIDO}</td>
					 		<td>${field.DATA_PEDIDO}</td>
					 		<td>${field.NOME_FORNECEDOR}</td>
					 		<td><button class="btn btn-xs btn-outline" type="button" name="btn-status" style="color: ${field.COR};">${field.TIPO_STATUS}</button></td>
					 		<td>${editar}</td>
					 	`
					 document.getElementById('corpoTabela').appendChild(tr);

				});
			}

		});

	}

	codPedido(){
		document.querySelector("#btn-cadastrar").addEventListener("click", event =>{

			$.ajax({

				type: 'POST',
				url: "/praxis/modulo_merenda/pesquisa/codigo/pedido",
				data: {teste: "teste"},
				success: data=>{
					let dados = JSON.parse(data);
					window.location.href=`/praxis/modulo_merenda/cadastro/pedido/${dados.CODIGO_PEDIDO}`
				}

			})

		});

	}

	codFornecedor(){
		document.querySelector("#btn-novo").addEventListener("click", event =>{
            $.ajax({
            	type: "POST",
            	url: "/praxis/modulo_merenda/codFornecedores",
            	data: {teste: "teste"},
            	success: data =>{
            		let dados = JSON.parse(data);
            		// console.log(dados)
            		// $("#pesquisa").css("display", "none");
		            // $("#tabela").css("display", "none");
		            // $("#oculta").css("display", "block");
		            // $("#btn-novo").remove();
		            // $("#btn-finalizar").show();
		            // $("#codFornecedor").val(dados.CODIGO_FORNECEDOR);
		            
		            window.location.href=`/praxis/modulo_merenda/fornecedor/${dados.CODIGO_FORNECEDOR}/novo`;
            	}
            });

		});
	}

}