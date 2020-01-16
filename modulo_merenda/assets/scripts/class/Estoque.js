class Estoque{

	constructor(formEl, rotaPesquisa, rotaChange){

		this.formEl 		= document.getElementById(formEl);
		this.rotaPesquisa 	= rotaPesquisa;
		this.rotaChange		= rotaChange;

		this.search();
		this.onChange();

	}


	onChange(){

		let categoria = document.querySelector("#categorias");

		categoria.addEventListener("change", event =>{

			$.ajax({

				type: "POST",
				url: this.rotaChange,
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
				url: this.rotaPesquisa,
				data: values,
				success: data =>{
					let dados = JSON.parse(data);

					if (dados.length == 0) {
						swal.fire({
							title: "Falha!",
							text: "Nada encontrado no estoque",
							icon: "warning"
						});
					}

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