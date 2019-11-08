<?php if(!class_exists('Rain\Tpl')){exit;}?><!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <script src="\<?php echo htmlspecialchars( $cidade, ENT_COMPAT, 'UTF-8', FALSE ); ?>/modulo_merenda/public/plugins/jquery-1.10.2.js"></script>
    <!-- <script src="\<?php echo htmlspecialchars( $cidade, ENT_COMPAT, 'UTF-8', FALSE ); ?>/modulo_merenda/public/plugins/jquery-1.2.6.pack.js"></script> -->
    <script src="\<?php echo htmlspecialchars( $cidade, ENT_COMPAT, 'UTF-8', FALSE ); ?>/modulo_merenda/public/plugins/jquery.maskedinput-1.1.4.pack.js"></script>
    
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <!-- Core CSS - Include with every page -->
    <link href="\<?php echo htmlspecialchars( $cidade, ENT_COMPAT, 'UTF-8', FALSE ); ?>/modulo_merenda/public/plugins/bootstrap/bootstrap.css" rel="stylesheet" />
    <link href="\<?php echo htmlspecialchars( $cidade, ENT_COMPAT, 'UTF-8', FALSE ); ?>/modulo_merenda/public/font-awesome/css/font-awesome.css" rel="stylesheet" />
    <link href="\<?php echo htmlspecialchars( $cidade, ENT_COMPAT, 'UTF-8', FALSE ); ?>/modulo_merenda/public/plugins/pace/pace-theme-big-counter.css" rel="stylesheet" />
    <link href="\<?php echo htmlspecialchars( $cidade, ENT_COMPAT, 'UTF-8', FALSE ); ?>/modulo_merenda/public/css/style.css" rel="stylesheet" />
    <link href="\<?php echo htmlspecialchars( $cidade, ENT_COMPAT, 'UTF-8', FALSE ); ?>/modulo_merenda/public/css/main-style.css" rel="stylesheet" />
    <!-- Page-Level CSS -->
    <link href="\<?php echo htmlspecialchars( $cidade, ENT_COMPAT, 'UTF-8', FALSE ); ?>/modulo_merenda/public/plugins/morris/morris-0.4.3.min.css" rel="stylesheet" />
    <link href="\<?php echo htmlspecialchars( $cidade, ENT_COMPAT, 'UTF-8', FALSE ); ?>/modulo_merenda/vendor/harvesthq/chosen/chosen.css" rel="stylesheet" >
    <link href="\<?php echo htmlspecialchars( $cidade, ENT_COMPAT, 'UTF-8', FALSE ); ?>/modulo_merenda/vendor/harvesthq/chosen/chosen.min.css" rel="stylesheet" >

   </head>
<body>
    <!--  wrapper -->
    <div id="wrapper">
        <!-- navbar top -->
        <nav class="navbar navbar-default navbar-fixed-top" role="navigation" id="navbar">
            <!-- navbar-header -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.html">
                    <img src="\<?php echo htmlspecialchars( $cidade, ENT_COMPAT, 'UTF-8', FALSE ); ?>/imagens/praxis.png" alt="" />
                </a>
            </div>
            <!-- end navbar-header -->
            <!-- navbar-top-links -->
            <ul class="nav navbar-top-links navbar-right">
                <!-- main dropdown -->
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-3x"></i>
                    </a>
                    <!-- dropdown user-->
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="#"><i class="fa fa-user fa-fw"></i>Perfil</a>
                        </li>
                        <li class="divider"></li>
                        <li><a href=""><i class="fa fa-sign-out fa-fw"></i>Sair</a>
                        </li>
                    </ul>
                    <!-- end dropdown-user -->
                </li>
                <!-- end main dropdown -->
            </ul>
            <!-- end navbar-top-links -->

        </nav>
        <!-- end navbar top -->

        <?php if( $nivelAcesso==9 ){ ?>

        <!-- navbar side -->
        <nav class="navbar-default navbar-static-side" role="navigation">
            <!-- sidebar-collapse -->
            <div class="sidebar-collapse">
                <!-- side-menu -->
                <ul class="nav" id="side-menu">
                    <li>
                        <!-- user image section-->
                        <div class="user-section">
                            
                            <div class="user-info">
                                <div>Merenda</div>
                                <div style="color: white;">
                                    Administrador
                                </div>
                                
                            </div>
                        </div>
                        <!--end user image section-->
                    </li>
                    
                    <li class="">
                        <a href="/praxis/modulo_merenda/">Ínicio</a>
                    </li>
                    
                    <li class="">
                        <a href="/praxis/modulo_merenda/estoque">Estoque</a>
                    </li>

                    <li>
                        <a href="/praxis/modulo_merenda/pedidos">Pedidos</a>
                    </li>

                    <li>
                        <a href="#">Cadastros<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a href="/praxis/modulo_merenda/cadastro/fornecedores">Fornecedores</a>
                            </li>
                            <li>
                                <a href="/praxis/modulo_merenda/cadastro/produtos">Produtos</a>
                            </li>
                            <li>
                                <a href="/praxis/modulo_merenda/cadastro/tipos">Tipos de Produtos</a>
                            </li>
                            <li>
                                <a href="/praxis/modulo_merenda/cadastro/categorias">Categorias de Produtos</a>
                            </li>
                            <li>
                                <a href="/praxis/modulo_merenda/cadastro/programas">Programas</a>
                            </li>
                        </ul>
                        <!-- second-level-items -->
                    </li>
                     
                </ul>
                <!-- end side-menu -->
            </div>
            <!-- end sidebar-collapse -->
        </nav>
        <!-- end navbar side -->
        <?php } ?>

        <div id="page-wrapper">
            <div class="row">
                <!-- Page Header -->
                <div class="col-lg-12">
                    <h1 class="page-header"><?php echo htmlspecialchars( $inepUnidade, ENT_COMPAT, 'UTF-8', FALSE ); ?> - <?php echo htmlspecialchars( $unidade, ENT_COMPAT, 'UTF-8', FALSE ); ?></h1>
                </div>
                <!--End Page Header -->
            </div>

            <div class="row">
                <!-- Welcome -->
                <div class="col-lg-12">
                    <div class="alert alert-info">
                        <i class="fa fa-user">  <?php echo htmlspecialchars( $dados["0"]['NOME_PROFISSIONAL'], ENT_COMPAT, 'UTF-8', FALSE ); ?></i>
                    </div>
                </div>
                <!--end  Welcome -->
            </div>


            
        

   

