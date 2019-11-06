<?php if(!class_exists('Rain\Tpl')){exit;}?>	<div id="page-wrapper">
		<div class="row">
             <!-- page header -->
            <div class="page-header"></div>
            <!--end page header -->
        </div>

        <div class="row">
        	<div class="col-lg-12">
        		<div class="panel panel-default">
        			<div class="panel-heading">Cadastro de Tipos</div>
        			<div class="panel-body">
        				<div class="row">
        					<div class="col-lg-12">
        						<form method="post" action="/praxis/modulo_merenda/editar/tipo/<?php echo htmlspecialchars( $info["ID_TIPO"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" role="form" id="form-tipos">
        							
        							<div class="form-group">
        								<label class="control-label">Tipo de Produto</label>
        								<input type="text" name="tipoProduto" id="tipoProduto" class="form-control" placeholder="Digite o o tipo de produto" required autocomplete="off" autofocus value="<?php echo htmlspecialchars( $info["TIPO_PRODUTO"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
        							</div>

                                    <div class="form-group">
                                        <input type="checkbox" name="status" id="status" <?php if( $info["STATUS"] == 2 ){ ?> checked <?php } ?> value="2">Inativo
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
                            <button type="submit" name="atualizarTipo" id="atualizarTipo" class="btn btn-success">Salvar</button>
                        </div>
                        </form>

                    </div>
                </div>
        	</div>
        </div>
	</div>