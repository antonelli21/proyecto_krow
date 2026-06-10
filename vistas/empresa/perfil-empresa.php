<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();

// Configurar header incluible correctamente
$isIncluded = true;
$basePath = '/guardalo_aca/proyecto_krow';
$publicPath = $basePath . '/public';
$rol = 'empresa';
$pageTitle = 'Perfil Empresa - Krow';

// Modo desarrollo: mock empresa (sin base de datos)
$_SESSION['id_empresa'] = $_SESSION['id_empresa'] ?? 1;
$_SESSION['usuario_rol'] = 'empresa';

$empresa = [
    'nombre' => 'ACME S.A.',
    'rubro' => 'Software / Tecnología',
    'email' => 'contacto@acme.example',
    'telefono' => '+54 9 11 9876 5432',
    'direccion' => 'Av. Siempreviva 742',
    'localidad' => 'Ciudad Ficticia',
    'provincia' => 'Provincia Ejemplo',
    'sitio_web' => 'https://acme.example',
    'descripcion' => 'Empresa dedicada a soluciones de software y consultoría tecnológica.',
    'linkedin' => 'https://linkedin.com/company/acme',
    'facebook' => '',
];

$ofertas = [
    ['titulo' => 'Desarrollador Full Stack', 'modalidad' => 'Híbrido', 'salario' => 'AR$ 250.000'],
    ['titulo' => 'Analista QA', 'modalidad' => 'Remoto', 'salario' => 'AR$ 180.000']
];

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $pageTitle; ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="<?php echo $publicPath; ?>/css/styles.css">
</head>
<body>
    <?php include '../../includes/header.php'; ?>

    <div class="container mt-4">
        <div class="card perfil-header-card shadow-sm mb-4">
            <div class="card-body">
                <div class="row align-items-center gy-3">
                    <div class="col-auto">
                        <div class="perfil-avatar">
                            <?php echo strtoupper(substr($empresa['nombre'] ?? 'E', 0, 1)); ?>
                        </div>
                    </div>
                    <div class="col">
                        <h1 class="h4 mb-1"><?php echo htmlspecialchars($empresa['nombre']); ?></h1>
                        <p class="mb-1 text-muted"><?php echo htmlspecialchars($empresa['rubro']); ?></p>
                        <p class="mb-0 text-muted"><?php echo htmlspecialchars($empresa['direccion']); ?> — <?php echo htmlspecialchars($empresa['localidad']); ?></p>
                    </div>
                    <div class="col-auto">
                        <a href="../empresa/perfil-empresa-editar.php" class="btn btn-warning btn-sm">
                            <i class="fas fa-edit me-1"></i> Editar perfil
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="row g-4">
            <div class="col-12">
                <div class="card perfil-card shadow-sm">
                    <div class="card-header"><i class="fas fa-building me-2"></i> Datos de la Empresa</div>
                    <div class="card-body">
                        <dl class="row mb-0">
                            <dt class="col-sm-4 text-muted">Rubro</dt>
                            <dd class="col-sm-8 mb-2"><?php echo htmlspecialchars($empresa['rubro']); ?></dd>

                            <dt class="col-sm-4 text-muted">Descripción</dt>
                            <dd class="col-sm-8 mb-0"><?php echo htmlspecialchars($empresa['descripcion']); ?></dd>
                        </dl>
                    </div>
                </div>
            </div>

            <div class="col-12">
                <div class="card perfil-card shadow-sm">
                    <div class="card-header"><i class="fas fa-map-marker-alt me-2"></i> Ubicación</div>
                    <div class="card-body">
                        <dl class="row mb-0">
                            <dt class="col-sm-4 text-muted">Dirección</dt>
                            <dd class="col-sm-8 mb-2"><?php echo htmlspecialchars($empresa['direccion']); ?></dd>

                            <dt class="col-sm-4 text-muted">Localidad / Provincia</dt>
                            <dd class="col-sm-8 mb-0"><?php echo htmlspecialchars($empresa['localidad']); ?> — <?php echo htmlspecialchars($empresa['provincia']); ?></dd>
                        </dl>
                    </div>
                </div>
            </div>

            <div class="col-12">
                <div class="card perfil-card shadow-sm">
                    <div class="card-header"><i class="fas fa-briefcase me-2"></i> Ofertas publicadas</div>
                    <div class="card-body">
                        <?php if (!empty($ofertas)): ?>
                            <ul class="list-unstyled">
                                <?php foreach ($ofertas as $of): ?>
                                    <li class="mb-3">
                                        <strong><?php echo htmlspecialchars($of['titulo']); ?></strong>
                                        <div class="text-muted small"><?php echo htmlspecialchars($of['modalidad']); ?> · <?php echo htmlspecialchars($of['salario']); ?></div>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        <?php else: ?>
                            <div class="text-muted">No hay ofertas publicadas</div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <div class="col-12">
                <div class="card perfil-card shadow-sm">
                    <div class="card-header"><i class="fas fa-address-book me-2"></i> Contacto y Redes</div>
                    <div class="card-body">
                        <dl class="row mb-0">
                            <dt class="col-sm-4 text-muted">Correo</dt>
                            <dd class="col-sm-8 mb-2"><?php echo htmlspecialchars($empresa['email']); ?></dd>

                            <dt class="col-sm-4 text-muted">Teléfono</dt>
                            <dd class="col-sm-8 mb-2"><?php echo htmlspecialchars($empresa['telefono']); ?></dd>

                            <dt class="col-sm-4 text-muted">Sitio web</dt>
                            <dd class="col-sm-8 mb-2"><a href="<?php echo htmlspecialchars($empresa['sitio_web']); ?>" target="_blank"><?php echo htmlspecialchars($empresa['sitio_web']); ?></a></dd>

                            <dt class="col-sm-4 text-muted">Redes</dt>
                            <dd class="col-sm-8 mb-0">
                                <?php if (!empty($empresa['linkedin'])): ?>
                                    <a href="<?php echo htmlspecialchars($empresa['linkedin']); ?>" target="_blank" class="me-2"><i class="fab fa-linkedin fa-lg"></i></a>
                                <?php endif; ?>
                                <?php if (!empty($empresa['facebook'])): ?>
                                    <a href="<?php echo htmlspecialchars($empresa['facebook']); ?>" target="_blank" class="me-2"><i class="fab fa-facebook fa-lg"></i></a>
                                <?php endif; ?>
                            </dd>
                        </dl>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php include '../../includes/footer.php'; ?>
    <script src="../../public/js/main.js"></script>
</body>
</html>
