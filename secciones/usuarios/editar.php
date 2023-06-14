<?php
include("../../datos.php");
if(isset($_GET['txtID'])){
  $txtID=(isset($_GET['txtID']))?$_GET['txtID']:"";
  $sentencia=$conn->prepare("SELECT * FROM tbl_usuarios WHERE id=:id");
  $sentencia->bindParam(":id",$txtID);
  $sentencia->execute();
  $registro=$sentencia->fetch(PDO::FETCH_LAZY);
  $usuario=$registro["usuario"];
  $password=$registro["password"];
  $correo=$registro["correo"];

  //header("Location:index.php");
}
if($_POST){
  //print_r($_POST);
  //recolectamos los datos
  $usuario=(isset($_POST["txtID"])?$_POST["txtID"]:"");
  $usuario=(isset($_POST["usuario"])?$_POST["usuario"]:"");
  $password=(isset($_POST["password"])?$_POST["password"]:"");
  $correo=(isset($_POST["correo"])?$_POST["correo"]:"");
  //preparar la insercion de los datos
  $sentencia= $conn->prepare("UPDATE tbl_usuarios SET
  usuario=:usuario,
  password=:password,
  correo=:correo
  WHERE id=:id
  ");
  //asigna los valores que tienen uso de :variable
  $sentencia->bindParam(":usuario",$usuario);
  $sentencia->bindParam(":password",$password);
  $sentencia->bindParam(":correo",$correo);
  $sentencia->bindParam(":id",$txtID);
  $sentencia->execute();
  $mensaje="Actualizacion exitosa";
  header("Location:index.php?mensaje=".$mensaje); 
}
?>
<?php include("../../templates/header.php");?>

</br>
<div class="card">
    <div class="card-header">
        Datos del usuario
    </div>
    <div class="card-body">
    
    <form action="" method="post" enctype="multipart/fomr-data">

    <div class="mb-3">
      <label for="txtID" class="form-label">ID:</label>
      <input type="text"
      value="<?php echo $txtID;?>"
      class="form-control" readonly name="txtID" id="txtID" aria-describedby="helpId" placeholder="">

    <div class="mb-3">
      <label for="usuario" class="form-label">Nombre del usuario: </label>
      <input type="text"
      value="<?php echo $usuario;?>"
        class="form-control" name="usuario" id="usuario" aria-describedby="helpId" placeholder="Nombre del usuario">
    </div>
    <div class="mb-3">
      <label for="" class="form-label">Password</label>
      <input type="password"
      value="<?php echo $password;?>"
        class="form-control" name="password" id="password" aria-describedby="helpId" placeholder="Escriba su contraseña">
    </div>
    <div class="mb-3">
      <label for="correo" class="form-label">Correo</label>
      <input type="text"
      value="<?php echo $correo;?>"
        class="form-control" name="correo" id="correo" aria-describedby="helpId" placeholder="Escriba su correo">
    </div>
    <button type="submit" class="btn btn-success">Actualizar</button>
    | <a name="" id="" class="btn btn-primary" href="index.php" role="button">Cancelar</a>
    </form>

    </div>
</div>


<?php include("../../templates/footer.php");?>