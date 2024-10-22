<?php
$a = "SELECT * FROM medicos WHERE id_user = $id_user";
$ares = $mysqli->query($a);
$row_med = $ares->fetch_array();
?>
<script src="../assets/js/funciones.js"></script>
<div class="nav-align-top mb-4">
	<ul class="nav nav-pills mb-2" role="tablist">
		<li class="nav-item">
			<button type="button" class="nav-link active" role="tab" data-bs-toggle="tab" data-bs-target="#datos" aria-controls="datos" aria-selected="true"><i class="fi fi-ts-user-pen"></i> &nbsp;Datos Basicos </button>
		</li>
		<li class="nav-item">
			<button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#bancos" aria-controls="bancos" aria-selected="false"> <i class="fi fi-ts-bank"></i> &nbsp;Datos Bancarios </button>
		</li>
		<li class="nav-item">
			<button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#especialidades" aria-controls="especialidades" aria-selected="false"> <i class="fi fi-tr-hand-holding-medical"></i> &nbsp;Servicios y Especialidades </button>
		</li>
		<li class="nav-item">
			<button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#documentos" aria-controls="documentos" aria-selected="false"><i class="fi fi-tr-add-document"></i> &nbsp; Documentos </button>
		</li>
	</ul>
	<hr>
	<div class="tab-content">
		<!-- PESTAÑA DE DATOS BASICOS -->
		<div class="tab-pane fade show active" id="datos" role="tabpanel">
			<form id="upd_datos">
				<input type="text" name="id_user" value="<?php echo $id_user; ?>" id="id_user" hidden/>
				<div class="row"> <!--INICIO ROW 1 -->
					<div class="divider">
						
						<div class="divider-text">Datos Personales</div>
					</div>
					<div class="col-md-3">
						<div class="form-group">
							<label for="apellido1">Primer Apellido: </label>
							<input type="text" name="apellido1" id="apellido1" value="<?php echo $row_med['apellido1']; ?>" class="form-control" style="text-transform:uppercase;" onkeypress="return letras(this, event);" required />
						</div>
					</div>
					<div class="col-md-3">
						<div class="form-group">
							<label for="apellido1">Segundo Apellido: </label>
							<input type="text" name="apellido2" id="apellido2" value="<?php echo $row_med['apellido2']; ?>" class="form-control" style="text-transform:uppercase;" onkeypress="return letras(this, event);" />
						</div>
					</div>

					<div class="col-md-3">
						<div class="form-group">
							<label for="nombre1">Primer Nombre: </label>
							<input type="text" name="nombre1" id="nombre1" value="<?php echo $row_med['nombre1']; ?>" class="form-control" style="text-transform:uppercase;" onkeypress="return letras(this, event);" required />
						</div>
					</div>

					<div class="col-md-3 mb-4">
						<div class="form-group">
							<label for="mombre2">Segundo Nombre: </label>
							<input type="text" name="nombre2" id="nombre2" value="<?php echo $row_med['nombre2']; ?>" class="form-control" style="text-transform:uppercase;" onkeypress="return letras(this, event);" required />
						</div>
					</div>

					

					<div class="col-md-5">
					<label for="rif">RIF:</label>
						<div class="input-group">
							<select class="form-select" id="tprif" name="tprif">
								<?php
								$opciones = ['N', 'J', 'G'];
								$letra_rif = substr($row_med['rif'], 0, 1);
								foreach ($opciones as $opcion) {
									if ($letra_rif != $opcion) {
										echo '<option value="' . $opcion . '">' . $opcion . '</option>';
									}
								}
								echo '<option value="' . $letra_rif . '" selected>' . $letra_rif . '</option>';
								?>
							</select>
							<input type="text" name="rif" id="rif" value="<?php echo substr($row_med['rif'], 1); ?>" maxlength="9" minlength="9" class="form-control" onkeypress="return numeros(this, event);" required />
						</div>
						<small>Colocar el Numero del Rif sin Guiones solo numero</small>
					</div>

					

					<div class="col-md-5">
						<label for="rif">Cédula Identidad:</label>
						<div class="input-group">
						<select class="form-select" id="tpdoc" name="tpdoc">
								<?php
								$opciones = ['V', 'E', 'P'];
								$valor = $row_med['nac'];
								foreach ($opciones as $opcion) {
									if ($valor != $opcion) {
										echo '<option value="' . $opcion . '">' . $opcion . '</option>';
									}
								}
								echo '<option value="' . $valor . '" selected>' . $valor . '</option>';
								?>
							</select>
							<input type="text" name="cedula" id="cedula" minlength="6" maxlength="9" value="<?php echo $row_med['cedula']; ?>"class="form-control" onkeypress="return numeros(this, event);" required />
						</div>
					</div>


					<div class="col-md-2 mb-4">
						<div class="form-group">
							<label for="fnacimiento">Fec. Nac:</label>
							<input type="date" name="fnacimiento" id="fnacimiento" value="<?php echo $row_med['fec_nac']; ?>" class="form-control mb-3" onblur="calcedad(this.value)" required/> 
						</div>
					</div>

					<div class="col-md-1">
						<div class="form-group">
							<label for="edad">Edad:</label>
							<input type="text" name="edad" id="edad" value="<?php echo $row_med['edad']; ?>" class="form-control" required readonly/>
						</div>
					</div>

					<div class="col-md-2">
						<div class="form-group">
							<label for="idsexo">Sexo:</label>
							<select id="idsexo" class="form-select" name="idsexo" required>
								<?php
								$a = $mysqli->query("SELECT id_sex, genero from sexo WHERE id_sta = 1");
								while ($rowa = mysqli_fetch_array($a)) {
									if ($rowa['id_sex'] == $row_med['idsex']) {
										echo '<option value="' . $rowa['id_sex'] . '" selected>' . $rowa['genero'] . '</option>';
									} else {
										echo '<option value="' . $rowa['id_sex'] . '">' . $rowa['genero'] . '</option>';
									}
								} ?>
							</select>
						</div>
					</div>

					<div class="col-md-3">
						<div class="form-group">
							<label for="idestcivil">Est. Civil:</label>
							<select id="idestcivil" class="form-select" name="idestcivil" required>
								<?php
								$a = $mysqli->query("SELECT id_civ, civil from estadocivil WHERE id_sta = 1");
								while ($rowa = mysqli_fetch_array($a)) {
									if ($rowa['id_civ'] == $row_med['idcivil']) {
										echo '<option value="' . $rowa['id_civ'] . '" selected>' . $rowa['civil'] . '</option>';
									} else {
										echo '<option value="' . $rowa['id_civ'] . '">' . $rowa['civil'] . '</option>';
									}
								} ?>
							</select>
						</div>
					</div>

					<div class="col-md-3">
						<div class="form-group">
							<label for="celular">Celular:</label>
							<input type="text" name="celular" id="celular" value="<?php echo $row_med['celular']; ?>" maxlength="12" minlength="12" class="form-control" onkeypress="return numeros(this, event);" required />
						</div>
					</div>
					<script>
						const input2 = document.querySelector("#celular");
						window.intlTelInput(input2, {
							loadUtilsOnInit: "https://cdn.jsdelivr.net/npm/intl-tel-input@24.6.0/build/js/utils.js",
							initialCountry: "ve",
						});
					</script>
					

					<div class="col-md-3 mb-4">
						<div class="form-group">
							<label for="telefono">Teléfono:</label>
							<input type="text" name="telefono" id="telefono" minlength="12" maxlength="12" value="<?php echo $row_med['telf']; ?>" class="form-control mb-3" onkeypress="return numeros(this, event);" />
						</div>
					</div>
					<script>
						const input = document.querySelector("#telefono");
						window.intlTelInput(input, {
							loadUtilsOnInit: "https://cdn.jsdelivr.net/npm/intl-tel-input@24.6.0/build/js/utils.js",
							initialCountry: "ve",
						});
					</script>

					<div class="col-md-3">
						<div class="form-group">
							<label for="correo">Correo:</label>
							<input type="email" name="correo" value="<?php echo $row_med['correo_pri']; ?>" id="correo" class="form-control" readonly>
							<small class="mb-3">Por razones de seguridad el correo no se puede modificar</small>
						</div>
					</div>

					<div class="col-md-3">
						<div class="form-group">
							<label for="correoalt">Correo Alterno:</label>
							<input type="email" name="correoalt" value="<?php echo $row_med['correo2']; ?>" id="correo2" class="form-control mb-3"
								style="text-transform:lowercase;">
						</div>
					</div>

					<div class="col-md-3">
						<div class="form-group">
						<label for="codcolmed">N° Colegio Médico:</label>
						<input type="text" name="codcolemed" id="codcolemed" value="<?php echo $row_med['cod_col_med']; ?>" class="form-control" required/>
						</div>  
					</div>

					<div class="col-md-3">
						<div class="form-group">
						<label for="mpsscod">MPSS:</label>
						<input type="text" name="mpsscod" id="mpsscod"  minlength="5" maxlength="5" value="<?php echo $row_med['mpss']; ?>" class="form-control mb-4" required/>
						</div>  
					</div>


				</div> <!--FIN ROW 1 -->

				<div class="row mt-3"> <!--INICIO ROW 3 -->
					<div class="col-md-3">
						<div class="form-group">
							<label for="idpais">País:</label>
							<select id="idpais" class="form-select" name="idpais" required>
								<?php
								$a = $mysqli->query("SELECT id, pais FROM pais WHERE id_sta=1");
								while ($rowa = mysqli_fetch_array($a)) {
									if ($rowa['id'] == $row_med['idpais']) {
										echo '<option value="' . $rowa['id'] . '" selected>' . $rowa['pais'] . '</option>';
									} else {
										echo '<option value="' . $rowa['id'] . '">' . $rowa['pais'] . '</option>';
									}
								} ?>
							</select>
						</div>
					</div>

					<div id="div-estado" class="col-md-3">
						<div class="form-group">
							<label for="correo">Estado:</label>
							<select id="id_estado" class="form-select" name="idestado">
								<?php
								$a = $mysqli->query("SELECT id_estado, estado FROM estados WHERE idpais=1");
								while ($rowa = mysqli_fetch_array($a)) {
									if ($rowa['id_estado'] == $row_med['idestado']) {
										echo '<option value="' . $rowa['id_estado'] . '" selected>' . $rowa['estado'] . '</option>';
									} else {
										echo '<option value="' . $rowa['id_estado'] . '">' . $rowa['estado'] . '</option>';
									}
								} ?>


							</select>
						</div>
					</div>

					<div id="div-municipio" class="col-md-3">
						<div class="form-group">
							<label for="correo">Municipio:</label>
							<select id="id_municipio" class="form-select" name="idmunicipio" >
								<?php
								$a = $mysqli->query("SELECT id_municipio, id_estado, municipio FROM municipios WHERE id_estado = ".$row_med['idestado']."");
								while ($rowa = mysqli_fetch_array($a)) {
									if ($rowa['id_municipio'] == $row_med['idmunicipio']) {
										echo '<option value="' . $rowa['id_municipio'] . '" selected>' . $rowa['municipio'] . '</option>';
									} else {
										echo '<option value="' . $rowa['id_municipio'] . '">' . $rowa['municipio'] . '</option>';
									}
								} ?>
							</select>
						</div>
					</div>

					<div  id="div-parroquia" class="col-md-3">
						<div class="form-group">
							<label for="correo">Parroquia:</label>
							<select id="id_parroquia" class="form-select mb-3" name="idparroquia" >
							<?php
								$a = $mysqli->query("SELECT id_parroquia, id_municipio, parroquia FROM parroquias WHERE id_municipio = ".$row_med['idmunicipio']."");
								while ($rowa = mysqli_fetch_array($a)) {
									if ($rowa['id_parroquia'] == $row_med['idparroquia']) {
										echo '<option value="' . $rowa['id_parroquia'] . '" selected>' . $rowa['parroquia'] . '</option>';
									} else {
										echo '<option value="' . $rowa['id_parroquia'] . '">' . $rowa['parroquia'] . '</option>';
									}
								} ?>
							</select>
						</div>
					</div>
				</div><!--FIN ROW 3 -->

				<div class="row mt-3"> <!--INICIO ROW 3 -->
					<div class="col-md-12">
						<div class="form-group">
							<label for="direccion">Direccion de Habitación:</label>
							<input type="text" name="direccion" style="text-transform:uppercase;" id="direccion" value="<?php echo $row_med['direccion']; ?>" class="form-control" required />
						</div>
					</div>

					<div class="text-center mt-4">
						<button type="submit" id="btn_upd_datos" class="btn btn-primary"><i class="fi fi-rs-disk"></i> ACTUALIZAR</button>
						<a href="javascript:history.back()" class="btn btn-outline-warning" rel="noopener noreferrer"><i class="fi fi-rr-undo"></i> VOLVER </a>
					</div>
				</div> <!-- FIN ROW 4 -->
			</form>

			<script>
				$(document).ready(function () {
					$("#upd_datos").submit(function (e) {
						e.preventDefault();
						$.ajax({
							type: "POST",
							url: "../model/perfil/medicos/datos_basicos.php",
							data: $(this).serialize(),
							success: function (data) {
								if(data == 1){
									Swal.fire({
										title: 'Actualización Exitosa!',
										text: 'Se Actualizo correctamente los datos Basicos',
										icon: 'success',
										confirmButtonColor: "#007ebc",
										confirmButtonText: 'Aceptar'
									}).then((result) => {
										if (result.isConfirmed) {
											window.location.href = "perfil";
										}
									});
								}else{
									Swal.fire({
										title: 'Error!',
										text: 'Ocurrio un Error al Actualizar los Datos Basicos ',
										icon: 'error',
										confirmButtonColor: "#007ebc",
										confirmButtonText: 'Aceptar'
									});
								}
							}
						});
					});
				});
			</script>
		</div><!-- FIN PESTAÑA DE DATOS BASICOS -->
		<!-- PESTAÑA DE DATOS BANCARIOS -->
		<div class="tab-pane fade" id="bancos" role="tabpanel">
		<?php 
			//--------- DATA DE CUENTAS ---------//
			$a="SELECT DBM.id, U.id_user, CONCAT(M.nac, '', M.cedula) AS cedula, CONCAT(apellido1, ' ', nombre1) AS nom_titular, 
				DBM.id_ban, B.cod_ban, B.banco, B.nacional,
				CASE WHEN B.nacional = 1 THEN 'NACIONAL'
						ELSE 'INTERNACIONAL'
					END AS tip_banco,
				TCB.id AS id_tip, TCB.tipo_cuenta, DBM.nro_cuenta, DBM.ach, DBM.swit, DBM.aba, DBM.id_sta, E.nom_sta
				FROM users U
				INNER JOIN medicos M ON U.id_user = M.id_user 
				LEFT JOIN datos_bancarios_med DBM ON M.id_user = DBM.id_user
				LEFT JOIN bancos B ON DBM.id_ban = B.id_ban
				LEFT JOIN tipo_cuenta_banco TCB ON DBM.id_tip = TCB.id
				LEFT JOIN users_status US ON U.id_user = US.id_user
				LEFT JOIN estatus E ON DBM.id_sta = E.id_sta
				WHERE U.id_user = $id_user
				AND US.id_sta IN (1, 4)";
				$ares=$mysqli->query($a);
				
			?>
			<div class="row">
				<div class="divider">
					<div class="divider-text">Cuentas Asociadas</div>
				</div>
			
					<div class="text-center text-danger">
						<p>Recuerde que tiene que tener al menos una Cuenta Activa para poder recibir Pagos</p>
					</div>
		
				<div class="text-center">
					<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#crear_cuenta">CREAR CUENTA</button>
				</div>


				<div class="table-responsive">
					<table class="table table-hover" id="user" cellspacing="0" style="width: 100%;">
						<thead>
							<tr>
								<th>#</th>
								<th>Banco</th>
								<th>Tipo</th>
								<th>Cuenta</th>
								<th>Nro. Cuenta</th>
								<th>Estatus</th>
								<th>Acción</th>
							</tr>
						</thead>
					<tbody>
						<?php while ($row = mysqli_fetch_array($ares)) { ?>
						<tr>
							<td><?php echo $row['id']; ?></td>
							<td><?php echo $row['banco']; ?></td>
							<td><?php echo $row['tip_banco']; ?></td>
							<td><?php echo $row['tipo_cuenta']; ?></td>
							<td><?php echo $row['nro_cuenta']; ?></td>
							<td><?php echo $row['nom_sta']; ?></td>
							<td><button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalEditarCuenta" data-cuenta="<?php echo $row['id']?>"><i class="fi fi-rr-user-pen"></i> &nbsp;&nbsp;Editar</button></td>
						</tr>
						<?php } ?>
					</tbody>
					</table>
				</div>
			</div>

			<script>

			//----------- ACTIVACION DEL MODAL ------------//
			$(document).on('show.bs.modal', '#modalEditarCuenta', function(event) {
            var button = $(event.relatedTarget);
            var cuenta = button.data('cuenta');
            var modal = $(this);
            modal.find('.modal-body').load('../html/view/perfil/modals/editar_cuenta.php?id=' + cuenta);
            });
				$(document).ready(function () {
					$("#bank_inter").change(function () {
						const selectedOption = $(this).val();
						const requiredElements = ["telf_inter", "codpostalint", "dircta", "aba", "swit", "ach", "nrocuentaint"];
						if (selectedOption === "1") {
							$("#cuenta_inter").removeAttr("hidden");
							requiredElements.forEach(elementId => {
								$("#" + elementId).attr("required", true);
							});
						} else {
							$("#cuenta_inter").attr("hidden", true);
							requiredElements.forEach(elementId => {
								$("#" + elementId).removeAttr("required");
							});
						}
					});
					$("#upd_banco").submit(function (e) {
						e.preventDefault();
						$.ajax({
							type: "POST",
							url: "../model/perfil/medicos/datos_bancarios.php",
							data: $(this).serialize(),
							success: function (data) {
								if(data == 1){
									Swal.fire({
										title: 'Actualización Exitosa!',
										text: 'Se Actualizo correctamente los datos Bancarios',
										icon: 'success',
										confirmButtonColor: "#007ebc",
										confirmButtonText: 'Aceptar'
									}).then((result) => {
										if (result.isConfirmed) {
											window.location.href = "perfil";
										}
									});
								}else{
									Swal.fire({
										title: 'Error!',
										text: 'Ocurrio un Error al Actualizar los Datos Bancarios ',
										icon: 'error',
										confirmButtonColor: "#007ebc",
										confirmButtonText: 'Aceptar'
									});
								}
							}
						});
					});
				});
			</script>

			<div class="text-center mt-4">
				<a href="javascript:history.back()" class="btn btn-outline-warning" rel="noopener noreferrer"><i class="fi fi-rr-undo"></i> VOLVER </a>
			</div>

		</div><!-- FIN PESTAÑA DE DATOS BANCARIOS -->

				<!-- PESTAÑA DE DATOS DE ESPECIALIDADES -->
		<div class="tab-pane fade" id="especialidades" role="tabpanel">
			<div class="divider">
				<div class="divider-text">Servicios Afiliados</div>
			</div>
			<?php 
				$a = "SELECT id, nom_servicio, id_sta FROM serviciosafiliados where id_sta=1";
				$res=$mysqli->query($a);
			?>

			<div style="text-align: left;">
				<div class="row">
				<?php while($row = mysqli_fetch_array($res)) { 
					$b="SELECT COUNT(*) as cant FROM medico_serv_afil WHERE id_med= '$id_user' and id_ser = '".$row['id']."'; ";
					$obj=$mysqli->query($b);
					$arrlast=$obj->fetch_array();
					$cant=$arrlast[0];
				?>
					<div class="col-md-3">
						<div class="form-check">
							<input class="form-check-input" type="checkbox" value="" id="<?php echo $row['id'];?>"  onclick="fcheckafilia(this.id)" 
							<?php if ($cant!='0') { ?>
							checked
							<?php  } ?>
							>
							<label class="form-check-label" for="<?php echo $row['id'];?>">
								<?php echo $row['nom_servicio'];?>
							</label>
						</div>
					</div>
				<?php  } ?>
					
				</div>
			</div>

			<div class="divider">
				<div class="divider-text">Especialidades Médicas</div>
			</div>
			<div class="row">
				<div class="col-md-5">
					<div class="form-group">
						<label for="apellido1">Especialidad</label>
						<select class="form-select" id="idespmed" name="idespmed">
							<option value="" disabled selected>Seleccione</option>
							<?php
							$a = $mysqli -> query ("SELECT id_espe, especialidad FROM especialidades_med WHERE id_sta = 1");
							while ($row = mysqli_fetch_array($a)) {
							echo '<option value="'.$row['id_espe'].'">'.$row['especialidad'].'</option>'; } 
							?>
						</select>
					</div>
				</div>
				<div class="col-md-7">
				<?php 
				$b = "SELECT ME.id, ME.id_user, EM.especialidad
					FROM medico_especialidad ME
					LEFT JOIN especialidades_med EM ON EM.id_espe = ME.id_espe
					WHERE ME.id_user = $id_user
					AND EM.id_sta = 1";
				$bres=$mysqli->query($b);
				?>
				<div class="table-responsive">
					<table class="table table-hover" id="tblesp" cellspacing="0" style="width: 100%;">
					<thead>
						<tr>
							<th>Especialidad Seleccionada</th>
							<th>Acción</th>
						</tr>
						</thead>
						<tbody>
							 <?php
								while ($row = $bres->fetch_array(MYSQLI_ASSOC)) {
								echo '<tr>';
								echo '<td>'.$row['especialidad'].'</td>';
								echo '<td><button class="btn btn-primary" type="button" onclick="borrar('.$row['id'].')" id="del-'.$row['id'].'"><i class="fi fi-rr-delete-user"></i></button></td>';
								echo '</tr>';
								}
							?> 
						</tbody>
					</table>
					</div>
					
				</div>
				</div> <!-- FIN DE ROW 2 -->
			<div class="row"> 
					<div class="divider">
						<div class="divider-text">Horarios de Atención</div>
					</div>
				<div class="text-center mb-5">
					<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
					<i class="fi fi-rs-disk"></i> Agregar Horarios de Atención
					</button>
					
				</div>
				
				<div class="table-responsive">
					<table class="table table-hover" id="user2" cellspacing="0" style="width: 100%;">
					<thead>
						<tr>
							<th>Clinica</th>
							<th>Horario de Atención</th>
							<th>Accion</th>
						</tr>
					</thead>
						<tbody>
							<?php
							$c = "SELECT MH.id, MH.id_cli, MH.id_med, C.nom_cli, MH.dia, MH.desde, MH.hasta
								FROM medico_horario MH
								INNER JOIN clinicas C ON MH.id_cli = C.id_cli
								WHERE MH.id_med =  $id_user";
								$cres=$mysqli->query($c);
								while ($rowc = $cres->fetch_array(MYSQLI_ASSOC)) {
									$desde=date("g:iA", strtotime($rowc['desde']));
									$hasta=date("g:iA", strtotime($rowc['hasta']));
									echo '<tr>';
										echo '<td>'.$rowc['nom_cli'].'</td>';
										echo '<td>'.$rowc['dia'].' : '.$desde.'-'.$hasta.'</td>';
										echo '<td><button class="btn btn-primary" type="button" onclick="borrarcli('.$rowc['id'].')" id="del-'.$rowc['id'].'"><i class="fi fi-rr-delete-user"></i></button></td>';
									echo '</tr>';
								}
							?>
					</table>
				</div>
			</div>
		
			<div class="text-center mt-4">
				<a href="javascript:history.back()" class="btn btn-outline-warning" rel="noopener noreferrer">
					<i class="fi fi-rr-undo"></i> VOLVER 
				</a>
			</div>
		<script>
			$("#idespmed").change(function () {
				const idespmed = $("#idespmed").val();
				const idmed = $("#id_user").val();
				$.ajax({
					type: "POST",
					url: "../model/perfil/medicos/datos_especialidades.php",
					data: { idespmed: idespmed, idmed: idmed },
					success: function (data) {
						if(data == 2){
							Swal.fire({
								title: 'Error!',
								text: 'La especialidad seleccionada ya esta incluida anteriormente',
								icon: 'error',
								confirmButtonColor: "#007ebc",
								confirmButtonText: 'Aceptar'
							});
							return false;
						}
						const arrdata = data.split('-');
						const id =arrdata[0];
						const espe =arrdata[1];
						document.getElementById("tblesp").insertRow(-1).innerHTML = '<tr><td>'+espe+'</td><td><button class="btn btn-primary" type="button" onclick="borrar('+id+')" id="del-'+id+'"><i class="fi fi-rr-delete-user"></i></button></td></tr>';
						Swal.fire({
							title: 'Actualización Exitosa!',
							text: 'Agrego Correctamente la Especialidad',
							icon: 'success',
							confirmButtonColor: "#007ebc",
							confirmButtonText: 'Aceptar'
						}).then((result) => {
							if (result.isConfirmed) {
								window.location.href = "perfil";
							}
						});
					}
				});
			});
			
			$('#idespmed').select2({
				theme: 'bootstrap-5',
				width: '100%',
			});
		</script>
		</div><!-- FIN PESTAÑA DE DATOS DE ESPECIALIDADES -->
		<!-- PESTAÑA DE DATOS DE DOCUMENTOS -->
		<div class="tab-pane fade" id="documentos" role="tabpanel">
			<div class="divider">
                <div class="divider-text">Documentación Médica</div>
            </div>
			<form enctype="multipart/form-data" action="../model/perfil/medicos/add_docu_med.php" method="post">
				<input type="text" id="idmed_docu" name="idmed_docu" value="<?php echo $id_user; ?>" hidden/> 
				<div class="row mb-4">
					<div class="col-md-4">
						<label for="cedula">Cédula:</label>
						<div class="custom-file">
						<input type="file" id="cedula" name="cedula" class="form-control" accept="image/jpeg, image/png, image/jpg, image/webp, application/pdf" onchange="validarArchivo(this)" />
						</div>
					</div>
					<div class="col-md-4">
					<label for="rif">RIF:</label>
						<div class="custom-file">
						<input type="file" id="rif" name="rif" class="form-control" accept="image/jpeg, image/png, image/jpg, image/webp, application/pdf"  onchange="validarArchivo(this)" />
						</div>
					</div>
					
					<div class="col-md-4">
					<label for="colemed">Carnet C.M:</label>
						<div class="custom-file">
						<input type="file" id="colemed" name="colemed" class="form-control" accept="image/jpeg, image/png, image/jpg, image/webp, application/pdf" onchange="validarArchivo(this)" />
						</div>
					</div>
				</div>
				<hr>
				<div class="row">
					<div class="col-md-4">
					<label for="colemed">MPSS:</label>
						<div class="custom-file">
							<input type="file" id="mpss" name="mpss" class="form-control" accept="image/jpeg, image/png, image/jpg, image/webp, application/pdf" onchange="validarArchivo(this)" />
						</div>
					</div>

					<div class="col-md-4">
					<label for="colemed">Firma:</label>
						<div class="custom-file">
							<input type="file" id="firma" name="firma" class="form-control" accept="image/jpeg, image/png, image/jpg, image/webp, application/pdf" onchange="validarArchivo(this)" />  
						</div>
					</div>

					<div class="col-md-4">
					<label for="colemed">Sello:</label>
						<div class="custom-file">
							<input type="file" id="sello" name="sello" class="form-control" accept="image/jpeg, image/png, image/jpg, image/webp, application/pdf" onchange="validarArchivo(this)" />  
						</div>
					</div>

				</div>
						<div class="row text-center mt-3">
							<small class="text-danger">Formatos Permitidos: jpeg, png, jpg, webp, pdf</small> <br>
							<small class="text-danger">Peso Maximo de Carga: 2MB</small>
						</div>
					<div class="text-center">
						<button type="submit" value="enviar" class="btn btn-primary mt-4"><i class="fi fi-rs-cloud-upload"></i>&nbsp; Cargar</button>
					</div>

				
			</form>
			<div class="table-responsive">
				 <table class="table table-hover" id="user3" cellspacing="0" style="width: 100%;">
					<thead>
						<tr>
							<th>Documento</th>
							<th>Accion</th>
						</tr>
					</thead>
					<tbody>
						<?php 
						$a = "SELECT id, id_med, tip_docum, nom_docum 
						FROM medico_documentos WHERE id_med='$id_user'";
						$row=$mysqli->query($a);
						while($rowdoc = mysqli_fetch_array($row)) { 
							$extension = pathinfo($rowdoc['nom_docum'], PATHINFO_EXTENSION);?>
						<tr>
						<td>
							<?php 
							if ($extension === 'pdf') {
								echo '<a href="../upload/perfil_medico/' . $rowdoc['nom_docum'] . '" target="_blank">Ver PDF</a>';
							}else{
								echo '<a href="../upload/perfil_medico/' . $rowdoc['nom_docum'] . '" data-lightbox="image-1" data-title="' . "Documentacion del Doctor: " . $fullname . '">' . $rowdoc['nom_docum'] . '</a>';
							}?>
						
						</td>
						<td align="center">
							<button type="button" onclick="fdeldoc(<?php echo $rowdoc['id'];?>)" class="btn btn-primary btn-sm"><i class="fi fi-rr-delete-user"></i></button>
							
						</td>
						</tr>
					<?php } ?>

					</tbody>

				 </table>
			</div>
		<script>
		function fdeldoc(id) {
			const idmed = $("#idmed_docu").val();
			$.ajax({
				type: "POST",
				url: "../model/perfil/medicos/del_docu_med.php",
				data: { id: id, idmed: idmed },
				success: function (data) {
					if(data == 1){
						Swal.fire({
							title: "Documento Eliminado",
							text: "Elimino con Exito el Documento Seleccionado",
							icon: "success",
							confirmButtonColor: "#007ebc",
							confirmButtonText: "Aceptar"
						})
						var tabla = document.getElementById("user3");
						var filas = tabla.getElementsByTagName("tr");
						for (var i = 0; i < filas.length; i++) {
							var celdas = filas[i].getElementsByTagName("td");
							if (celdas.length > 0) {
								var boton = celdas[celdas.length - 1].getElementsByTagName("button")[0];
									if (boton.getAttribute("onclick").includes(id)) {
										tabla.deleteRow(i);
										break;
									}
							}
						}
					}else{
						Swal.fire({
							icon: "error",
							title: "Error al Eliminar",
							text:"Ocurrio un error al Eliminar el Documento",
							confirmButtonText: "Volver",
							confirmButtonColor: "#007ebc",
						})
					}
					if(data == 3){
						Swal.fire({
							icon: "error",
							title: "No se encuentra el documento",
							text:"Ocurrio un error al Eliminar el Documento",
							confirmButtonText: "Volver",
							confirmButtonColor: "#007ebc",
							}).then(function() {
								window.location.href = "../../../html/perfil.php";
							});

					}
				}
			});
		}
		</script>
		<div class="text-center mt-4">
				<a href="javascript:history.back()" class="btn btn-outline-warning" rel="noopener noreferrer"><i class="fi fi-rr-undo"></i> VOLVER </a>
			</div>
		</div><!-- FIN PESTAÑA DE DATOS DE DOCUMENTOS -->
