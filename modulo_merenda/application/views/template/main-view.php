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
        <!-- Page-Level CSS -->
        <link href="<?php echo base_url('assets/plugins/morris/morris-0.4.3.min.css'); ?>" rel="stylesheet" />
        <!-- Sweet Alert -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@9/dist/sweetalert2.min.css" id="theme-styles">
        <!-- Data Table -->
        <link  href="<?php echo base_url('assets/plugins/dataTables/dataTables.bootstrap.css'); ?>" rel="stylesheet" />
        <script src="<?php echo base_url("assets/plugins/jquery-1.10.2.js"); ?>"  ></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9/dist/sweetalert2.min.js"></script>
        <!-- <script src="<?php echo base_url('assets/plugins/jquery.maskedinput-1.1.4.pack.js') ?>"></script> -->
        <script src="<?php echo base_url("assets/scripts/jquery.mask.js"); ?>"  ></script>



    </head>
    <body >
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
                    <a class="navbar-brand" >
                        <img src="<?php echo base_url('assets/img/praxis.png'); ?>" alt="" />
                        <label><?php echo $this->session->userdata('sistema'); ?></label>
                    </a>
                </div>
                <!-- end navbar-header -->
                <!-- navbar-top-links -->
                <?php $this->load->view('template/navbar-view'); ?>
                <!-- end navbar-top-links -->
            </nav>
            <!-- end navbar top -->
            <!-- navbar side -->
            <nav class="navbar-default navbar-static-side" role="navigation">
                <!-- sidebar-collapse -->
                <div class="sidebar-collapse">
                    <!-- side-menu -->
                    <ul class="nav" id="side-menu">
                        <!-- menu -->
                        <?php 
                            switch ($this->session->userdata('ID_NIVEL_ACESSO')) {
                                case 1:
                                    $this->load->view('template/menu1-view');
                                    break;

                                case 2:
                                    $this->load->view('template/menu2-view');
                                    break;
                                
                                case 3:
                                    $this->load->view('template/menu3-view');
                                    break;
                                default:
                                    # code...
                                    break;
                            }
                        ?>
                        <!-- <?php
                        /*if($this->session->userdata('ID_NIVEL_ACESSO')==1){
                        $this->load->view('template/menu1-view');
                        }elseif ($this->session->userdata('ID_NIVEL_ACESSO')==2) {
                        $this->load->view('template/menu2-view');
                        }*/
                        ?> -->
                        <!-- end side-menu -->
                    </div>
                    <!-- end sidebar-collapse -->
                </nav>
                <!-- end navbar side -->
                <!--  page-wrapper -->
                <div id="page-wrapper">
                    <?php $this->load->view('template/head-view'); ?>
                    <div class="row">
                        <!--quick info section -->
                        <!-- <?php $this->load->view('template/painel-view'); ?> -->
                        <!--end quick info section -->
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <!-- Conteudo Principal-->
                            <?php $this->load->view('template/block_return-view'); ?>
                            <?php $this->load->view($page); ?>

                        </div>
                    </div>
                    <!-- flooter -->
                    <?php $this->load->view('template/footer-view'); ?>
                    <!-- end floot -->
                </div>
                <!-- end page-wrapper -->
            </div>
            <!-- end wrapper -->
            <script src="<?php echo base_url("assets/plugins/bootstrap/bootstrap.min.js"); ?>"  ></script>
            <script src="<?php echo base_url('assets/plugins/metisMenu/jquery.metisMenu.js'); ?>"  ></script>
            <script src="<?php echo base_url('assets/plugins/pace/pace.js'); ?>"  ></script>
            <script src="<?php echo base_url('assets/scripts/siminta.js'); ?>"  ></script>
            <!-- Page-Level Plugin Scripts-->
            <script src="<?php echo base_url('assets/plugins/morris/raphael-2.1.0.min.js'); ?>"  ></script>
            <script src="<?php echo base_url('assets/plugins/morris/morris.js'); ?>"  ></script>
            <script src="<?php echo base_url('assets/scripts/dashboard-demo.js'); ?>"  ></script>
            <!-- Sweet Alert -->
            <!-- Data Table -->
            <script src="<?php echo base_url('assets/plugins/dataTables/jquery.dataTables.js'); ?>" ></script>
            <script src="<?php echo base_url('assets/plugins/dataTables/dataTables.bootstrap.js'); ?>" ></script>
            <!--Bloqueia botão voltar do navegador -->
            <script type="text/javascript">
            (function(window) {
            'use strict';
            
            var noback = {
            
            //globals
            version: '0.0.1',
            history_api : typeof history.pushState !== 'undefined',
            
            init:function(){
            window.location.hash = '#no-back';
            noback.configure();
            },
            
            hasChanged:function(){
            if (window.location.hash == '#no-back' ){
            window.location.hash = '#block';
            //mostra mensagem que não pode usar o btn volta do browser
            if($( "#msgAviso" ).css('display') =='none'){
            $( "#msgAviso" ).slideToggle("slow");
            }
            }
            },
            
            checkCompat: function(){
            if(window.addEventListener) {
            window.addEventListener("hashchange", noback.hasChanged, false);
            }else if (window.attachEvent) {
            window.attachEvent("onhashchange", noback.hasChanged);
            }else{
            window.onhashchange = noback.hasChanged;
            }
            },
            
            configure: function(){
            if ( window.location.hash == '#no-back' ) {
            if ( this.history_api ){
            history.pushState(null, '', '#block');
            }else{
            window.location.hash = '#block';
            //mostra mensagem que não pode usar o btn volta do browser
            if($( "#msgAviso" ).css('display') =='none'){
            $( "#msgAviso" ).slideToggle("slow");
            }
            }
            }
            noback.checkCompat();
            noback.hasChanged();
            }
            
            };
            
            // AMD support
            if (typeof define === 'function' && define.amd) {
            define( function() { return noback; } );
            }
            // For CommonJS and CommonJS-like
            else if (typeof module === 'object' && module.exports) {
            module.exports = noback;
            }
            else {
            window.noback = noback;
            }
            noback.init();
            }(window));
            </script>
  
        </body>
    </html>

