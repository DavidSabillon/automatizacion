<?php

ob_start();
session_start();
require_once ('../vistas/pagina_inicio_vista.php');
require_once ('../clases/Conexion.php');
require_once ('../clases/Conexionvoae.php');
require_once ('../clases/conexion_mantenimientos.php');
require_once ('../clases/funcion_bitacora.php');
require_once ('../clases/funcion_visualizar.php');
require_once ('../clases/funcion_permisos.php');

$Id_objeto=146; 


$visualizacion= permiso_ver($Id_objeto);

if($visualizacion==0){
  echo '<script type="text/javascript">
      swal({
            title:"",
            text:"Lo sentimos no tiene permiso de visualizar la pantalla",
            type: "error",
            showConfirmButton: false,
            timer: 3000
          });
      window.location = "../vistas/pagina_principal_vista.php";

       </script>'; 
}else{
  bitacora::evento_bitacora($Id_objeto, $_SESSION['id_usuario'],'INGRESO' , 'A Solicitud de Actividades CVE');
}

ob_end_flush();
?>
 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">

         <h1>Actividades CVE</h1>
          </div>

                <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="../vistas/pagina_principal_vista.php">Inicio</a></li>
              <li class="breadcrumb-item active"><a href="../vistas/menu_actividades_cve_vista.php">Administrar Módulo CVE</a></li>
            </ol>
          </div>

            <div class="RespuestaAjax"></div>
   
        </div>
      </div><!-- /.container-fluid -->
    </section>
<!--Contenido-->
      <!-- Content Wrapper. Contains page content -->
      <div class="card card-default">        
        <!-- Main content -->
        <section class="content">
            <div class="card-header">
              <div class="col-md-12">
                  <div class="box">
                    <div class="box-header with-border">
                          <h1 class="box-title">Solicitudes </h1>
                          <h1><button class="btn btn-success" id="btnagregar" onclick="mostrarform(true)"><i class="fa fa-plus-circle"></i> Agregar Solicitud</button></h1>
                        <div class="box-tools pull-right">
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <!-- centro -->
                    <div class="panel-body table-responsive" id="listadoregistros">
                        <table id="tbllistado" class="table table-striped table-bordered table-condensed table-hover">
                          <thead>
                            <th>Opciones</th>
                            <th>Nombre</th>
                            <th>Descripción</th>
                            <th>Estado</th>
                          </thead>
                          <tbody>                            
                          </tbody>
                        </table>
                    </div>
                    <div class="panel-body table-responsive" style="height: 800px;" id="formularioregistros">
              <form name="formulario" id="formulario" method="POST">
                <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                  <label>No.Solicitud:</label>
                  <input type="hidden" name="idestado" id="idestado">
                  <input type="text" class="form-control" name="nombre" id="nombre" maxlength="50" placeholder="Nombre" required>
                </div>
                <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                  <label>Fecha de Solicitud:</label>
                  <input type="date" class="form-control" name="descripcion" id="descripcion" maxlength="256" placeholder="Descripción">
                </div>
                <div class="form-group col-lg-12 col-md-6 col-sm-6 col-xs-12 maxlength">
                  <label>Nombre de la Actividad:</label>
                  <input type="hidden" name="idestado" id="idestado">
                  <input type="text" class="form-control" name="nombre" id="nombre" maxlength="50" placeholder= "Nombre" required> 
                </div>
                <div class="form-group col-lg-12 col-md-6 col-sm-6 col-xs-12 maxlength">
                  <label>Ubicacion de la Actividad:</label>
                  <input type="hidden" name="idestado" id="idestado">
                  <input type="text" class="form-control" name="nombre" id="nombre" maxlength="50" placeholder="Nombre" required>
                </div>
                <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12 maxlength">
                  <label>Periodo Academico:</label>
                  <input type="hidden" name="idestado" id="idestado">
                  <select name="nombre" id="nombre"class="form-control" name="nombre" id="nombre" maxlength="50" placeholder="Nombre" required>
                    <option value="volvo">Primer Periodo</option>
                    <option value="saab">Segundo Periodo</option>
                    <option value="mercedes">Tercer Periodo</option>
                  </select> 
                </div>
                <div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-12 maxlength">
                  <label>Fecha Incial:</label>
                  <input type="hidden" name="idestado" id="idestado">
                  <input type="datetime-local" class="form-control" name="nombre" id="nombre" maxlength="50" placeholder="Nombre" required>
                </div>
                <div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-12 maxlength">
                  <label>Fecha Final:</label>
                  <input type="hidden" name="idestado" id="idestado">
                  <input type="datetime-local" class="form-control" name="nombre" id="nombre" maxlength="50" placeholder="Nombre" required>
                </div>
                
                <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12 maxlength">
                  <label>Poblacion Objetiva:</label>
                  <input type="hidden" name="idestado" id="idestado">
                  <input type="text" class="form-control" name="nombre" id="nombre" maxlength="50" placeholder="Nombre" required>
                </div>
                <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12 maxlength">
                  <label>Ambito:</label>
                  <input type="hidden" name="idestado" id="idestado">
                  <input type="text" class="form-control" name="nombre" id="nombre" maxlength="50" placeholder="Nombre" required>
                </div>
                <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12 maxlength">
                  <label>Descripcion:</label>
                  <input type="hidden" name="idestado" id="idestado">
                  <input type="text" class="form-control" name="nombre" id="nombre" maxlength="50" placeholder="Nombre" required>
                </div>
                <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                  <button class="btn btn-primary pull-right" type="submit" id="btnGuardar"><i class="fa fa-save"></i> Enviar Solicitud</button>
                  <button class="btn btn-danger pull-right" onclick="cancelarform()" type="button"><i class="fa fa-arrow-circle-left"></i> Salir</button>
                </div>
              </form>
            </div>
                    <!--Fin centro -->
                  </div><!-- /.box -->
              </div><!-- /.col -->
          </div><!-- /.row -->
      </section><!-- /.content -->

    </div><!-- /.content-wrapper -->
  <!--Fin-Contenido-->
  </div> 
 
<script type="text/javascript" src="../js/ambito.js"></script>

 


</body>
</html>
