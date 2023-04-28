<?php include("cabecera.php"); ?>
<?php include("conexion.php"); ?>
<?php

if($_POST){ //Insertar datos

    
    $nombre= $_POST['nombre'];//recuperamos nombre
    $descripcion= $_POST['descripcion'];//recuperamos descripcion

    $fecha=new DateTime();//para dierenciar imagenes con el mismo nombre usando la fecha de subida

    $imagen=$fecha->getTimestamp()."_".$_FILES['archivo']['name'];//recuperamos nombre de la imagen

    $imagen_temporal=$_FILES['archivo']['tmp_name'];

    move_uploaded_file($imagen_temporal,"imagenes/".$imagen);//guardamos la imagen en la carpeta

    $objConexion = new conexion();//creamos instancia e insertamos datos en la tabla
    $sql="INSERT INTO `proyectos` (`id`, `nombre`, `imagen`, `descripcion`) VALUES (NULL, '$nombre', '$imagen', '$descripcion');";
    $objConexion->ejecutar($sql);
    
    header("location:portafolio.php");//esto evita que se refresque la pagina y se reenvie lo mismo

}

if($_GET){ //eliminar datos
   

    $id=$_GET['borrar'];

    $objConexion= new conexion();

    $imagen=$objConexion->consultar("SELECT imagen FROM `proyectos` WHERE id=".$id);//recumeramos id de la imagen
    unlink("imagenes/".$imagen[0]['imagen']);//borrado del ARCHIVO imagen en carpeta

    $sql="DELETE FROM proyectos WHERE `proyectos`.`id` =".$id;
    $objConexion->ejecutar($sql);
    header("location:portafolio.php");
}

$objConexion = new conexion();
$proyectos=$objConexion->consultar("SELECT * FROM `proyectos`");
//print_r($proyectos);

?>
<br/>

<div class="container">
    <div class="row">
        <div class="col-md-6"><!--inicio columna 1-->
            <div class="card">
                <div class="card-header">
                Datos del Proyecto:
                </div>
                <div class="card-body">
                    <form action="portafolio.php" method="post" enctype="multipart/form-data">

                        Nombre del proyecto: <input required class="form-control" type="text" name="nombre" id="">
                        <br/>
                        Imagen del proyecto: <input required class="form-control" type="file" name="archivo" id="">
                        <br/>
                        Descripcion:
                        <textarea required class="form-control" name="descripcion" id="" rows="3"></textarea>
                        <br/>

                        <input class="btn btn-success" type="submit" value="Enviar Proyecto">

                    </form>
                </div>
            </div>
        </div><!--fin columna 1-->
        <div class="col-md-6"> <!--inicio columna 2-->
            
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Nombre</th>
                            <th scope="col">Imagen</th>
                            <th scope="col">Descripcion</th>
                            <th scope="col">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($proyectos as $proyecto){ ?>
                        <tr>
                            <td><?php echo $proyecto['id'];?></td>
                            <td><?php echo $proyecto['nombre'];?></td>
                            <td>
                                <img width="100" src="imagenes/<?php echo $proyecto['imagen'];?>" alt="">
                            </td>
                            <td><?php echo $proyecto['descripcion'];?></td>
                            <td> <a  class="btn btn-danger" href="?borrar=<?php echo $proyecto['id']; ?>">Eliminar</a> </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>

        </div><!--fin columna 2-->
    </div>
</div>








<?php include("pie.php"); ?>