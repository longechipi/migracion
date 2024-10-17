<?php 
require('../../../../conf/conex.php');

$id = $_GET['id'];
$a="SELECT DBM.id, DBM.id_user, DBM.id_ban, B.banco, 
CASE WHEN B.nacional = 1 THEN 'NACIONAL'
        ELSE 'INTERNACIONAL'
    END AS tip_banco,
DBM.id_tip, TCB.tipo_cuenta, DBM.nro_cuenta, DBM.ach, 
DBM.swit, DBM.aba, DBM.id_sta, E.nom_sta
FROM datos_bancarios_med DBM
LEFT JOIN bancos B ON DBM.id_ban = B.id_ban
LEFT JOIN tipo_cuenta_banco TCB ON DBM.id_tip = TCB.id
LEFT JOIN estatus E ON DBM.id_sta = E.id_sta
WHERE DBM.id = $id";
$ares=$mysqli->query($a);
$row=$ares->fetch_assoc();
?>
<form id="banco">
    <input type="text" name="id_prin" id="id_prin" value="<?php echo $id; ?>" hidden />
    <input type="text" name="id_user_ban" id="id_user_ban" value="<?php echo $row['id_user']; ?>"  hidden/>
<div class="row">
    <div class="divider">
        <div class="divider-text">Cuenta <?php echo $row['tip_banco']?></div>
    </div>
    
    <div class="col-md-6">
        <div class="form-group">
            <label for="id_ban">Banco:</label>
            <select id="id_ban" class="form-select mb-3" name="id_ban" required>
            <?php
            if($row['tip_banco'] == 'NACIONAL' ){
                $a = $mysqli->query("SELECT id_ban, banco FROM bancos WHERE id_sta = 1 AND nacional = 1");
                while ($rowa = mysqli_fetch_array($a)) {
                    if ($rowa['id_ban'] == $row['id_ban']) {
                        echo '<option value="' . $rowa['id_ban'] . '" selected>' . $rowa['banco'] . '</option>';
                    } else {
                        echo '<option value="' . $rowa['id_ban'] . '">' . $rowa['banco'] . '</option>';
                    }
                }
            }else{
                $a = $mysqli->query("SELECT id_ban, banco FROM bancos WHERE id_sta = 1 AND nacional = 0");
                while ($rowa = mysqli_fetch_array($a)) {
                    if ($rowa['id_ban'] == $row['id_ban']) {
                        echo '<option value="' . $rowa['id_ban'] . '" selected>' . $rowa['banco'] . '</option>';
                    } else {
                        echo '<option value="' . $rowa['id_ban'] . '">' . $rowa['banco'] . '</option>';
                    }
                }
            }
                ?>
            </select>
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            <label for="id_tip_cuenta">Tipo de Cuenta:</label>
            <select id="id_tip_cuenta" class="form-select mb-3" name="id_tip_cuenta" required>
            <?php
                $a = $mysqli->query("SELECT id, tipo_cuenta FROM tipo_cuenta_banco WHERE id_sta = 1");
                while ($rowa = mysqli_fetch_array($a)) {
                    if ($rowa['id'] == $row['id_tip']) {
                        echo '<option value="' . $rowa['id'] . '" selected>' . $rowa['tipo_cuenta'] . '</option>';
                    } else {
                        echo '<option value="' . $rowa['id'] . '">' . $rowa['tipo_cuenta'] . '</option>';
                    }
                } ?>
            </select>
        </div>
    </div>

    <div class="col-md-3">
        <div class="form-group">
            <label for="nro_cuenta">Numero de Cuenta:</label>
            <input type="text" name="nro_cuenta" id="nro_cuenta" value="<?php echo $row['nro_cuenta']; ?>" class="form-control" onkeypress="return numeros(this, event);" />
        </div>
    </div>
    <?php 
    if($row['tip_banco'] == 'NACIONAL' ){
    }else{ ?>
    <div class="col-md-3">
        <div class="form-group">
            <label for="ach">ACH:</label>
            <input type="text" name="ach" id="ach" value="<?php echo $row['ach']; ?>" class="form-control" />
        </div>
    </div>

    <div class="col-md-3">
        <div class="form-group">
            <label for="swit">SWIT:</label>
            <input type="text" name="swit" id="swit" value="<?php echo $row['swit']; ?>" class="form-control" />
        </div>
    </div>

    <div class="col-md-3 mb-4">
        <div class="form-group">
            <label for="aba">ABA:</label>
            <input type="text" name="aba" id="aba" value="<?php echo $row['aba']; ?>" class="form-control" />
        </div>
    </div>

   <?php } ?>

   <div class="col-md-3">
        <div class="form-group">
            <label for="id_sta">Cuenta Activa:</label>
            <select id="id_sta" class="form-select mb-3" name="id_sta" required>
            <?php
                $a = $mysqli->query("SELECT id_sta, nom_sta FROM estatus WHERE id_sta IN (1, 2)");
                while ($rowa = mysqli_fetch_array($a)) {
                    if ($rowa['id_sta'] == $row['id_sta']) {
                        echo '<option value="' . $rowa['id_sta'] . '" selected>' . $rowa['nom_sta'] . '</option>';
                    } else {
                        echo '<option value="' . $rowa['id_sta'] . '">' . $rowa['nom_sta'] . '</option>';
                    }
                } ?>
            </select>
        </div>
    </div>
    <div class="col-md-6" id="nota"></div>
    
    <div class="text-center">
        <button type="submit" class="btn btn-primary"><i class="fi fi-rs-disk"></i> GUARDAR</button>
    </div>
</div>
</form>
<script>
$('#id_sta').change(function () {
    var id_sta = $(this).val();
    if(id_sta == 2){
        $("#nota").html("<div class='alert alert-dark' role='alert'><p>RECUERDE QUE TIENE QUE TENER UNA CUENTA ACTIVA PARA PODER RECIBIR LOS PAGOS </p></div>");
    }else{
        $("#nota").html("");
    }
});
$('#banco').submit(function (e) {
    e.preventDefault();
    var formData = new FormData(this);
    formData.append('id', <?php echo $id; ?>);
    $('#modalEditarCuenta').modal('hide')
    $.ajax({
        type: 'POST',
        url: '../model/perfil/medicos/datos_bancarios.php',
        data: formData,
        contentType: false,
        processData: false,
        success: function (data) {
            console.log(data)

            // if (data == 1) {
            //     Swal.fire({
            //         title: 'Actualización Exitosa!',
            //         text: 'Se Actualizo correctamente la Cuenta Bancaria',
            //         icon: 'success',
            //         confirmButtonColor: "#007ebc",
            //         confirmButtonText: 'Aceptar'
            //     }).then((result) => {
            //         location.reload();
            //     })
                
            // }
            // if(data == 2){
            //     Swal.fire({
            //         title: 'Error!',
            //         text: 'Tiene que tener al menos una Cuenta Bancaria Activa',
            //         icon: 'error',
            //         confirmButtonColor: "#007ebc",
            //         confirmButtonText: 'Aceptar'
            //     }).then((result) => {
            //         location.reload();
            //     })
            // }
            // if(data == 3){
            //     Swal.fire({
            //         title: 'Error!',
            //         text: 'No se pudo actualizar la Cuenta Bancaria',
            //         icon: 'error',
            //         confirmButtonColor: "#007ebc",
            //         confirmButtonText: 'Aceptar'
            //     }).then((result) => {
            //         location.reload();
            //     })
            // }
               
           
        }
    });
});
</script>