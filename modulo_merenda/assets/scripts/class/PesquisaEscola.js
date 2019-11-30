class PesquisaEscola{

	constructor(formEl, rotaBusca, typeSearch, rotaEdicao = ""){

		this.formEl 	= document.getElementById(formEl);

		this.rotaBusca 	= rotaBusca;

		this.typeSearch = typeSearch;

		this.rotaEdicao = rotaEdicao;

		this.onSubmit();


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
					this.searchDataPedidos(values);
					this.codPedidoEscola();
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


	// searchDataProduto(values){
	// 	let corpo = $("#corpoTabela");
	// 	$.ajax({

	// 		type: "POST",
	// 		url: this.rotaBusca,
	// 		data: values,
	// 		success: data => {
	// 			let dados = JSON.parse(data);

	// 			if (dados.length == 0) {
	// 				swal.fire({
	// 					title: "Falha!",
	// 					text: "Nenhum produto encontrado",
	// 					icon: "warning"
	// 				});
	// 			} else {

	// 				let status;
					
	// 				dados.forEach((field, index) => {
	// 					status = field.STATUS == 1 ? "ATIVO" : "INATIVO";
						
	// 					corpo.append(
	// 						`<tr>
	// 							<td>${field.ID_PRODUTO}</td>
	// 							<td>${field.TIPO_PRODUTO}</td>
	// 							<td>${field.DESC_CATEGORIA}</td>
	// 							<td>${field.DESC_PRODUTO}</td>
	// 							<td>${field.SIGLA_UNIDADE_MEDIDA}</td>
	// 							<td>${status}</td>
	// 							<td><a href='editar-produto/${field.ID_PRODUTO}' class="btn btn-default btn-xs">Editar<a></td>
	// 						</tr>`
	// 						);
						
	// 				});
	// 			}
	// 		}

	// 	});

	// }


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

						if (field.ID_STATUS != false && field.ID_STATUS != 4) {
							editar = `<a href='${this.rotaEdicao}/${field.CODIGO_PEDIDO}' class='btn btn-default btn-xs'>editar</a>`
						}
						


						let tr = document.createElement("tr");

						tr.innerHTML = 
							`<tr>
						 		<td>${field.CODIGO_PEDIDO}</td>
						 		<td>${field.DATA_PEDIDO}</td>
						 		<td>${field.NOME_ESCOLA}</td>
						 		<td><button class="btn btn-xs btn-outline" type="button" name="btn-status" style="color: ${field.COR};">${field.TIPO_STATUS}</button></td>
						 		<td>${editar}</td>
						 	`
						 document.getElementById('corpoTabela').appendChild(tr);

					});
				}
			}

		});

	}

	codPedidoEscola(){
		document.querySelector("#btn-cadastrar").addEventListener("click", event =>{

			$.ajax({

				type: 'POST',
				url: "codigo-pedidoEscola",
				data: {teste: "teste"},
				success: data=>{
					let dados = JSON.parse(data);
					window.location.href=`novoPedidoEscola/${dados.CODIGO_PEDIDO_ESCOLA}`
				}

			})

		});

	}

	

}