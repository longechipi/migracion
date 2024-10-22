<header>
    <script src="../../../libs/sweetalert/sweetalert.js"></script>
</header>
<?php 
require('../../../conf/conex.php');
require('../../../controller/log.php');
$idmed = $_POST['idmed'];
$a = "SELECT cedula FROM medicos WHERE id_user='$idmed'";
$ares=$mysqli->query($a);
$datos = $ares->fetch_assoc();
$nrodoc = $datos['cedula'];

$date = date('Y-m-d');

//--------- Carga de Archivo para la Firma --------//
if (isset($_FILES['imagen'])) {
    $allowedImageTypes = ['image/jpeg', 'image/png', 'image/jpg', 'image/webp']; 
    $allowedPdfTypes = ['application/pdf'];
    if (in_array($_FILES['imagen']['type'], $allowedImageTypes) || in_array($_FILES['imagen']['type'], $allowedPdfTypes)) {
        $fileName = $_FILES['imagen']['name'];
        $sourcePath = $_FILES['imagen']['tmp_name'];
        $targetPath = "../../../upload/perfil_medico/" . "FIRMA-" . $nrodoc . '-'.$date. '.' . pathinfo($fileName, PATHINFO_EXTENSION);

        if (move_uploaded_file($sourcePath, $targetPath)) {
            $nom_docum = "FIRMA-" . $nrodoc . '-'.$date. '.' .  pathinfo($fileName, PATHINFO_EXTENSION);
            $validar = true;
        }
        $c = "INSERT INTO medico_documentos(id_med, tip_docum, nom_docum, id_sta) VALUES('$idmed', 'FIRMA', '$nom_docum', 1)";
        $cres = $mysqli->query($c);
        echo "PASO";
    } else {
        $validar = false;
    }
}

// //--------- Carga de Archivo para el Sello --------//
// if (isset($_FILES['imagen1'])) {
//     $allowedImageTypes = ['image/jpeg', 'image/png', 'image/jpg', 'image/webp']; 
//     $allowedPdfTypes = ['application/pdf'];
//     if (in_array($_FILES['imagen1']['type'], $allowedImageTypes) || in_array($_FILES['imagen1']['type'], $allowedPdfTypes)) {
//         $fileName = $_FILES['imagen1']['name'];
//         $sourcePath = $_FILES['imagen1']['tmp_name'];
//         $targetPath = "../../../upload/perfil_medico/" . "Sello-" . $nrodoc . '-'.$date. '.' . pathinfo($fileName, PATHINFO_EXTENSION);

//         if (move_uploaded_file($sourcePath, $targetPath)) {
//             $imagen = "Sello-" . $nrodoc . '-'.$date. '.' .  pathinfo($fileName, PATHINFO_EXTENSION);
//             $validar = true;
//         }
//         $d = "INSERT INTO drdocument(idmed, imagen, quees) VALUES('$idmed', '$imagen','sello');";
//         $dres = $mysqli->query($d);
        
//     } else {
//         $validar = false;
//     }
// }
// if($validar == true){
//     echo '<script>
//     Swal.fire({
//         title: "Informacion Actualizada!",
//         text: "Documentos e Información actualizados con Exito",
//         icon: "success",
//         confirmButtonColor: "#007ebc",
//         confirmButtonText: "Aceptar"
//     }).then((result) => {
//         if (result.isConfirmed) {
//             window.location.href = "../../../html/rpt_med.php";
//         }
//     });
// </script>';
// } else {
// echo '<script>
//         Swal.fire({
//             title: "Error",
//             text: "ocurrio un Error al Cargar los Documentos",
//             icon: "error",
//             confirmButtonColor: "#007ebc",
//             confirmButtonText: "Aceptar"
//         }).then((result) => {
//             if (result.isConfirmed) {
//                 window.location.href = "../../../html/rpt_med.php";
//             }
//         });
//     </script>';
// }
?>

            