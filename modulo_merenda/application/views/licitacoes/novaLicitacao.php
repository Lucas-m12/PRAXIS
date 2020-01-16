
        <div class="row" >
			<div class="col-lg-12">
				<div class="panel panel-default">
					<div class="panel-heading">Licitação</div>
					<div class="panel-body">
						<div class="row">
							<div class="col-lg-12">
								<form id="form-licitacao" method="POST" action="#" role="form">
									
									<div class="form-group col-lg-6">
										<label class="control-label">Número da Licitação</label>
										<input type="text" name="numeroLicitacao" id="numeroLicitacao" class="form-control" value="">
									</div>

									<div class="form-group col-lg-6">
										<label class="control-label">Data de Ínicio</label>
										<input type="date" name="dataInicio" id="dataInicio" class="form-control" value="">
									</div>

									<div class="form-group col-lg-6">
										<label class="control-label">Fornecedor</label>
										<input type="text" name="fornecedor" id="fornecedor" class="form-control" value="">
									</div>									
									

									<div class="form-group col-lg-6">
										<label class="control-label">Data de Fim</label>
										<input type="date" name="dataFim" id="dataFim" class="form-control" value="">
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
                    <button type="button" class="btn btn-info" onclick="history.go(-1)">Voltar</button>
                    <a href="<?php echo base_url('inicio') ?>" type="button" class="btn btn-danger">Fechar</a>
                    <button type="reset" class="btn btn-default">Limpar</button>
                    <button type="submit" class="btn btn-success" id="btn-finalizar" name="btn-finalizar">Avançar</button>
                </div>
                </form>
            </div>
        </div>



	<script src="<?php echo base_url('assets/scripts/class/Licitacao.js'); ?>"></script>
	<script>
		window.app = new Licitacao("form-licitacao", "<?php echo base_url('pesquisa-produtoForn') ?>", "<?php echo base_url('pesquisa-unidadeMedida') ?>", "<?php echo base_url('cadastrar-itensPedido') ?>", "<?php echo base_url('excluir-itemPedido') ?>", "<?php echo base_url('editar-statusPedido') ?>", "<?php echo base_url('inicio') ?>");
	</script>

    <script>
        $(".chosen-select").chosen({
                placeholder_text_single : 'Selecione o produto',
                width: "95%",
                no_results_text: "Nada Encontrado"
            }); 
    </script>