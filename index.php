
<?php
// Supongamos que acá arriba iniciás sesión y obtenés el rol del usuario desde la base de datos
// $rol_usuario puede ser: 'invitado', 'estudiante', 'empresa' o 'admin'
$rol_usuario = $_SESSION['user_role'] ?? 'invitado';

// Rutas base del proyecto — una sola fuente de verdad para todos los partials
$basePath   = '/guardalo_aca/proyecto_krow';
$publicPath = $basePath . '/public';

// Variables que usan header.php y footer.php
$rol        = $rol_usuario;
$isIncluded = true;
?>
<!DOCTYPE html>
<html lang="es" data-theme="dark" data-role="<?php echo $rol_usuario; ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KROW — Portal de Empleos</title>
    <link rel="stylesheet" href="<?php echo $publicPath; ?>/css/styles.css">
</head>
<body>

    <?php include './includes/header.php'; ?>

    <div class="page-body">
        
        <aside class="sidebar-filtros">
            <?php include './includes/sidebar-filtros.php'; ?>
        </aside>

        <main class="main-content">
            <div class="content-head">
                <div>
                    <h2 class="content-title">Ofertas de Empleo</h2>
                    <p class="result-count">Se encontraron 124 resultados</p>
                </div>
                <select class="sort-select">
                    <option>Más recientes</option>
                    <option>Menor salario</option>
                    <option>Mayor salario</option>
                </select>
            </div>

            <article class="job-card">
                <div class="job-card-top">
                    <div class="company-logo">MC</div>
                    <div class="job-info">
                        <h3 class="job-title">Fullstack Developer Node/React</h3>
                        <p class="job-meta"><span>MegaCorp</span> • <span>Remoto</span></p>
                    </div>
                    <div class="job-actions">
                        <button class="btn-bookmark"><i class="bi bi-bookmark"></i></button>
                    </div>
                </div>
                <div class="job-badges">
                    <span class="badge badge-salary">$450.000 / mes</span>
                    <span class="badge badge-outline">Full-time</span>
                    <span class="badge badge-new">Nuevo</span>
                </div>
                <p class="job-desc">
                    Buscamos un desarrollador proactivo orientado a resultados para sumarse al equipo de core-banking...
                </p>
                <div class="job-footer">
                    <span class="job-date">Publicado hace 2 días</span>
                    <button class="btn-ver">Ver oferta</button>
                </div>
            </article>

            <div class="pagination">
                <button class="pg-btn active">1</button>
                <button class="pg-btn">2</button>
                <button class="pg-btn">3</button>
            </div>
        </main>

        <aside id="right-panel" class="right-panel">
            </aside>

    </div> <div class="site-footer-wrap">
        <?php include './includes/footer.php'; ?>
    </div>

    <div class="role-switcher">
        <p class="role-switcher-title">Modo de Vista (Demo)</p>
        <button class="role-btn" data-role="invitado">Invitado</button>
        <button class="role-btn" data-role="estudiante">Estudiante</button>
        <button class="role-btn" data-role="empresa">Empresa</button>
        <button class="role-btn" data-role="admin">Admin</button>
    </div>

    <script src="<?php echo $publicPath; ?>/js/main.js"></script>
</body>
</html>