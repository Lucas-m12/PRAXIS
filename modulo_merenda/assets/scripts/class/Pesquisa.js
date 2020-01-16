class Pesquisa{

	constructor(formEl, rotaBusca, typeSearch, rotaEdicao = "", rotaDestino = "", rotaImpressao = ""){

		this.formEl 	= document.getElementById(formEl);

		this.rotaBusca 	= rotaBusca;

		this.typeSearch = typeSearch;

		this.rotaEdicao = rotaEdicao;

		this.rotaDestino = rotaDestino;

		this.rotaImpressao = rotaImpressao;

		this.onSubmit();

		switch (this.typeSearch){

			case 2:
				this.codFornecedor();
			break;

			case 3:
				this.codPedido();
			break;

		}

	}

	onSubmit(){

		let btn = this.formEl.querySelector("[type=button]");

		btn.addEventListener("click", event =>{

			let values = this.getValues(this.formEl, btn);

			switch(this.typeSearch){

				case 1:
					this.searchDataProduto(values);
				break;

				case 2:
					this.searchDataFornecedor(values);
				break;

				case 3:
					this.searchDataPedidos(values);
				break;

				case 4:
					this.searchDataPedidosEscola(values);
				break;

				case 5:
					this.searchDataLicitacoes(values);
				break;

				case 6:
					this.searchDataReceitas(values);
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
		let corpo = $("#corpoTabela");
		corpo.empty();
		$.ajax({

			type: "POST",
			url: this.rotaBusca,
			data: values,
			success: data => {
				let dados = JSON.parse(data);

				if (dados.length == 0) {
					swal.fire({
						title: "Falha!",
						text: "Nenhum produto encontrado",
						icon: "warning"
					});
				} else {

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
								<td><a href='editar-produto/${field.ID_PRODUTO}' class="btn btn-default btn-xs">Editar<a></td>
							</tr>`
							);
						
					});
				}
			}

		});

	}

	searchDataFornecedor(values){
		let data = values;
		let corpo = $("#corpoTabela");
		corpo.empty();
		$.ajax({

			type: "POST",
			url: this.rotaBusca,
			data,
			success: data => {
				let dados = JSON.parse(data);

				if (dados.length == 0) {
					swal.fire({
						title: "Falha!",
						text: "Nenhum fornecedor encontrado",
						icon: "warning"
					});
				} else {

					dados.forEach((field, index) => {
						corpo.append(

							`<tr>
								<td>${field.CODIGO_FORNECEDOR}</td>
								<td>${field.NOME_FORNECEDOR}</td>
								<td>${field.CNPJ_FORNECEDOR}</td>
								<td><a href='editar-fornecedor/${field.CODIGO_FORNECEDOR}' type='button' class='btn btn-default btn-xs'>Editar</a></td>
							</tr>`
							);
						
					});

				}

				
				$("#btn-novo").prop("disabled", false);
			}

		});

	}


	searchDataPedidos(values){

		let data 	= values;
		let corpo 	= $("#corpoTabela");

		$.ajax({

			type: "POST",
			url: this.rotaBusca,
			data,
			success: data =>{
				let dados = JSON.parse(data);

				corpo.empty();


				if (dados.length == 0) {
					swal.fire({
						title: "Falha!",
						text: "Nenhum pedido encontrado",
						icon: "warning"
					});
				} else {

					dados.forEach((field, index) => {
						let editar = "";

						if (field.ID_STATUS != false && field.ID_STATUS != 4 && field.ID_STATUS != 3) {
							editar = `<a href='${this.rotaEdicao}/${field.CODIGO_PEDIDO}' class='btn btn-default btn-xs'>editar</a>`
						}
						


						let tr = document.createElement("tr");

						tr.innerHTML = 
							`<tr>
						 		<td>${field.CODIGO_PEDIDO}</td>
						 		<td>${field.DATA_PEDIDO}</td>
						 		<td>${field.NOME_FORNECEDOR}</td>
						 		<td><button class="btn btn-xs btn-outline" type="button" name="btn-status" style="color: ${field.COR};">${field.TIPO_STATUS}</button></td>
						 		<td><a href="${this.rotaImpressao}/${field.CODIGO_PEDIDO}/pedido" type="button" class="btn btn-success btn-xs" target="new">Imprimir</a>         ${editar}</td>
						 	`
						 document.getElementById('corpoTabela').appendChild(tr);

					});
				}
			}

		});

	}

	searchDataPedidosEscola(values){

		let corpo = $("#corpoTabela");

		$.ajax({

			type: "POST",
			url: this.rotaBusca,
			data: values,
			success: data =>{
				let dados = JSON.parse(data);
				corpo.empty();

				dados.forEach((field, index) =>{

					corpo.append(`

						<tr>
							<td>${field.CODIGO_PEDIDO}</td>
							<td>${field.NOME_ESCOLA}</td>
							<td>${field.DATA_PEDIDO}</td>
							<td>${field.TIPO_STATUS}</td>
							<td><a type="button" href="${this.rotaEdicao}/${field.CODIGO_PEDIDO}" class="btn btn-default btn-xs">Editar</a></td>
						</tr>

					`);

				});

			}

		});

	}

	codPedido(){
		document.querySelector("#btn-cadastrar").addEventListener("click", event =>{

			$.ajax({

				type: 'POST',
				url: "codigo-pedido",
				data: {teste: "teste"},
				success: data=>{
					let dados = JSON.parse(data);
					window.location.href=`novoPedido/${dados.CODIGO_PEDIDO}`
				}

			})

		});

	}


	codFornecedor(){
		document.querySelector("#btn-novo").addEventListener("click", event =>{
            $.ajax({
            	type: "POST",
            	url: "codigo-fornecedor",
            	data: {teste: "teste"},
            	success: data =>{
            		let dados = JSON.parse(data);
            		
		            window.location.href=`novoFornecedor/${dados.CODIGO_FORNECEDOR}`;
            	}
            });

		});
	}

	searchDataLicitacoes(values){

		let corpo = $("#corpoTabela");

		$.ajax({

			type: "POST",
			url: this.rotaBusca,
			data: values,
			success: data =>{
				let dados = JSON.parse(data);

				if (dados == "" || dados == undefined || dados.length < 1) {
					swal.fire({
						title: "Falha!",
						text: "Nenhuma licitação encontrada",
						icon: "warning"
					});
				}else{

					dados.forEach(field =>{

						corpo.append(
							`
							<tr>

								<td>${field.ID_LICITACAO}</td>
								<td>${field.NUMERO_LICITACAO}</td>
								<td>${field.NOME_FORNECEDOR}</td>
								<td>${field.DATA_INICIO}</td>
								<td>${field.DATA_FIM}</td>
								<td><a href="${this.rotaImpressao}/${field.ID_LICITACAO}/licitacao" class="btn btn-success btn-xs" target="new">Imprimir</a>       <a href="${this.rotaDestino}/${field.ID_LICITACAO}" class="btn btn-default btn-xs">Editar</a></td>

							</tr>

							`
						);

					});

				}

			}

		});

	}

	searchDataReceitas(values){

		let corpo = $("#corpoTabela");

		$.ajax({

			type: "POST",
			url: this.rotaBusca,
			data: values,
			success: data =>{
				let dados = JSON.parse(data);

				if (dados == "" || dados == undefined || dados.length < 1) {
					swal.fire({
						title: "Falha!",
						text: "Nenhuma receita encontrada",
						icon: "warning"
					});
				}else{

					dados.forEach(field =>{

						corpo.append(
							`
							<tr>

								<td>${field.ID_RECEITA}</td>
								<td>${field.NOME_RECEITA}</td>
								<td>${field.DS_NIVEL_ENSINO}</td>
								<td><a href="${this.rotaEdicao}/${field.ID_RECEITA}" class="btn btn-default btn-xs">Editar</a></td>

							</tr>

							`
						);

					});

				}

			}

		});

	}


}