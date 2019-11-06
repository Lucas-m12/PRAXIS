<?php if(!class_exists('Rain\Tpl')){exit;}?>
        <div class="row">
        	<div class="col-lg-12">
        		<div class="panel panel-default">
        			<div class="panel-heading">Cadastro de Programas</div>
        			<div class="panel-body">
        				<div class="row">
        					<div class="col-lg-12">
        						<form method="post" action="/praxis/modulo_merenda/editar/programa/<?php echo htmlspecialchars( $info["ID_PROGRAMA"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" role="form" id="form-programa">
        							
        							<div class="form-group">
        								<label>Nome do Programa</label>
        								<input type="text" name="programa" id="programa" class="form-control" placeholder="Digite o nome do programa" value="<?php echo htmlspecialchars( $info["DESC_PROGRAMA"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
        							</div>

                                    <div class="form-group">
                                        <input type="checkbox" name="statusPrograma" id="statusPrograma" <?php if( $info["STATUS"] == 2 ){ ?> checked <?php } ?> value="2">Inativo
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
                            <button type="submit" name="atualizarPrograma" id="atualizarPrograma" class="btn btn-success">Salvar</button>
                        </div>
                    </div>
                </div>
            </form>

        	</div>
        </div>

