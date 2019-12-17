		
		<div class="row" id="oculta">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">PerCapita</div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                    <tr>
                                        
                                        <th>NÍVEL DE ENSINO</th>
                                        <th>AÇÃO</th>

                                    </tr>
                                </thead>
                                <tbody>

                                    <?php foreach ($niveisEnsino as $value): ?>
                                    	<tr>
                                    		<td><?php echo $value['DS_NIVEL_ENSINO'] ?></td>
                                            <td><a type="button" href="<?php echo base_url('edicao-percapitaView') . '/' . $value['ID_NIVEL_ENSINO']; ?>" class="btn btn-default btn-xs">Editar</a> <a type="button" class="btn btn-success btn-xs" href="<?php echo base_url('#') ?>" disabled>Imprimir</a></td>
                                    	</tr>
                                    <?php endforeach ?>
                                    
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
                    <a type="button" class="btn btn-info" href="<?php echo base_url('inicio') ?>">Voltar</a>
                    <a href="<?php echo base_url('inicio') ?>" type="button" class="btn btn-danger">Fechar</a>
                    <button type="reset" class="btn btn-default">Limpar</button>
                    <!-- <a type="button" href="<?php echo base_url('cadastro-percapita') ?>" class="btn btn-success" id="btn-avancar" name="btn-avancar">Novo PerCapita</a> -->
                </div>
            </div>
        </div>



        <script type="text/javascript">
        	function adicionar(linha){

        		let tr = $(linha).parent().parent();

        		let nivelEnsino = tr[0].querySelector(".nivelEnsino").innerHTML;
        		let produto 	= tr[0].querySelector(".produto").value;
        		let percapita 	= tr[0].querySelector(".percapita").value;

        		$.ajax({

        			type: "POST",
        			url: "<?php echo base_url('cadastrar-perCapita') ?>",
        			data: {nivelEnsino, produto, percapita},
        			success: data =>{

        				if (JSON.parse(data) != "") {
        					swal.fire({

        						text: "Adicionado com sucesso",
        						icon: "success"

        					}).then(()=>{
        						produto.disabled 	= true;
        						percapita.disabled 	= true;
        						linha.disabled 		= true;
        					});
        				}

        			}

        		});
        	}
        </script>