        <div class="row" id="pesquisa">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Pesquisa de Produto</div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <form method="post" action="" role="form" id="form-pesquisa-produto">
                                    
                                    <div class="form-group col-lg-6">
                                        <label class="control-label">
                                            Nome do Produto
                                        </label>
                                        <input type="text" name="nomeProduto" id="nomeProduto" class="form-control">
                                    </div>

                                    <div class="form-group col-lg-6">
                                        <label class="control-label">Categoria do Produto</label>
                                        <select name="buscaCategoria" id="buscaCategoria" class="form-control">
                                            <option disabled selected></option>
                                            <?php foreach ($categorias as $value): ?>
                                                <option value="<?php echo $value['ID_CATEGORIA'] ?>"><?php echo $value['DESC_CATEGORIA'] ?></option>
                                            <?php endforeach ?>
                                        </select>
                                    </div>

                                    <div class="form-group col-lg-6">
                                        <label>Tipo do Produto</label>
                                        <select name="buscaTipo" id="buscaTipo" class="form-control">
                                            <option disabled selected></option>
                                            <?php foreach ($tipos as $value): ?>
                                                <option value="<?php echo $value['ID_TIPO'] ?>"><?php echo $value['TIPO_PRODUTO'] ?></option>
                                            <?php endforeach ?>
                                        </select>
                                    </div>

                                    

                                    <div class="form-group col-lg-12">
                                        <button type="button" name="pesquisarProduto" id="pesquisarProduto" class="btn btn-success ">Pesquisar</button>
                                    </div>

                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row" id="resultadoPesquisa" style="display: block;">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <!-- <div class="panel-heading">Pesquisa de Produto</div> -->
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>CÓDIGO DO PRODUTO</th>
                                        <th>TIPO</th>
                                        <th>CATEGORIA</th>
                                        <th>PRODUTO</th>
                                        <th>UNIDADE DE MEDIDA</th>
                                        <th>SITUAÇÃO</th>
                                        <th>EDITAR</th>
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

        <div class="row" id="oculta" style="display: none;">
        	<div class="col-lg-12">
        		<div class="panel panel-default">
        			<div class="panel-heading">Cadastro de Produto</div>
        			<div class="panel-body">
        				<div class="row">
        					<div class="col-lg-12">
        						<form method="post" action="" role="form" id="form-produto">
        							
                                    <div class="form-group col-lg-6">
                                        <label>Categoria do Produto</label>
                                        <select name="categoriaProduto" id="categoriaProduto" class="form-control" >
                                            <option disabled selected>Selecione a categoria do produto</option>
                                            <?php foreach ($categorias as $value): ?>
                                                <option value="<?php echo $value['ID_CATEGORIA'] ?>"><?php echo $value['DESC_CATEGORIA'] ?></option>
                                            <?php endforeach ?>
                                        </select>
                                    </div>

                                    <div class="form-group col-lg-6">
                                        <label>Unidade de Medida</label>
                                        <select name="unidadeMedida" id="unidadeMedida" class="form-control" >
                                            <option disabled selected>Selecione a unidade de medida</option>
                                            <?php foreach ($unidadesMedida as $value): ?>
                                                <option value="<?php echo $value['ID_UNIDADE_MEDIDA'] ?>"><?php echo $value['DESC_UNIDADE_MEDIDA'] ?></option>
                                            <?php endforeach ?>
                                        </select>
                                    </div>

                                    <div class="form-group col-lg-6">
                                        <label>Tipo de Produto</label>
                                        <select name="tipoProduto" id="tipoProduto" class="form-control" >
                                            <option disabled selected>Selecione o tipo de produto</option>
                                            <?php foreach ($tipos as $value): ?>
                                                <option value="<?php echo $value['ID_TIPO'] ?>"><?php echo $value['TIPO_PRODUTO'] ?></option>
                                            <?php endforeach ?>
                                        </select>
                                    </div>

        							<div class="form-group col-lg-6">
        								<label>Nome do Produto</label>
        								<input type="text" name="produto" id="produto" class="form-control" autocomplete="off" placeholder="Digite o nome do produto" >
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
                    <a href="<?php echo base_url(); ?>inicio" type="button" class="btn btn-info">Voltar</a>
                    <a href="<?php echo base_url('inicio') ?>" type="button" class="btn btn-danger">Fechar</a>
                    <button type="reset" class="btn btn-default">Limpar</button>
                    <button type="button" class="btn btn-success" onclick="cadastrar()" id="novoProduto">Novo Produto</button>
                    <button type="submit" class="btn btn-success" id="cadastrarProduto" name="cadastrarProduto" style="display: none;">Cadastrar</button>
                </div>
                </form>
            </div>
        </div>

    <script src="<?php echo base_url('assets/scripts/class/Pesquisa.js') ?>"></script>
    <script>
        window.app = new Pesquisa('form-pesquisa-produto', '<?php echo base_url('pesquisa-produto') ?> ', 1);
    </script>
    
    <script src="<?php echo base_url('assets/scripts/class/Produto.js') ?>"></script>
    <script>
        window.app = new Produto("form-produto", ['categoriaProduto', 'tipoProduto', 'unidadeMedida', 'produto'], '<?php echo base_url('cadastrar-produto') ?>' );
    </script>

    <script type="text/javascript">
        function cadastrar(){
            $('#oculta').css("display", "block");
            $('#pesquisa').css("display", "none");
            $('#resultadoPesquisa').css("display", "none");
            $('#novoProduto').remove();
            $('#cadastrarProduto').show();
            

        }
    </script>