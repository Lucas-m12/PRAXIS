<?php if(!class_exists('Rain\Tpl')){exit;}?>
		

        <div class="row" id="lista">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Lista de Categorias dos Produtos</div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                    <tr>
                                        
                                        <th>CÓDIGO DA CATEGORIA</th>
                                        <th>CATEGORIA</th>
                                        <th>SITUAÇÃO</th>
                                        <th>AÇÃO</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $counter1=-1;  if( isset($categorias) && ( is_array($categorias) || $categorias instanceof Traversable ) && sizeof($categorias) ) foreach( $categorias as $key1 => $value1 ){ $counter1++; ?>
                                        <tr class="odd gradeX">
                                            <td><?php echo htmlspecialchars( $value1["ID_CATEGORIA"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
                                            <td><?php echo htmlspecialchars( $value1["DESC_CATEGORIA"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
                                            <td><?php if( $value1["STATUS"]==1 ){ ?><i></i>ATIVO<?php }else{ ?>INATIVO<?php } ?></td>
                                            <td><a href="/praxis/modulo_merenda/edicao/categoria/<?php echo htmlspecialchars( $value1["ID_CATEGORIA"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" class="btn btn-default btn-xs">Editar</a></td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
        	<div class="col-lg-12">
        		<div class="panel panel-default" id="cadastro" style="display: none;">
        			<div class="panel-heading">Cadastro de Categorias dos Produtos</div>
        			<div class="panel-body">
        				<div class="row">
        					<div class="col-lg-6">
        						<form method="post" action="" role="form" id="form-categorias">
        							
        							<div class="form-group">
        								<label>Categoria do Produto</label>
        								<input type="text" name="categoriaProduto" id="categoriaProduto" class="form-control" placeholder="Digite o nome da categoria">
        							</div>
        					</div>
        				</div>
        			</div>
        		</div>

                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div align="center" id="oculta">
                            <button type="button" class="btn btn-info" onclick="history.go(-1)">Voltar</button>
                            <a href="/praxis/modulo_merenda/" type="button" class="btn btn-danger">Fechar</a>
                            <button type="reset" class="btn btn-default">Limpar</button>
                            <button type="button" class="btn btn-success" name="novaCategoria" id="novaCategoria">Nova Categoria</button>
                            <button type="submit" name="cadastrarCategoria" id="cadastrarCategoria" class="btn btn-success" style="display: none;">Cadastrar</button>
                        </div>
                        </form>

                    </div>
                </div>
        	</div>
        </div>

    <script src="\modulo_merenda/public/scripts/controllers/Cadastro.js"></script>
    <script src="\modulo_merenda/public/scripts/cadastroCategorias.js"></script>
    <script>
        document.querySelector("#novaCategoria").addEventListener("click", event =>{

           $("#lista").css("display", "none");
           $("#cadastro").css("display", "block");
           $("#novaCategoria").remove();
           $("#cadastrarCategoria").show();


        });
    </script>
