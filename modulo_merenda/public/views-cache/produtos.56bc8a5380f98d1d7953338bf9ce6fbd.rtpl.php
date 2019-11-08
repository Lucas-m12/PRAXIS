<?php if(!class_exists('Rain\Tpl')){exit;}?>
        <div class="row" id="pesquisa">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Pesquisa de Produto</div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <form method="post" action="" role="form" id="form-pesquisa-produto">
                                    
                                    <div class="form-group col-lg-6">
                                        <label class="control-label">
                                            Nome do Produto
                                        </label>
                                        <input type="text" name="nomeProduto" id="nomeProduto" class="form-control">
                                    </div>

                                    <div class="form-group col-lg-6">
                                        <label class="control-label">Categoria do Produto</label>
                                        <select name="buscaCategoria" id="buscaCategoria" class="form-control">
                                            <option disabled selected></option>
                                            <?php $counter1=-1;  if( isset($categoria) && ( is_array($categoria) || $categoria instanceof Traversable ) && sizeof($categoria) ) foreach( $categoria as $key1 => $value1 ){ $counter1++; ?>
                                                <option value="<?php echo htmlspecialchars( $value1["ID_CATEGORIA"], ENT_COMPAT, 'UTF-8', FALSE ); ?>"><?php echo htmlspecialchars( $value1["DESC_CATEGORIA"], ENT_COMPAT, 'UTF-8', FALSE ); ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>

                                    <div class="form-group col-lg-6">
                                        <label>Tipo do Produto</label>
                                        <select name="buscaTipo" id="buscaTipo" class="form-control">
                                            <option disabled selected></option>
                                            <?php $counter1=-1;  if( isset($tipo) && ( is_array($tipo) || $tipo instanceof Traversable ) && sizeof($tipo) ) foreach( $tipo as $key1 => $value1 ){ $counter1++; ?>
                                                <option value="<?php echo htmlspecialchars( $value1["ID_TIPO"], ENT_COMPAT, 'UTF-8', FALSE ); ?>"><?php echo htmlspecialchars( $value1["TIPO_PRODUTO"], ENT_COMPAT, 'UTF-8', FALSE ); ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>

                                    

                                    <div class="form-group col-lg-12">
                                        <button type="button" name="pesquisarProduto" id="pesquisarProduto" class="btn btn-success ">Pesquisar</button>
                                    </div>

                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row" id="resultadoPesquisa" style="display: block;">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <!-- <div class="panel-heading">Pesquisa de Produto</div> -->
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>CÓDIGO DO PRODUTO</th>
                                        <th>TIPO</th>
                                        <th>CATEGORIA</th>
                                        <th>PRODUTO</th>
                                        <th>UNIDADE DE MEDIDA</th>
                                        <th>SITUAÇÃO</th>
                                        <th>EDITAR</th>
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

        <div class="row" id="oculta" style="display: none;">
        	<div class="col-lg-12">
        		<div class="panel panel-default">
        			<div class="panel-heading">Cadastro de Produto</div>
        			<div class="panel-body">
        				<div class="row">
        					<div class="col-lg-12">
        						<form method="post" action="/praxis/modulo_merenda/cadastrar/produto" role="form" id="form-produto" onsubmit="">
        							
                                    <div class="form-group col-lg-6">
                                        <label>Categoria do Produto</label>
                                        <select name="categoriaProduto" id="categoriaProduto" class="form-control" >
                                            <option disabled selected>Selecione a categoria do produto</option>
                                            <?php $counter1=-1;  if( isset($categoria) && ( is_array($categoria) || $categoria instanceof Traversable ) && sizeof($categoria) ) foreach( $categoria as $key1 => $value1 ){ $counter1++; ?>
                                                <option value="<?php echo htmlspecialchars( $value1["ID_CATEGORIA"], ENT_COMPAT, 'UTF-8', FALSE ); ?>"><?php echo htmlspecialchars( $value1["DESC_CATEGORIA"], ENT_COMPAT, 'UTF-8', FALSE ); ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>

                                    <div class="form-group col-lg-6">
                                        <label>Tipo de Produto</label>
                                        <select name="tipoProduto" id="tipoProduto" class="form-control" >
                                            <option disabled selected>Selecione o tipo de produto</option>
                                            <?php $counter1=-1;  if( isset($tipo) && ( is_array($tipo) || $tipo instanceof Traversable ) && sizeof($tipo) ) foreach( $tipo as $key1 => $value1 ){ $counter1++; ?>
                                                <option value="<?php echo htmlspecialchars( $value1["ID_TIPO"], ENT_COMPAT, 'UTF-8', FALSE ); ?>"><?php echo htmlspecialchars( $value1["TIPO_PRODUTO"], ENT_COMPAT, 'UTF-8', FALSE ); ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>

                                    <div class="form-group col-lg-6">
                                        <label>Unidade de Medida</label>
                                        <select name="unidadeMedida" id="unidadeMedida" class="form-control" >
                                            <option disabled selected>Selecione a unidade de medida</option>
                                            <?php $counter1=-1;  if( isset($unidade) && ( is_array($unidade) || $unidade instanceof Traversable ) && sizeof($unidade) ) foreach( $unidade as $key1 => $value1 ){ $counter1++; ?>
                                                <option value="<?php echo htmlspecialchars( $value1["ID_UNIDADE_MEDIDA"], ENT_COMPAT, 'UTF-8', FALSE ); ?>"><?php echo htmlspecialchars( $value1["DESC_UNIDADE_MEDIDA"], ENT_COMPAT, 'UTF-8', FALSE ); ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>

        							<div class="form-group col-lg-6">
        								<label>Nome do Produto</label>
        								<input type="text" name="produto" id="produto" class="form-control" autocomplete="off" placeholder="Digite o nome do produto" >
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
                    <a href="/praxis/modulo_merenda/" type="button" class="btn btn-danger">Fechar</a>
                    <button type="reset" class="btn btn-default">Limpar</button>
                    <button type="button" class="btn btn-success" onclick="cadastrar()" id="novoProduto">Novo</button>
                    <button type="submit" class="btn btn-success" id="cadastrarProduto" name="cadastrarProduto" style="display: none;">Cadastrar</button>
                </div>
                </form>
            </div>
        </div>



    <script src="\<?php echo htmlspecialchars( $cidade, ENT_COMPAT, 'UTF-8', FALSE ); ?>/modulo_merenda/public/scripts/controllers/Produto.js"></script>
    <script src="\<?php echo htmlspecialchars( $cidade, ENT_COMPAT, 'UTF-8', FALSE ); ?>/modulo_merenda/public/scripts/cadastroProduto.js"></script>

    <script src="\<?php echo htmlspecialchars( $cidade, ENT_COMPAT, 'UTF-8', FALSE ); ?>/modulo_merenda/public/scripts/controllers/Pesquisa.js"></script>
    <script src="\<?php echo htmlspecialchars( $cidade, ENT_COMPAT, 'UTF-8', FALSE ); ?>/modulo_merenda/public/scripts/pesquisaProduto.js"></script>

    <script type="text/javascript">
        function cadastrar(){
            $('#oculta').css("display", "block");
            $('#pesquisa').css("display", "none");
            $('#resultadoPesquisa').css("display", "none");
            $('#novoProduto').remove();
            $('#cadastrarProduto').show();
            

        }
    </script>