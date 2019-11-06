<?php if(!class_exists('Rain\Tpl')){exit;}?>
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
											<option disabled selected value="">Selecione o Fornecedor</option>
											<?php $counter1=-1;  if( isset($fornecedor) && ( is_array($fornecedor) || $fornecedor instanceof Traversable ) && sizeof($fornecedor) ) foreach( $fornecedor as $key1 => $value1 ){ $counter1++; ?>
												<option value="<?php echo htmlspecialchars( $value1["CODIGO_FORNECEDOR"], ENT_COMPAT, 'UTF-8', FALSE ); ?>"><?php echo htmlspecialchars( $value1["NOME_FORNECEDOR"], ENT_COMPAT, 'UTF-8', FALSE ); ?></option>
											<?php } ?>
										</select>
									</div>

									<div class="form-group col-lg-6">
										<label class="control-label">Data do Pedido</label>
										<input type="date" name="dataPesquisa" id="dataPesquisa" class="form-control">
									</div>

									<div class="form-group col-lg-6">
										<label class="control-label">Programa</label>
										<select name="programaPesquisa" id="programaPesquisa" class="form-control">
											<option selected></option>
											<?php $counter1=-1;  if( isset($programas) && ( is_array($programas) || $programas instanceof Traversable ) && sizeof($programas) ) foreach( $programas as $key1 => $value1 ){ $counter1++; ?>
												<option value="<?php echo htmlspecialchars( $value1["ID_PROGRAMA"], ENT_COMPAT, 'UTF-8', FALSE ); ?>"><?php echo htmlspecialchars( $value1["DESC_PROGRAMA"], ENT_COMPAT, 'UTF-8', FALSE ); ?></option>
											<?php } ?>
										</select>
									</div>

									<div class="form-group col-lg-6">
										<label class="control-label">Situação</label>
										<select name="statusPedidoPesquisa" id="statusPedidoPesquisa" class="form-control">
											<option selected></option>
											<?php $counter1=-1;  if( isset($status) && ( is_array($status) || $status instanceof Traversable ) && sizeof($status) ) foreach( $status as $key1 => $value1 ){ $counter1++; ?>
												<option value="<?php echo htmlspecialchars( $value1["ID_STATUS"], ENT_COMPAT, 'UTF-8', FALSE ); ?>"><?php echo htmlspecialchars( $value1["TIPO_STATUS"], ENT_COMPAT, 'UTF-8', FALSE ); ?></option>
											<?php } ?>
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
                    <a href="/praxis/modulo_merenda/" type="button" class="btn btn-danger">Fechar</a>
                    <button type="reset" class="btn btn-default">Limpar</button>
                    <button type="button" class="btn btn-success" id="btn-cadastrar" name="btn-cadastrar" onclick="">Novo</button>
                </div>
            </div>
        </div>

	<script src="\praxis/modulo_merenda/public/scripts/controllers/Pesquisa.js"></script>
	<script src="\praxis/modulo_merenda/public/scripts/pesquisaPedido.js"></script>

	<script type="text/javascript">
		
		

	</script>