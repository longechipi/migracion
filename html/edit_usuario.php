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
$a="SELECT U.id_user, U.usuario, U.nombre, U.apellido, UP.id_pri, P.nom_pri, US.id_sta, E.nom_sta 
FROM users U
LEFT JOIN users_privilegios UP ON U.id_user = UP.id_user
LEFT JOIN privilegios P ON P.id_pri = UP.id_pri
LEFT JOIN users_status US ON U.id_user = US.id_user
LEFT JOIN estatus E ON US.id_sta = E.id_sta
WHERE U.id_user = $id_usuario";
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
                            <input type="text" name="id_user" id="id_user" value="<?php echo $row['id_user']; ?>" hidden />
                            <div class="row mb-4">
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

                            <div class="col-md-4 mb-4">
                                <div class="form-group">
                                    <label for="ape_user">Apellido:</label>
                                    <input type="text" class="form-control" name="ape_user" id="ape_user" value="<?php echo $row['apellido']; ?>" onkeypress="return letras(this, event);" style="text-transform:uppercase;" required />
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="privi">Privilegio:</label>
                                    <select id="privi" class="form-select" name="privi" required />
                                    <?php
                                        $a = $mysqli->query("SELECT * FROM privilegios");
                                        while ($rowa = mysqli_fetch_array($a)) {
                                            if ($rowa['id_pri'] == $row['id_pri']) {
                                                echo '<option value="' . $rowa['id_pri'] . '" selected>' . $rowa['nom_pri'] . '</option>';
                                            } else {
                                                echo '<option value="' . $rowa['id_pri'] . '">' . $rowa['nom_pri'] . '</option>';
                                            }
                                        } 
                                    ?>
							        </select>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="sta_user">Estatus:</label>
                                    <select id="sta_user" class="form-select" name="sta_user" required />
                                    <?php
                                        $a = $mysqli->query("SELECT * FROM estatus");
                                        while ($rowa = mysqli_fetch_array($a)) {
                                            if ($rowa['id_sta'] == $row['id_sta']) {
                                                echo '<option value="' . $rowa['id_sta'] . '" selected>' . $rowa['nom_sta'] . '</option>';
                                            } else {
                                                echo '<option value="' . $rowa['id_sta'] . '">' . $rowa['nom_sta'] . '</option>';
                                            }
                                        } 
                                    ?>
							        </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                            <label for="asd">¿Desea reiniciar la clave del Usuario?</label>
                                <div class="text-center">
                                    <button class="btn btn-primary" id="mail">Enviar Contraseña</button>
                                </div>
                                
                            </div>
                        </div>
                            <div class="text-center mt-4">
                                <button type="submit" id="btn_upd_datos" class="btn btn-primary"><i class="fi fi-rs-disk"></i> ACTUALIZAR</button>
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
    $(document).ready(function (){
        $('#mail').click(function(e){
            e.preventDefault();
            var id_user = $('#id_user').val();
            var usuario = $('#usuario').val();

            Swal.fire({
                title: "¿Reiniciar la Contraseña?",
                text: "La contraseña se va a reiniciar y será enviada una temporal al usuario por Correo",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#007ebc",
                cancelButtonColor: "#d33",
                cancelButtonText: "Cancelar",
                confirmButtonText: "Si, Reiniciar"
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            type: 'POST',
                            url: '../model/users/mail_user.php',
                            data: {id_user:id_user, usuario: usuario},
                            success: function(data){
                                console.log(data);
                                if(data == 1){
                                    Swal.fire({
                                        title: '¡Éxito!',
                                        text: 'Contraseña reiniciada correctamente',
                                        icon: 'success',
                                        confirmButtonText: 'Aceptar'
                                    });
                                }else{
                                    Swal.fire({
                                        title: 'Error',
                                        text: 'Error al reiniciar contraseña',
                                        icon: 'error',
                                        confirmButtonText: 'Aceptar'
                                    });
                                }
                            }
                        });





                        // Swal.fire({
                        //     title: "Contraseña Reiniciada",
                        //     text: "La contraseña temporal se envío al usuario",
                        //     icon: "success",
                        //     confirmButtonColor: "#007ebc",
                        //     confirmButtonText: "Aceptar"
                        // });
                    }
                });


            


            
            
        });


        $('#upt_user').submit(function(e){
            e.preventDefault();
            $.ajax({
                type: 'POST',
                url: '../model/users/edit_user.php',
                data: $('#upt_user').serialize(),
                success: function(data){
                    // if(data == 1){
                    //     Swal.fire({
                    //         title: '¡Éxito!',
                    //         text: 'Usuario actualizado correctamente',
                    //         icon: 'success',
                    //         confirmButtonText: 'Aceptar'
                    //     }).then((result) => {
                    //         if (result.isConfirmed) {
                    //             window.location.href = 'usuarios.php';
                    //         }
                    //     });
                    // }else{
                    //     Swal.fire({
                    //         title: 'Error',
                    //         text: 'Error al actualizar usuario',
                    //         icon: 'error',
                    //         confirmButtonText: 'Aceptar'
                    //     });
                    // }
                }
            });
        });
    })
</script>
</body>
</html>