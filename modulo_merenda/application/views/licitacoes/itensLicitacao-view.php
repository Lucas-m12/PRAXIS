
        <div class="row">
        	<div class="col-lg-12">
        		<div class="panel panel-default">
        		    <div id="cadastroFornecedor">
                        <div class="panel-heading">Cadastro de Fornecedores</div>
            			<div class="panel-body">
            				<div class="row">
            					<div class="">
            						<form method="post" action="" role="form" id="form-itens-licitacao" onsubmit="">

                                        <div class="form-group col-lg-6">
                                            <label class="control-label">Código da Licitação</label>
                                            <input type="number" name="codigoLicitacao" id="codigoLicitacao" class="form-control" value="<?php echo $dados['ID_LICITACAO'] ?>" readonly>
                                        </div>

                                        <div class="form-group col-lg-6">
                                            <label class="control-label">Número da Licitação</label>
                                            <input type="number" name="numeroLicitacao" id="numeroLicitacao" class="form-control" value="<?php echo $dados['NUMERO_LICITACAO'] ?>" disabled>
                                        </div>

                                        <div class="form-group col-lg-6">
                                            <label class="control-label">Fornecedor</label>
                                            <input type="text" name="fornecedor" id="fornecedor" value="<?php echo $dados['NOME_FORNECEDOR'] ?>" disabled class="form-control">
                                        </div>

                                        <div class="form-group col-lg-6">
                                            <label class="control-label">Data de Início</label>
                                            <input type="date" name="inicio" id="inicio" class="form-control" value="<?php echo $dados['DATA_INICIO'] ?>" disabled>
                                        </div>

                                        <div class="form-group col-lg-6">
                                            <label class="control-label">
                                                Selecione os Produtos Desta Licitação
                                            </label>

                                            <select name="produtos" id="produtos" class="form-control ">
                                                <option></option>
                                                <?php foreach ($produtos as $value): ?>
                                                    <option value="<?php echo $value['ID_PRODUTO'] ?>/<?php echo $value['DESC_PRODUTO'] ?>"><?php echo $value['DESC_PRODUTO'] ?></option>
                                                <?php endforeach ?>
                                            </select>
                                        </div>

                                        <div class="form-group col-lg-6">
                                            <label class="control-label">Data de Fim</label>
                                            <input type="date" name="fim" id="fim" class="form-control" value="<?php echo $dados['DATA_FIM'] ?>" disabled>
                                        </div>

                                        <div class="form-group col-lg-6">
                                            <label class="control-label">Quantidade</label>
                                            <div class="input-group">
                                                <input type="number" name="quantidade" id="quantidade" class="form-control" placeholder="Digite a quantidade do produto">
                                                <span class="input-group-addon" id="unidadeMedida"></span>
                                            </div>
                                        </div>

                                        <div class="form-group col-lg-6">
                                            <label></label>
                                            <button type="button" name="addProduto" id="addProduto" class="btn btn-primary form-control">Adicionar</button>
                                        </div>
                                        
            						<!-- </form> -->
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
                                        <th>CÓDIGO DO PRODUTO</th>            
                                        <th>NOME</th>
                                        <th>QUANTIDADE</th>
                                        <th>AÇÃO</th>
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
                    <a href="<?php echo base_url('licitacoes'); ?>" type="button" class="btn btn-info" onclick="history.go(-1)">Voltar</a>
                    <a href="<?php echo base_url('inicio') ?>" type="button" class="btn btn-danger">Fechar</a>
                    <button type="reset" class="btn btn-default">Limpar</button>
                    <a type="button" href="<?php echo base_url('licitacoes') ?>" class="btn btn-success" name="btn-finalizar" id="btn-finalizar">Finalizar Cadastro</a>
                </div>
                </form>
            </div>
        </div>


    <link href="<?php echo base_url('vendor/harvesthq/chosen/chosen.css') ?>" rel="stylesheet" >
    <link href="<?php echo base_url('vendor/harvesthq/chosen/chosen.min.css') ?>" rel="stylesheet" >   
    <script src="<?php echo base_url('vendor/harvesthq/chosen/chosen.jquery.js'); ?>"></script>
    <script src="<?php echo base_url('vendor/harvesthq/chosen/chosen.jquery.min.js'); ?>"></script>
    <script src="<?php echo base_url('vendor/harvesthq/chosen/chosen.proto.js'); ?>"></script>
    <script src="<?php echo base_url('vendor/harvesthq/chosen/chosen.proto.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/scripts/class/ItensLicitacao.js') ?>"></script>
    <script>
        window.app = new ItensLicitacao("form-itens-licitacao", ['produtos'], '<?php echo base_url('pesquisa-unidadeMedida') ?>', '<?php echo base_url('cadastrar-itemLicitacao') ?>', '<?php echo base_url('remover-itemLicitacao') ?>');
    </script>

    <script>
        $(".chosen-select").chosen({
                placeholder_text_single : 'Selecione os Produtos',
                width: "95%",
                no_results_text: "Nada Encontrado"
            }); 
    </script>
    
