
        <div class="row" >
			<div class="col-lg-12">
				<div class="panel panel-default">
					<div class="panel-heading">Pedidos de Produtos</div>
					<div class="panel-body">
						<div class="row">
							<div class="col-lg-12">
								<form id="form-pedidos" method="POST" action="#" role="form">
									
									<div class="form-group col-lg-6">
										<label class="control-label">Código do Pedido</label>
										<input type="number" name="codigoPedido" id="codigoPedido" class="form-control" value="<?php echo $codigo ?>" readonly>
									</div>


									<div class="form-group col-lg-6">
										<label class="control-label">Fornecedor</label>
										<input type="text" name="fornecedor" id="fornecedor" class="form-control" disabled value="<?php echo $pedido['NOME_FORNECEDOR'] ?>">
									</div>

									<div class="form-group col-lg-6">
										<label class="control-label">Programa</label>
										<input type="text" name="programa" id="programa" class="form-control" value="<?php echo $pedido['DESC_PROGRAMA'] ?>" disabled>
									</div>

									<div class="form-group col-lg-6">
										<label class="control-label">Selecione a categoria do produto</label>
										<select class="form-control" name="categoria" id="categoria">
											<option disabled selected></option>
											<?php foreach ($categorias as $value): ?>
												<option value="<?php echo $value['ID_CATEGORIA'] ?>"><?php echo $value['DESC_CATEGORIA'] ?></option>
											<?php endforeach ?>
										</select>
									</div>

									<div class="form-group col-lg-6">
										<label class="control-label">Selecione os produtos do pedido</label>
										<select class="form-control" name="produtos" id="produtos">
											<option disabled selected></option>
											
										</select>
									</div>

									<div class="form-group col-lg-6">
										<label class="control-label">Quantidade do produto</label>
										<div class="input-group">
											<input type="number" name="quantidade" id="quantidade" class="form-control" placeholder="Digite a quantidade do produto">
											<span class="input-group-addon" id="unidadeMedida"></span>
										</div>
										<input type="hidden" name="idUnidadeMedida" id="idUnidadeMedida">
									</div>

									<div class="form-group col-lg-12">
										<label></label>
										<button type="button" name="addProduto" id="addProduto" class="btn btn-primary">Adicionar</button>
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
                                        <th>CÓDIGO DO PRODUTO</th>            
                                        <th>NOME</th>
                                        <th>QUANTIDADE</th>
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
                    <a href="/{$cidade}/modulo_merenda/" type="button" class="btn btn-danger">Fechar</a>
                    <button type="reset" class="btn btn-default">Limpar</button>
                    <button type="button" class="btn btn-success" id="btn-finalizar" name="btn-finalizar" onclick="window.location.href='<?php echo base_url(); ?>pedidos'">Finalizar Cadastro</button>
                </div>
            </div>
        </div>



	<script src="<?php echo base_url('assets/scripts/class/ItensPedido.js'); ?>"></script>
	<script>
		window.app = new ItensPedido("form-pedidos", "<?php echo base_url('pesquisa-produtoForn') ?>", "<?php echo base_url('pesquisa-unidadeMedida') ?>", "<?php echo base_url('cadastrar-itensPedido') ?>", "<?php echo base_url('excluir-itemPedido') ?>", "<?php echo base_url('editar-statusPedido') ?>", "<?php echo base_url('inicio') ?>");
	</script>	