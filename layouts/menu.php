<?php
session_start();
date_default_timezone_set('America/Caracas');
if (!$_SESSION['loggedin'] == true) {
  header('location: ../index.html');
}
//-------- SESSIONES DE USAURIO --------//
$id_user = $_SESSION['id_user'];
$privilegios = $_SESSION['id_pri'];
$estatus = $_SESSION['id_sta'];
$user = $_SESSION['usuario'];
$fullname = $_SESSION['nombre'];
?>
<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <!-- LOGO E INF DEL USUARIO -->
    <div class="app-brand demo ">
    <a href="index2.php" class="app-brand-link">
    <span class="app-brand-logo demo">
        <img src="../assets/img/logos/iconoInt.svg" alt="Brand" width="50px">
    </span>
    
      <span class="app-brand-text demo menu-text fw-bold ms-2">
        <!-- <img src="../assets/img/logos/logoP.svg" alt=""> -->
        <img src="../assets/img/logos/LogoPrin.svg" alt="PayMedGlobal" width="150px">
      </span>
    </a>

    <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto">
      <i class="bx bx-chevron-left bx-sm d-flex align-items-center justify-content-center"></i>
    </a>
  </div>
    <!-- FIN LOGO E INF DEL USUARIO -->
    <?php 
    $host = basename($_SERVER['PHP_SELF']);
    switch ($privilegios) {
      case 1:
        //------ MENU ADMINISTRADOR -------//
        include('../layouts/nav/menu-admin.php');
        break;
      case 6:
        //------ MENU MEDICO -------//
        include('../layouts/nav/menu-medico.php');
        break;
      case 7:
        //------ MENU ASISTENTE -------//
        include('../layouts/nav/menu-asistente.php');
        break;
      default:
        // Manejar caso en el que no exista el privilegio
        echo "Privilegio no válido";
  }

?>

</aside>