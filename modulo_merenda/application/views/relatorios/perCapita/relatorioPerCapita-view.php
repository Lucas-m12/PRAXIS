        <div class="row" id="pesquisa">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Relatório PerCapita</div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <form method="post" action="<?php echo base_url('relatorioPerCapita') ?>" role="form" id="form-pesquisa-produto" target="new">
                                    
                                    <div class="form-group col-lg-6">
                                        <label>Nivel de Ensino</label>
                                        <select name="nivelEnsino" id="nivelEnsino" class="form-control" required>
                                            <option selected value=""></option>
                                            <?php foreach ($niveisEnsino as $value): ?>
                                                <option value="<?php echo $value['ID_NIVEL_ENSINO'] ?>"><?php echo $value['DS_NIVEL_ENSINO'] ?></option>
                                            <?php endforeach ?>
                                        </select>
                                    </div>

                                    <div class="form-group col-lg-6">
                                        <label>Unidade de Ensino</label>
                                        <select name="unidadeEnsino" id="unidadeEnsino" class="form-control" required>
                                            <option selected value=""></option>
                                            <?php foreach ($escolas as $value): ?>
                                                <option value="<?php echo $value['ID_ESCOLA'] ?>"><?php echo $value['NOME_ESCOLA'] ?></option>
                                            <?php endforeach ?>
                                        </select>
                                    </div>

                                    <div class="form-group col-lg-6">
                                        <label>Produto</label>
                                        <select name="produto" id="produto" class="form-control" required>
                                            <option selected value=""></option>
                                            <?php foreach ($produtos as $value): ?>
                                                <option value="<?php echo $value['ID_PRODUTO'] ?>"><?php echo $value['DESC_PRODUTO'] ?></option>
                                            <?php endforeach ?>
                                        </select>
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
                    <a href="<?php echo base_url(); ?>inicio" type="button" class="btn btn-info" onclick="history.go(-1)">Voltar</a>
                    <a href="<?php echo base_url('inicio') ?>" type="button" class="btn btn-danger">Fechar</a>
                    <button type="reset" class="btn btn-default">Limpar</button>
                    <button type="submit" class="btn btn-success" name="imprimir" id="imprimir">Imprimir</button>
                    </form>
                </div>
            </div>
        </div>

