    <div class="row" id="pesquisa">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">Pesquisa de Receita</div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <form method="post" action="" role="form" id="form-pesquisa-receita">
                                
                                <div class="form-group col-lg-6">
                                    <label class="control-label">
                                        Código da Receita
                                    </label>
                                    <input type="number" name="idReceita" id="idReceita" class="form-control">
                                </div>

                                <div class="form-group col-lg-6">
                                    <label class="control-label">Nome da Receita</label>
                                    <select name="nomeReceita" id="nomeReceita" class="form-control">
                                        <option disabled selected></option>
                                    </select>
                                </div>

                                <div class="form-group col-lg-6">
                                    <label>Nivel de Ensino</label>
                                    <select name="nivelEnsino" id="nivelEnsino" class="form-control">
                                        <option disabled selected></option>
                                    </select>
                                </div>

                                

                                <div class="form-group col-lg-6">
                                    <button type="button" name="pesquisarReceita" id="pesquisarReceita" class="btn btn-success">Pesquisar</button>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row" id="resultadoPesquisa">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <!-- <div class="panel-heading">Pesquisa de Produto</div> -->
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>CÓDIGO DA RECEITA</th>
                                    <th>NOME</th>
                                    <th>NÍVEL DE ENSINO</th>
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
                <a href="<?php echo base_url(); ?>inicio" type="button" class="btn btn-info">Voltar</a>
                <a href="<?php echo base_url('inicio') ?>" type="button" class="btn btn-danger">Fechar</a>
                <button type="reset" class="btn btn-default">Limpar</button>
                <a href="<?php echo base_url('novaReceita') ?>" type="button" class="btn btn-success" id="novaReceita">Nova Receita</a>
            </div>
        </div>
    </div>

<script src="<?php echo base_url('assets/scripts/class/Pesquisa.js') ?>"></script>
<script type="text/javascript">
    window.app = new Pesquisa("form-pesquisa-receita", "<?php echo base_url('pesquisarReceita') ?>", 6, "<?php echo base_url('editarReceita') ?>");
</script>