		
		<div class="row" id="oculta">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Edição PerCapita</div>
                    <div class="panel-body">
                        <form action="" method="POST" role="form" id="form-edicao-percapita"> 
                            <div class="form-group col-lg-6">
                                <label class="control-label">Nível de Ensino</label>
                                <input type="text" name="nivelEnsino" id="nivelEnsino" class="form-control" value="<?php echo $perCapita['DS_NIVEL_ENSINO'] ?>" disabled>
                                <input type="hidden" name="idPercapita" id="idPercapita" value="<?php echo $perCapita['ID_PERCAPITA'] ?>">
                            </div>
                            <div class="form-group col-lg-6">
                                <label class="control-label">Produto</label>
                                <input type="text" name="produto" id="produto" class="form-control" value="<?php echo $perCapita['DESC_PRODUTO'] ?>" disabled>
                            </div>
                            <div class="form-group col-lg-6">
                                <label class="control-label">Valor PerCapita</label>
                                <input type="number" name="valorPerCapita" id="valorPerCapita" class="form-control" value="<?php echo $perCapita['VALOR_PERCAPITA'] ?>">
                            </div>
                            
                        
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
                    <button type="submit" class="btn btn-success" id="btn-cadastrar" name="btn-cadastrar">Salvar</button>
                </div>
                </form>
            </div>
        </div>

        <script type="text/javascript">
            $(document).ready(function(){

                let formEl = document.getElementById('form-edicao-percapita');

                formEl.addEventListener("submit", event =>{

                    event.preventDefault();

                    let data = {};
                    let isValid = true;

                    [...formEl.elements].forEach(campos =>{

                        if (campos.name == "valorPerCapita") {
                            if (campos.value != "") {
                               data[campos.name] = campos.value; 
                            } else {
                                campos.parentElement.classList.add('has-error');

                                isValid = false;
                            }
                            
                        } 

                        if (campos.name == "idPercapita") {
                            if (campos.value != "") {
                                data[campos.name] = campos.value;
                            } else {
                                campos.parentElement.classList.add('has-error');

                                isValid = false;
                            }
                        }

                    });

                    if (!isValid) {
                        swal.fire({

                            text: "Preencha o valor perCapita",
                            icon: "error"

                        });
                    } else {

                        $.ajax({

                            type: "POST",
                            url: "<?php echo base_url() ?>editarPerCapita",
                            data,
                            success: data =>{

                                swal.fire({

                                    text: "Atualização efetuada com sucesso",
                                    icon: "success"

                                }).then(result =>{

                                    window.location.href = "<?php echo base_url() ?>perCapita";

                                });

                            }

                        });

                    }

                });

            });
        </script>