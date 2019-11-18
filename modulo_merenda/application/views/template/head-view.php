<div class="row">
    <!-- Page Header -->
    <div class="col-lg-12">
        <h4 class="page-header"><?php echo $this->session->userdata('inepEscola').' - '.$this->session->userdata('nomeEscola'); ?></h4>
    </div>
    <!--End Page Header -->
</div>
<div class="row">
    <!-- Welcome -->
    <div class="col-lg-12">
        <div class="alert alert-info">
            <i class="fa fa-user"></i>&nbsp;Bem vindo(a), <b><?php echo $this->session->userdata('momeProfissional'); ?></b>
            <i class="fa fa-desktop"></i><b>&nbsp;Último acesso em: </b><?php echo $this->session->userdata('dataAcesso'); ?>
        </div>
    </div>
    <!--end  Welcome -->
</div>