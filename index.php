<?php
/**
 * index.php
 * Landing page / Página de bienvenida
 * Redirige al Login si no hay sesión activa
 */

session_start();

// Si hay sesión activa, redirigir al home correspondiente
if (isset($_SESSION['usuario_id'])) {
    if ($_SESSION['usuario_tipo'] === 'empresa') {
        header('Location: vistas/empresa/home-empresa.php');
    } else {
        header('Location: vistas/estudiante/home-estudiante.php');
    }
    exit;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Krow - Plataforma de Empleo Comunitaria</title>
    <link rel="stylesheet" href="public/css/styles.css">
</head>
<body class="dark-mode">
    <?php include 'includes/header.php'; ?>
    
    <main class="landing">
        <div class="hero">
            <h1>Bienvenido a Krow</h1>
            <p>La plataforma de empleo basada en comunidad y reputación</p>
            
            <div class="cta-buttons">
                <a href="vistas/auth/login.php" class="btn btn-primary btn-lg">Iniciar Sesión</a>
                <div class="registro-opciones">
                    <a href="vistas/auth/registro-estudiante.php" class="btn btn-secondary">Registrate como Estudiante</a>
                    <a href="vistas/auth/registro-empresa.php" class="btn btn-secondary">Registrate como Empresa</a>
                </div>
            </div>
        </div>
        
        <div class="features">
            <div class="feature">
                <h3>Para Estudiantes</h3>
                <p>Busca ofertas de empleo, construye tu reputación y conecta con empresas</p>
            </div>
            <div class="feature">
                <h3>Para Empresas</h3>
                <p>Publica ofertas, encuentra talento y evalúa candidatos basado en reputación</p>
            </div>
            <div class="feature">
                <h3>Sistema de Reputación</h3>
                <p>Vota y contribuye a una comunidad transparente y confiable</p>
            </div>
        </div>
        
        <div class="info-section">
            <h2>¿Cómo funciona Krow?</h2>
            <ol>
                <li>Crea tu cuenta como estudiante o empresa</li>
                <li>Completa tu perfil con tu información</li>
                <li>Explora ofertas o publica nuevas posiciones</li>
                <li>Conecta con candidatos o empresas</li>
                <li>Contribuye a la comunidad con votos de reputación</li>
            </ol>
        </div>
    </main>
    
    <?php include 'includes/footer.php'; ?>
</body>
</html>
