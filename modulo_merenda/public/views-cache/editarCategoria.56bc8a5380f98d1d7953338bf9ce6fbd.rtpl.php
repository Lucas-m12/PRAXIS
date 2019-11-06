<?php if(!class_exists('Rain\Tpl')){exit;}?>
    <div id="page-wrapper">
		<div class="row">
             <!-- page header -->
            <div class="page-header"></div>
            <!--end page header -->
        </div>

        <div class="row">
        	<div class="col-lg-12">
        		<div class="panel panel-default">
        			<div class="panel-heading">Edição da Categoria <?php echo htmlspecialchars( $dado["DESC_CATEGORIA"], ENT_COMPAT, 'UTF-8', FALSE ); ?></div>
        			<div class="panel-body">
        				<div class="row">
        					<div class="col-lg-12">
        						<form method="post" action="/praxis/modulo_merenda/editar/categoria/<?php echo htmlspecialchars( $dado["ID_CATEGORIA"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" role="form" id="form-categorias-edicao">

                                    <div class="form-group col-lg-6">
                                        <label class="control-label">Código da Categoria</label>
                                        <input type="text" name="idCategoria" id="idCategoria" class="form-control" disabled value="<?php echo htmlspecialchars( $dado["ID_CATEGORIA"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
                                    </div>

        							<div class="form-group col-lg-6">
                                        <label class="control-label">Nome da Categoria</label>
                                        <input type="text" name="categoriaProduto" id="categoriaProduto" class="form-control" placeholder="Digite o nome da categoria" value="<?php echo htmlspecialchars( $dado["DESC_CATEGORIA"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
                                    </div>

                                    <div class="form-group col-lg-12">
                                        <input type="checkbox" name="statusCategoria" id="statusCategoria" value="2" class="" <?php if( $dado["STATUS"] == 2 ){ ?> checked <?php } ?> >Inativo
                                    </div>  
        					</div>
        				</div>
        			</div>
        		</div>

                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div align="center" id="oculta">
                            <button type="button" class="btn btn-info" onclick="history.go(-1)">Voltar</button>
                            <a href="/praxis/modulo_merenda/" type="button" class="btn btn-danger">Fechar</a>
                            <button type="reset" class="btn btn-default">Limpar</button>
                            <button type="submit" name="cadastrarCategoria" id="cadastrarCategoria" class="btn btn-success">Salvar</button>
                        </div>
                        </form>

                    </div>
                </div>
        	</div>
        </div>
	</div>

    
