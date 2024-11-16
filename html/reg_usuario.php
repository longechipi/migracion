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
<div class="col-lg-12 mb-12 order-0">
    <div class="card">
        <div class="d-flex align-items-end row">
            <div class="col-12">
                <div class="card-body">
                    <h5 class="card-title text-primary">Registro de Usuario <?php echo $id_user; ?></h5>
                    <div class="row">
                        <form id="reg_user">
                        <div class="row mt-4">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="usuario">Usuario:</label>
                                    <input type="mail" class="form-control" name="usuario" id="usuario" style="text-transform:uppercase;" required />
                                    <input type="text" class="form-control" name="id_user" id="id_user" value="<?php echo $id_user; ?>" style="text-transform:uppercase;" hidden/>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="nom_user">Nombre:</label>
                                    <input type="text" class="form-control" name="nom_user" id="nom_user" style="text-transform:uppercase;" onkeypress="return letras(this, event);" required />
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="apel_user">Apellido:</label>
                                    <input type="text" class="form-control" name="apel_user" id="apel_user" style="text-transform:uppercase;" onkeypress="return letras(this, event);" required />
                                </div>
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="privi">Privilegio:</label>
                                    <select id="privi" class="form-select" name="privi" required />
                                    <option value="" selected disabled>Seleccionar</option>
                                    <?php
                                        $a = $mysqli->query("SELECT * FROM privilegios");
                                        while ($rowa = mysqli_fetch_array($a)) {
                                            echo '<option value="' . $rowa['id_pri'] . '">' . $rowa['nom_pri'] . '</option>';
                                        } 
                                    ?>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="sta_user">Estatus:</label>
                                    <select id="sta_user" class="form-select" name="sta_user" required />
                                    <option value="" selected disabled>Seleccionar</option>
                                    <?php
                                        $a = $mysqli->query("SELECT * FROM estatus");
                                        while ($rowa = mysqli_fetch_array($a)) {
                                            echo '<option value="' . $rowa['id_sta'] . '">' . $rowa['nom_sta'] . '</option>';

                                        } 
                                    ?>
							        </select>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="pass">Contraseña:</label>
                                    <input type="text" class="form-control" name="pass" id="pass" required />
                                    <small>Colocar una Clave Alfanumerica</small>
                                </div>
                            </div>
                        </div>
                        <div class="text-center mt-4">
                            <button type="submit" id="btn_upd_datos" class="btn btn-primary"><i class="fi fi-rs-disk"></i> CREAR</button>
                            <a href="javascript:history.back()" class="btn btn-outline-warning" rel="noopener noreferrer"><i class="fi fi-rr-undo"></i> VOLVER </a>
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
<script>
    $(document).ready(function () {
        $('#reg_user').submit(function (e) {
            e.preventDefault();
            var formData = new FormData(this);
            $.ajax({
                type: 'POST',
                url: '../model/users/reg_user.php',
                data: formData,
                contentType: false,
                processData: false,
                success: function (res) {
                    console.log(res);
                    if (res == 1) {
                        Swal.fire({
                            icon: 'success',
                            title: '¡Éxito!',
                            text: 'Usuario Creado Correctamente',
                            confirmButtonText: 'Aceptar'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location.href = 'usuarios';
                            }
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: '¡Error!',
                            text: 'Error al Crear Usuario',
                            confirmButtonText: 'Aceptar'
                        });
                    }
                }
            });
        });
    });
</script>
</body>
</html>