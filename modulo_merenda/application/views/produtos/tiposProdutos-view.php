
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
                                    <?php foreach ($tipos as $value): ?>
                                        <tr class="odd gradeX">
                                            <td><?php echo $value['ID_TIPO'] ?></td>
                                            <td><?php echo $value['TIPO_PRODUTO'] ?></td>
                                            <td><?php if ($value['STATUS'] == 1): ?>
                                                ATIVO
                                            <?php else: ?>
                                                INATIVO
                                            <?php endif ?></td>
                                            <td><a href="<?php echo base_url(); ?>editar-tipo/<?php echo $value['ID_TIPO'] ?>" class="btn btn-default btn-xs">Editar</a></td>
                                        </tr>
                                    <?php endforeach ?>
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
        						<form method="post" action="<?php echo base_url(); ?>cadastro-fornecedor" role="form" id="form-tipos">
        							
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
                            <a href="<?php echo base_url(); ?>inicio" type="button" class="btn btn-danger">Fechar</a>
                            <button type="reset" class="btn btn-default">Limpar</button>
                            <button type="button" class="btn btn-success" name="novoTipo" id="novoTipo">Novo</button>
                            <button type="submit" name="submitCadastrar" id="submitCadastrar" class="btn btn-success" style="display: none;">Cadastrar</button>
                        </div>
                        </form>

                    </div>
                </div>
        	</div>
        </div>
    <!-- <script src="\{$cidade}/modulo_merenda/public/scripts/controllers/Cadastro.js"></script>
    <script src="\{$cidade}/modulo_merenda/public/scripts/cadastroTipos.js"></script>
    <script src="\{$cidade}/modulo_merenda/public/scripts/controllers/Status.js"></script>
    <script src="\{$cidade}/modulo_merenda/public/scripts/statusTipos.js"></script> -->
    <script src="<?php echo base_url('assets/scripts/class/TipoProduto.js') ?>"></script>
    <script src="<?php echo base_url('assets/scripts/instancias/cadastroTipos.js') ?>"></script>

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