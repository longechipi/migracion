<?php 
include('../layouts/header.php');
require('../conf/conex.php');
?>

<div class="layout-wrapper layout-content-navbar">
    <div class="layout-container">
        <?php include("../layouts/menu.php"); ?>
            <div class="layout-page">
                <?php include("../layouts/navbar.php"); ?>
                <div class="content-wrapper">
                    <div class="container-fluid flex-grow-1 container-p-y">
                        <div class="row">
<?php 
//--------BUSQUEDA DE PRIVILEGIOS --------- //
$a = "SELECT P.id_pri, P.nom_pri, P.id_sta, E.nom_sta, COUNT(id_user) AS total
FROM privilegios P
LEFT JOIN estatus E ON P.id_sta = E.id_sta
LEFT JOIN users_privilegios UP ON P.id_pri = UP.id_pri
GROUP BY P.id_pri, P.nom_pri, P.id_sta, E.nom_sta";
$ares=$mysqli->query($a);
?>   
<div class="col-lg-12 mb-12 order-0">
    <div class="card">
        <div class="d-flex align-items-end row">
            <div class="col-12">
                <div class="card-body">
                    <h5 class="card-title text-primary">Gestión de Usuarios</h5>
                    <div class="text-center mb-6">
                        <a class="btn btn-primary" href="reg_privilegio" rel="noopener noreferrer"><i class="fi fi-rs-user-lock"></i>&nbsp;AÑADIR PRIVILEGIO</a>
                    </div>
                    

                    <div class="table-responsive">
                        <table class="table table-hover" id="user" cellspacing="0" style="width: 100%;">
                            <thead>
                                <tr>
                                    <th>Privilegio</th>
                                    <th>Usuarios</th>
                                    <th>Estatus</th>
                                    <th>Accion</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                while($row = mysqli_fetch_array($ares)) {
                                ?>
                                <tr>
                                    <td><?php echo $row['nom_pri']; ?></td>
                                    <td><?php echo $row['total']; ?></td>
                                    <td><?php echo $row['nom_sta']; ?></td>
                                    <td>
                                        <div class="btn-group">
                                        <button type="button" class="btn btn-primary btn-icon rounded-pill dropdown-toggle hide-arrow" data-bs-toggle="dropdown" aria-expanded="false"><i class="bx bx-dots-vertical-rounded"></i>
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-end" >
                                            <li><a class="dropdown-item" href="updcli.php?id=<?php echo $row['id_pri'];?>"><i class="fi fi-rr-edit"></i>&nbsp;Editar Privilegio</a></li>
                                        </ul>
                                        </div>
                                    </td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
                    </div>
                    <?php include('../layouts/footer.php')?>
                    <div class="content-backdrop fade"></div>
                </div>
            </div>
    </div>
    <!-- Overlay -->
    <div class="layout-overlay layout-menu-toggle"></div>
</div>
<?php include('../layouts/script.php')?>

</body>
</html>