<header>
    <script src="../../../libs/sweetalert/sweetalert.js"></script>
</header>

<?php 
require('../../../conf/conex.php');
require('../../../controller/log.php');

$idmed = $_POST['idmed_docu'];
$codcolemed = $_POST['codcolemed'];
$mpsscod = $_POST['mpsscod'];
//$idlogin = $_POST['idlogin'];

$a = "SELECT cedula FROM medicos WHERE id_user='$idmed'";
$ares=$mysqli->query($a);
$datos = $ares->fetch_assoc();
$nrodoc = $datos['cedula'];
$date = date('Y-m-d');

$b ="UPDATE medicos SET cod_col_med='$codcolemed', mpss='$mpsscod' WHERE id_user='$idmed'";
$bres=$mysqli->query($b); 
register_log($mysqli, $idmed,'ACTUALIZO DATOS', 'PERFIL', 'USUARIO ACTUALIZO DATOS DE COLEGIO MEDICO: '.$codcolemed.' y MPSS '.$mpsscod.'');

//--------- Carga de Archivo para la Cedula --------//
if (isset($_FILES['imagen'])) {
    $allowedImageTypes = ['image/jpeg', 'image/png', 'image/jpg', 'image/webp']; 
    $allowedPdfTypes = ['application/pdf'];
    if (in_array($_FILES['imagen']['type'], $allowedImageTypes) || in_array($_FILES['imagen']['type'], $allowedPdfTypes)) {
        $fileName = $_FILES['imagen']['name'];
        $sourcePath = $_FILES['imagen']['tmp_name'];
        $targetPath = "../../../upload/perfil_medico/" . "CI-" . $nrodoc . '-'.$date. '.' . pathinfo($fileName, PATHINFO_EXTENSION);

        if (move_uploaded_file($sourcePath, $targetPath)) {
            $nom_docum = "CI-" . $nrodoc . '-'.$date. '.' .  pathinfo($fileName, PATHINFO_EXTENSION);
            $validar = true;
        }
        $c = "INSERT INTO medico_documentos(id_med, tip_docum, nom_docum, id_sta) VALUES('$idmed', 'CEDULA', '$nom_docum', 1)";
        $cres = $mysqli->query($c);
        register_log($mysqli, $idmed,'ACTUALIZO DATOS', 'PERFIL', 'USUARIO SUBIO UN ARCHIVO DE TIPO: CEDULA');
    } else {
        $validar = false;
    }
}

//--------- Carga de Archivo para el Rif --------//
if (isset($_FILES['imagen1'])) {
    $allowedImageTypes = ['image/jpeg', 'image/png', 'image/jpg', 'image/webp']; 
    $allowedPdfTypes = ['application/pdf'];
    if (in_array($_FILES['imagen1']['type'], $allowedImageTypes) || in_array($_FILES['imagen1']['type'], $allowedPdfTypes)) {
        $fileName = $_FILES['imagen1']['name'];
        $sourcePath = $_FILES['imagen1']['tmp_name'];
        $targetPath = "../../../upload/perfil_medico/" . "RIF-" . $nrodoc . '-'.$date. '.' . pathinfo($fileName, PATHINFO_EXTENSION);

        if (move_uploaded_file($sourcePath, $targetPath)) {
            $nom_docum = "RIF-" . $nrodoc . '-'.$date. '.' .  pathinfo($fileName, PATHINFO_EXTENSION);
            $validar = true;
        }
        $d = "INSERT INTO medico_documentos(id_med, tip_docum, nom_docum, id_sta) VALUES('$idmed', 'RIF', '$nom_docum', 1)";
        $dres = $mysqli->query($d);
        register_log($mysqli, $idmed,'ACTUALIZO DATOS', 'PERFIL', 'USUARIO SUBIO UN ARCHIVO DE TIPO: RIF');
    } else {
        $validar = false;
    }
}

//--------- Carga de Archivo para Colegio Medico--------//
if (isset($_FILES['imagen2'])) {
    $allowedImageTypes = ['image/jpeg', 'image/png', 'image/jpg', 'image/webp']; 
    $allowedPdfTypes = ['application/pdf'];
    if (in_array($_FILES['imagen2']['type'], $allowedImageTypes) || in_array($_FILES['imagen2']['type'], $allowedPdfTypes)) {
        $fileName = $_FILES['imagen2']['name'];
        $sourcePath = $_FILES['imagen2']['tmp_name'];
        $targetPath = "../../../upload/perfil_medico/" . "CM-" . $nrodoc . '-'.$date. '.' . pathinfo($fileName, PATHINFO_EXTENSION);

        if (move_uploaded_file($sourcePath, $targetPath)) {
            $nom_docum = "CM-" . $nrodoc . '-'.$date. '.' .  pathinfo($fileName, PATHINFO_EXTENSION);
            $validar = true;
        }
        $e = "INSERT INTO medico_documentos(id_med, tip_docum, nom_docum, id_sta) VALUES('$idmed', 'CM', '$nom_docum', 1)";
        $eres = $mysqli->query($e);
        register_log($mysqli, $idmed,'ACTUALIZO DATOS', 'PERFIL', 'USUARIO SUBIO UN ARCHIVO DE TIPO: COLEGIO MEDICO');
    } else {
        $validar = false;
    }
}

//--------- Carga de Archivo para el MPSS--------//
if (isset($_FILES['imagen3'])) {
    $allowedImageTypes = ['image/jpeg', 'image/png', 'image/jpg', 'image/webp']; 
    $allowedPdfTypes = ['application/pdf'];
    if (in_array($_FILES['imagen3']['type'], $allowedImageTypes) || in_array($_FILES['imagen3']['type'], $allowedPdfTypes)) {
        $fileName = $_FILES['imagen3']['name'];
        $sourcePath = $_FILES['imagen3']['tmp_name'];
        $targetPath = "../../../upload/perfil_medico/" . "MPSS-" . $nrodoc . '-'.$date. '.' . pathinfo($fileName, PATHINFO_EXTENSION);

        if (move_uploaded_file($sourcePath, $targetPath)) {
            $nom_docum = "MPSS-" . $nrodoc . '-'.$date. '.' .  pathinfo($fileName, PATHINFO_EXTENSION);
            $validar = true;
        }
        $f = "INSERT INTO medico_documentos(id_med, tip_docum, nom_docum, id_sta) VALUES('$idmed', 'MPSS', '$nom_docum', 1)";
        $fres = $mysqli->query($f);
        register_log($mysqli, $idmed,'ACTUALIZO DATOS', 'PERFIL', 'USUARIO SUBIO UN ARCHIVO DE TIPO: MPSS');
    } else {
        $validar = false;
    }
}

echo '<script>
        Swal.fire({
            title: "Informacion Actualizada!",
            text: "Documentos e Información actualizados con Exito",
            icon: "success",
            confirmButtonColor: "#007ebc",
            confirmButtonText: "Aceptar"
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = "../../../html/perfil";
            }
        });
    </script>';

