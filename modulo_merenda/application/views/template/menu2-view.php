<li>
    <!-- user image section-->
    <div class="user-section">
        
        <div class="user-info">
            <div><small>Módulo</small></div>
            <div class="user-text-online">
                Escola
            </div>
        </div>
    </div>
    <!--end user image section-->
</li>

                    
    <li class="">
        <a href="<?php echo base_url('inicio') ?>">Ínicio</a>
    </li>
    
    <li class="">
        <a href="<?php echo base_url('estoque-escola/') . $this->session->userdata('ID_UNIDADE'); ?>">Estoque</a>
    </li>

    <li>
        <a href="<?php echo base_url('pedidos-escola') ?>">Pedidos</a>
    </li>

    


</ul>

