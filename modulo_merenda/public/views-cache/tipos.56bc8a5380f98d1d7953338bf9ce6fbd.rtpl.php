<?php if(!class_exists('Rain\Tpl')){exit;}?>
        <div class="row" id="tabelas">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Lista de Tipos dos Produtos</div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                    <tr>
                                        
                                        <th>CÓDIGO DO TIPO</th>
                                        <th>TIPO DE PRODUTO</th>
                                        <th>SITUAÇÃO</th>
                                        <th>AÇÃO</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $counter1=-1;  if( isset($tipos) && ( is_array($tipos) || $tipos instanceof Traversable ) && sizeof($tipos) ) foreach( $tipos as $key1 => $value1 ){ $counter1++; ?>
                                        <tr class="odd gradeX">
                                            <td><?php echo htmlspecialchars( $value1["ID_TIPO"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
                                            <td><?php echo htmlspecialchars( $value1["TIPO_PRODUTO"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
                                            <td><?php if( $value1["STATUS"]==1 ){ ?>ATIVO<?php }else{ ?>INATIVO<?php } ?></td>
                                            <td><a href="/praxis/modulo_merenda/edicao/tipos/<?php echo htmlspecialchars( $value1["ID_TIPO"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" class="btn btn-default btn-xs">Editar</a></td>
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
        			<div class="panel-heading">Cadastro de Tipos</div>
        			<div class="panel-body">
        				<div class="row">
        					<div class="col-lg-6">
        						<form method="post" action="/praxis/modulo_merenda/cadastro/fornecedor" role="form" id="form-tipos">
        							
        							<div class="form-group">
        								<label class="control-label">Tipo de Produto</label>
        								<input type="text" name="tipoProduto" id="tipoProduto" class="form-control" placeholder="Digite o o tipo de produto" required>
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
                            <button type="button" class="btn btn-success" name="novoTipo" id="novoTipo">Novo</button>
                            <button type="submit" name="submitCadastrar" id="submitCadastrar" class="btn btn-success" style="display: none;">Cadastrar</button>
                        </div>
                        </form>

                    </div>
                </div>
        	</div>
        </div>

    <script src="\praxis/modulo_merenda/public/scripts/controllers/Cadastro.js"></script>
    <script src="\praxis/modulo_merenda/public/scripts/cadastroTipos.js"></script>
    <script src="\praxis/modulo_merenda/public/scripts/controllers/Status.js"></script>
    <script src="\praxis/modulo_merenda/public/scripts/statusTipos.js"></script>
    <script>
        $(document).ready(function(){
            $("#novoTipo").click(function(){

                $(this).remove();
                $("#tabelas").remove();
                $("#cadastro").css("display", "block");
                $("#submitCadastrar").show();

            });
        });
    </script>