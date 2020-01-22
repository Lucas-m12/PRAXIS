
        <?php if ($info[0]['STATUS'] == 1): ?>
        <div class="row" >
			<div class="col-lg-12">
				<div class="panel panel-default">
					<div class="panel-heading">Pedidos de Produtos</div>
					<div class="panel-body">
						<div class="row">
							<div class="col-lg-12">
								<form id="form-pedidos-edicao" method="POST" action="#" role="form">
									
									<div class="form-group col-lg-6">
										<label class="control-label">Código do Pedido</label>
										<input type="number" name="codigoPedido" id="codigoPedido" class="form-control" value="<?php echo $info[0]['CODIGO_PEDIDO'] ?>" readonly>
									</div>

									<div class="form-group col-lg-6">
										<label class="control-label">Selecione o Fornecedor</label>
										<input type="text" name="fornecedor" id="fornecedor" class="form-control" disabled value="<?php echo $info[0]['NOME_FORNECEDOR'] ?>">
									</div>

									<div class="form-group col-lg-6">
										<label class="control-label">Selecione o programa que receberá o pedido</label>
										<input type="text" name="programa" id="programa" class="form-control" value="<?php echo $info[0]['DESC_PROGRAMA'] ?>" disabled>
									</div>

									<div class="form-group col-lg-6">
										<label class="control-label">Situação do pedido</label>
										<select class="form-control" name="statusPedido" id="statusPedido">
											<option selected value="<?php echo $info[0]['STATUS'] ?>"><?php echo $info[0]['TIPO_STATUS'] ?> / <?php echo $info[0]['DESC_STATUS'] ?></option>
											<?php foreach ($status as $value): ?>
												<option value="<?php echo $value['ID_STATUS'] ?>"><?php echo $value['TIPO_STATUS'] ?> / <?php echo $value['DESC_STATUS'] ?></option>
											<?php endforeach ?>
										</select>
									</div>

									<div style="display: block;" id="oculta">

										<div class="form-group col-lg-6">
											<label class="control-label">Selecione os produtos do pedido</label>
											<!-- <input type="hidden" name="idPedido" id="idPedido" value=""> -->
											<select class="form-control" name="produtos" id="produtos">
												<option selected></option>
												<?php foreach ($produtos as $value): ?>
													<option value="<?php echo $value['ID_PRODUTO'] ?>/<?php echo $value['DESC_PRODUTO'] ?>/<?php echo $value['SIGLA_UNIDADE_MEDIDA'] ?>/<?php echo $value['SALDO'] ?>"><?php echo $value['DESC_PRODUTO']; ?></option>
												<?php endforeach ?>
											</select>
										</div>

										<div class="form-group col-lg-6">
											<label class="control-label">Quantidade do produto</label>
											<div class="input-group">
												<input type="number" name="quantidade" id="quantidade" class="form-control" placeholder="Digite a quantidade do produto">
												<span class="input-group-addon" id="unidadeMedida"></span>
											</div>
											<input type="hidden" name="idUnidadeMedida" id="idUnidadeMedida">
											<input type="hidden" name="saldo" id="saldo" value="">
										</div>

										<div class="form-group col-lg-6">
											<label></label>
											<button type="button" name="addProduto" id="addProduto" class="btn btn-primary">Adicionar</button>
										</div>
									</div>
								
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
                                        <th>NOME DO PRODUTO</th>
                                        <th>QUANTIDADE</th>
                                        <th>AÇÃO</th>
                                    </tr>
                                </thead>
                                <tbody id="corpoTabela">
                                	<?php foreach ($info as $value): ?>
                                		<tr id="tr">
                                			<td class="idProduto"><?php echo $value['ID_PRODUTO'] ?></td>
                                			<td><?php echo $value['DESC_PRODUTO'] ?></td>
                                			<td class="quantidadeProduto"><?php echo $value['QUANTIDADE'] ?> <?php echo $value['SIGLA_UNIDADE_MEDIDA'] ?></td>
                                			<td><button type="button" id="<?php echo $value['ID_PRODUTO'] ?>" class="btn btn-danger btn-xs btn-delete" onclick="excluirProdutoPedido(this.id, this)">Excluir</button></td>
                                		</tr>
                                	<?php endforeach ?>
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
                    <a href="<?php echo base_url('pedidos-escola') ?>" type="button" class="btn btn-info" onclick="history.go(-1)">Voltar</a>
                    <a href="<?php echo base_url('inicio') ?>" type="button" class="btn btn-danger">Fechar</a>
                    <button type="reset" class="btn btn-default">Limpar</button>
                    <button type="submit" class="btn btn-success" id="btn-finalizar" name="btn-finalizar">Atualizar</button>
                </div>
                </form>
            </div>
        </div>

        <script src="<?php echo base_url('assets/scripts/class/ItensPedidoEscola.js'); ?>"></script>
		<script>
			window.app = new ItensPedidoEscola("form-pedidos-edicao", "", "", "<?php echo base_url('cadastrar-itensPedidoEscola') ?>", "<?php echo base_url('excluir-itemPedidoEscola') ?>", "<?php echo base_url('finalizarPedidoEscola') ?>", "<?php echo base_url('pedidos-escola') ?>");
		</script>

        <?php else: ?>

        <div class="row" >
			<div class="col-lg-12">
				<div class="panel panel-default">
					<div class="panel-heading">Pedidos de Produtos</div>
					<div class="panel-body">
						<div class="row">
							<div class="col-lg-12">
								<form id="form-pedidos-edicao" method="POST" action="#" role="form">
									
									<div class="form-group col-lg-6">
										<label class="control-label">Código do Pedido</label>
										<input type="number" name="codigoPedido" id="codigoPedido" class="form-control" value="<?php echo $info[0]['CODIGO_PEDIDO'] ?>" readonly>
									</div>

									<div class="form-group col-lg-6">
										<label class="control-label">Selecione o Fornecedor</label>
										<input type="text" name="fornecedor" id="fornecedor" class="form-control" disabled value="<?php echo $info[0]['NOME_FORNECEDOR'] ?>">
									</div>

									<div class="form-group col-lg-6">
										<label class="control-label">Selecione o programa que receberá o pedido</label>
										<input type="text" name="programa" id="programa" class="form-control" value="<?php echo $info[0]['DESC_PROGRAMA'] ?>" disabled>
									</div>

									<div class="form-group col-lg-6">
										<label class="control-label">Situação do pedido</label>
										<select class="form-control" name="statusPedido" id="statusPedido">
											<option selected value="<?php echo $info[0]['STATUS'] ?>"><?php echo $info[0]['TIPO_STATUS'] ?> / <?php echo $info[0]['DESC_STATUS'] ?></option>
											<?php foreach ($status as $value): ?>
												<option value="<?php echo $value['ID_STATUS'] ?>"><?php echo $value['TIPO_STATUS'] ?> / <?php echo $value['DESC_STATUS'] ?></option>
											<?php endforeach ?>
										</select>
									</div>

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
                                        <th>PRODUTO</th>
                                        <th>QUANTIDADE</th>
                                    </tr>
                                </thead>
                                <tbody id="corpoTabela">
                                	<?php foreach ($info as $value): ?>
                                		<tr id="tr">
                                			<td><?php echo $value['ID_PRODUTO'] ?></td>
                                			<td><?php echo $value['DESC_PRODUTO'] ?></td>
                                			<td><?php echo $value['QUANTIDADE'] ?></td>
                                		</tr>
                                	<?php endforeach ?>
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
                    <a href="<?php echo base_url('pedidos-escola') ?>" type="button" class="btn btn-info" onclick="history.go(-1)">Voltar</a>
                    <a href="<?php echo base_url('inicio') ?>" type="button" class="btn btn-danger">Fechar</a>
                    <button type="reset" class="btn btn-default">Limpar</button>
                    <button type="submit" class="btn btn-success" id="btn-atualizar" name="btn-atualizar">Atualizar Situação</button>
                </div>
                </form>
            </div>
        </div>

        <script src="<?php echo base_url('assets/scripts/class/ItensPedidoEscola.js'); ?>"></script>
		<script type="text/javascript">
			window.app = new ItensPedidoEscola("form-pedidos-edicao", "", "", "", "", "<?php echo base_url('finalizarPedidoEscola') ?>", "<?php echo base_url('pedidos-escola') ?>");
		</script>

        <?php endif ?>

		<script>
			function excluirProdutoPedido(idProduto, linha) {
				let tr 			= $(linha).parent().parent();
				let quantidade 	= tr[0].querySelector(".quantidadeProduto").innerHTML.split(" ")[0]
				$.ajax({

					type: "POST",
					url: "<?php echo base_url('excluir-itemPedidoEscola') ?>",
					data: {idProduto, codigoPedido: $("#codigoPedido").val(), quantidade},
					success: data =>{
						window.location.reload();
					}
				});
			}
		</script>

	
	