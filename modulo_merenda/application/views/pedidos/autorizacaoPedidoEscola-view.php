
        <div class="row" >
			<div class="col-lg-12">
				<div class="panel panel-default">
					<div class="panel-heading">Informações do Pedido</div>
					<div class="panel-body">
						<div class="row">
							<div class="col-lg-12">
								<form id="form-autorizacao" method="POST" action="<?php echo base_url('autorizar-pedidoEscola') ?>" role="form">
									
									<div class="form-group col-lg-6">
										<label>Código do Pedido</label>
										<input type="number" name="codigoPedido" id="codigoPedido" value="<?php echo $dados[0]['CODIGO_PEDIDO'] ?>" class="form-control" readonly>	
									</div>

									<div class="form-group col-lg-6">
										<label>Data</label>
										<input type="date" name="data" id="data" value="<?php echo explode(" ", $dados[0]['DATA_PEDIDO'])[0]?>" class="form-control" disabled>
									</div>

									<div class="form-group col-lg-6">
										<label>Programa</label>
										<input type="text" name="programa" id="programa" value="<?php echo $dados[0]['DESC_PROGRAMA'] ?>" class="form-control" disabled>
									</div>

									<div class="form-group col-lg-6">
										<label>Escola</label>
										<input type="text" name="fornecedor" id="fornecedor" value="<?php echo $dados[0]['NOME_FORNECEDOR'] ?>" class="form-control" disabled>
									</div>


									<div class="form-group">
				                        <div class="table-responsive">
				                            <table class="table table-hover">
				                                <thead>
				                                    <tr>                    
				                                        <th>CÓDIGO DO PRODUTO</th>            
				                                        <th>NOME</th>
				                                        <th>QUANTIDADE</th>
				                                    </tr>
				                                </thead>
				                                <tbody id="corpoTabela">
				                                    <?php foreach ($dados as $value): ?>
				                                    	<tr>
				                                    		<td><?php echo $value['ID_PRODUTO']?></td>
				                                    		<td><?php echo $value['DESC_PRODUTO']?></td>
				                                    		<td><?php echo $value['QUANTIDADE'] . " " . $value['DESC_UNIDADE_MEDIDA']?></td>
				                                    	</tr>
													<?php endforeach ?>            
				                                </tbody>
				                            </table>
				                        </div>
				                    </div>


							</div>
						</div>
					</div>
				</div>
			</div>
		</div>



		<div class="panel panel-default">
            <div class="panel-heading">
                <div align="center">
                    <a type="button" href="<?php echo base_url('pedidos-pendentesEscola') ?>" class="btn btn-info">Voltar</a>
                    <a href="<?php echo base_url('inicio') ?>" type="button" class="btn btn-danger">Fechar</a>
                    <button type="reset" class="btn btn-default">Limpar</button>
                    <button type="submit" class="btn btn-success" id="btn-autorizar" name="btn-autorizar">Autorizar Pedido</button>
                </div>
                </form>
            </div>
        </div>

        <script type="text/javascript">
        	$(document).ready(function(){
        		var formEl = document.getElementById('form-autorizacao');

        		formEl.addEventListener("submit", event => {

        			event.preventDefault();

        			swal.fire({
        				title: "Deseja autorizar o pedido ?",
        				icon: "warning",
					  	confirmButtonText: 'Autorizar Pedido',
        			}).then((result) => {
        				formEl.submit();
        			});

        		});

        	});
        </script>
