<?php include("../../datos.php");

if(isset($_GET['txtID'])){
    $txtID=(isset($_GET['txtID']))?$_GET['txtID']:"";

    //buscar el archivo relacionado con el empleado
    $sentencia=$conn->prepare("SELECT foto,cv FROM `tbl_empleados` WHERE id=:id");
    $sentencia->bindParam(":id",$txtID);
    $sentencia->execute();
    $registro_recuperado=$sentencia->fetch(PDO::FETCH_LAZY);

    if(isset($registro_recuperado["foto"]) && $registro_recuperado["foto"]!=""){
        if(file_exists("./".$registro_recuperado["foto"])){
            unlink("./".$registro_recuperado["foto"]);
        }
    }
    if( isset($registro_recuperado["cv"]) && $registro_recuperado["cv"]!=""){
        if(file_exists("./".$registro_recuperado["cv"])){
            unlink("./".$registro_recuperado['cv']);
        }
    }
    $sentencia=$conn->prepare("DELETE FROM tbl_empleados WHERE id=:id");
    $sentencia->bindParam(":id",$txtID);
    $sentencia->execute();
    $mensaje="Eliminacion exitosa";
    header("Location:index.php?mensaje=".$mensaje);
}

$sentencia=$conn->prepare("SELECT *,
(SELECT nombredelpuesto 
FROM tbl_puestos 
WHERE tbl_puestos.id=tbl_empleados.idpuesto limit 1) as puesto
FROM `tbl_empleados`");
$sentencia->execute();
$lista_tbl_empleados=$sentencia->fetchAll(PDO::FETCH_ASSOC);

?>
<?php include("../../templates/header.php");?>
</br>

<div class="card">
    <div class="card-header">
        <a name="" id="" class="btn btn-primary" href="crear.php" role="button">
            Agregar registro
        </a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table" id="tabla_id">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Nombre completo</th>
                        <th scope="col">Foto</th>
                        <th scope="col">CV</th>
                        <th scope="col">Puesto</th>
                        <th scope="col">Fecha de ingreso</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($lista_tbl_empleados as $registro)
                {
                    ?>
                    <tr class="">
                        <td><?php echo $registro['id'];?></td>
                        <td scope="row"><?php echo $registro['primernombre'];?>
                        <?php echo $registro['segundonombre'];?>
                        <?php echo $registro['primerapellido'];?>
                        <?php echo $registro['segundoapellido'];?>
                        </td>
                        <td>
                            <img width="60" 
                            src="<?php echo $registro["foto"]?>" 
                            class="img-fluid rounded" alt="" />
                        </td>
                        <td><a href="<?php echo $registro['cv'];?>">
                        <?php echo $registro['cv'];?>
                        </a></td>
                        <td><?php echo $registro['puesto'];?></td>
                        <td><?php echo $registro['fechadeingreso'];?></td>
                        <td><a class="btn btn-primary" href="carta_recomendacion.php?txtID=<?php echo $registro['id'];?>" role="button">Carta</a>
                       | <a name="" class="btn btn-info" href="editar.php?txtID=<?php echo $registro['id'];?>" role="button">Editar</a>
                      | <a name="" class="btn btn-danger" href="javascript:borrar(<?php echo $registro['id'];?>);" role="button">Eliminar</a>
                        </td>
                    </tr>
                    <?php
                }
                    ?>
                </tbody>
            </table>
        </div>
        
    </div>
    
</div>

<?php include("../../templates/footer.php");?>