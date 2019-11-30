
        <div class="row">
        	<div class="col-lg-12">
        		<div class="panel panel-default">
        			<div class="panel-heading">Edição da Categoria <?php echo $dados['DESC_CATEGORIA'] ?></div>
        			<div class="panel-body">
        				<div class="row">
        					<div class="col-lg-12">
        						<form method="post" action="" role="form" id="form-categorias-edicao">

                                    <div class="form-group col-lg-6">
                                        <label class="control-label">Código da Categoria</label>
                                        <input type="text" name="idCategoria" id="idCategoria" class="form-control" disabled value="<?php echo $dados['ID_CATEGORIA'] ?>">
                                    </div>

        							<div class="form-group col-lg-6">
                                        <label class="control-label">Nome da Categoria</label>
                                        <input type="text" name="categoriaProduto" id="categoriaProduto" class="form-control" placeholder="Digite o nome da categoria" value="<?php echo $dados['DESC_CATEGORIA'] ?>">
                                    </div>

                                    <div class="form-group col-lg-12">
                                        <input type="checkbox" name="statusCategoria" id="statusCategoria" <?php if ($dados['STATUS'] == 2): ?> checked <?php endif ?>>Inativo
                                    </div>  
        					</div>
        				</div>
        			</div>
        		</div>

                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div align="center" id="oculta">
                            <a href="<?php echo base_url('categorias') ?>" type="button" class="btn btn-info" onclick="history.go(-1)">Voltar</a>
                            <a href="<?php echo base_url('inicio') ?>" type="button" class="btn btn-danger">Fechar</a>
                            <button type="reset" class="btn btn-default">Limpar</button>
                            <button type="submit" name="cadastrarCategoria" id="cadastrarCategoria" class="btn btn-success">Salvar</button>
                        </div>
                        </form>

                    </div>
                </div>
        	</div>
        </div>
        <script src="<?php echo base_url('assets/scripts/class/Categoria.js') ?>"></script>
        <script>
            window.app = new Categoria("form-categorias-edicao", ['idCategoria', 'categoriaProduto'], "<?php echo base_url('atualizar-categoria') ?>", "<?php echo base_url('categorias') ?>");
        </script>

    
