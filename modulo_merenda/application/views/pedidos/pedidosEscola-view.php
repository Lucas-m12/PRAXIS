
        <div class="row" >
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
												<option value="<?php echo $value['ID_ESCOLA'] ?>"><?php echo $value['NOME_ESCOLA'] . ' / ' . $value['INEP_ESCOLA'] ?></option>
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
		</div>

		<div class="row" id="tabela" style="display: block;">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="table-responsive">
                            <table class="table table-hover">
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

                                </tbody>
                            </table>
                        </div>                                                    
                    </div>
                </div>
            </div>
        </div>




		<div class="panel panel-default">
            <div class="panel-heading">
                <div align="center">
                    <button type="button" class="btn btn-info" onclick="history.go(-1)">Voltar</button>
                    <a href="<?php echo base_url('inicio')?>" type="button" class="btn btn-danger">Fechar</a>
                    <button type="reset" class="btn btn-default">Limpar</button>
                    <button type="button" class="btn btn-success" id="btn-cadastrar" name="btn-cadastrar" onclick="">Novo</button>
                    
                </div>
            </div>
        </div>

	<script src="<?php echo base_url('assets/scripts/class/PesquisaEscola.js') ?>"></script>
	<script>
		window.app = new PesquisaEscola("form-pesquisa-pedidos", "<?php echo base_url('pesquisa-pedidoEscola') ?>", 2, "<?php echo base_url('editarPedidoEscola') ?>");
	</script>
