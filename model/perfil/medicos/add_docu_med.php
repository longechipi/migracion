<header>
    <script src="../../../libs/sweetalert/sweetalert.js"></script>
</header>

<?php 
require('../../../conf/conex.php');
require('../../../controller/log.php');

$idmed = $_POST['idmed_docu'];

$a = "SELECT cedula FROM medicos WHERE id_user='$idmed'";
$ares=$mysqli->query($a);
$datos = $ares->fetch_assoc();
$nrodoc = $datos['cedula'];
$date = date('Y-m-d');
$archivos = ['cedula', 'rif', 'colemed', 'mpss', 'firma', 'sello'];

$tiene = false;
foreach ($archivos as $archivo) {
    if ($_FILES[$archivo]['error'] === UPLOAD_ERR_OK) {
        $tiene = true;
        break;
    }
}

if ($tiene) {
    //--------- Carga de Archivo para la Cedula --------//
    if (isset($_FILES['cedula'])) {
        $allowedImageTypes = ['image/jpeg', 'image/png', 'image/jpg', 'image/webp']; 
        $allowedPdfTypes = ['application/pdf'];
        if (in_array($_FILES['cedula']['type'], $allowedImageTypes) || in_array($_FILES['cedula']['type'], $allowedPdfTypes)) {
            $fileName = $_FILES['cedula']['name'];
            $sourcePath = $_FILES['cedula']['tmp_name'];
            $targetPath = "../../../upload/perfil_medico/" . "CI-" . $nrodoc . '-'.$date. '.' . pathinfo($fileName, PATHINFO_EXTENSION);

            $b ="SELECT tip_docum FROM medico_documentos WHERE tip_docum = 'CEDULA' AND id_med = $idmed ";
            $bres=$mysqli->query($b);
            $rowcount=mysqli_num_rows($bres);
                if($rowcount > 0){
                    echo '<script>
                        Swal.fire({
                            icon: "error",
                            title: "Error al Cargar",
                            text: "Usted ya tiene un Archivo tipo Cédula Cargado en el Sistema",
                            confirmButtonText: "Volver",
                            confirmButtonColor: "#007ebc",
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location.href = "../../../html/perfil";
                            }
                        });
                    </script>';
                }else{
                $nom_docum = "CI-" . $nrodoc . '-'.$date. '.' .  pathinfo($fileName, PATHINFO_EXTENSION);
                $c = "INSERT INTO medico_documentos(id_med, tip_docum, nom_docum, id_sta) VALUES('$idmed', 'CEDULA', '$nom_docum', 1)";
                $cres = $mysqli->query($c);
                if($cres){
                    if (move_uploaded_file($sourcePath, $targetPath)) {
                        $validar = true;
                        register_log($mysqli, $idmed,'ACTUALIZO DATOS', 'PERFIL', 'USUARIO SUBIO UN ARCHIVO DE TIPO: CEDULA');
                        echo '<script>
                            Swal.fire({
                                title: "Archivo Cargado Exitosamente!",
                                text: "Cargo Exitosamente el Archivo en el Sistema ",
                                icon: "success",
                                confirmButtonColor: "#007ebc",
                                confirmButtonText: "Aceptar"
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    window.location.href = "../../../html/perfil";
                                }
                            });
                        </script>';
                    }

                }else{
                    echo '<script>
                        Swal.fire({
                            icon: "error",
                            title: "Error al Cargar",
                            text: "Error al Cargar el Archivo",
                            confirmButtonText: "Volver",
                            confirmButtonColor: "#007ebc",
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location.href = "../../../html/perfil";
                            }
                        });
                    </script>';
                
                }
            }
        }
    }
    //--------- Carga de Archivo para el RIF --------//
    if (isset($_FILES['rif'])) {
        $allowedImageTypes = ['image/jpeg', 'image/png', 'image/jpg', 'image/webp']; 
        $allowedPdfTypes = ['application/pdf'];
        if (in_array($_FILES['rif']['type'], $allowedImageTypes) || in_array($_FILES['rif']['type'], $allowedPdfTypes)) {
            $fileName = $_FILES['rif']['name'];
            $sourcePath = $_FILES['rif']['tmp_name'];
            $targetPath = "../../../upload/perfil_medico/" . "RIF-" . $nrodoc . '-'.$date. '.' . pathinfo($fileName, PATHINFO_EXTENSION);

            $b ="SELECT tip_docum FROM medico_documentos WHERE tip_docum = 'RIF' AND id_med = $idmed ";
            $bres=$mysqli->query($b);
            $rowcount=mysqli_num_rows($bres);
                if($rowcount > 0){
                    echo '<script>
                        Swal.fire({
                            icon: "error",
                            title: "Error al Cargar",
                            text: "Usted ya tiene un Archivo tipo RIF Cargado en el Sistema",
                            confirmButtonText: "Volver",
                            confirmButtonColor: "#007ebc",
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location.href = "../../../html/perfil";
                            }
                        });
                    </script>';
                }else{
                $nom_docum = "RIF-" . $nrodoc . '-'.$date. '.' .  pathinfo($fileName, PATHINFO_EXTENSION);
                $c = "INSERT INTO medico_documentos(id_med, tip_docum, nom_docum, id_sta) VALUES('$idmed', 'RIF', '$nom_docum', 1)";
                $cres = $mysqli->query($c);
                if($cres){
                    if (move_uploaded_file($sourcePath, $targetPath)) {
                        $validar = true;
                        register_log($mysqli, $idmed,'ACTUALIZO DATOS', 'PERFIL', 'USUARIO SUBIO UN ARCHIVO DE TIPO: RIF');
                        echo '<script>
                            Swal.fire({
                                title: "Archivo Cargado Exitosamente!",
                                text: "Cargo Exitosamente el Archivo en el Sistema ",
                                icon: "success",
                                confirmButtonColor: "#007ebc",
                                confirmButtonText: "Aceptar"
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    window.location.href = "../../../html/perfil";
                                }
                            });
                        </script>';
                    }
                }else{
                    echo '<script>
                        Swal.fire({
                            icon: "error",
                            title: "Error al Cargar",
                            text: "Error al Cargar el Archivo",
                            confirmButtonText: "Volver",
                            confirmButtonColor: "#007ebc",
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location.href = "../../../html/perfil";
                            }
                        });
                    </script>';
                
                }
            }
        }
    }
    //--------- Carga de Archivo para el COLEGIO MEDICO --------//
    if (isset($_FILES['colemed'])) {
        $allowedImageTypes = ['image/jpeg', 'image/png', 'image/jpg', 'image/webp']; 
        $allowedPdfTypes = ['application/pdf'];
        if (in_array($_FILES['colemed']['type'], $allowedImageTypes) || in_array($_FILES['colemed']['type'], $allowedPdfTypes)) {
            $fileName = $_FILES['colemed']['name'];
            $sourcePath = $_FILES['colemed']['tmp_name'];
            $targetPath = "../../../upload/perfil_medico/" . "COL_MED-" . $nrodoc . '-'.$date. '.' . pathinfo($fileName, PATHINFO_EXTENSION);

            $b ="SELECT tip_docum FROM medico_documentos WHERE tip_docum = 'COL_MED' AND id_med = $idmed ";
            $bres=$mysqli->query($b);
            $rowcount=mysqli_num_rows($bres);
                if($rowcount > 0){
                    echo '<script>
                        Swal.fire({
                            icon: "error",
                            title: "Error al Cargar",
                            text: "Usted ya tiene un Archivo tipo Colegio Médico Cargado en el Sistema",
                            confirmButtonText: "Volver",
                            confirmButtonColor: "#007ebc",
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location.href = "../../../html/perfil";
                            }
                        });
                    </script>';
                }else{
                $nom_docum = "COL_MED-" . $nrodoc . '-'.$date. '.' .  pathinfo($fileName, PATHINFO_EXTENSION);
                $c = "INSERT INTO medico_documentos(id_med, tip_docum, nom_docum, id_sta) VALUES('$idmed', 'COL_MED', '$nom_docum', 1)";
                $cres = $mysqli->query($c);
                if($cres){
                    if (move_uploaded_file($sourcePath, $targetPath)) {
                        $validar = true;
                        register_log($mysqli, $idmed,'ACTUALIZO DATOS', 'PERFIL', 'USUARIO SUBIO UN ARCHIVO DE TIPO: COL_MED');
                        echo '<script>
                            Swal.fire({
                                title: "Archivo Cargado Exitosamente!",
                                text: "Cargo Exitosamente el Archivo en el Sistema ",
                                icon: "success",
                                confirmButtonColor: "#007ebc",
                                confirmButtonText: "Aceptar"
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    window.location.href = "../../../html/perfil";
                                }
                            });
                        </script>';
                    }
                }else{
                    echo '<script>
                        Swal.fire({
                            icon: "error",
                            title: "Error al Cargar",
                            text: "Error al Cargar el Archivo",
                            confirmButtonText: "Volver",
                            confirmButtonColor: "#007ebc",
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location.href = "../../../html/perfil";
                            }
                        });
                    </script>';
                
                }
            }
        }
    }
    //--------- Carga de Archivo para el MPSS --------//
    if (isset($_FILES['mpss'])) {
        $allowedImageTypes = ['image/jpeg', 'image/png', 'image/jpg', 'image/webp']; 
        $allowedPdfTypes = ['application/pdf'];
        if (in_array($_FILES['mpss']['type'], $allowedImageTypes) || in_array($_FILES['mpss']['type'], $allowedPdfTypes)) {
            $fileName = $_FILES['mpss']['name'];
            $sourcePath = $_FILES['mpss']['tmp_name'];
            $targetPath = "../../../upload/perfil_medico/" . "MPSS-" . $nrodoc . '-'.$date. '.' . pathinfo($fileName, PATHINFO_EXTENSION);

            $b ="SELECT tip_docum FROM medico_documentos WHERE tip_docum = 'MPSS' AND id_med = $idmed ";
            $bres=$mysqli->query($b);
            $rowcount=mysqli_num_rows($bres);
                if($rowcount > 0){
                    echo '<script>
                        Swal.fire({
                            icon: "error",
                            title: "Error al Cargar",
                            text: "Usted ya tiene un Archivo tipo MPSS Cargado en el Sistema",
                            confirmButtonText: "Volver",
                            confirmButtonColor: "#007ebc",
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location.href = "../../../html/perfil";
                            }
                        });
                    </script>';
                }else{
                $nom_docum = "MPSS-" . $nrodoc . '-'.$date. '.' .  pathinfo($fileName, PATHINFO_EXTENSION);
                $c = "INSERT INTO medico_documentos(id_med, tip_docum, nom_docum, id_sta) VALUES('$idmed', 'MPSS', '$nom_docum', 1)";
                $cres = $mysqli->query($c);
                if($cres){
                    if (move_uploaded_file($sourcePath, $targetPath)) {
                        $validar = true;
                        register_log($mysqli, $idmed,'ACTUALIZO DATOS', 'PERFIL', 'USUARIO SUBIO UN ARCHIVO DE TIPO: MPSS');
                        echo '<script>
                            Swal.fire({
                                title: "Archivo Cargado Exitosamente!",
                                text: "Cargo Exitosamente el Archivo en el Sistema ",
                                icon: "success",
                                confirmButtonColor: "#007ebc",
                                confirmButtonText: "Aceptar"
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    window.location.href = "../../../html/perfil";
                                }
                            });
                        </script>';
                    }
                }else{
                    echo '<script>
                        Swal.fire({
                            icon: "error",
                            title: "Error al Cargar",
                            text: "Error al Cargar el Archivo",
                            confirmButtonText: "Volver",
                            confirmButtonColor: "#007ebc",
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location.href = "../../../html/perfil";
                            }
                        });
                    </script>';
                
                }
            }
        }
    }
    //--------- Carga de Archivo para la Firma --------//
    if (isset($_FILES['firma'])) {
        $allowedImageTypes = ['image/jpeg', 'image/png', 'image/jpg', 'image/webp']; 
        $allowedPdfTypes = ['application/pdf'];
        if (in_array($_FILES['firma']['type'], $allowedImageTypes) || in_array($_FILES['firma']['type'], $allowedPdfTypes)) {
            $fileName = $_FILES['firma']['name'];
            $sourcePath = $_FILES['firma']['tmp_name'];
            $targetPath = "../../../upload/perfil_medico/" . "FIRMA-" . $nrodoc . '-'.$date. '.' . pathinfo($fileName, PATHINFO_EXTENSION);

            $b ="SELECT tip_docum FROM medico_documentos WHERE tip_docum = 'FIRMA' AND id_med = $idmed ";
            $bres=$mysqli->query($b);
            $rowcount=mysqli_num_rows($bres);
                if($rowcount > 0){
                    echo '<script>
                        Swal.fire({
                            icon: "error",
                            title: "Error al Cargar",
                            text: "Usted ya tiene un Archivo tipo FIRMA Cargado en el Sistema",
                            confirmButtonText: "Volver",
                            confirmButtonColor: "#007ebc",
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location.href = "../../../html/perfil";
                            }
                        });
                    </script>';
                }else{
                $nom_docum = "FIRMA-" . $nrodoc . '-'.$date. '.' .  pathinfo($fileName, PATHINFO_EXTENSION);
                $c = "INSERT INTO medico_documentos(id_med, tip_docum, nom_docum, id_sta) VALUES('$idmed', 'FIRMA', '$nom_docum', 1)";
                $cres = $mysqli->query($c);
                if($cres){
                    if (move_uploaded_file($sourcePath, $targetPath)) {
                        $validar = true;
                        register_log($mysqli, $idmed,'ACTUALIZO DATOS', 'PERFIL', 'USUARIO SUBIO UN ARCHIVO DE TIPO: FIRMA');
                        echo '<script>
                            Swal.fire({
                                title: "Archivo Cargado Exitosamente!",
                                text: "Cargo Exitosamente el Archivo en el Sistema ",
                                icon: "success",
                                confirmButtonColor: "#007ebc",
                                confirmButtonText: "Aceptar"
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    window.location.href = "../../../html/perfil";
                                }
                            });
                        </script>';
                    }
                }else{
                    echo '<script>
                        Swal.fire({
                            icon: "error",
                            title: "Error al Cargar",
                            text: "Error al Cargar el Archivo",
                            confirmButtonText: "Volver",
                            confirmButtonColor: "#007ebc",
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location.href = "../../../html/perfil";
                            }
                        });
                    </script>';
                
                }
            }
        }
    }
    //--------- Carga de Archivo para la Firma --------//
    if (isset($_FILES['sello'])) {
        $allowedImageTypes = ['image/jpeg', 'image/png', 'image/jpg', 'image/webp']; 
        $allowedPdfTypes = ['application/pdf'];
        if (in_array($_FILES['sello']['type'], $allowedImageTypes) || in_array($_FILES['sello']['type'], $allowedPdfTypes)) {
            $fileName = $_FILES['sello']['name'];
            $sourcePath = $_FILES['sello']['tmp_name'];
            $targetPath = "../../../upload/perfil_medico/" . "SELLO-" . $nrodoc . '-'.$date. '.' . pathinfo($fileName, PATHINFO_EXTENSION);

            $b ="SELECT tip_docum FROM medico_documentos WHERE tip_docum = 'SELLO' AND id_med = $idmed ";
            $bres=$mysqli->query($b);
            $rowcount=mysqli_num_rows($bres);
                if($rowcount > 0){
                    echo '<script>
                        Swal.fire({
                            icon: "error",
                            title: "Error al Cargar",
                            text: "Usted ya tiene un Archivo tipo SELLO Cargado en el Sistema",
                            confirmButtonText: "Volver",
                            confirmButtonColor: "#007ebc",
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location.href = "../../../html/perfil";
                            }
                        });
                    </script>';
                }else{
                $nom_docum = "SELLO-" . $nrodoc . '-'.$date. '.' .  pathinfo($fileName, PATHINFO_EXTENSION);
                $c = "INSERT INTO medico_documentos(id_med, tip_docum, nom_docum, id_sta) VALUES('$idmed', 'SELLO', '$nom_docum', 1)";
                $cres = $mysqli->query($c);
                if($cres){
                    if (move_uploaded_file($sourcePath, $targetPath)) {
                        $validar = true;
                        register_log($mysqli, $idmed,'ACTUALIZO DATOS', 'PERFIL', 'USUARIO SUBIO UN ARCHIVO DE TIPO: SELLO');
                        echo '<script>
                            Swal.fire({
                                title: "Archivo Cargado Exitosamente!",
                                text: "Cargo Exitosamente el Archivo en el Sistema ",
                                icon: "success",
                                confirmButtonColor: "#007ebc",
                                confirmButtonText: "Aceptar"
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    window.location.href = "../../../html/perfil";
                                }
                            });
                        </script>';
                    }
                }else{
                    echo '<script>
                        Swal.fire({
                            icon: "error",
                            title: "Error al Cargar",
                            text: "Error al Cargar el Archivo",
                            confirmButtonText: "Volver",
                            confirmButtonColor: "#007ebc",
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location.href = "../../../html/perfil";
                            }
                        });
                    </script>';
                
                }
            }
        }
    }

}else{
   echo '<script>
        Swal.fire({
            icon: "error",
            title: "Error al Cargar",
            text: "Tiene que cargar por lo menos un Archivo",
            confirmButtonText: "Volver",
            confirmButtonColor: "#007ebc",
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = "../../../html/perfil";
            }
        });
    </script>';
}