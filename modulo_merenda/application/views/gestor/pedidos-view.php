        <!-- <div class="row" >
			<div class="col-lg-12">
				<div class="panel panel-default">
					<div class="panel-heading">Pedidos de Produtos</div>
					<div class="panel-body">
						<div class="row">
							<div class="col-lg-12">
								<form id="form-pesquisa-pedidos" method="post" action="" role="form">
									
									<div class="form-group col-lg-6">
										<label class="control-label">Fornecedor</label>
										<select name="fornecedorPesquisa" id="fornecedorPesquisa" class="form-control">
											<option disabled selected value="">SELECIONE O FORNECEDOR</option>

											<?php foreach ($fornecedores as $value): ?>
												<option value="<?php echo $value['CODIGO_FORNECEDOR'] ?>"><?php echo $value['NOME_FORNECEDOR'] . ' / ' . $value['CNPJ_FORNECEDOR'] ?></option>
											<?php endforeach ?>

										</select>
									</div>

									<div class="form-group col-lg-6">
										<label class="control-label">Data do Pedido</label>
										<input type="date" name="dataPesquisa" id="dataPesquisa" class="form-control">
									</div>

									<div class="form-group col-lg-6">
										<label class="control-label">Programa</label>
										<select name="programaPesquisa" id="programaPesquisa" class="form-control">
											<option disabled selected value="">SELECIONE O PROGRAMA</option>
											<?php foreach ($programas as $value): ?>
												<option value="<?php echo $value['ID_PROGRAMA'] ?>"><?php echo $value['DESC_PROGRAMA'] ?></option>
											<?php endforeach ?>
										</select>
									</div>

									<div class="form-group col-lg-6">
										<label class="control-label">Situação</label>
										<select name="statusPedidoPesquisa" id="statusPedidoPesquisa" class="form-control">
											<option disabled selected value="">SELECIONE A SITUAÇÃO</option>

											<?php foreach ($status as $situacao): ?>
												<option value="<?php echo $situacao['ID_STATUS'] ?>"><?php echo $situacao['TIPO_STATUS'] ?></option>
											<?php endforeach ?>

										</select>
									</div>

									<div class="form-group col-lg-6">
										<button type="button" class="btn btn-success" id="btn-pesquisar">Pesquisar</button>
									</div>

								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div> -->
        <div class="row">
                <div class="col-lg-12">
                    <!-- Advanced Tables -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                             Pedidos
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTablesPedidos">
                                    <thead>
                                        <tr>
                                            <th>NÚMERO DO PEDIDO</th>            
	                                        <th>DATA</th>
	                                        <th>FORNECEDOR</th>
	                                        <th>SITUAÇÃO</th>
	                                        <th>AÇÃO</th>
                                        </tr>
                                    </thead>
                                    <tbody id="corpoTabela">
	                                	<?php foreach ($dados as $value): ?>
	                                		<tr class="odd gradeX">
	                                			<td><?php echo $value['CODIGO_PEDIDO'] ?></td>
	                                			<td><?php echo $value['DATA_PEDIDO'] ?></td>
	                                			<td><?php echo $value['NOME_FORNECEDOR'] ?></td>
	                                			<td><?php echo $value['DESC_STATUS'] ?></td>
	                                			<td><?php if ($value['STATUS'] == 1): ?>
	                                				<a type="button" href="<?php echo base_url('edicaoPedido-gestor/') . $value['CODIGO_PEDIDO'] ?>" class="btn btn-default btn-xs">Editar</a>
	                                			<?php endif ?> </td>
	                                		</tr>
	                                	<?php endforeach ?>
	                                </tbody>
                                    <!-- <tbody>
                                        <tr class="odd gradeX">
                                            <td>Trident</td>
                                            <td>Internet Explorer 4.0</td>
                                            <td>Win 95+</td>
                                            <td class="center">4</td>
                                            <td class="center">X</td>
                                        </tr>
                                        
                                    </tbody> -->
                                </table>
                            </div>
                            
                        </div>
                    </div>
                    <!--End Advanced Tables -->
                </div>
            </div>




		<div class="panel panel-default">
            <div class="panel-heading">
                <div align="center">
                    <a href="<?php echo base_url('inicio') ?>" type="button" class="btn btn-info">Voltar</a>
                    <a href="<?php echo base_url('inicio')?>" type="button" class="btn btn-danger">Fechar</a>
                    <button type="reset" class="btn btn-default">Limpar</button>
                    <!-- <button type="button" class="btn btn-success" id="btn-cadastrar" name="btn-cadastrar" onclick="">Novo Pedido</button> -->
                    
                </div>
            </div>
        </div>

	<script src="<?php echo base_url('assets/scripts/class/Pesquisa.js') ?>"></script>
	<script>
		window.app = new Pesquisa("form-pesquisa-pedidos", "<?php echo base_url('pesquisa-pedido') ?>", 3, "<?php echo base_url('editar-pedido') ?>", "", "<?php echo base_url('relatorio'); ?>");
	</script>