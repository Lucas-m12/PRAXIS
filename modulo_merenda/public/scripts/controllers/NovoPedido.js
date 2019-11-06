/*class NovoPedido{

	constructor(formEl, idBusca, array){
		this.formEl = document.getElementById(formEl);
		this.idBusca = idBusca;
		this.array = array;


		this.onChange();
		this.onSubmit();

	}

	onChange(){

		this.formEl.querySelector(this.idBusca).addEventListener("change", event => {

			let idFornecedor = $(this.idBusca).val();
			let corpo = $("#corpoTabela");
			$.ajax({

				type:"POST",
				url:"/praxis/modulo_merenda/pedidos/fornecedor",
				data: {idFornecedor: idFornecedor},
				success: data =>{
					let dados = JSON.parse(data);
					dados.forEach((field, index) => {

						corpo.append(

						`<tr>
							<td>${field.ID_PRODUTO}</td>
							<td>${field.TIPO_PRODUTO}</td>
							<td>${field.DESC_CATEGORIA}</td>
							<td>${field.DESC_PRODUTO}</td>
							<td>${field.SIGLA_UNIDADE_MEDIDA}</td>
							<td>${field.NOME_FORNECEDOR} / ${field.CNPJ_FORNECEDOR}</td>
							<td><input type='checkbox' value='${field.ID_PRODUTO}' name='produtos${index}'></td>
						</tr>`

					);

					});

					$("#btn-cadastrar").prop("disabled", false);
					
				}

			});

		});

	}

	onSubmit(){

		this.formEl.addEventListener("submit", event => {

			event.preventDefault();

            let btn = $("#btn-cadastrar").attr('name');

			// btn.disabled = true;

			let values = this.getValues(this.formEl, btn);

			if (!values) {
				return false;
			}else{
				console.log(values)

				// this.formEl.reset();

				// btn.disabled = false;
			}

		});

	}

	getValues(formEl, btn){

		let data = {};
		let isValid = true;

		[...formEl.elements].forEach((field, index) => {

			if (['produtos[]'].indexOf(field.name) > -1 && !field.value) {

				field.parentElement.classList.add('has-error');

				isValid = false;

			}


			if (field.name == `produtos${index}`) {
					data[field.name] = field.value;
			}
		});

		console.log(data)

		// return !isValid ? false : data;

	}


}