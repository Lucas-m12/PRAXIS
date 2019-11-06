<?php if(!class_exists('Rain\Tpl')){exit;}?>		
        <div class="row">
        	<div class="col-lg-12">
        		<div class="panel panel-default">
        			<div class="panel-heading">Estoque</div>
        			<div class="panel-body">
        				<div class="row">
        					<div class="col-lg-12">
                                <form id="pesquisa-estoque" method="post" action="#" role="form">
                                    <div class="form-group col-lg-6">
                                        <label class="control-label">Programa</label>
                                        <select class="form-control" name="programa" id="programa">
                                            <option selected></option>
                                            <?php $counter1=-1;  if( isset($programas) && ( is_array($programas) || $programas instanceof Traversable ) && sizeof($programas) ) foreach( $programas as $key1 => $value1 ){ $counter1++; ?>
                                                <option value="<?php echo htmlspecialchars( $value1["ID_PROGRAMA"], ENT_COMPAT, 'UTF-8', FALSE ); ?>"><?php echo htmlspecialchars( $value1["DESC_PROGRAMA"], ENT_COMPAT, 'UTF-8', FALSE ); ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>

                                    <div class="form-group col-lg-6">
                                        <label class="control-label">Categoria</label>
                                        <select class="form-control" name="categorias" id="categorias">
                                            <option selected></option>
                                            <?php $counter1=-1;  if( isset($categorias) && ( is_array($categorias) || $categorias instanceof Traversable ) && sizeof($categorias) ) foreach( $categorias as $key1 => $value1 ){ $counter1++; ?>
                                                <option value="<?php echo htmlspecialchars( $value1["ID_CATEGORIA"], ENT_COMPAT, 'UTF-8', FALSE ); ?>"><?php echo htmlspecialchars( $value1["DESC_CATEGORIA"], ENT_COMPAT, 'UTF-8', FALSE ); ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>

                                    <div class="form-group col-lg-6">
                                        <label class="control-label">Produto</label>
                                        <select class="form-control" name="produtos" id="produtos">
                                            <option selected></option>
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
                                        <th>PROGRAMA</th>            
                                        <th>PRODUTO</th>
                                        <th>ESTOQUE ATUAL</th>
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
                    <button type="submit" name="pesquisarEstoque" id="pesquisarEstoque" class="btn btn-success">Pesquisar</button>
                </div>
                </form>
            </div>
        </div>

    <script src="\praxis/modulo_merenda/public/scripts/controllers/Estoque.js"></script>
    <script src="\praxis/modulo_merenda/public/scripts/estoque.js"></script>