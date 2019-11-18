
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
										<label class="control-label">Selecione o Fornecedor</label>
										<select class="form-control" name="fornecedor" id="fornecedor">
											<option disabled selected></option>
											<?php foreach ($fornecedores as $value): ?>
												<option value="<?php echo $value['CODIGO_FORNECEDOR'] ?>"><?php echo $value['NOME_FORNECEDOR'] . " / " . $value['CNPJ_FORNECEDOR']; ?></option>
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
		</div>

		




		<div class="panel panel-default">
            <div class="panel-heading">
                <div align="center">
                    <button type="button" class="btn btn-info" onclick="history.go(-1)">Voltar</button>
                    <a href="/{$cidade}/modulo_merenda/" type="button" class="btn btn-danger">Fechar</a>
                    <button type="reset" class="btn btn-default">Limpar</button>
                    <button type="button" class="btn btn-success" id="btn-avancar" name="btn-avancar">Avançar</button>
                </div>
            </div>
        </div>



	<script src="<?php echo base_url('assets/scripts/class/Pedido.js') ?>"></script>
	<!-- <script src="<?php echo base_url('assets/scripts/instancias/novoPedido.php') ?>"></script> -->
	<script>
		window.app = new Pedido("form-pedidos", ["codigoPedido", "fornecedor", "programa"], "<?php echo base_url("cadastrar-pedido") ?>", "<?php echo base_url("produtosPedido") ?>");
	</script>
	