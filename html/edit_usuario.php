<?php 
include('../layouts/header.php');
require('../conf/conex.php');
$id_usuario = $_POST['user_id'];
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
$a="SELECT * FROM users WHERE id_user = $id_usuario";
$ares=$mysqli->query($a);
$row=$ares->fetch_assoc();
?>    
<div class="col-lg-12 mb-12 order-0">
    <div class="card">
        <div class="d-flex align-items-end row">
            <div class="col-12">
                <div class="card-body">
                    <h5 class="card-title text-primary">Editando Usuario: <?php echo $row['apellido'] . ' ' .$row['nombre']; ?></h5>
                    <div class="row">
                        <form id="upt_user">
                            <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="usuario">Usuario:</label>
                                    <input type="text" class="form-control" name="usuario" id="usuario" value="<?php echo $row['usuario']; ?>" style="text-transform:uppercase;" readonly />
                                    <small>No se puede editar el Usuario</small>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="nom_user">Nombre:</label>
                                    <input type="text" class="form-control" name="nom_user" id="nom_user" value="<?php echo $row['nombre']; ?>"  onkeypress="return letras(this, event);" style="text-transform:uppercase;" required />
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="ape_user">Usuario:</label>
                                    <input type="text" class="form-control" name="ape_user" id="ape_user" value="<?php echo $row['apellido']; ?>" onkeypress="return letras(this, event);" style="text-transform:uppercase;" required />
                                </div>
                            </div>


                            </div>

                        </form>
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