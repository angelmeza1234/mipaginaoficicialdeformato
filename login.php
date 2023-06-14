<?php
session_start();
if($_POST){
    include("./datos.php");
    $sentencia=$conn->prepare("SELECT *,count(*) as n_usuario 
    FROM `tbl_usuarios` 
    WHERE usuario=:usuario
     AND password=:password");

    $usuario=$_POST["usuario"];
    $password=$_POST["password"];

    $sentencia->bindParam(":usuario",$usuario);
    $sentencia->bindParam(":password",$password);
    $sentencia->execute();
    $registro=$sentencia->fetch(PDO::FETCH_LAZY);
    if($registro["n_usuario"]>0){

      $_SESSION['usuario']=$registro["usuario"];
      $_SESSION['logueado']=true;
      header("Location:index.php");
    }else{
      $mensaje="Error: El usuario o contraseña son incorrectos";
    }

}
?>
<!doctype html>
<html lang="es">

<head>
  <title>Login</title>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS v5.2.1 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
</head>
<body>

  <header>
  <main class="container">

  <div class="row">
  <div class="col-md-4">
  
  </div>
  <div class="col-md-4">
  <br/><br/>
    <div class="card">
      <div class="card-header">
        Login
      </div>
      <div class="card-body">
<?php if(isset($mensaje))
{
  ?>
      <div class="alert alert-danger" role="alert">
        <strong><?php echo $mensaje;?></strong>
      </div>
<?php
}
  ?>
        <form action="" method="post">
          <div class="mb-3">
            <label for="usuario" class="form-label">Usuario:</label>
            <input type="text"
              class="form-control" name="usuario" id="usuario" aria-describedby="helpId" placeholder="Escriba su usario">
          </div>
          <div class="mb-3">
            <label for="password" class="form-label">Contraseña:</label>
            <input type="password"
              class="form-control" name="password" id="password" aria-describedby="helpId" placeholder="Escriba su contraseña">
          </div>
          <button type="submit" class="btn btn-primary">Ingresar</button>
        </form>
      </div>
     
    </div>
  </div>
  </main>

  </header>

</body>
