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
                            switch ($privilegios) {
                                case 1: // Administrador
                                    include('../html/view/inicio/admin.php');
                                    break;
                                case 6: // Medico
                                    if($estatus == 4){
                                        include('../html/view/inicio/pago.php');
                                    }else{
                                        include('../html/view/inicio/medicos.php');
                                    }
                                    break;
                                case 7: // Asistente
                                    include('../html/view/inicio/asistentes.php');
                                    break;
                                default:
                                    echo "Privilegio no válido";
                            }
                        ?>
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
$(document).ready(function() {
    let data = [];
    for (let i = 1; i <= 20; i++) {
        data.push([`Tarea ${i}`, `2024-11-${i+19}`, `Descripción de la tarea ${i}`, `Alta ${i}`]);
    }

    $('#myTable').DataTable({
        data: data,
        columns: [
            { title: "Actividad" },
            { title: "Fecha" },
            { title: "Descripción" },
            { title: "Prioridad" }
        ],
        "language": {
            "sProcessing": "Procesando...",
            "sLengthMenu": "Mostrar _MENU_ registros",
            "sZeroRecords": "No se encontraron resultados",
            "sEmptyTable": "Ningún dato disponible en esta tabla",
            "sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
            "sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
            "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
            "sInfoPostFix": "",
            "sSearch": "Buscar:",
            "sUrl": "",
            "sInfoThousands": ",",
            "sLoadingRecords": "Cargando...",
            "oPaginate": {
                "sFirst": "Primero",
                "sLast": "Último",
                "sNext": "Siguiente",
                "sPrevious": "Anterior"
            },
            "oAria": {
                "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
                "sSortDescending": ": Activar para ordenar la columna de manera descendente"
            }
        },
    });
});
</script>
</body>
</html>