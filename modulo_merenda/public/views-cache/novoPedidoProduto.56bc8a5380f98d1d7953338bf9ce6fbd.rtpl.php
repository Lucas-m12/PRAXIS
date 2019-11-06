<?php if(!class_exists('Rain\Tpl')){exit;}?>	<div id="page-wrapper">
		
		<div class="row">
             <!-- page header -->
            <div class="page-header"></div>
            <!--end page header -->
        </div>

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
										<input type="number" name="codigoPedido" id="codigoPedido" class="form-control" value="<?php echo htmlspecialchars( $codPedido, ENT_COMPAT, 'UTF-8', FALSE ); ?>" readonly>
									</div>


									<div class="form-group col-lg-6">
										<label class="control-label">Fornecedor</label>
										<input type="text" name="fornecedor" id="fornecedor" class="form-control" disabled value="<?php echo htmlspecialchars( $dados["NOME_FORNECEDOR"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
									</div>

									<div class="form-group col-lg-6">
										<label class="control-label">Programa</label>
										<input type="text" name="programa" id="programa" class="form-control" value="<?php echo htmlspecialchars( $dados["DESC_PROGRAMA"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" disabled>
									</div>

									<div class="form-group col-lg-6">
										<label class="control-label">Selecione a categoria do produto</label>
										<select class="form-control" name="categoria" id="categoria">
											<option disabled selected></option>
											<?php $counter1=-1;  if( isset($categorias) && ( is_array($categorias) || $categorias instanceof Traversable ) && sizeof($categorias) ) foreach( $categorias as $key1 => $value1 ){ $counter1++; ?>
												<option value="<?php echo htmlspecialchars( $value1["ID_CATEGORIA"], ENT_COMPAT, 'UTF-8', FALSE ); ?>"><?php echo htmlspecialchars( $value1["DESC_CATEGORIA"], ENT_COMPAT, 'UTF-8', FALSE ); ?></option>
											<?php } ?>
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
                    <a href="/praxis/modulo_merenda/" type="button" class="btn btn-danger">Fechar</a>
                    <button type="reset" class="btn btn-default">Limpar</button>
                    <button type="button" class="btn btn-success" id="btn-finalizar" name="btn-finalizar" onclick="window.location.href='/praxis/modulo_merenda/pedidos' ">Finalizar Cadastro</button>
                </div>
            </div>
        </div>
	</div>



	<script src="\praxis/modulo_merenda/public/scripts/controllers/ItensPedido.js"></script>
	<script src="\praxis/modulo_merenda/public/scripts/itensPedido.js"></script>
	