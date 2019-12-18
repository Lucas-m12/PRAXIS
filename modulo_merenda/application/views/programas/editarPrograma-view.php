
        <div class="row">
        	<div class="col-lg-12">
        		<div class="panel panel-default">
        			<div class="panel-heading">Cadastro de Programas</div>
        			<div class="panel-body">
        				<div class="row">
        					<div class="col-lg-12">
        						<form method="post" action="" role="form" id="form-programa-edit">
        							
                                    <div class="form-group col-lg-6">
                                        <label class="control-label">Código do Programa</label>
                                        <input type="number" name="idPrograma" class="form-control" id="idPrograma" value="<?php echo $dados['ID_PROGRAMA'] ?>" disabled>
                                    </div>
        							<div class="form-group col-lg-6">
        								<label>Nome do Programa</label>
        								<input type="text" name="programa" id="programa" class="form-control" placeholder="Digite o nome do programa" value="<?php echo $dados['DESC_PROGRAMA'] ?>">
        							</div>
                                    <div class="form-group col-lg-6">
                                        <label>Sigla do Programa</label>
                                        <input type="text" name="siglaPrograma" id="siglaPrograma" class="form-control" placeholder="Digite a sigla do programa" value="<?php echo $dados['PROGRAMA'] ?>">
                                    </div>

                                    <div class="form-group">
                                        <input type="checkbox" name="statusPrograma" id="statusPrograma" <?php if ($dados['STATUS'] == 2): ?> checked <?php endif ?>>Inativo
                                    </div>
                                    
        					</div>
        				</div>
        			</div>
        		</div>

                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div align="center">
                            <a href="<?php echo base_url('programas');?>" type="button" class="btn btn-info">Voltar</a>
                            <a href="<?php echo base_url('inicio') ?>" type="button" class="btn btn-danger">Fechar</a>
                            <button type="reset" class="btn btn-default">Limpar</button>
                            <button type="submit" name="atualizarPrograma" id="atualizarPrograma" class="btn btn-success">Salvar</button>
                        </div>
                    </div>
                </div>
            </form>

        	</div>
        </div>

        <script src="<?php echo base_url('assets/scripts/class/Programa.js') ?>"></script>
        <script>
            window.app = new Programa("form-programa-edit", ["idPrograma", "programa"], "<?php echo base_url('atualizar-programa') ?>", "<?php echo base_url('programas') ?>");
        </script>

