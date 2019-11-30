
        <div class="row" >
			<div class="col-lg-12">
				<div class="panel panel-default">
					<div class="panel-heading">Pedidos de Produtos</div>
					<div class="panel-body">
						<div class="row">
							<div class="col-lg-12">
								<form id="form-pesquisa-pedidos" method="post" action="" role="form">
									
									<div class="form-group col-lg-6">
										<label class="control-label">Escola</label>
										<select name="escolaPesquisa" id="escolaPesquisa" class="chosen-select">
											<option selected value="">SELECIONE A ESCOLA</option>
											<?php foreach ($escolas as $value): ?>
												<option value="<?php echo $value['ID_ESCOLA'] ?>"><?php echo $value['NOME_ESCOLA'] ?> / <?php echo $value['INEP_ESCOLA'] ?></option>
											<?php endforeach ?>
										</select>
									</div>

									<div class="form-group col-lg-6">
										<label class="control-label">Situação</label>
										<select name="statusPedidoPesquisa" id="statusPedidoPesquisa" class="chosen-select">
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
                                        <th>ESCOLA</th>
                                        <th>DATA</th>
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
                    <a href="<?php echo base_url('inicio') ?>" type="button" class="btn btn-info">Voltar</a>
                    <a href="<?php echo base_url('inicio') ?>" type="button" class="btn btn-danger">Fechar</a>
                    <button type="reset" class="btn btn-default">Limpar</button>
                    <button type="button" class="btn btn-success" id="btn-cadastrar" name="btn-cadastrar" onclick="" disabled="">Novo</button>
                    
                </div>
            </div>
        </div>

	<script src="<?php echo base_url('assets/scripts/class/Pesquisa.js') ?>"></script>
	<script>
		window.app = new Pesquisa("form-pesquisa-pedidos", "<?php echo base_url('lista-pedidoEscola') ?>", 4);
	</script>
	<link href="<?php echo base_url('vendor/harvesthq/chosen/chosen.css') ?>" rel="stylesheet" >
    <link href="<?php echo base_url('vendor/harvesthq/chosen/chosen.min.css') ?>" rel="stylesheet" >   
    <script src="<?php echo base_url('vendor/harvesthq/chosen/chosen.jquery.js'); ?>"></script>
    <script src="<?php echo base_url('vendor/harvesthq/chosen/chosen.jquery.min.js'); ?>"></script>
    <script src="<?php echo base_url('vendor/harvesthq/chosen/chosen.proto.js'); ?>"></script>
    <script src="<?php echo base_url('vendor/harvesthq/chosen/chosen.proto.min.js'); ?>"></script>
    <script>
        $(".chosen-select").chosen({
                placeholder_text_single : 'Selecione as categorias',
                width: "95%",
                no_results_text: "Nenhuma categoria encontrada"
            }); 
    </script>