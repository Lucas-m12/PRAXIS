<?php if(!class_exists('Rain\Tpl')){exit;}?>
        <div class="row" id="pesquisa">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Pesquisa de Fornecedor</div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <form method="post" action="" role="form" id="form-pesquisa-fornecedores">
                                    
                                    <div class="form-group col-lg-6">
                                        <label class="control-label">
                                            Nome do Fornecedor
                                        </label>
                                        <input type="text" name="nomeFornecedorPesquisa" id="nomeFornecedorPesquisa" class="form-control" placeholder="Digite o Nome do Fornecedor">
                                    </div>

                                    <div class="form-group col-lg-6">
                                        <label class="control-label">
                                            CNPJ do Fornecedor
                                        </label>
                                        <input type="text" name="cnpjFornecedorPesquisa" id="cnpjFornecedorPesquisa" class="form-control" maxlength="14" placeholder="Digite o CNPJ do fornecedor">
                                    </div>

                                    

                                    <div class="form-group col-lg-12">
                                        <button type="button" name="pesquisarFornecedor" id="pesquisarFornecedor" class="btn btn-success">Pesquisar</button>
                                    </div>

                                </form>
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
                                        <th>CÓDIGO DO FORNECEDOR</th>            
                                        <th>NOME DO FORNECEDOR</th>
                                        <th>CNPJ DO FORNECEDOR</th>        
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
                    <button type="button" class="btn btn-info" onclick="history.go(-1)">Voltar</button>
                    <a href="/praxis/modulo_merenda/" type="button" class="btn btn-danger">Fechar</a>
                    <button type="reset" class="btn btn-default">Limpar</button>
                    <button type="button" class="btn btn-success" disabled name="btn-novo" id="btn-novo">Novo Fornecedor</button>
                </div>
            </div>
        <!-- </form> -->
        </div>

    <script src="\praxis/modulo_merenda/public/scripts/controllers/Pesquisa.js"></script>
    <script src="\praxis/modulo_merenda/public/scripts/pesquisaFornecedor.js"></script>
    <!-- <script src="\praxis/modulo_merenda/public/scripts/funcoes.js"></script> -->

    
