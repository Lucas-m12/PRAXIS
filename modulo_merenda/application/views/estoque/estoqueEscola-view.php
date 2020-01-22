		
        <div class="row">
        	<div class="col-lg-12">
        		<div class="panel panel-default">
        			<div class="panel-heading">Estoque</div>
        			<div class="panel-body">
        				<div class="row">
        					<div class="col-lg-12">
                                <form id="pesquisa-estoque" method="post" action="#" role="form">
                                    <div class="form-group col-lg-6">
                                        <label class="control-label">Programa</label>
                                        <select class="form-control" name="programa" id="programa">
                                            <option selected></option>
                                            <?php foreach ($programas as $value): ?>
                                            	<option value="<?php echo $value['ID_PROGRAMA'] ?>"><?php echo $value['DESC_PROGRAMA'] ?></option>
                                            <?php endforeach ?>
                                                
                                        </select>
                                    </div>

                                    <div class="form-group col-lg-6">
                                        <label class="control-label">Produto</label>
                                        <select class="form-control" name="produtos" id="produtos">
                                            <option selected></option>
                                            <?php foreach ($produtos as $value): ?>
                                                <option value="<?php echo $value['ID_PRODUTO'] ?>"><?php echo $value['DESC_PRODUTO'] ?></option>
                                            <?php endforeach ?>
                                        </select>
                                        <input type="hidden" name="escola" id="escola" value="<?php echo $escola ?>">
                                    </div>

        					</div>
        				</div>
        			</div>
        		</div>
        	</div>
        </div>

        <div class="row" id="tabela" style="display: block;">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>FORNECEDOR</th>
                                        <th>PROGRAMA</th>            
                                        <th>PRODUTO</th>
                                        <th>ESTOQUE ATUAL</th>
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


        <div class="panel panel-default">
            <div class="panel-heading">
                <div align="center">
                    <a href="<?php echo base_url(); ?>inicio" type="button" class="btn btn-info">Voltar</a>
                    <a href="<?php echo base_url(); ?>inicio" type="button" class="btn btn-danger">Fechar</a>
                    <button type="reset" class="btn btn-default">Limpar</button>
                    <button type="submit" name="pesquisarEstoque" id="pesquisarEstoque" class="btn btn-success">Pesquisar</button>
                    <!-- <a href="<?php echo base_url('relatorio-estoque') ?>" target="new">imprimir</a> -->
                </div>
                </form>
            </div>
        </div>

    <script src="<?php echo base_url('assets/scripts/class/Estoque.js') ?>"></script>
    <script>
        window.app = new Estoque("pesquisa-estoque", "<?php echo base_url('pesquisar-estoqueEscola') ?>");
    </script>