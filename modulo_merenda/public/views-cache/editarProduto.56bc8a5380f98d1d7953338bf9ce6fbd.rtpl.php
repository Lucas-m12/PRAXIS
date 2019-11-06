<?php if(!class_exists('Rain\Tpl')){exit;}?>	<div id="page-wrapper">
		<div class="row">
             <!-- page header -->
            <div class="page-header"></div>
            <!--end page header -->
        </div>


        <div class="row">
        	<div class="col-lg-12">
        		<div class="panel panel-default">
        			<div class="panel-heading">Cadastro de Produto</div>
        			<div class="panel-body">
        				<div class="row">
        					<div class="col-lg-12">
        						<form method="post" action="/praxis/modulo_merenda/cadastrar/produto/<?php echo htmlspecialchars( $info["ID_PRODUTO"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" role="form" id="form-produto" onsubmit="">
        							
                                    <div class="form-group col-lg-12">
                                        <label class="control-label">Código do produto</label>
                                        <input type="number" name="idProduto" id="idProduto" value="<?php echo htmlspecialchars( $info["ID_PRODUTO"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" class="form-control" disabled>
                                    </div>

                                    <div class="form-group col-lg-6">
                                        <label>Categoria do Produto</label>
                                        <select name="categoriaProduto" id="categoriaProduto" class="form-control" required>
                                            <option value="<?php echo htmlspecialchars( $info["ID_CATEGORIA"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" selected><?php echo htmlspecialchars( $info["DESC_CATEGORIA"], ENT_COMPAT, 'UTF-8', FALSE ); ?></option>
                                            <?php $counter1=-1;  if( isset($categoria) && ( is_array($categoria) || $categoria instanceof Traversable ) && sizeof($categoria) ) foreach( $categoria as $key1 => $value1 ){ $counter1++; ?>
                                                <option value="<?php echo htmlspecialchars( $value1["ID_CATEGORIA"], ENT_COMPAT, 'UTF-8', FALSE ); ?>"><?php echo htmlspecialchars( $value1["DESC_CATEGORIA"], ENT_COMPAT, 'UTF-8', FALSE ); ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>

                                    <div class="form-group col-lg-6">
                                        <label>Tipo de Produto</label>
                                        <select name="tipoProduto" id="tipoProduto" class="form-control" required>
                                            <option value="<?php echo htmlspecialchars( $info["ID_TIPO"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" selected><?php echo htmlspecialchars( $info["TIPO_PRODUTO"], ENT_COMPAT, 'UTF-8', FALSE ); ?></option>
                                            <?php $counter1=-1;  if( isset($tipo) && ( is_array($tipo) || $tipo instanceof Traversable ) && sizeof($tipo) ) foreach( $tipo as $key1 => $value1 ){ $counter1++; ?>
                                                <option value="<?php echo htmlspecialchars( $value1["ID_TIPO"], ENT_COMPAT, 'UTF-8', FALSE ); ?>"><?php echo htmlspecialchars( $value1["TIPO_PRODUTO"], ENT_COMPAT, 'UTF-8', FALSE ); ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>

                                    <div class="form-group col-lg-6">
                                        <label>Unidade de Medida</label>
                                        <select name="unidadeMedida" id="unidadeMedida" class="form-control" required>
                                            <option value="<?php echo htmlspecialchars( $info["ID_UNIDADE_MEDIDA"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" selected><?php echo htmlspecialchars( $info["DESC_UNIDADE_MEDIDA"], ENT_COMPAT, 'UTF-8', FALSE ); ?></option>
                                            <?php $counter1=-1;  if( isset($unidade) && ( is_array($unidade) || $unidade instanceof Traversable ) && sizeof($unidade) ) foreach( $unidade as $key1 => $value1 ){ $counter1++; ?>
                                                <option value="<?php echo htmlspecialchars( $value1["ID_UNIDADE_MEDIDA"], ENT_COMPAT, 'UTF-8', FALSE ); ?>"><?php echo htmlspecialchars( $value1["DESC_UNIDADE_MEDIDA"], ENT_COMPAT, 'UTF-8', FALSE ); ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>

        							<div class="form-group col-lg-6">
        								<label>Nome do Produto</label>
        								<input type="text" name="produto" id="produto" class="form-control" autocomplete="off" value="<?php echo htmlspecialchars( $info["DESC_PRODUTO"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" placeholder="Digite o nome do produto" required>
        							</div>

                                    <div class="form-group col-lg-6">
                                        <input type="checkbox" name="status" id="status" <?php if( $info["STATUS"] == 2 ){ ?> checked <?php } ?> value="2" >Inativo
                                    </div>

        							<!-- <div class="form-group">
        								<button type="submit" name="cadastrarProduto" id="cadastrarProduto" class="btn btn-success btn-block">Cadastrar Produto</button>
        							</div> -->

        						
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
                    <a href="/praxis/modulo_merenda/" type="button" class="btn btn-danger">Fechar</a>
                    <button type="reset" class="btn btn-default">Limpar</button>
                    <button type="submit" class="btn btn-success" id="cadastrarProduto" name="cadastrarProduto">Salvar</button>
                </div>
                </form>
            </div>
        </div>

	</div>


    <script src="\praxis/modulo_merenda/public/scripts/controllers/Produto.js"></script>
    <script src="\praxis/modulo_merenda/public/scripts/cadastroProduto.js"></script>
