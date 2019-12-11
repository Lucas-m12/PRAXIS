
        <div class="row" id="pesquisa">
			<div class="col-lg-12">
				<div class="panel panel-default">
					<div class="panel-heading">Pesquisar Licitação</div>
					<div class="panel-body">
						<div class="row">
							<div class="col-lg-12">
								<form id="form-pesquisa-licitacao" method="post" action="" role="form">
									
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
										<label class="control-label">Numero da Licitação</label>
										<input type="text" name="numeroLicitacaoPesquisa" id="numeroLicitacaoPesquisa" class="form-control">
									</div>

									<!-- <div class="form-group col-lg-6">
										<label class="control-label">Programa</label>
										<select name="programaPesquisa" id="programaPesquisa" class="form-control">
											<option disabled selected value="">SELECIONE O PROGRAMA</option>
											<?php foreach ($programas as $value): ?>
												<option value="<?php echo $value['ID_PROGRAMA'] ?>"><?php echo $value['DESC_PROGRAMA'] ?></option>
											<?php endforeach ?>
										</select>
									</div> -->

									<div class="form-group col-lg-6">
										<label class="control-label">Situação</label>
										<select name="statusPesquisa" id="statusPesquisa" class="form-control">
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
                                    	<th>CÓDIGO DA LICITAÇÃO</th>
                                        <th>NÚMERO</th>            
                                        <th>FORNECEDOR</th>
                                        <th>DATA DE INÍCIO</th>
                                        <th>DATA DE FIM</th>
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


        <div class="row" id="cadastro" style="display: none;">
			<div class="col-lg-12">
				<div class="panel panel-default">
					<div class="panel-heading">Nova Licitação</div>
					<div class="panel-body">
						<div class="row">
							<div class="col-lg-12">
								<form id="form-licitacao" method="post" action="" role="form">
									
									<div class="form-group col-lg-6">
										<label class="control-label">Número da Licitação</label>
										<input type="text" name="numeroLicitacao" id="numeroLicitacao" class="form-control" placeholder="DIGITE O NÚMERO DA LICITAÇÃO">
									</div>

									<div class="form-group col-lg-6">
										<label class="control-label">Fornecedor</label>
										<select name="fornecedor" id="fornecedor" class="form-control">
											<option value="">SELECIONE O FORNECEDOR</option>
											<?php foreach ($fornecedores as $value): ?>
												<option value="<?php echo $value['CODIGO_FORNECEDOR'] ?>"><?php echo $value['NOME_FORNECEDOR'] ?></option>
											<?php endforeach ?>
										</select>
									</div>

									<div class="form-group col-lg-6">
										<label class="control-label">Data de Início</label>
										<input type="date" name="inicio" id="inicio" class="form-control">
									</div>

									<div class="form-group col-lg-6">
										<label class="control-label">Data de Fim</label>
										<input type="date" name="fim" id="fim" class="form-control">
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
                    <a href="<?php echo base_url('inicio') ?>" type="button" class="btn btn-info">Voltar</a>
                    <a href="<?php echo base_url('inicio')?>" type="button" class="btn btn-danger">Fechar</a>
                    <button type="reset" class="btn btn-default">Limpar</button>
                    <button type="button" class="btn btn-success" id="btn-cadastrar" name="btn-cadastrar" onclick="mostrar()">Nova Licitacao</button>
                    <button type="submit" class="btn btn-success" id="avancar" name="avancar" style="display: none;">Avançar</button>
                    </form>
                </div>
            </div>
        </div>

	<script src="<?php echo base_url('assets/scripts/class/Pesquisa.js') ?>"></script>
	<script>
		window.app = new Pesquisa("form-pesquisa-licitacao", "<?php echo base_url('pesquisa-licitacao') ?>", 5, "<?php echo base_url('editar-licitacao') ?>", "<?php echo base_url('editar-licitacao') ?>", "<?php echo base_url('relatorio-licitacao') ?>");
	</script>

	<script src="<?php echo base_url('assets/scripts/class/Licitacao.js') ?>"></script>
	<script>
		window.app = new Licitacao("form-licitacao", ['numeroLicitacao', 'fornecedor', 'inicio', 'fim'], "<?php echo base_url('cadastrar-licitacao') ?>", "<?php echo base_url('itens-licitacao') ?>");
	</script>


	<script>
		function mostrar(){

			$("#pesquisa").hide();
			$("#tabela").hide();
			$("#btn-cadastrar").hide();
			$("#avancar").show();
			$("#cadastro").show();

		}
	</script>