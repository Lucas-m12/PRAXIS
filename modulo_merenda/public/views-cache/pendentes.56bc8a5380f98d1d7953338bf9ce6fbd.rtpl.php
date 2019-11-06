<?php if(!class_exists('Rain\Tpl')){exit;}?>	<div id="page-wrapper">
		<div class="row">
             <!-- page header -->
            <div class="page-header"></div>
            <!--end page header -->
        </div>
        
        <div class="row">

        	<div class="col-lg-12">
        		
        		<div class="panel panel-default">
        			
					<div class="panel-heading">Pedidos Pendentes</div>

        			<div class="panel-body">
        				
        				<div class="table-responsive">
        					
        					<table class="table table-striped table-bordered table-hover" id="dataTables-example">
        						
        						<thead>
        							
        							<tr>
        								
        								<th>CÓDIGO DO PEDIDO</th>
        								<th>FORNECEDOR</th>
        								<th>PRODUTO</th>
                                        <th>QUANTIDADE</th>
        								<th>SITUAÇÃO</th>

        							</tr>

        						</thead>

        						<tbody>
        							
        							<tr class="odd gradeX">
                                        <?php $counter1=-1;  if( isset($pendentes) && ( is_array($pendentes) || $pendentes instanceof Traversable ) && sizeof($pendentes) ) foreach( $pendentes as $key1 => $value1 ){ $counter1++; ?>
                                        	<td><?php echo htmlspecialchars( $value1["ID_PEDIDO"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
                                        	<td><?php echo htmlspecialchars( $value1["NOME_FORNECEDOR"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
                                        	<td><?php echo htmlspecialchars( $value1["DESC_PRODUTO"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
                                            <td><?php echo htmlspecialchars( $value1["QUANTIDADE_PRODUTO"], ENT_COMPAT, 'UTF-8', FALSE ); ?> <?php echo htmlspecialchars( $value1["SIGLA_UNIDADE_MEDIDA"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
                                        	<td><?php echo htmlspecialchars( $value1["DS_STATUS"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
                                        	<td><a id="buttonEdit" href="#modal_confirmarPedido" data-toggle='modal' class="btn btn-success btn-block">Editar</a></td>
                                        	<td><button type="button" id="buttonCancel" class="btn btn-danger btn-block">Cancelar</button></td>
                                        <?php } ?>
                                    </tr>        							

        						</tbody>

        					</table>

        				</div>

        			</div>

        		</div>

        	</div>

        </div>

	</div>
	<!--<script src="\praxis/modulo_merenda/public/plugins/dataTables/jquery.dataTables.js"></script>
    <script src="\praxis/modulo_merenda/public/plugins/dataTables/dataTables.bootstrap.js"></script>
	<script>
        $(document).ready(function () {
            $('#dataTables-example').dataTable();
        });
    </script>-->
    <!-- Janela Modal -->
    <div class="modal" id="modal_confirmarPedido">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Confirmar Pedido</h4>
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Fechar</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="col-xs-20">

                        <form method="POST" id="form-confirmarPedido" name="action">

                            <div class="form-group">
                                <label class="control-label" for="first-name">
                                    Data de Recebimento
                                </label>
                                <input type="date" name="dataRecebimento" id="dataRecebimento" class="form-control" required>
                            </div>

                            <div class="form-group">
                                <button type="submit" name="submitSalvar" class="btn btn-lg btn-success btn-block">Salvar</button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>