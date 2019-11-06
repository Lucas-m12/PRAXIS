class Estoque{

	constructor(formEl){

		this.formEl = document.getElementById(formEl);

		this.search();
		this.onChange();

	}


	onChange(){

		let categoria = document.querySelector("#categorias");

		categoria.addEventListener("change", event =>{

			$.ajax({

				type: "POST",
				url: "/praxis/modulo_merenda/pesquisa/produtos",
				data: {idCategoria: categoria.value},
				success: data =>{
					let dados = JSON.parse(data);

					dados.forEach((field, index) =>{

						$("#produtos").append(

							`<option value="${field.ID_PRODUTO}">${field.DESC_PRODUTO}</option>`

						);

					});

					

				}

			});

		});



	}


	search(){

		this.formEl.addEventListener("submit", event =>{

			event.preventDefault();

			let tabela = $("#corpoTabela");

			let values = {};

			[...this.formEl.elements].forEach((field, index) => {
				if (field.name != "pesquisarEstoque" && field.name != "" && field.name != "categorias") {

					values[field.name] = field.value;

				}

			});
			
			$.ajax({

				type: "POST",
				url: "/praxis/modulo_merenda/pesquisa/estoque",
				data: values,
				success: data =>{
					let dados = JSON.parse(data);

					console.log(dados)

					tabela.empty();

					dados.forEach(info =>{

						tabela.append(

							`<tr>

								<td>${info.DESC_PROGRAMA}</td>
								<td>${info.DESC_PRODUTO}</td>
								<td>${info.ESTOQUE_ATUAL} ${info.SIGLA_UNIDADE_MEDIDA}</td>

							</tr>`

						);

					});

				}

			});

		});

	}


}