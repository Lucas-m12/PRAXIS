
        <div class="row">
        	<div class="col-lg-12">
        		<div class="panel panel-default">
        		    <div id="cadastroFornecedor">
                        <div class="panel-heading">Cadastro de Fornecedores</div>
            			<div class="panel-body">
            				<div class="row">
            					<div class="">
            						<form method="post" action="<?php echo base_url('cadastrar-itenLicitacao') ?>" role="form" id="form-itens-licitacao" onsubmit="">

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
                                            <label class="control-label">Data de Fim</label>
                                            <input type="date" name="fim" id="fim" class="form-control" value="<?php echo $dados['DATA_FIM'] ?>" disabled>
                                        </div>
                                        
                                        <div class="form-group col-lg-6">
                                            <label class="control-label">
                                                Selecione os Produtos Desta Licitação
                                            </label>
                                            <select multiple name="produtos[]" id="produtos" class="form-control chosen-select">
                                                <?php foreach ($produtos as $value): ?>
                                                    <option value="<?php echo $value['ID_PRODUTO'] ?>"><?php echo $value['DESC_PRODUTO'] ?></option>
                                                <?php endforeach ?>
                                            </select>
                                        </div>
                                        
            						<!-- </form> -->
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
                    <a href="<?php echo base_url('licitacoes'); ?>" type="button" class="btn btn-info" onclick="history.go(-1)">Voltar</a>
                    <a href="<?php echo base_url('inicio') ?>" type="button" class="btn btn-danger">Fechar</a>
                    <button type="reset" class="btn btn-default">Limpar</button>
                    <button type="submit" class="btn btn-success" name="btn-finalizar" id="btn-finalizar">Finalizar Cadastro</button>
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
        window.app = new ItensLicitacao("form-itens-licitacao", ['produtos[]']);
    </script>

    <script>
        $(".chosen-select").chosen({
                placeholder_text_single : 'Selecione os Produtos',
                width: "95%",
                no_results_text: "Nada Encontrado"
            }); 
    </script>
    
