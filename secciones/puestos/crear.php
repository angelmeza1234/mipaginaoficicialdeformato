<?php
include("../../datos.php");

if($_POST){
    print_r($_POST);

    //recolectamos los datos
    $nombredelpuesto=(isset($_POST["nombredelpuesto"])?$_POST["nombredelpuesto"]:"");
    //preparar la insercion de los datos
    $sentencia= $conn->prepare("INSERT INTO tbl_puestos(id,nombredelpuesto)
    VALUES (null, :nombredelpuesto)");
    //Asignando los valores que vienen del metodo post
    $sentencia->bindParam(":nombredelpuesto",$nombredelpuesto);
    $sentencia->execute();
    $mensaje="Registro agregado";
    header("Location:index.php?mensaje=".$mensaje);


}
?>
<?php include("../../templates/header.php");?>

</br>
<div class="card">
    <div class="card-header">
        Puestos
    </div>
    <div class="card-body">
    
    <form action="" method="post" enctype="multipart/fomr-data">
    <div class="mb-3">
      <label for="nombredelpuesto" class="form-label">Nombre del puesto: </label>
      <input type="text"
        class="form-control" name="nombredelpuesto" id="nombredelpuesto" aria-describedby="helpId" placeholder="Nombre del puesto">
    </div>
    <button type="submit" class="btn btn-success">Agregar</button>
    | <a name="" id="" class="btn btn-primary" href="index.php" role="button">Cancelar</a>
    </form>

    </div>
</div>

<?php include("../../templates/footer.php");?>