
		

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
                                    <?php foreach ($categorias as $value): ?>
                                        <tr class="odd gradeX">
                                            <td><?php echo $value['ID_CATEGORIA'] ?></td>
                                            <td><?php echo $value['DESC_CATEGORIA'] ?></td>
                                            <td><?php if ($value['STATUS'] == 1): ?>
                                                ATIVO
                                            <?php else: ?>
                                                INATIVO
                                            <?php endif ?>
                                            </td>
                                            <td><a href="<?php echo base_url(); ?>editar-categoria/<?php echo $value['ID_CATEGORIA'] ?>" class="btn btn-default btn-xs">Editar</a></td>
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
                            <a href="<?php echo base_url('categorias') ?>" type="button" class="btn btn-info" onclick="history.go(-1)">Voltar</a>
                            <a href="<?php echo base_url(); ?>inicio" type="button" class="btn btn-danger">Fechar</a>
                            <button type="reset" class="btn btn-default">Limpar</button>
                            <button type="button" class="btn btn-success" name="novaCategoria" id="novaCategoria">Nova Categoria</button>
                            <button type="submit" name="cadastrarCategoria" id="cadastrarCategoria" class="btn btn-success" style="display: none;">Cadastrar</button>
                        </div>
                        </form>

                    </div>
                </div>
        	</div>
        </div>

    <script src="<?php echo base_url('assets/scripts/class/Categoria.js') ?>"></script>
    <script src="<?php echo base_url('assets/scripts/instancias/cadastroCategoria.js') ?>"></script>
    <script>
        document.querySelector("#novaCategoria").addEventListener("click", event =>{

           $("#lista").css("display", "none");
           $("#cadastro").css("display", "block");
           $("#novaCategoria").remove();
           $("#cadastrarCategoria").show();


        });
    </script>
