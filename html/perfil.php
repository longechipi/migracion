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
                                <h5 class="card-title text-primary mb-3">Perfil de Usuario</h5>
                                <div class="row">
                                    <div class="col-xl-12">
                                        <?php
                                            switch ($privilegios) {
                                                case 6: // Medico
                                                    include('../html/view/perfil/medico.php');
                                                    include('../layouts/modals/add-horarios.php');
                                                    include ('../layouts/modals/datos_bancarios.php');
                                                    include ('../layouts/modals/upt_cuenta_bank.php');
                                                    break;
                                                case 1: // Admin
                                                    include('../html/view/perfil/admin.php');
                                                    break;
                                                case 7: // Asistente
                                                    include('../html/view/perfil/asistente.php');
                                                    break;
                                                default:
                                                    echo "Privilegio no válido";
                                            }
                                        ?>
                                    </div>
                                </div>



</div>
</div>
</div>
</div>
</div>
</div>
</div>
<?php include('../layouts/footer.php') ?>
<div class="content-backdrop fade"></div>
</div>
</div>
</div>
<!-- Overlay -->
<div class="layout-overlay layout-menu-toggle"></div>
</div>

<?php include('../layouts/script.php') ?>
<script>
$('#user').DataTable({
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
	$('#user2').DataTable({
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
$('#user3').DataTable({
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
</script>
<script src="../js/direcciones.js"></script>
<script src="../js/fun_globales.js"></script>
</body>

</html>