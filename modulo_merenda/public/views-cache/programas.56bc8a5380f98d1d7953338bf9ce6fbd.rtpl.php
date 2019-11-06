<?php if(!class_exists('Rain\Tpl')){exit;}?>
        <div class="row" id="oculta">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Lista de Programas</div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                    <tr>
                                        
                                        <th>CÓDIGO DO PROGRAMA</th>
                                        <th>NOME DO PROGRAMA</th>
                                        <th>SITUAÇÃO</th>
                                        <th>EDITAR</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $counter1=-1;  if( isset($programas) && ( is_array($programas) || $programas instanceof Traversable ) && sizeof($programas) ) foreach( $programas as $key1 => $value1 ){ $counter1++; ?>
                                        <tr class="odd gradeX">
                                            <td><?php echo htmlspecialchars( $value1["ID_PROGRAMA"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
                                            <td><?php echo htmlspecialchars( $value1["DESC_PROGRAMA"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
                                            <td><?php if( $value1["STATUS"]==1 ){ ?>ATIVO<?php }else{ ?>INATIVO<?php } ?></td>
                                            <td><a href="/praxis/modulo_merenda/edicao/programa/<?php echo htmlspecialchars( $value1["ID_PROGRAMA"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" class="btn btn-default btn-xs">Editar</a></td>
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
        			<div class="panel-heading">Cadastro de Programas</div>
        			<div class="panel-body">
        				<div class="row">
        					<div class="col-lg-12">
        						<form method="post" action="" role="form" id="form-programa">
        							
        							<div class="form-group">
        								<label>Nome do Programa</label>
        								<input type="text" name="programa" id="programa" class="form-control" placeholder="Digite o nome do programa">
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
                            <button type="button" class="btn btn-success" name="novoPrograma" id="novoPrograma">Novo Programa</button>
                            <button type="submit" name="cadastrarPrograma" id="cadastrarPrograma" class="btn btn-success" style="display: none;">Cadastrar Programa</button>
                        </div>
                    </div>
                </div>
            </form>

        	</div>
        </div>

    <script src="\praxis/modulo_merenda/public/scripts/controllers/Cadastro.js"></script>
    <script src="\praxis/modulo_merenda/public/scripts/cadastroPrograma.js"></script>
    <script src="\praxis/modulo_merenda/public/scripts/controllers/Status.js"></script>
    <script src="\praxis/modulo_merenda/public/scripts/statusProgramas.js"></script>
    <script>
        $(document).ready(function(){
            $("#novoPrograma").click(function(){

                $(this).remove();
                $("#oculta").remove();
                $("#cadastro").css("display", "block");
                $("#cadastrarPrograma").show();

            });
        });
    </script>