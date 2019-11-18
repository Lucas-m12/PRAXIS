<!DOCTYPE html>
<html>
<head>
	<title>teste</title>
</head>
<body>
       

        <div class="container">

      <div class="row">
        <h1>Lista de Raças</h1>

        <table class="table table-bordered">
            
            <thead>
                <tr>
                  <th class="text-center">ID</th>
                  <th class="text-right">Raça</th>
                  <th class="text-center">Açoes</th>
                </tr>
            </thead>

            <?php
                $contador = 0;
                foreach ($racas as $raca)
                {        
                    echo '<tr>';
                      echo '<td>'.$raca->ID_COR.'</td>'; 
                      echo '<td class="text-right">'.$raca->DESC_COR_RACA.'</td>'; 
                      echo '<td class="text-center">';
                        echo '<a href="/produtos/editar/'.$raca->ID_COR.'" title="Editar cadastro" class="btn btn-primary"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a>';
                        echo ' <a href="/produtos/apagar/'.$raca->ID_COR.'" title="Apagar cadastro" class="btn btn-danger"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>';
                        echo ' <a href="/produtos/detalhes/'.$raca->ID_COR.'" title="Detalhes" class="btn btn-info"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span></a>';
                      echo '</td>'; 
                    echo '</tr>';
                $contador++;
                }
            ?>

        </table>

        <div class="row">
          <div class="col-md-12">
            Todal de Registro: <?php echo $contador ?>
          </div>
        </div>

      </div>
    </div><!-- /.container -->
</body>
</html>