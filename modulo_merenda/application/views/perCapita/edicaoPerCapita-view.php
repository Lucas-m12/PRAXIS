		
		<div class="row" id="oculta">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Edição PerCapita</div>
                    <div class="panel-body">
                        <form action="" method="POST" role="form" id="form-edicao-percapita">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                                                                
                                            <th>NÍVEL DE ENSINO</th>
                                            <th>PRODUTO</th>
                                            <th>PERCAPITA</th>
                                            <th>AÇÃO</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <?php echo $perCapita[0]['DS_NIVEL_ENSINO'] ?>
                                                <input type="hidden" name="idNivelEnsino" id="idNivelEnsino" value="<?php echo $perCapita[0]['ID_NIVEL_ENSINO'] ?>">
                                            </td>
                                            <td>
                                                <div class="form-group">
                                                    <select class="form-control" name="produto" id="produto">
                                                        <option selected value=""></option>
                                                        <?php foreach ($perCapita as $value): ?>
                                                            <option value="<?php echo $value['ID_PRODUTO'] ?>"><?php echo $value['DESC_PRODUTO'] ?></option>
                                                        <?php endforeach ?>
                                                    </select>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="form-group">
                                                    <input type="number" name="valorPerCapita" id="valorPerCapita" class="form-control">
                                                </div>
                                            </td>
                                            <td>
                                                <button type="button" class="btn btn-success btn-xs" name="salvar" id="salvar" onclick="adicionar(this)">Salvar</button>
                                            </td>
                                        </tr>                                        
                                    </tbody>
                                </table>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

		




		<div class="panel panel-default">
            <div class="panel-heading">
                <div align="center">
                    <a type="button" class="btn btn-info" href="<?php echo base_url('perCapita') ?>">Voltar</a>
                    <a href="<?php echo base_url('inicio') ?>" type="button" class="btn btn-danger">Fechar</a>
                    <button type="reset" class="btn btn-default">Limpar</button>
                    <a type="button" class="btn btn-success" href="<?php echo base_url('perCapita') ?>">Finalizar</a>
                </div>
                
            </div>
        </div>

        <script type="text/javascript">
            $(document).ready(function(){

                $("#produto").change(function(){

                    var valorPerCapita = $("#valorPerCapita");

                    valorPerCapita.empty();

                    $.ajax({

                        type: "POST",
                        url: "<?php echo base_url('valorPercapita') ?>",
                        data: {idProduto: this.value, nivelEnsino: $("#idNivelEnsino").val()},
                        success: data =>{
                            let dados = JSON.parse(data);
                            
                            valorPerCapita.val(JSON.parse(data)['VALOR_PERCAPITA']);

                        }

                    });

                });

            });
        </script>

        <script type="text/javascript">
            function adicionar(linha){
                
                linha.disabled = true;

                let tr = $(linha).parent().parent();

                let nivelEnsino = tr[0].querySelector("#idNivelEnsino").value;
                let produto     = tr[0].querySelector("#produto").value;
                let percapita   = tr[0].querySelector("#valorPerCapita").value;

                $.ajax({

                    type: "POST",
                    url: "<?php echo base_url('editarPerCapita') ?>",
                    data: {nivelEnsino, produto, percapita},
                    success: data =>{

                        swal.fire({

                            text: "Salvo com sucesso",
                            icon: "success"

                        }).then(()=>{
                            linha.disabled      = false;
                        });

                    }

                });
            }
        </script>

        