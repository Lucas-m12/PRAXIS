<script type="text/javascript">
function validar(){
var nome = form_sala.nome.value;
var max = form_sala.max.value;
var area = form_sala.area.value;

if(nome == ""){
form_sala.nome.focus();
Swal.fire('Preencha o campo Número da Sala!');
return false;
}
if(max == ""){
form_sala.max.focus();
Swal.fire('Preencha o campo Capacidade da Sala!');
return false;
}
if(area == ""){
form_sala.area.focus();
Swal.fire('Preencha o campo Área!');
return false;
}

}
</script>