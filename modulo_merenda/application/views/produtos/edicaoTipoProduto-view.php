
        <div class="row">
        	<div class="col-lg-12">
        		<div class="panel panel-default">
        			<div class="panel-heading">Cadastro de Tipos</div>
        			<div class="panel-body">
        				<div class="row">
        					<div class="col-lg-12">
        						<form method="post" action="" role="form" id="form-tipos-edicao">
        							
                                    <div class="form-group col-lg-6">
                                        <label class="control-label">Código do Tipo</label>
                                        <input type="number" name="idTipo" id="idTipo" class="form-control" value="<?php echo $dados['ID_TIPO'] ?>" disabled>
                                    </div>

        							<div class="form-group col-lg-6">
        								<label class="control-label">Tipo de Produto</label>
        								<input type="text" name="tipoProduto" id="tipoProduto" class="form-control" placeholder="Digite o o tipo de produto" required autocomplete="off" autofocus value="<?php echo $dados['TIPO_PRODUTO'] ?>">
        							</div>

                                    <div class="form-group">
                                        <input type="checkbox" name="status" id="status" <?php if ($dados['STATUS'] == 2): ?> checked <?php endif ?>>Inativo
                                    </div>
        						
        					</div>
        				</div>
        			</div>
        		</div>

                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div align="center">
                            <a href="<?php echo base_url('tipos');?>" type="button" class="btn btn-info">Voltar</a>
                            <a href="<?php echo base_url('inicio') ?>" type="button" class="btn btn-danger">Fechar</a>
                            <button type="reset" class="btn btn-default">Limpar</button>
                            <button type="submit" name="atualizarTipo" id="atualizarTipo" class="btn btn-success">Salvar</button>
                        </div>
                        </form>

                    </div>
                </div>
        	</div>
        </div>

        <script src="<?php echo base_url('assets/scripts/class/TipoProduto.js') ?>"></script>
        <script>
            window.app = new TipoProduto("form-tipos-edicao", ['idTipo', 'tipoProduto'], "<?php echo base_url('atualizar-tipoProduto') ?>", "<?php echo base_url('tipos') ?>");
        </script>
