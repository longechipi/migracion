<?php $host = basename($_SERVER['PHP_SELF']); ?>
<ul class="menu-inner py-1">
    <li class="menu-header small text-uppercase">
        <span class="menu-header-text">Módulos</span>
    </li>
    <li class="menu-item 
        <?php if ($host === "index.php") { echo 'active'; } ?>">
            <a href="../html/inicio" class="menu-link">
                <i class="menu-icon tf-icons bx bx-clinic"></i>
                <div data-i18n="Analytics">INICIO</div>
            </a>
    </li>
    <!-- Verifico si ya pago y tiene estatus Activo, sino solo muestro opccion de actualizar perfil -->
    <?php if ($estatus== 4) { ?> 
        <!-- Perfil -->
        <li class="menu-item">
            <a href="javascript:void(0)" class="menu-link menu-toggle"> 
                <i class="menu-icon tf-icons bx bx-wrench"></i>
                <div id="menu-hono" data-i18n="User interface">PERFIL</div>
            </a>
            <ul class="menu-sub">
                <!-- Actualizar -->
                <li class="menu-item">
                    <a href="../html/perfil" id="sidebar-hono" class="menu-link empty">
                        <div data-i18n="Accordion">Datos Basicos</div>
                    </a>
                </li>
            </ul>
        </li>

        <li class="menu-item 
        <?php if ($host === "inicio") { echo 'active'; } ?>">
            <a href="../html/salir.php" class="menu-link">
                <i class="menu-icon tf-icons bx bx-clinic"></i>
                <div data-i18n="Analytics">SALIR</div>
            </a>
        </li>
    <?php } else{?> 
        <!-- PRIMER NIVEL -->
        <li class="menu-item 
        <?php
        if (($host === "rpt_pacxmed.php") || ($host === "perfil.php")|| ($host === "rpt_asixmed.php") || ($host === "rpt_horar.php")) {
            echo 'active' . ' ' . 'open';
        } ?>">
            <a href="javascript:void(0)" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-user"></i>
                <div id="menu-hono" data-i18n="User interface">PERFIL</div>
            </a>
            <ul class="menu-sub">
                <!-- Actualizar -->
                <li class="menu-item 
                <?php if ($host === "perfil.php") { echo 'active'; } ?>">
                    <a href="../html/perfil.php" id="sidebar-hono" class="menu-link empty">
                        <div data-i18n="Accordion">Datos Basicos</div>
                    </a>
                </li>
            </ul>
        </li>
        <!-- FIN PRIMER NIVEL -->

        <!-- SEGUNDO NIVEL -->
        <li class="menu-item 
        <?php
        if (($host === "pacientes") ||($host === "rpt_citas.php") ) {
            echo 'active' . ' ' . 'open';
        } ?>">
            <a href="javascript:void(0)" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-donate-heart"></i>
                <div id="menu-hono" data-i18n="User interface">GESTION</div>
            </a>
            <ul class="menu-sub">
            <!-- Pacientes -->
                <li class="menu-item 
                <?php if ($host === "pacientes") { echo 'active'; } ?>">
                    <a href="../html/pacientes" id="sidebar-hono" class="menu-link empty">
                        <div data-i18n="Accordion">Pacientes</div>
                    </a>
                </li>

                <!-- Proveedores -->
                <li class="menu-item">
                    <a href="pages/forms/rpt_prov.php" id="sidebar-hono" class="menu-link empty">
                        <div data-i18n="Accordion">Materiales / Insumos</div>
                    </a>
                </li>
                
                <!-- Asistente -->
                <li class="menu-item 
                <?php if ($host === "rpt_asixmed.php") { echo 'active'; } ?>">
                    <a href="../html/rpt_asixmed.php" id="sidebar-hono" class="menu-link empty">
                        <div data-i18n="Accordion">Asistente</div>
                    </a>
                </li>
            </ul>
        </li>
        <!-- FIN SEGUNDO NIVEL -->

        <!-- TERCER NIVEL -->
        <li class="menu-item 
        <?php
        if (($host === "rpt_citpac.php") ||($host === "rpt_citas.php") ) {
            echo 'active' . ' ' . 'open';
        } ?>">
            <a href="javascript:void(0)" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-calendar"></i>
                <div id="menu-hono" data-i18n="User interface">CITAS MEDICAS</div>
            </a>
            <ul class="menu-sub">
                <!-- Ver Citas -->
                <li class="menu-item 
                <?php if ($host === "rpt_citas.php") { echo 'active'; } ?>">
                    <a href="../html/rpt_citas.php" id="sidebar-hono" class="menu-link empty">
                        <div data-i18n="Accordion">Ver Citas</div>
                    </a>
                </li>
                <!-- Crear Citas -->
                <li class="menu-item 
                <?php if ($host === "rpt_citpac.php") { echo 'active'; } ?>">
                    <a href="../html/rpt_citpac.php" id="sidebar-hono" class="menu-link empty">
                        <div data-i18n="Accordion">Crear Citas</div>
                    </a>
                </li>
            </ul>
        </li>
        <!-- FIN TERCER NIVEL -->

        



        <!-- TERCER NIVEL -->
        <li class="menu-item 
            <?php
            if (($host === "prefilterpac.php")) {
                echo 'active' . ' ' . 'open';
            } ?>">
            <a href="javascript:void(0)" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-wrench"></i>
                <div id="menu-hono" data-i18n="User interface">HISTORIA MEDICA</div>
            </a>
            <ul class="menu-sub">
                <!-- Historia Medica -->
                <li class="menu-item 
                <?php if ($host === "prefilterpac.php") { echo 'active'; } ?>">
                    <a href="../html/prefilterpac.php" id="sidebar-hono" class="menu-link empty">
                        <div data-i18n="Accordion">VER</div>
                    </a>
                </li>
            </ul>
        </li>
        <!-- FIN TERCER NIVEL -->

        <!-- CUARTO NIVEL -->
        <li class="menu-item">
            <a href="javascript:void(0)" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-wrench"></i>
                <div id="menu-hono" data-i18n="User interface">PRESUPUESTO</div>
            </a>
            <ul class="menu-sub">
                <!-- Presupuesto -->
                <li class="menu-item">
                    <a href="pages/forms/rpt_presupuestos.php" id="sidebar-hono" class="menu-link empty">
                        <div data-i18n="Accordion">Ver</div>
                    </a>
                </li>
            </ul>
        </li>
        <!-- FIN CUARTO NIVEL -->

        <li class="menu-item 
        <?php if ($host === "index.php") { echo 'active'; } ?>">
            <a href="../html/salir.php" class="menu-link">
                <i class="menu-icon tf-icons bx bx-clinic"></i>
                <div data-i18n="Analytics">SALIR</div>
            </a>
        </li>
    <?php } ?>
</ul>