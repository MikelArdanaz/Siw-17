<?php
   function mMostrarUser($usuario){
      $con = new mysqli("dbserver", "siw14", "eeshaekaip", "db_siw14");
      mysqli_set_charset($con,"utf8");
      $consulta = "select idproducto from final_favoritos where idusuario = '$usuario'";
      $resultado = $con->query($consulta);
      return $resultado;
   }
?>
