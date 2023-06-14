<?php
session_start();
$url_base="http://localhost/app/";

if(!isset($_SESSION['usuario'])){
  header("Location:".$url_base."login.php");
}
?>
<!doctype html>
<html lang="es">

<head>
  <title>app</title>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS v5.2.1 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
<link rel="stylesheet" href="estilos.css">
<script
  src="https://code.jquery.com/jquery-3.7.0.js"
  integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM="
  crossorigin="anonymous"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.css"/>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.js">
</script>
<script src="sweetalert2.all.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
  <header>
    <!-- place navbar here -->
  </header>

  <nav class="navbar navbar-expand navbar-light bg-light">
      <ul class="nav navbar-nav">
         <li class="nav-item">
              <a class="nav-link" href="<?php echo $url_base;?>">Inicio</a>
         </li>
         <li class="nav-item">
              <a class="nav-link" href="<?php echo $url_base;?>secciones/empleados/">Empleados</a>
          </li>
          <li class="nav-item">
              <a class="nav-link" href="<?php echo $url_base;?>secciones/puestos/">Puestos</a>
          </li>
          <li class="nav-item">
              <a class="nav-link" href="<?php echo $url_base;?>secciones/usuarios/">Usuarios</a>
          </li>
          <li class="nav-item">
              <a class="nav-link" href="<?php echo $url_base;?>cerrar.php">Cerrar Sesion</a>
          </li>
      </ul>
  </nav>
  <main class="container">
  <?php if(isset($_GET['mensaje']))
{
    ?>
<script>
    Swal.fire({icon:"success", title:"<?php echo $_GET['mensaje'];?>"});
</script>
<?php
}
?>