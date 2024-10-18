<!-- Modal -->
<div class="modal fade" id="crear_cuenta" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="crear_cuentaLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">  
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="divider">
          <div class="divider-text">Creación de Cuenta</div>
        </div>
      <form id="account">
        <div class="row">
          <div class="text-center">
            <h5 class="text-danger">Recuerde que las Cuentas Registradas tienen que estar a su nombre de lo contrario ocurrirá problemas al momento de cancelar sus Honorarios</h5>
          </div>
        <input type="text" name="id_user" id="id_user" value="<?php echo $id_user; ?>" hidden/>
          <div class="row">
            <div class="col-md-3">
              <div class="form-group">
                <label for="id_ban">Tipo de Banco:</label>
                <select id="naci" class="form-select mb-3" name="naci" required>
                  <option value="" selected disabled>SELECCIONE</option>
                  <option value="1">NACIONAL</option>
                  <option value="0">INTERNACIONAL</option>
                </select>
              </div>
            </div>

            <div class="col-md-4">
              <div class="form-group">
                <label for="id_ban">Banco:</label>
                <select id="id_ban" class="form-select mb-3" name="id_ban" required>
                  <option value="" selected disabled>SELECCIONE</option>
                  <?php
                    $a = $mysqli->query("SELECT id_ban, banco FROM bancos WHERE id_sta = 1 ");
                      while ($row = mysqli_fetch_array($a)) {
                        echo '<option value="' . $row['id_ban'] . '">' . $row['banco'] . '</option>';
                      }
                  ?>
                </select>
              </div>
            </div>

            <div class="col-md-2">
              <div class="form-group">
                <label for="id_ban">Cuenta:</label>
                <select id="id_tip_cuenta" class="form-select mb-3" name="id_tip_cuenta" required>
                  <option value="" selected disabled>SELECCIONE</option>
                  <?php
                    $a = $mysqli->query("SELECT id, tipo_cuenta FROM tipo_cuenta_banco WHERE id_sta = 1");
                      while ($row = mysqli_fetch_array($a)) {
                        echo '<option value="' . $row['id'] . '">' . $row['tipo_cuenta'] . '</option>';
                      }
                  ?>
                </select>
              </div>
            </div>

            <div class="col-md-3">
              <div class="form-group">
                  <label for="nro_cuenta">Numero de Cuenta:</label>
                  <input type="text" name="nro_cuenta" id="nro_cuenta" class="form-control" onkeypress="return numeros(this, event);" required/>
              </div>
            </div>
          </div>
          <div class="row" id="inter" hidden>
            <div class="col-md-4">
              <div class="form-group">
                <label for="ach">ACH:</label>
                  <input type="text" name="ach" id="ach" placeholder="00000000000" class="form-control" />
              </div>
            </div>

            <div class="col-md-4">
              <div class="form-group">
                <label for="ach">SWIT:</label>
                  <input type="text" name="swit" id="swit" placeholder="00000000000" class="form-control" />
              </div>
            </div>

            <div class="col-md-4">
              <div class="form-group">
                <label for="ach">ABA:</label>
                  <input type="text" name="aba" id="aba" placeholder="00000000000" class="form-control" />
              </div>
            </div>
          </div>
          <div class="text-center mt-5">
            <button type="submit" class="btn btn-primary"><i class="fi fi-rs-disk"></i> GUARDAR</button>
          </div>
        </div>
      </form>
      <script>
        $(document).ready(function() {
          $('#naci').change(function() {
            const selectedOption = $(this).val();
						const requiredElements = ["aba", "swit", "ach"];
            if ($(this).val() == '0') {
              $('#inter').removeAttr('hidden');
              requiredElements.forEach(elementId => {
								$("#" + elementId).attr("required", true);
							});
            } else {
              $('#inter').attr('hidden',true);
              requiredElements.forEach(elementId => {
								$("#" + elementId).removeAttr("required");
							});
            }
          });

        $('#account').submit(function(e) {
          e.preventDefault();
          var data = new FormData(this);
          $('#crear_cuenta').modal('hide')
          $.ajax({
            url: '../model/perfil/medicos/crear_cuenta.php',
            type: 'POST',
            data: data,
            contentType: false,
            cache: false,
            processData: false,
            success: function(data) {
              if (data == '1') {
                
                Swal.fire({
                  icon: 'success',
                  title: 'Cuenta Creada',
                  text: 'La cuenta se creo correctamente',
                  confirmButtonColor: "#007ebc",
                  confirmButtonText: 'Aceptar'
                }).then((result) => {
										if (result.isConfirmed) {
											window.location.href = "perfil";
										}
									});
              } else {
                Swal.fire({
                  icon: 'error',
                  title: 'Error',
                  text: 'Error al crear la cuenta',
                  confirmButtonColor: "#007ebc",
                  confirmButtonText: 'Aceptar'
                }).then((result) => {
										if (result.isConfirmed) {
											window.location.href = "perfil";
										}
									});
              }
            }
          });
        });

        });
      </script>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>