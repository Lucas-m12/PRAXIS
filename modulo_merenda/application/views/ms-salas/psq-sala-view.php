<?php 
/*
    Mensagem de erro de permissão
*/
$error = $this->session->flashdata('error');
if(isset($error)) { echo '<div align="center" class="alert alert-danger" >' .$this->session->flashdata('error').'</div>' ; } 
$this->session->set_userdata('permissao', 1);
?>
<div class="panel panel-success">
    <div class="panel-heading">
        <i class="fa fa-search fa-fw"></i>Pesquisa de Salas
    </div>
    <div class="panel-body">
        <div class="list-group">
            <form role="form">
                <div class="col-lg-12">
                <div class="table-responsive">    
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        
                        <thead>
                            <tr>
                                <th class="text-center">Sala</th>
                                <th class="text-right">Capacidade</th>
                                <th class="text-center">Açoes</th>
                            </tr>
                        </thead>
                        <?php
                       
                        $contador = 0;
                        foreach ($salas as $sala)
                        {
                        echo '<tr>';
                            echo '<td>'.$sala->NOME_SALA.'</td>';
                            echo '<td class="text-right">'.$sala->CAPAC_ALUNO_SALA.'</td>';
                            echo '<td class="text-center">';
                                echo '<a href="/salas/editar/'.$sala->ID_SALA.'" title="Editar cadastro" class="btn btn-primary"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a>';
                                echo ' <a href="/salas/apagar/'.$sala->ID_SALA.'" title="Apagar cadastro" class="btn btn-danger"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>';
                                echo ' <a href="/salas/detalhes/'.$sala->ID_SALA.'" title="Detalhes" class="btn btn-info"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span></a>';
                            echo '</td>';
                        echo '</tr>';
                        $contador++;
                        }
                     
                        ?>
                    </table>
                </div>    
                    <div class="row">
                        <div class="col-md-12">
                            Todal de Registro: <?php echo $contador ?>
                        </div>
                    </div>
                </div>
                <!-- /.list-group -->
                
                
                <div class="col-lg-12">
                    <a href="<?php echo base_url('cadastra-sala'); ?>" class="btn btn-success btn-block">Cadastrar</a>
                    <button class="btn btn-default btn-block" onClick="history.go(0)" type="reset">Limpar</button>
                    <a href="#" class="btn btn-danger btn-block">Sair</a>
                </div>
                
            </div>
        </form>
    </div>
</div>
<!--End Notifications-->

