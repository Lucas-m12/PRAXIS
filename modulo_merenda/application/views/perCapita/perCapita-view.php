		
		<div class="row" id="oculta">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Lista de Programas</div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                    <tr>
                                                                            
                                        <th>NÍVEL DE ENSINO</th>
                                        <th>AÇÃO</th>

                                    </tr>
                                </thead>
                                <tbody>

                                    <?php foreach ($niveisEnsino as $value): ?>
                                    	<tr>
                                    		<td class="nivelEnsino"><?php echo $value['ID_NIVEL_ENSINO'] ?></td>
                                    		<td><?php echo $value['DS_NIVEL_ENSINO'] ?></td>
                                    		<td><select class="form-control produto">
                                    			<option selected value="">SELECIONE O PRODUTO</option>
                                    			<?php foreach ($produtos as $produto): ?>
                                    				<option value="<?php echo $produto['ID_PRODUTO'] ?>"><?php echo $produto['DESC_PRODUTO'] ?></option>
                                    			<?php endforeach ?>
                                    		</select></td>
                                    		<td><input type="number" name="percapita" class="form-control percapita"></td>
                                    		<td><button type="button" class="btn btn-primary btn-xs" onclick="adicionar(this)">Adicionar</button></td>
                                    	</tr>
                                    <?php endforeach ?>
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- <div class="row" >
			<div class="col-lg-12">
				<div class="panel panel-default">
					<div class="panel-heading">PerCapita</div>
					<div class="panel-body">
						<div class="row">
							<div class="col-lg-12">
								<form id="form-perCapita" method="POST" action="#" role="form">
									
									<div class="form-group col-lg-6">
										<label class="control-label">Produto</label>
										<input type="number" name="codigoPedido" id="codigoPedido" class="form-control" readonly>
									</div>

									<div class="form-group col-lg-6">
										<label class="control-label">Selecione o Fornecedor</label>
										<select class="form-control" name="fornecedor" id="fornecedor">
											<option value="" selected></option>
											<?php foreach ($fornecedores as $value): ?>
												<option value="<?php echo $value['CODIGO_FORNECEDOR'] ?>"><?php echo $value['NOME_FORNECEDOR']; ?></option>
											<?php endforeach ?>
										</select>
									</div>

									<div class="form-group col-lg-6">
										<label class="control-label">Selecione o programa que receberá o pedido</label>
										<select class="form-control" name="programa" id="programa">
											<option disabled selected></option>
											<?php foreach ($programas as $value): ?>
												<option value="<?php echo $value['ID_PROGRAMA'] ?>"><?php echo $value['DESC_PROGRAMA'] ?></option>
											<?php endforeach ?>
										</select>
									</div>

									
									
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div> -->

		




		<div class="panel panel-default">
            <div class="panel-heading">
                <div align="center">
                    <a type="button" class="btn btn-info" href="<?php echo base_url('perCapita') ?>">Voltar</a>
                    <a href="<?php echo base_url('inicio') ?>" type="button" class="btn btn-danger">Fechar</a>
                    <button type="reset" class="btn btn-default">Limpar</button>
                    <a type="button" class="btn btn-success" id="btn-avancar" name="btn-avancar" href="<?php echo base_url('perCapita') ?>">Finalizar</a>
                </div>
            </div>
        </div>



        <script type="text/javascript">
        	function adicionar(linha){

        		let tr = $(linha).parent().parent();

        		let nivelEnsino = tr[0].querySelector(".nivelEnsino").innerHTML;
        		let produto 	= tr[0].querySelector(".produto").value;
        		let percapita 	= tr[0].querySelector(".percapita").value;

        		$.ajax({

        			type: "POST",
        			url: "<?php echo base_url('cadastrar-perCapita') ?>",
        			data: {nivelEnsino, produto, percapita},
        			success: data =>{

        				if (JSON.parse(data) != "") {
        					swal.fire({

        						text: "Adicionado com sucesso",
        						icon: "success"

        					}).then(()=>{
        						produto.disabled 	= true;
        						percapita.disabled 	= true;
        						linha.disabled 		= true;
        					});
        				}

        			}

        		});
        	}
        </script>