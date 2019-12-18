
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
                                        <th>AÇÃO</th>

                                    </tr>
                                </thead>
                                <tbody>

                                    <?php foreach ($programas as $value): ?>
                                        <tr class="odd gradeX">
                                            <td><?php echo $value['ID_PROGRAMA']; ?></td>
                                            <td><?php echo $value['DESC_PROGRAMA']; ?></td>
                                            <td><?php if ($value['STATUS'] == 1): ?>
                                                ATIVO
                                            <?php else: ?>
                                                INATIVO
                                            <?php endif ?></td>
                                            <td><a href="<?php echo base_url(); ?>editar-programa/<?php echo $value['ID_PROGRAMA'] ?>" class="btn btn-default btn-xs">Editar</a></td>
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
        			<div class="panel-heading">Cadastro de Programas</div>
        			<div class="panel-body">
        				<div class="row">
        					<div class="col-lg-12">
        						<form method="post" action="" role="form" id="form-programa">
        							
        							<div class="form-group col-lg-6">
        								<label>Nome do Programa</label>
        								<input type="text" name="programa" id="programa" class="form-control" placeholder="Digite o nome do programa">
        							</div>

                                    <div class="form-group col-lg-6">
                                        <label>Sigla do Programa</label>
                                        <input type="text" name="siglaPrograma" id="siglaPrograma" class="form-control" placeholder="Digite a sigla do programa">
                                    </div>
        					</div>
        				</div>
        			</div>
        		</div>

                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div align="center">
                            <a href="<?php echo base_url(); ?>inicio" type="button" class="btn btn-info">Voltar</a>
                            <a href="<?php echo base_url('inicio') ?>" type="button" class="btn btn-danger">Fechar</a>
                            <button type="reset" class="btn btn-default">Limpar</button>
                            <button type="button" class="btn btn-success" name="novoPrograma" id="novoPrograma">Novo Programa</button>
                            <button type="submit" name="cadastrarPrograma" id="cadastrarPrograma" class="btn btn-success" style="display: none;">Cadastrar Programa</button>
                        </div>
                    </div>
                </div>
            </form>

        	</div>
        </div>
<!-- 
    <script src="<?php echo base_url('assets/scripts/controllers/Cadastro.js') ?>"></script>
    <script src="<?php echo base_url('assets/public/scripts/cadastroPrograma.js') ?>"></script>
    <script src="<?php echo base_url('assets/public/scripts/controllers/Status.js') ?>"></script>
    <script src="<?php echo base_url('assets/public/scripts/statusProgramas.js') ?>"></script> -->
    
    <script src="<?php echo base_url('assets/scripts/class/Programa.js'); ?>"></script>
    <script src="<?php echo base_url('assets/scripts/instancias/cadastroPrograma.js'); ?>"></script>

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