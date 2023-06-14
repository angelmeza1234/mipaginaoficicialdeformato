<?php
include("../../datos.php");
if(isset($_GET['txtID'])){
    $txtID=(isset($_GET['txtID']))?$_GET['txtID']:"";

    $sentencia=$conn->prepare("SELECT * FROM tbl_empleados WHERE id=:id");
    $sentencia->bindParam(":id",$txtID);
    $sentencia->execute();
    $registro=$sentencia->fetch(PDO::FETCH_LAZY);

    $primernombre=$registro["primernombre"];
    $segundonombre=$registro["segundonombre"];
    $primerapellido=$registro["primerapellido"];
    $segundoapellido=$registro["segundoapellido"];


    $foto=$registro["foto"];
    $cv=$registro["cv"];

    $idpuesto=$registro["idpuesto"];
    $fechadeingreso=$registro["fechadeingreso"];

    $sentencia=$conn->prepare("SELECT * FROM `tbl_puestos`");
    $sentencia->execute();
    $lista_tbl_puestos=$sentencia->fetchAll(PDO::FETCH_ASSOC);
    
    //header("Location:index.php");


}
if($_POST){

  //recolectamos los datos
  $txtID=(isset($_POST['txtID']))?$_POST['txtID']:"";
  $primernombre=(isset($_POST["primernombre"])?$_POST["primernombre"]:"");
  $segundonombre=(isset($_POST["segundonombre"])?$_POST["segundonombre"]:"");
  $primerapellido=(isset($_POST["primerapellido"])?$_POST["primerapellido"]:"");
  $segundoapellido=(isset($_POST["segundoapellido"])?$_POST["segundoapellido"]:"");
 
  $idpuesto=(isset($_POST["idpuesto"])?$_POST["idpuesto"]:"");
  $fechadeingreso=(isset($_POST["fechadeingreso"])?$_POST["fechadeingreso"]:"");

  $sentencia= $conn->prepare("
  UPDATE tbl_empleados 
  SET
    primernombre=:primernombre,
    segundonombre=:segundonombre,
    primerapellido=:primerapellido,
    segundoapellido=:segundoapellido,
    idpuesto=:idpuesto,
    fechadeingreso=:fechadeingreso
WHERE id=:id
");

  $sentencia->bindParam(":primernombre",$primernombre);
  $sentencia->bindParam(":segundonombre",$segundonombre);
  $sentencia->bindParam(":primerapellido",$primerapellido);
  $sentencia->bindParam(":segundoapellido",$segundoapellido);
  $sentencia->bindParam(":idpuesto",$idpuesto);
  $sentencia->bindParam(":fechadeingreso",$fechadeingreso);
  $sentencia->bindParam(":id",$txtID);
  $sentencia->execute();  

  $foto=(isset($_FILES["foto"]['name'])?$_FILES["foto"]['name']:"");
  $fecha_=new DateTime();
   $nombreArchivo_foto=($foto!='')?$fecha_->getTimestamp()."_".$_FILES["foto"]['name']:"";
   $tmp_foto=$_FILES["foto"]["tmp_name"];
   if($tmp_foto!=''){
    move_uploaded_file($tmp_foto,"./".$nombreArchivo_foto);
    $sentencia=$conn->prepare("SELECT foto FROM `tbl_empleados` WHERE id=:id");
    $sentencia->bindParam(":id",$txtID);
    $sentencia->execute();
    $registro_recuperado=$sentencia->fetch(PDO::FETCH_LAZY);

    if(isset($registro_recuperado["foto"]) && $registro_recuperado["foto"]!=""){
        if(file_exists("./".$registro_recuperado["foto"])){
            unlink("./".$registro_recuperado["foto"]);
        }
    }
    $sentencia= $conn->prepare("UPDATE tbl_empleados SET foto=:foto WHERE id=:id");
    $sentencia->bindParam(":foto",$nombreArchivo_foto);
    $sentencia->bindParam(":id",$txtID);
    $sentencia->execute();
   }
   

  $cv=(isset($_FILES["cv"]['name'])?$_FILES["cv"]['name']:"");

  $nombreArchivo_cv=($cv!='')?$fecha_->getTimestamp()."_".$_FILES["cv"]['name']:"";
  $tmp_cv=$_FILES["cv"]['tmp_name'];
  if($tmp_cv!=''){
    move_uploaded_file($tmp_cv,"./".$nombreArchivo_cv);
    $sentencia=$conn->prepare("SELECT cv FROM `tbl_empleados` WHERE id=:id");
    $sentencia->bindParam(":id",$txtID);
    $sentencia->execute();
    $registro_recuperado=$sentencia->fetch(PDO::FETCH_LAZY);

    if(isset($registro_recuperado["cv"]) && $registro_recuperado["cv"]!=""){
      if(file_exists("./".$registro_recuperado["cv"])){
          unlink("./".$registro_recuperado["cv"]);
      }
      }
    $sentencia= $conn->prepare("UPDATE tbl_empleados SET cv=:cv WHERE id=:id");
    $sentencia->bindParam(":cv",$nombreArchivo_cv);
    $sentencia->bindParam(":id",$txtID);
    $sentencia->execute();
  }
  $mensaje="Actualizacion exitosa";
  header("Location:index.php?mensaje=".$mensaje);
  
}
?>
<?php include("../../templates/header.php");?>
<br>
<div class="card">
    <div class="card-header">
        Datos del empleado
    </div>
    <div class="card-body">
        <form action="" method="post" enctype="multipart/form-data">

        <div class="mb-3">
      <label for="txtID" class="form-label">ID:</label>
      <input type="text"
      value="<?php echo $txtID;?>"
        class="form-control" readonly name="txtID" id="txtID" aria-describedby="helpId" placeholder="">
        </div>

        <div class="mb-3">
          <label for="primernombre" class="form-label">Primer nombre</label>
          <input type="text"
          value="<?php echo $primernombre;?>"
            class="form-control" name="primernombre" id="primernombre" aria-describedby="helpId" placeholder="Primer nombre">
        </div>
        <div class="mb-3">
          <label for="segudonombre" class="form-label">Segudo nombre</label>
          <input type="text"
          value="<?php echo $segundonombre;?>"
          class="form-control" name="segundonombre" id="segundonombre" aria-describedby="helpId" placeholder="Segundo nombre">
        </div>

        <div class="mb-3">
          <label for="primerapellido" class="form-label">Primer apellido</label>
          <input type="text"
          value="<?php echo $primerapellido;?>"
          class="form-control" name="primerapellido" id="primerapellido" aria-describedby="helpId" placeholder="Primer apellido">
        </div>

        <div class="mb-3">
          <label for="segundoapellido" class="form-label">Segundo apellido</label>
          <input type="text"
          value="<?php echo $segundoapellido;?>"
            class="form-control" name="segundoapellido" id="segundoapellido" aria-describedby="helpId" placeholder="Segundo apellido">
        </div>

        <div class="mb-3">
          <label for="foto" class="form-label">Foto</label>
          </br>
          <img width="70" 
                            src="<?php echo $foto;?>" 
                            class="rounded" alt="" />
          </br></br>

        <input type="file" 
        class="form-control" name="foto" id="foto" aria-describedby="helpId" placeholder="Foto">
        </div>

        <div class="mb-3">
          <label for="cv" class="form-label">CV(PDF)</label>
          </br>
          <a href="<?php echo $cv;?>"><?php echo $cv?></a>
          <input type="file" class="form-control" name="cv" id="cv" aria-describedby="helpId" placeholder="CV">
        </div> 

       <div class="mb-3">
        <label for="idpuesto" class="form-label">Puesto</label>
        "<?php echo $idpuesto;?>"
        <select class="form-select form-select-lg" name="idpuesto" id="idpuesto">
          <?php foreach ($lista_tbl_puestos as $registro)
          {
            ?>
            <option value="<?php echo $registro['id'];?>">
            <?php echo $registro['nombredelpuesto'];?>
            </option>
          <?php
          }
            ?>
        </select>

    </div>
        <div class="mb-3">
          <label for="fechadeingreso" class="form-label">Fecha de ingreso:</label>

          <input 
          value="<?php echo $fechadeingreso;?>"
          type="date" class="form-control" name="fechadeingreso" id="fechadeingreso" aria-describedby="emailHelpId" placeholder="Fecha de ingreso">
        </div>
        
        
        <button type="submit" class="btn btn-success">Actualizar registro</button>
        <a name="" id="" class="btn btn-danger" href="index.php" role="button">Cancelar</a>


        </form>
    </div>
    <div class="card-footer text-muted">
    </div>
</div>

<?php include("../../templates/footer.php");?>