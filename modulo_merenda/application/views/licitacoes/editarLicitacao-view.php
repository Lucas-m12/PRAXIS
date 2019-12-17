
        <div class="row" >
			<div class="col-lg-12">
				<div class="panel panel-default">
					<div class="panel-heading">Pedidos de Produtos</div>
					<div class="panel-body">
						<div class="row">
							<div class="col-lg-12">
								<form id="form-licitacao" method="POST" action="#" role="form">

									<div class="form-group col-lg-6">
										<label class="control-label">Código da Licitação</label>
										<input type="number" class="form-control" name="idLicitacao" id="idLicitacao" readonly value="<?php echo $dados['ID_LICITACAO'] ?>">
									</div>
									
									<div class="form-group col-lg-6">
										<label class="control-label">Número da Licitação</label>
										<input type="text" name="numeroLicitacao" id="numeroLicitacao" class="form-control" value="<?php echo $dados['NUMERO_LICITACAO'] ?>" >
									</div>

									<div class="form-group col-lg-6">
										<label class="control-label">Data de Ínicio</label>
										<input type="date" name="dataInicio" id="dataInicio" class="form-control" value="<?php echo $dados['DATA_INICIO'] ?>">
									</div>

									<div class="form-group col-lg-6">
										<label class="control-label">Fornecedor</label>
										<input type="text" name="fornecedor" id="fornecedor" class="form-control" value="<?php echo $dados['NOME_FORNECEDOR'] ?>">
									</div>									
									

									<div class="form-group col-lg-6">
										<label class="control-label">Data de Fim</label>
										<input type="date" name="dataFim" id="dataFim" class="form-control" value="<?php echo $dados['DATA_FIM'] ?>">
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
                    <a type="button" href="<?php echo base_url('licitacoes') ?>" class="btn btn-info" >Voltar</a>
                    <a href="<?php echo base_url('inicio') ?>" type="button" class="btn btn-danger">Fechar</a>
                    <button type="reset" class="btn btn-default">Limpar</button>
                    <button type="submit" class="btn btn-success" id="btn-finalizar" name="btn-finalizar">Finalizar Edição</button>
                </div>
                </form>
            </div>
        </div>

        <script src="<?php echo base_url('assets/scripts/class/Licitacao.js') ?>"></script>
        <script>
        	window.app = new Licitacao("form-licitacao", ['numeroLicitacao', 'dataInicio', 'dataFim'], "<?php echo base_url('atualizar-licitacao') ?>", "<?php echo base_url('licitacoes') ?>", 2);
        </script>


