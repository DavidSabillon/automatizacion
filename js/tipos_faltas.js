var tabla;

//Función que se ejecuta al inicio
function init(){
  mostrarform(false);
  listar();

  $("#formulario").on("submit",function(e)
  {
    guardaryeditar(e);  
  })
}

//Función limpiar
function limpiar()
{
  $("#nombre_falta").val("");
  $("#descripcion_falta").val("");
  $("#id_falta").val("");
}

//Función mostrar formulario
function mostrarform(flag)
{
  limpiar();
  if (flag)
  {
    $("#listadoregistros").hide();
    $("#formularioregistros").show();
    $("#btnGuardar").prop("disabled",false);
    $("#btnagregar").hide();
  }
  else
  {
    $("#listadoregistros").show();
    $("#formularioregistros").hide();
    $("#btnagregar").show();
  }
}

//Función cancelarform
function cancelarform()
{
  limpiar();
  mostrarform(false);
}

//Función Listar
function listar()
{
  tabla=$('#tbllistado').dataTable(
  {
    "aProcessing": true,//Activamos el procesamiento del datatables
      "aServerSide": true,//Paginación y filtrado realizados por el servidor
      dom: 'Bfrtip',//Definimos los elementos del control de tabla
      buttons: [              
                'copyHtml5',
                'excelHtml5',
                'csvHtml5',
                'pdf'
            ],
    "ajax":
        {
          url: '../Controlador/tipos_faltas_controlador.php?op=listar',
          type : "get",
          dataType : "json",            
          error: function(e){
            console.log(e.responseText);  
          }
        },
    "bDestroy": true,
    "iDisplayLength": 5,//Paginación
      "order": [[ 0, "desc" ]]//Ordenar (columna,orden)
  }).DataTable();
}
//Función para guardar o editar

function guardaryeditar(e)
{
  e.preventDefault(); //No se activará la acción predeterminada del evento
  $("#btnGuardar").prop("disabled",true);
  var formData = new FormData($("#formulario")[0]);

  $.ajax({
    url: "../Controlador/tipos_faltas_controlador.php?op=guardaryeditar",
      type: "POST",
      data: formData,
      contentType: false,
      processData: false,

      success: function(datos)
      {                    
            bootbox.alert(datos);           
            mostrarform(false);
            tabla.ajax.reload();
      }

  });
  limpiar();
}

function mostrar(id_falta)
{
  $.post("../Controlador/tipos_faltas_controlador.php?op=mostrar",{id_falta : id_falta}, function(data, status)
  {
    data = JSON.parse(data);    
    mostrarform(true);

    $("#nombre_falta").val(data.nombre_falta);
    $("#descripcion_falta").val(data.descripcion_falta);
    $("#id_falta").val(data.id_falta);

  })
}

//Función para desactivar registros
function desactivar(id_falta)
{
  bootbox.confirm("¿Está seguro de desactivar la falta?", function(result){
    if(result)
        {
          $.post("../Controlador/tipos_faltas_controlador.php?op=desactivar", {id_falta : id_falta}, function(e){
            bootbox.alert(e);
              tabla.ajax.reload();
          }); 
        }
  })
}

//Función para activar registros
function activar(id_falta)
{
  bootbox.confirm("¿Está seguro de activar la falta?", function(result){
    if(result)
        {
          $.post("../Controlador/tipos_faltas_controlador.php?op=activar", {id_falta : id_falta}, function(e){
            bootbox.alert(e);
              tabla.ajax.reload();
          }); 
        }
  })
}


init();

