
        <div class="row">
        	<div class="col-lg-12">
        		<div class="panel panel-default">
        			<div class="panel-heading">Cadastro de Produto</div>
        			<div class="panel-body">
        				<div class="row">
        					<div class="col-lg-12">
        						<form method="post" action="" role="form" id="form-produto-edicao" onsubmit="">
        							
                                    <div class="form-group col-lg-12">
                                        <label class="control-label">Código do produto</label>
                                        <input type="number" name="idProduto" id="idProduto" value="<?php echo $info['ID_PRODUTO'] ?>" class="form-control" disabled>
                                    </div>

                                    <div class="form-group col-lg-6">
                                        <label>Categoria do Produto</label>
                                        <select name="categoriaProduto" id="categoriaProduto" class="form-control" required>
                                            <option value="<?php echo $info['ID_CATEGORIA'] ?>" selected><?php echo $info['DESC_CATEGORIA'] ?></option>
                                            <?php foreach ($categorias as $value): ?>
                                                <option value="<?php echo $value['ID_CATEGORIA'] ?>"><?php echo $value['DESC_CATEGORIA'] ?></option>
                                            <?php endforeach ?>
                                        </select>
                                    </div>

                                    <div class="form-group col-lg-6">
                                        <label>Tipo de Produto</label>
                                        <select name="tipoProduto" id="tipoProduto" class="form-control" required>
                                            <option value="<?php echo $info['ID_TIPO'] ?>" selected><?php echo $info['TIPO_PRODUTO'] ?></option>
                                            <?php foreach ($tipos as $value): ?>
                                                <option value="<?php echo $value['ID_TIPO'] ?>"><?php echo $value['TIPO_PRODUTO'] ?></option>
                                            <?php endforeach ?>
                                        </select>
                                    </div>

                                    <div class="form-group col-lg-6">
                                        <label>Unidade de Medida</label>
                                        <select name="unidadeMedida" id="unidadeMedida" class="form-control" required>
                                            <option value="<?php echo $info['ID_UNIDADE_MEDIDA'] ?>" selected><?php echo $info['DESC_UNIDADE_MEDIDA'] ?></option>
                                            <?php foreach ($unidadesMedida as $value): ?>
                                                <option value="<?php echo $value['ID_UNIDADE_MEDIDA'] ?>"><?php echo $value['DESC_UNIDADE_MEDIDA'] ?></option>
                                            <?php endforeach ?>
                                        </select>
                                    </div>

        							<div class="form-group col-lg-6">
        								<label>Nome do Produto</label>
        								<input type="text" name="produto" id="produto" class="form-control" autocomplete="off" value="<?php echo $info['DESC_PRODUTO'] ?>" placeholder="Digite o nome do produto" required>
        							</div>

                                    <div class="form-group col-lg-6">
                                        <input type="checkbox" name="status" id="status" <?php if ($info['STATUS'] == 2): ?> checked <?php endif ?>>Inativo
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
                    <a href="<?php echo base_url('inicio') ?>" type="button" class="btn btn-danger">Fechar</a>
                    <button type="reset" class="btn btn-default">Limpar</button>
                    <button type="submit" class="btn btn-success" id="cadastrarProduto" name="cadastrarProduto">Salvar</button>
                </div>
                </form>
            </div>
        </div>



    <script src="<?php echo base_url('assets/scripts/class/Produto.js') ?>"></script>
    <script>
        window.app = new Produto("form-produto-edicao", ['categoriaProduto', 'tipoProduto', 'unidadeMedida', 'produto'], "<?php echo base_url('atualizar-produto') ?>", "atualizado", "<?php echo base_url('view-produtos') ?>");
    </script>