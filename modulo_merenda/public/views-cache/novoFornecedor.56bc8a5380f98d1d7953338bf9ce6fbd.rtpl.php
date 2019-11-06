<?php if(!class_exists('Rain\Tpl')){exit;}?>	<div id="page-wrapper">
		<div class="row">
             <!-- page header -->
            <div class="page-header"></div>
            <!--end page header -->
        </div>

        <div class="row">
        	<div class="col-lg-12">
        		<div class="panel panel-default">
        		    <div id="cadastroFornecedor">
                        <div class="panel-heading">Cadastro de Fornecedores</div>
            			<div class="panel-body">
            				<div class="row">
            					<div class="">
            						<form method="post" action="/praxis/modulo_merenda/cadastrar/fornecedor" role="form" id="form-fornecedores" onsubmit="">

                                        <div class="form-group col-lg-6">
                                            <label class="control-label">
                                                Código do Fornecedor
                                            </label>
                                            <input type="text" name="codFornecedor" id="codFornecedor" value="<?php echo htmlspecialchars( $codigoFornecedor, ENT_COMPAT, 'UTF-8', FALSE ); ?>" class="form-control" readonly>
                                        </div>
            							
            							<div class="form-group col-lg-6">
            								<label class="control-label">Nome Fantasia</label>
            								<input type="text" name="nomeFornecedor" id="nomeFornecedor" class="form-control" placeholder="Digite o nome fantasia do fornecedor" autocomplete="off" autofocus>
            							</div>
            							
            							<div class="form-group col-lg-6">
            								<label class="control-label">CNPJ do Fornecedor</label>
            								<input type="text" name="cnpjFornecedor" id="cnpjFornecedor" class="form-control" placeholder="Digite o CNPJ do fornecedor" maxlength="14" autocomplete="off">
            							</div>

                                        <div class="form-group col-lg-6">
                                            <label class="control-label">
                                                Razão social
                                            </label>
                                            <input type="text" name="razaoSocial" id="razaoSocial" class="form-control" placeholder="Digite a razão social fornecedor" autocomplete="off">
                                        </div>

                                        <div class="form-group col-lg-6">
                                            <label class="control-label">
                                                Inscrição Estadual
                                            </label>
                                            <input type="text" name="inscricaoEstadual" id="inscricaoEstadual" class="form-control" placeholder="Digite a inscrição estadual do fornecedor" autocomplete="off">
                                        </div>

                                        <div class="form-group col-lg-6">
                                            <label class="control-label">
                                                Cep
                                            </label>
                                            <input type="text" name="cep" id="cep" class="form-control" placeholder="Digite o CEP do fornecedor" autocomplete="off" onblur="pesquisacep(this.value)">
                                        </div>

                                        <div class="form-group col-lg-6">
                                            <label class="control-label">
                                                Estado
                                            </label>
                                            <input type="text" name="estadoFornecedor" id="estadoFornecedor" class="form-control" placeholder="Digite o estado do fornecedor">
                                        </div>

                                        <div class="form-group col-lg-6">
                                            <label class="control-label">
                                                Cidade
                                            </label>
                                            <input type="text" name="cidadeFornecedor" id="cidadeFornecedor" class="form-control" placeholder="Digite a cidade do fornecedor">
                                        </div>

                                        <div class="form-group col-lg-6">
                                            <label class="control-label">
                                                Bairro
                                            </label>
                                            <input type="text" name="bairroFornecedor" id="bairroFornecedor" class="form-control" placeholder="Digite o bairro do fornecedor" autocomplete="off">
                                        </div>

                                        <div class="form-group col-lg-6">
                                            <label class="control-label">
                                                Logradouro
                                            </label>
                                            <input type="text" name="logradouroFornecedor" id="logradouroFornecedor" class="form-control"  placeholder="Digite o logradouro do fornecedor">
                                        </div>

                                        <div class="form-group col-lg-6">
                                            <label class="control-label">
                                                Complemento
                                            </label>
                                            <input type="text" name="complementoFornecedor" id="complementoFornecedor" placeholder="Digite o Complemento do Endereço do fornecedor" class="form-control">
                                        </div>
                                        
                                        <div class="form-group col-lg-6">
                                            <label class="control-label">
                                                Selecione as Categorias de Produtos Ofertados Pelo Fornecedor
                                            </label>
                                            <select multiple name="categoriasOfertadas[]" id="categoriasOfertadas" class="form-control chosen-select">
                                                <?php $counter1=-1;  if( isset($categorias) && ( is_array($categorias) || $categorias instanceof Traversable ) && sizeof($categorias) ) foreach( $categorias as $key1 => $value1 ){ $counter1++; ?>
                                                    <option value="<?php echo htmlspecialchars( $value1["ID_CATEGORIA"], ENT_COMPAT, 'UTF-8', FALSE ); ?>"><?php echo htmlspecialchars( $value1["DESC_CATEGORIA"], ENT_COMPAT, 'UTF-8', FALSE ); ?></option>
                                                <?php } ?>
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
                    <button type="button" class="btn btn-info" onclick="history.go(-1)">Voltar</button>
                    <a href="/praxis/modulo_merenda/" type="button" class="btn btn-danger">Fechar</a>
                    <button type="reset" class="btn btn-default">Limpar</button>
                    <button type="submit" class="btn btn-success" name="btn-finalizar" id="btn-finalizar">Finalizar Cadastro</button>
                </div>
                </form>
            </div>
        </div>

	</div>

    <script src="\praxis/modulo_merenda/public/scripts/controllers/NovoFornecedor.js"></script>
    <script src="\praxis/modulo_merenda/public/scripts/cadastroFornecedores.js"></script>
    <script src="\praxis/modulo_merenda/public/scripts/viaCep.js"></script>
    <script src="\praxis/modulo_merenda/public/scripts/funcoes.js"></script>

    <script src="\praxis/modulo_merenda/vendor/harvesthq/chosen/chosen.jquery.js"></script>
    <script src="\praxis/modulo_merenda/vendor/harvesthq/chosen/chosen.jquery.min.js"></script>
    <script src="\praxis/modulo_merenda/vendor/harvesthq/chosen/chosen.proto.js"></script>
    <script src="\praxis/modulo_merenda/vendor/harvesthq/chosen/chosen.proto.min.js"></script>

    <script>
        $(".chosen-select").chosen({
                width: "95%",
                no_results_text: "Nenhuma categoria encontrada"
            }); 
    </script>
