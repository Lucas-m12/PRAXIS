<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-default">
			<div class="panel-heading">Cadastro de Receitas</div>
			<div class="panel-body">
				<div class="row">
					<div class="col-lg-12">
						<form method="post" action="<?php echo base_url('editarReceita') ?>" role="form" id="form-receita">
							
                            <div class="form-group col-lg-6">
                                <label>Código da Receita</label>    
                                <input type="number" class="form-control" name="idReceita" id="idReceita" value="<?php echo $dados[0]['ID_RECEITA'] ?>" readonly>
                            </div>

                            <div class="form-group col-lg-6">
                                <label>Nivel de Ensino</label>
                                <select name="nivelEnsino" id="nivelEnsino" class="form-control">
                                    <option selected value="<?php echo $dados[0]['ID_NIVEL_ENSINO'] ?>"><?php echo $dados[0]['DS_NIVEL_ENSINO'] ?></option>
                                    <?php foreach ($niveisEnsino as $value): ?>
                                        <option value="<?php echo $value['ID_NIVEL_ENSINO'] ?>"><?php echo $value['DS_NIVEL_ENSINO'] ?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>

                            <div class="form-group col-lg-6">
                                <label>Nome da Receita</label>
                                <input type="text" name="receita" id="receita" class="form-control" placeholder="Digite o nome da receita" value="<?php echo $dados[0]['NOME_RECEITA'] ?>">
                            </div>

                            <div class="form-group col-lg-6">
                                <label>PerCapita da Receita</label>
                                <input type="number" name="perCapita" id="perCapita" class="form-control" value="<?php echo $dados[0]['PERCAPITA'] ?>">
                            </div>

                            <div class="form-group col-lg-6">
                                <label>Produtos</label>
                                <select class="chosen-select" name="produtosReceita[]" id="produtosReceita" multiple>
                                    <?php foreach ($dados as $value): ?>
                                        <option selected value="<?php echo $value['ID_PRODUTO'] ?>"><?php echo $value['DESC_PRODUTO'] ?></option>
                                    <?php endforeach ?>
                                    <?php foreach ($produtos as $value): ?>
                                        <option value="<?php echo $value['ID_PRODUTO'] ?>"><?php echo $value['DESC_PRODUTO'] ?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>
					</div>
				</div>
			</div>
		</div>

        <div class="panel panel-default">
            <div class="panel-heading">
                <div align="center">
                    <a href="<?php echo base_url('receitas'); ?>" type="button" class="btn btn-info">Voltar</a>
                    <a href="<?php echo base_url('inicio') ?>" type="button" class="btn btn-danger">Fechar</a>
                    <button type="reset" class="btn btn-default">Limpar</button>
                    <button type="submit" name="atualizarReceita" id="atualizarReceita" class="btn btn-success">Atualizar Receita</button>
                </div>
            </div>
        </div>
    </form>

	</div>
</div>

    <script src="<?php echo base_url('assets/scripts/class/Receita.js') ?>"></script>
    <script type="text/javascript">
        window.app = new Receita("form-receita", ['receita', 'nivelEnsino', 'perCapita']);
    </script>
    <link href="<?php echo base_url('vendor/harvesthq/chosen/chosen.css') ?>" rel="stylesheet" >
    <link href="<?php echo base_url('vendor/harvesthq/chosen/chosen.min.css') ?>" rel="stylesheet" >   
    <script src="<?php echo base_url('vendor/harvesthq/chosen/chosen.jquery.js'); ?>"></script>
    <script src="<?php echo base_url('vendor/harvesthq/chosen/chosen.jquery.min.js'); ?>"></script>
    <script src="<?php echo base_url('vendor/harvesthq/chosen/chosen.proto.js'); ?>"></script>
    <script src="<?php echo base_url('vendor/harvesthq/chosen/chosen.proto.min.js'); ?>"></script>

    <script>
        $(".chosen-select").chosen({
                placeholder_text_single : 'Selecione os produtos',
                width: "95%",
                no_results_text: "Nada Encontrado"
            }); 
    </script>