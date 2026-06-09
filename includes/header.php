<?php
// Configurar rutas base (por si no están definidas)
if (!isset($basePath)) {
    $basePath = '/guardalo_aca/proyecto_krow';
}
if (!isset($publicPath)) {
  $publicPath = $basePath . '/public';
}

// Valor por defecto del rol (puede venir de index.php o de sesión)
$rol = $rol_usuario ?? 'invitado';

// Generar navItems según el rol
if ($rol === 'estudiante') {
    $navItems = [
        ['url' => $basePath . '/index.php', 'label' => 'Inicio', 'active' => false],
        ['url' => $basePath . '/vistas/estudiante/empresas-lista.php', 'label' => 'Empresas', 'active' => false],
        ['url' => $basePath . '/vistas/estudiante/postulaciones-lista.php', 'label' => 'Mis Postulaciones', 'active' => false],
        ['url' => $basePath . '/vistas/ayuda.php', 'label' => 'Ayuda', 'active' => false],
    ];
} elseif ($rol === 'invitado') {
    $navItems = [
        ['url' => $basePath . '/index.php', 'label' => 'Inicio', 'active' => false],
        ['url' => $basePath . '/vistas/auth/login.php', 'label' => 'Empresas', 'active' => false],
        ['url' => $basePath . '/vistas/auth/login.php', 'label' => 'Mis Postulaciones', 'active' => false],
        ['url' => $basePath . '/vistas/ayuda.php', 'label' => 'Ayuda', 'active' => false],
    ];
} elseif ($rol === 'empresa') {
    $navItems = [
        ['url' => $basePath . '/index.php', 'label' => 'Inicio', 'active' => false],
        ['url' => '#', 'label' => 'Panel Empresa', 'active' => false],
        ['url' => $basePath . '/vistas/ayuda.php', 'label' => 'Ayuda', 'active' => false],
    ];
} elseif ($rol === 'admin') {
    $navItems = [
        ['url' => $basePath . '/index.php', 'label' => 'Inicio', 'active' => false],
        ['url' => '#', 'label' => 'Administrar', 'active' => false],
        ['url' => $basePath . '/vistas/ayuda.php', 'label' => 'Ayuda', 'active' => false],
    ];
} else {
    $navItems = [
        ['url' => $basePath . '/index.php', 'label' => 'Inicio', 'active' => false],
        ['url' => $basePath . '/vistas/ayuda.php', 'label' => 'Ayuda', 'active' => false],
    ];
}

?>

<header class="krow-header" id="krow-header">
  <div class="header-inner">
    
    <a href="<?php echo $basePath; ?>/index.php" class="header-logo">
      <img src="<?php echo $publicPath; ?>/img/logo_claro.png" alt="KROW" class="logo-image logo-light">
      <img src="<?php echo $publicPath; ?>/img/logo_oscuro.png" alt="KROW" class="logo-image logo-dark">
      <div class="logo-brand">
        <span class="logo-text">KROW</span>
        <span class="brand-name">Banco de Trabajo</span>
      </div>
    </a>

    <nav class="header-nav" id="header-nav">
      <?php foreach ($navItems as $item): ?>
      <a href="<?php echo $item['url']; ?>" class="nav-link <?php echo $item['active'] ? 'active' : ''; ?>">
        <?php echo $item['label']; ?>
      </a>
      <?php endforeach; ?>
    </nav>

    <div class="header-actions">
      
      <button class="action-btn" id="theme-toggle" aria-label="Cambiar tema">
        <svg class="icon-sun" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
          <circle cx="12" cy="12" r="4"/>
          <path d="M12 2v2M12 20v2M4.93 4.93l1.41 1.41M17.66 17.66l1.41 1.41M2 12h2M20 12h2M4.93 19.07l1.41-1.41M17.66 6.34l1.41-1.41"/>
        </svg>
        <svg class="icon-moon" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" style="display:none">
          <path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z"/>
        </svg>
      </button>

      <?php if ($rol !== 'invitado'): ?>
        <div id="logged-in-actions" style="display:flex; align-items:center; gap:0.75rem;">
          <button class="action-btn notif-btn" aria-label="Notificaciones">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
              <path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"/>
              <path d="M13.73 21a2 2 0 0 1-3.46 0"/>
            </svg>
          </button>

          <div class="dropdown" id="account-dropdown">
            <button class="account-btn" id="account-toggle" aria-haspopup="true" aria-expanded="false">
              <div class="account-avatar" id="avatar-letter"><?php echo strtoupper(substr($rol, 0, 1)); ?></div>
              <span class="account-name" id="account-label">Mi Cuenta</span>
              <span class="role-badge <?php echo $rol; ?>" id="account-role-badge">
                <?php echo $rol === 'estudiante' ? 'Est.' : ($rol === 'empresa' ? 'Emp.' : 'Adm.'); ?>
              </span>
              <svg class="chevron" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <polyline points="6 9 12 15 18 9"/>
              </svg>
            </button>
            <div class="dropdown-menu" id="account-menu" role="menu">
              <a href="#" id="link-perfil" class="dropdown-item" role="menuitem">
                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor"><circle cx="12" cy="8" r="4"/><path d="M4 20c0-4 3.6-7 8-7s8 3 8 7"/></svg>
                Mi Perfil
              </a>
              <a href="<?php echo $basePath; ?>/vistas/configuracion.php" class="dropdown-item" role="menuitem">
                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor"><circle cx="12" cy="12" r="3"/><path d="M12 1v2M12 21v2M4.22 4.22l1.42 1.42M18.36 18.36l1.42 1.42M1 12h2M21 12h2M4.22 19.78l1.42-1.42M18.36 5.64l1.42-1.42"/></svg>
                Configuración
              </a>
              <hr class="dropdown-divider">
              <a href="<?php echo $basePath; ?>/src/logout.php" class="dropdown-item dropdown-item-danger" role="menuitem">
                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/><polyline points="16 17 21 12 16 7"/><line x1="21" y1="12" x2="9" y2="12"/></svg>
                Cerrar sesión
              </a>
            </div>
          </div>
        </div>
      <?php else: ?>
        <div id="guest-actions" style="display:flex; gap:0.5rem;">
          <a href="<?php echo $basePath; ?>/vistas/auth/login.php" class="btn-ghost-sm">Ingresar</a>
          <a href="<?php echo $basePath; ?>/vistas/auth/registro-estudiante.php" class="btn-primary-sm">Registro</a>
        </div>
      <?php endif; ?>

      <button class="hamburger" id="hamburger" aria-label="Menú" aria-expanded="false">
        <span></span>
        <span></span>
        <span></span>
      </button>

      </div>
    </div>
  </div>
</header>
