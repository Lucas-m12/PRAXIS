<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?php echo $this->session->userdata('sistema'); ?></title>
        <!-- Core CSS - Include with every page -->
        <link href="<?php echo base_url('assets/plugins/bootstrap/bootstrap.css'); ?>" rel="stylesheet" />
        <link href="<?php echo base_url('assets/font-awesome/css/font-awesome.css'); ?>" rel="stylesheet" />
        <link href="<?php echo base_url('assets/plugins/pace/pace-theme-big-counter.css'); ?>" rel="stylesheet" />
        <link href="<?php echo base_url('assets/css/style.css'); ?>" rel="stylesheet" />
        <link href="<?php echo base_url('assets/css/main-style.css'); ?>" rel="stylesheet" />
        <link rel="icon" href="<?php echo base_url('assets/img/favicon.ico'); ?>" />
        <link href="<?php echo base_url('assets/img/favicon.ico'); ?>" rel='shortcut icon' type='image/x-icon'/>
        <!-- Sweet Alert -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@9/dist/sweetalert2.min.css" id="theme-styles">
    </head>
    <body class="body-Login-back">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page"><b>&nbsp;<?php echo $this->session->userdata('empresa'). ' - CNPJ: ' .$this->session->userdata('cnpj').' - '.$this->session->userdata('sistema'); ?></b></li>
            </ol>
        </nav>
        <div class="container">
            
            <div class="row">
                <div class="col-md-4 col-md-offset-4 text-center logo-margin ">
                    <img src="<?php echo base_url('assets/img/praxis.png'); ?>" width="210" height="150" alt="">
                </div>
                <div class="col-md-4 col-md-offset-4">
                    <div class="login-panel panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title">Autenticar usuário</h3>
                        </div>
                        <div class="panel-body">
                            <?php
                            //Exibi mensagem de erro
                            $error = $this->session->flashdata('error');
                            if(isset($error)) { echo '<div align="center" class="alert alert-danger" >' .$this->session->flashdata('error').'</div>' ; }
                            ?>
                            <form id="formuser" name="formuser" role="form" method="post" action="<?php echo base_url('autenticar'); ?>" >
                                <fieldset>
                                    <div class="form-group">
                                        <input class="form-control" placeholder="Login" id="login" name="login" type="text" autofocus autocomplete="off" maxlength="30" >
                                    </div>
                                    <div class="form-group">
                                        <input class="form-control" placeholder="Senha" id='senha' name="password" type="password" maxlength="30">
                                    </div>
                                    
                                    <div align="right" class="form-group">
                                        <button class="btn btn-success" type="submit" onclick="return validar()" >Acessar</button>
                                    </div>
                                    <?php echo $this->session->flashdata('error_msg') ; ?>
                                </fieldset>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Core Scripts - Include with every page -->
        <script src="<?php echo base_url("assets/plugins/jquery-1.10.2.js"); ?>"  ></script>
        <script src="<?php echo base_url("assets/plugins/bootstrap/bootstrap.min.js"); ?>"  ></script>
        <script src="<?php echo base_url('assets/plugins/metisMenu/jquery.metisMenu.js'); ?>"  ></script>
        <!-- Sweet Alert -->
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9/dist/sweetalert2.min.js"></script>
        <!-- validar formulário -->
        <script type="text/javascript">
        function validar(){
        var login = formuser.login.value;
        var senha = formuser.senha.value;
        
        if(login == ""){
        formuser.login.focus();
        Swal.fire({
        icon: 'error',
        title: 'Oops...',
        text: 'Informe o Login!',
        footer: '<a href>Esqueceu o Login?</a>'
        });
        
        return false;
        }
        if(senha == ""){
        formuser.senha.focus();    
        Swal.fire({
        icon: 'error',
        title: 'Oops...',
        text: 'Informe a senha!',
        footer: '<a href>Esqueceu a senha?</a>'
        });
        
        return false;
        }
        }
        </script>
    </body>
</html>