<?php if(!class_exists('Rain\Tpl')){exit;}?>
        <div class="row">
        	<div class="col-lg-12">
        		<div class="panel panel-default">
        		    <div id="cadastroFornecedor">
                        <div class="panel-heading">Cadastro de Fornecedores</div>
            			<div class="panel-body">
            				<div class="row">
            					<div class="">
            						<form method="POST" action="/praxis/modulo_merenda/editar/fornecedor/<?php echo htmlspecialchars( $dados["CODIGO_FORNECEDOR"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" role="form" id="form-edicao-fornecedores">

                                        <div class="form-group col-lg-6">
                                            <label class="control-label">
                                                Código do Fornecedor
                                            </label>
                                            <input type="text" name="codFornecedor" id="codFornecedor" value="<?php echo htmlspecialchars( $dados["CODIGO_FORNECEDOR"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" class="form-control" readonly>
                                        </div>
            							
            							<div class="form-group col-lg-6">
            								<label class="control-label">Nome Fantasia</label>
            								<input type="text" name="nomeFornecedor" id="nomeFornecedor" class="form-control" placeholder="Digite o nome fantasia do fornecedor" value="<?php echo htmlspecialchars( $dados["NOME_FORNECEDOR"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" autocomplete="off" autofocus>
            							</div>
            							
            							<div class="form-group col-lg-6">
            								<label class="control-label">CNPJ do Fornecedor</label>
            								<input type="text" name="cnpjFornecedor" id="cnpjFornecedor" class="form-control" placeholder="Digite o CNPJ do fornecedor" value="<?php echo htmlspecialchars( $dados["CNPJ_FORNECEDOR"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
            							</div>

                                        <div class="form-group col-lg-6">
                                            <label class="control-label">
                                                Razão social
                                            </label>
                                            <input type="text" name="razaoSocial" id="razaoSocial" class="form-control" placeholder="Digite a razão social fornecedor" value="<?php echo htmlspecialchars( $dados["RAZAO_SOCIAL"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
                                        </div>

                                        <div class="form-group col-lg-6">
                                            <label class="control-label">
                                                Inscrição Estadual
                                            </label>
                                            <input type="text" name="inscricaoEstadual" id="inscricaoEstadual" class="form-control" placeholder="Digite a inscrição estadual do fornecedor" value="<?php echo htmlspecialchars( $dados["INSCRICAO_ESTADUAL"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
                                        </div>

                                        <div class="form-group col-lg-6">
                                            <label class="control-label">
                                                Cep
                                            </label>
                                            <input type="text" name="cep" id="cep" class="form-control" placeholder="Digite o CEP do fornecedor" value="<?php echo htmlspecialchars( $dados["CEP_FORNECEDOR"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" onblur="pesquisacep(this.value)">
                                        </div>

                                        <div class="form-group col-lg-6">
                                            <label class="control-label">
                                                Estado
                                            </label>
                                            <input type="text" name="estadoFornecedor" id="estadoFornecedor" class="form-control" placeholder="Digite o estado do fornecedor" value="<?php echo htmlspecialchars( $dados["ESTADO_FORNECEDOR"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" readonly>
                                        </div>

                                        <div class="form-group col-lg-6">
                                            <label class="control-label">
                                                Cidade
                                            </label>
                                            <input type="text" name="cidadeFornecedor" id="cidadeFornecedor" class="form-control" placeholder="Digite a cidade do fornecedor" value="<?php echo htmlspecialchars( $dados["CIDADE_FORNECEDOR"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" readonly>
                                        </div>

                                        <div class="form-group col-lg-6">
                                            <label class="control-label">
                                                Bairro
                                            </label>
                                            <input type="text" name="bairroFornecedor" id="bairroFornecedor" class="form-control" placeholder="Digite o bairro do fornecedor" value="<?php echo htmlspecialchars( $dados["BAIRRO_FORNECEDOR"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
                                        </div>

                                        <div class="form-group col-lg-6">
                                            <label class="control-label">
                                                Logradouro
                                            </label>
                                            <input type="text" name="logradouroFornecedor" id="logradouroFornecedor" class="form-control"  placeholder="Digite o logradouro do fornecedor" value="<?php echo htmlspecialchars( $dados["LOGRADOURO_FORNECEDOR"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
                                        </div>

                                        <div class="form-group col-lg-6">
                                            <label class="control-label">
                                                Complemento
                                            </label>
                                            <input type="text" name="complementoFornecedor" id="complementoFornecedor" placeholder="Digite o Complemento do Endereço do fornecedor" class="form-control" value="<?php echo htmlspecialchars( $dados["COMPLEMENTO"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
                                        </div>
                                        
                                        <div class="form-group col-lg-6">
                                            <label class="control-label">
                                                Selecione as Categorias de Produtos Ofertados Pelo Fornecedor
                                            </label>
                                            <select multiple name="categoriasOfertadas[]" id="categoriasOfertadas" class="form-control chosen-select">
                                                <option></option>
                                                <?php $counter1=-1;  if( isset($ofertas) && ( is_array($ofertas) || $ofertas instanceof Traversable ) && sizeof($ofertas) ) foreach( $ofertas as $key1 => $value1 ){ $counter1++; ?>
                                                    <option selected value="<?php echo htmlspecialchars( $value1["ID_CATEGORIA"], ENT_COMPAT, 'UTF-8', FALSE ); ?>"><?php echo htmlspecialchars( $value1["DESC_CATEGORIA"], ENT_COMPAT, 'UTF-8', FALSE ); ?></option>
                                                <?php } ?>

                                                <?php $counter1=-1;  if( isset($categorias) && ( is_array($categorias) || $categorias instanceof Traversable ) && sizeof($categorias) ) foreach( $categorias as $key1 => $value1 ){ $counter1++; ?>
                                                    <option value="<?php echo htmlspecialchars( $value1["ID_CATEGORIA"], ENT_COMPAT, 'UTF-8', FALSE ); ?>"><?php echo htmlspecialchars( $value1["DESC_CATEGORIA"], ENT_COMPAT, 'UTF-8', FALSE ); ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>

                                        <div class="form-group col-lg-6">
                                            <input type="checkbox" name="status" id="status" <?php if( $dados["STATUS"] == 2 ){ ?>checked<?php } ?> value="2">Inativo
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
                    <button type="submit" class="btn btn-success" name="btn-finalizar" id="btn-finalizar">Finalizar Edição</button>
                </div>
            </div>
        </form>
        </div>

    <script src="\praxis/modulo_merenda/public/scripts/funcoes.js"></script>
    <script src="\praxis/modulo_merenda/public/scripts/viaCep.js"></script>
    <script src="\praxis/modulo_merenda/public/scripts/controllers/Pesquisa.js"></script>
    <script src="\praxis/modulo_merenda/public/scripts/pesquisaFornecedor.js"></script>
    
    <script src="\praxis/modulo_merenda/public/scripts/controllers/NovoFornecedor.js"></script>
    <script src="\praxis/modulo_merenda/public/scripts/editarFornecedor.js"></script>
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
    
