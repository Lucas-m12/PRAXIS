<div class="panel panel-success">
    <div class="panel-heading">
        <i class="fa fa-list fa-fw"></i>Cadastro de Salas
    </div>
    <div class="panel-body">
        <div class="list-group">
            <?php if(isset($msg_error)) echo '<div class="alert alert-danger" >' .$msg_error.'</div>' ; ?>
            <form role="form" method="post" id="form_sala" action="<?php echo base_url('inserir-sala'); ?>"  >
                <div class="col-lg-6">
                    <div class="form-group">
                        <label>Número da Sala<small>*</small></label>
                        <input  name="nome" id="nome_sala" type="number" class="form-control" min="1" max="100" autocomplete="off" >
                    </div>
                    <div class="form-group">
                        <label>Capacidade Máxima de Alunos<small>*</small></label>
                        <input   name="capacidade" id="max" type="number" max="" class="form-control">
                    </div>
                    
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label>Área da Sala<small></small></label>
                        <input name="area" id="area" type="number" class="form-control"  autocomplete="off" >
                    </div>
                </div>
            </div>
            <!-- /.list-group -->
            <div class="col-lg-12">
                <?php
                //Exibi mensagem de erro ou sucesso
                $error = $this->session->flashdata('error');
                $success = $this->session->flashdata('success');
                if(isset($error)) { echo '<div align="center" class="alert alert-danger" >' .$this->session->flashdata('error').'</div>' ; }
                if(isset($success)) { echo '<div align="center" class="alert alert-success" >' .$this->session->flashdata('success').'</div>' ; }
                ?>
                
            </div>
            
        </div>
    </div>
    <!-- Botões de Controle -->
    <div class="panel panel-default">
        <div class="panel-heading">
            <div align="center" >
                <a href="<?php echo base_url('pesquisa-sala'); ?>" type="button" class="btn btn-info">Voltar</a>
                <a href="../secretaria.php" type="button" class="btn btn-danger" >Fechar</a>
                <button class="btn btn-default" type="reset">Limpar</button>
            <button id="submitSalvar" name="submitSalvar" type="submit" class="btn btn-success" onclick="return validar()" >Salvar</button></form>
        </div>
    </div>
</div>
<!-- End Botões de Controle -->
<!--End Notifications-->
<!-- Desabilita botão Salvar -->
<script type="text/javascript">
var formID = document.getElementById("form_sala");
var send = $("#submitSalvar");
$(formID).submit(function(event){
if (formID.checkValidity()) {
send.attr('disabled', 'disabled');
}
});
</script>
<!-- validar formulário -->
<?php $this->load->view('ms-salas/validate'); ?>