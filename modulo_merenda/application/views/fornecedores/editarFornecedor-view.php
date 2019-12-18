
        <div class="row">
        	<div class="col-lg-12">
        		<div class="panel panel-default">
        		    <div id="cadastroFornecedor">
                        <div class="panel-heading">Cadastro de Fornecedores</div>
            			<div class="panel-body">
            				<div class="row">
            					<div class="">
            						<form method="POST" action="<?php echo base_url('atualizar-fornecedor') ?>" role="form" id="form-edicao-fornecedores">

                                        <div class="form-group col-lg-6">
                                            <label class="control-label">
                                                Código do Fornecedor
                                            </label>
                                            <input type="text" name="codFornecedor" id="codFornecedor" value="<?php echo $dados['CODIGO_FORNECEDOR'] ?>" class="form-control" readonly>
                                        </div>

                                        <div class="form-group col-lg-6">
                                            <label><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Botões de opção em linha</font></font></label>
                                            <div class="form-group">
                                                <label class="radio-inline">
                                                    <input type="radio" name="cnpj" id="cnpj" value="option1" checked onclick="if (this.checked) {$('#cnpjDiv').show(); $('#cpfDiv').hide(); $('#dapDiv').hide()}"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">CNPJ
                                                </font></font></label>
                                                <label class="radio-inline">
                                                    <input type="radio" name="cnpj" id="cpf"  value="option2" onclick="if (this.checked) {$('#cnpjDiv').hide(); $('#cpfDiv').show(); $('#dapDiv').hide()}"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">CPF
                                                </font></font></label>
                                                <label class="radio-inline">
                                                    <input type="radio" name="cnpj" id="dap" value="option3" onclick="if (this.checked) {$('#cnpjDiv').hide(); $('#cpfDiv').hide(); $('#dapDiv').show()}"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">DAP
                                                </font></font></label>
                                            </div>
                                        </div>
            							
            							<div class="form-group col-lg-6">
            								<label class="control-label">Nome Fantasia</label>
            								<input type="text" name="nomeFornecedor" id="nomeFornecedor" class="form-control" placeholder="Digite o nome fantasia do fornecedor" value="<?php echo $dados['NOME_FORNECEDOR'] ?>" autocomplete="off" autofocus>
            							</div>
            							
            							<div class="form-group col-lg-6">
                                            <div style="display: block;" id="cnpjDiv">
                                                <label class="control-label">CNPJ do Fornecedor</label>
                                                <input type="text" name="cnpjFornecedor" id="cnpjFornecedor" class="form-control" placeholder="Digite o CNPJ do fornecedor" maxlength="14" autocomplete="off"  value="<?php echo $dados['CNPJ_FORNECEDOR'] ?>">
                                            </div>

                                            <div style="display: none;" id="cpfDiv">
                                                <label class="control-label">CPF do Fornecedor</label>
                                                <input type="text" name="cpfFornecedor" id="cpfFornecedor" class="form-control" placeholder="Digite o CPF do fornecedor" value="<?php echo $dados['CPF_FORNECEDOR'] ?>">
                                            </div>

                                            <div style="display: none;" id="dapDiv">
                                                <label class="control-label">DAP do Fornecedor</label>
                                                <input type="text" name="dapFornecedor" id="dapFornecedor" class="form-control" placeholder="Digite o DAP do fornecedor" value="<?php echo $dados['DAP_FORNECEDOR'] ?>">
                                            </div>
                                        </div>

                                        <div class="form-group col-lg-6">
                                            <label class="control-label">
                                                Razão social
                                            </label>
                                            <input type="text" name="razaoSocial" id="razaoSocial" class="form-control" placeholder="Digite a razão social fornecedor" value="<?php echo $dados['RAZAO_SOCIAL'] ?>">
                                        </div>

                                        <div class="form-group col-lg-6">
                                            <label class="control-label">
                                                Inscrição Estadual
                                            </label>
                                            <input type="text" name="inscricaoEstadual" id="inscricaoEstadual" class="form-control" placeholder="Digite a inscrição estadual do fornecedor" value="<?php echo $dados['INSCRICAO_ESTADUAL'] ?>">
                                        </div>

                                        <div class="form-group col-lg-6">
                                            <label class="control-label">
                                                Cep
                                            </label>
                                            <input type="text" name="cep" id="cep" class="form-control" placeholder="Digite o CEP do fornecedor" value="<?php echo $dados['CEP_FORNECEDOR'] ?>" onblur="pesquisacep(this.value)">
                                        </div>

                                        <div class="form-group col-lg-6">
                                            <label class="control-label">
                                                Estado
                                            </label>
                                            <input type="text" name="estadoFornecedor" id="estadoFornecedor" class="form-control" placeholder="Digite o estado do fornecedor" value="<?php echo $dados['ESTADO_FORNECEDOR'] ?>" readonly>
                                        </div>

                                        <div class="form-group col-lg-6">
                                            <label class="control-label">
                                                Cidade
                                            </label>
                                            <input type="text" name="cidadeFornecedor" id="cidadeFornecedor" class="form-control" placeholder="Digite a cidade do fornecedor" value="<?php echo $dados['CIDADE_FORNECEDOR'] ?>" readonly>
                                        </div>

                                        <div class="form-group col-lg-6">
                                            <label class="control-label">
                                                Bairro
                                            </label>
                                            <input type="text" name="bairroFornecedor" id="bairroFornecedor" class="form-control" placeholder="Digite o bairro do fornecedor" value="<?php echo $dados['BAIRRO_FORNECEDOR'] ?>">
                                        </div>

                                        <div class="form-group col-lg-6">
                                            <label class="control-label">
                                                Logradouro
                                            </label>
                                            <input type="text" name="logradouroFornecedor" id="logradouroFornecedor" class="form-control"  placeholder="Digite o logradouro do fornecedor" value="<?php echo $dados['LOGRADOURO_FORNECEDOR'] ?>">
                                        </div>

                                        <div class="form-group col-lg-6">
                                            <label class="control-label">
                                                Complemento
                                            </label>
                                            <input type="text" name="complementoFornecedor" id="complementoFornecedor" placeholder="Digite o Complemento do Endereço do fornecedor" class="form-control" value="<?php echo $dados['COMPLEMENTO'] ?>">
                                        </div>

                                        <div class="form-group col-lg-6">
                                            <label class="control-label">Email</label>
                                            <input type="email" name="emailFornecedor" id="emailFornecedor" class="form-control" placeholder="Digite o email do fornecedor" value="<?php echo $dados['EMAIL_FORNECEDOR'] ?>">
                                        </div>
                                        
                                        <div class="form-group col-lg-6">
                                            <label class="control-label">
                                                Selecione as Categorias de Produtos Ofertados Pelo Fornecedor
                                            </label>
                                            <select multiple name="categoriasOfertadas[]" id="categoriasOfertadas" class="form-control chosen-select">
                                                <option></option>
                                                <?php foreach ($ofertas as $value): ?>
                                                    <option selected value="<?php echo $value['ID_CATEGORIA'] ?>"><?php echo $value['DESC_CATEGORIA'] ?></option>
                                                <?php endforeach ?>

                                                <?php foreach ($categorias as $categoria): ?>
                                                    <option value="<?php echo $categoria['ID_CATEGORIA'] ?>"><?php echo $categoria['DESC_CATEGORIA'] ?></option>
                                                <?php endforeach ?>

                                            </select>
                                        </div>

                                        <div class="form-group col-lg-6">
                                            <input type="checkbox" name="status" id="status" <?php if ($dados['STATUS'] == 2): ?> checked <?php endif ?> value="2">Inativo
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
                    <a href="<?php echo base_url('fornecedores'); ?>" type="button" class="btn btn-info">Voltar</a>
                    <a href="<?php echo base_url('inicio') ?>" type="button" class="btn btn-danger">Fechar</a>
                    <button type="reset" class="btn btn-default">Limpar</button>
                    <button type="submit" class="btn btn-success" name="btn-finalizar" id="btn-finalizar">Finalizar Edição</button>
                </div>
            </div>
        </form>
        </div>

    <script src="<?php echo base_url('assets/scripts/viaCep.js')?>"></script>
    <script src="<?php echo base_url('assets/scripts/funcoes.js') ?>"></script>
    <script src="<?php echo base_url('assets/scripts/class/Fornecedor.js') ?>"></script>
    <script type="text/javascript">
        window.app = new Fornecedor("form-edicao-fornecedores", ['nomeFornecedor', 'razaoSocial', 'cep', 'estadoFornecedor', 'cidadeFornecedor', 'bairroFornecedor', 'logradouroFornecedor', 'categoriasOfertadas[]']);
    </script>
    <link href="<?php echo base_url('vendor/harvesthq/chosen/chosen.css') ?>" rel="stylesheet" >
    <link href="<?php echo base_url('vendor/harvesthq/chosen/chosen.min.css') ?>" rel="stylesheet" >   
    <script src="<?php echo base_url('vendor/harvesthq/chosen/chosen.jquery.js'); ?>"></script>
    <script src="<?php echo base_url('vendor/harvesthq/chosen/chosen.jquery.min.js'); ?>"></script>
    <script src="<?php echo base_url('vendor/harvesthq/chosen/chosen.proto.js'); ?>"></script>
    <script src="<?php echo base_url('vendor/harvesthq/chosen/chosen.proto.min.js'); ?>"></script>

    <script>
        $(".chosen-select").chosen({
                placeholder_text_single : 'Selecione as categorias',
                width: "95%",
                no_results_text: "Nenhuma categoria encontrada"
            }); 
    </script>

