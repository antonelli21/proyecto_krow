
 
document.addEventListener('DOMContentLoaded', () => {
 
  /* ════════════════════════════════════════
     1. TEMA CLARO / OSCURO
     Persiste en localStorage.
     Aplica data-theme="dark" al <html>.
  ════════════════════════════════════════ */
  const root      = document.documentElement;
  const themeBtn  = document.getElementById('theme-toggle');
  const iconSun   = themeBtn?.querySelector('.icon-sun');
  const iconMoon  = themeBtn?.querySelector('.icon-moon');
 
  // Aplicar tema guardado o dark por defecto
  const savedTheme = localStorage.getItem('krow-theme') || 'dark';
  applyTheme(savedTheme);
 
  themeBtn?.addEventListener('click', () => {
    const next = root.getAttribute('data-theme') === 'dark' ? 'light' : 'dark';
    applyTheme(next);
    localStorage.setItem('krow-theme', next);
  });
 
  function applyTheme(theme) {
    root.setAttribute('data-theme', theme);
    if (iconSun && iconMoon) {
      iconSun.style.display  = theme === 'dark'  ? 'block' : 'none';
      iconMoon.style.display = theme === 'light' ? 'block' : 'none';
    }
  }
 
 
  /* ════════════════════════════════════════
     2. DROPDOWN MI CUENTA
     Abre/cierra con click.
     Cierra con click fuera o tecla Escape.
     Navegación con flechas del teclado.
  ════════════════════════════════════════ */
  const accountToggle = document.getElementById('account-toggle');
  const accountMenu   = document.getElementById('account-menu');
 
  accountToggle?.addEventListener('click', (e) => {
    e.stopPropagation();
    const isOpen = accountMenu.classList.toggle('open');
    accountToggle.setAttribute('aria-expanded', isOpen);
  });
 
  document.addEventListener('click', (e) => {
    if (!accountToggle?.contains(e.target) && !accountMenu?.contains(e.target)) {
      accountMenu?.classList.remove('open');
      accountToggle?.setAttribute('aria-expanded', 'false');
    }
  });
 
  document.addEventListener('keydown', (e) => {
    if (e.key === 'Escape') {
      accountMenu?.classList.remove('open');
      accountToggle?.setAttribute('aria-expanded', 'false');
      accountToggle?.focus();
    }
  });
 
  accountMenu?.addEventListener('keydown', (e) => {
    const items = [...accountMenu.querySelectorAll('.dropdown-item')];
    const idx   = items.indexOf(document.activeElement);
    if (e.key === 'ArrowDown') { e.preventDefault(); items[idx + 1]?.focus(); }
    if (e.key === 'ArrowUp')   { e.preventDefault(); items[idx - 1]?.focus(); }
  });
 
 
  /* ════════════════════════════════════════
     3. MENÚ HAMBURGUESA (mobile)
     Abre/cierra el nav en pantallas chicas.
     Se cierra al tocar un link.
  ════════════════════════════════════════ */
  const hamburger = document.getElementById('hamburger');
  const headerNav = document.getElementById('header-nav');
 
  hamburger?.addEventListener('click', () => {
    const isOpen = headerNav.classList.toggle('open');
    hamburger.classList.toggle('open', isOpen);
    hamburger.setAttribute('aria-expanded', isOpen);
  });
 
  headerNav?.querySelectorAll('.nav-link').forEach(link => {
    link.addEventListener('click', () => {
      headerNav.classList.remove('open');
      hamburger?.classList.remove('open');
      hamburger?.setAttribute('aria-expanded', 'false');
    });
  });
 
 
  /* ════════════════════════════════════════
     4. LINK ACTIVO EN NAV
     Marca el link que coincide con la URL actual.
  ════════════════════════════════════════ */
  const currentPath = window.location.pathname;
  document.querySelectorAll('.nav-link').forEach(link => {
    if (link.getAttribute('href') === currentPath) {
      link.classList.add('active');
    }
  });
 
 
  /* ════════════════════════════════════════
     5. VALIDACIÓN DE FORMULARIOS
     Muestra error si un campo requerido está vacío.
     Agrega clase .input-error al input.
  ════════════════════════════════════════ */
  document.querySelectorAll('form[data-validate]').forEach(form => {
    form.addEventListener('submit', (e) => {
      let valid = true;
 
      form.querySelectorAll('[required]').forEach(field => {
        field.classList.remove('input-error');
        if (!field.value.trim()) {
          field.classList.add('input-error');
          valid = false;
        }
      });
 
      if (!valid) {
        e.preventDefault();
        form.querySelector('.input-error')?.focus();
      }
    });
  });
 
 
  /* ════════════════════════════════════════
     6. FILTROS — checkboxes con estilo
     Agrega/quita clase .active en los checks custom.
  ════════════════════════════════════════ */
  document.querySelectorAll('.filter-option').forEach(option => {
    option.addEventListener('click', () => {
      option.querySelector('.fcheck')?.classList.toggle('active');
    });
  });
 
 
  /* ════════════════════════════════════════
     7. SORT BAR — botones de ordenamiento
     Solo uno activo a la vez.
  ════════════════════════════════════════ */
  document.querySelectorAll('.sort-bar').forEach(bar => {
    bar.querySelectorAll('.sort-btn').forEach(btn => {
      btn.addEventListener('click', () => {
        bar.querySelectorAll('.sort-btn').forEach(b => b.classList.remove('active'));
        btn.classList.add('active');
      });
    });
  });
 
 
  /* ════════════════════════════════════════
     8. PAGINACIÓN
     Solo un botón activo a la vez.
  ════════════════════════════════════════ */
  document.querySelectorAll('.pagination').forEach(pgn => {
    pgn.querySelectorAll('.pg-btn').forEach(btn => {
      btn.addEventListener('click', () => {
        pgn.querySelectorAll('.pg-btn').forEach(b => b.classList.remove('active'));
        btn.classList.add('active');
      });
    });
  });
 
});
 

/* ════════════════════════════════════════
   9. FILTROS SIDEBAR - Accordions dinámicos
   Maneja apertura/cierre de acordeones
════════════════════════════════════════ */

function initFiltersSidebar() {
  // Accordions toggle
  const accordions = document.querySelectorAll('.filter-accordion');
  
  accordions.forEach(accordion => {
    const header = accordion.querySelector('.accordion-header');
    
    if (header && !accordion.hasAttribute('data-initialized')) {
      accordion.setAttribute('data-initialized', 'true');
      
      header.addEventListener('click', () => {
        accordion.classList.toggle('open');
      });
    }
  });
  
  // Provincia y Localidad (cascada)
  const provinciaSelect = document.getElementById('provincia');
  const localidadSelect = document.getElementById('localidad');
  
  if (provinciaSelect && localidadSelect) {
    // Datos de ejemplo - puedes expandir con más provincias/localidades
    const localidadesPorProvincia = {
      'Buenos Aires': ['La Plata', 'Mar del Plata', 'Bahía Blanca', 'Tandil', 'San Nicolás'],
      'CABA': ['Palermo', 'Recoleta', 'Belgrano', 'Nuñez', 'Caballito'],
      'Córdoba': ['Córdoba Capital', 'Villa Carlos Paz', 'Río Cuarto', 'San Francisco'],
      'Santa Fe': ['Rosario', 'Santa Fe Capital', 'Rafaela', 'Venado Tuerto'],
      'Mendoza': ['Mendoza Capital', 'San Rafael', 'Godoy Cruz', 'Luján de Cuyo'],
      'default': ['Seleccioná una provincia primero']
    };
    
    provinciaSelect.addEventListener('change', (e) => {
      const provincia = e.target.value;
      const localidades = localidadesPorProvincia[provincia] || localidadesPorProvincia['default'];
      
      // Limpiar y habilitar select de localidad
      localidadSelect.innerHTML = '<option value="" disabled selected>Seleccioná una localidad</option>';
      localidades.forEach(localidad => {
        const option = document.createElement('option');
        option.value = localidad.toLowerCase().replace(/\s+/g, '-');
        option.textContent = localidad;
        localidadSelect.appendChild(option);
      });
      
      localidadSelect.disabled = false;
    });
  }
  
  // Tags de tecnologías
  const inputTech = document.getElementById('tecnologia-input');
  const btnAdd = document.getElementById('btn-add-tag');
  const containerTags = document.getElementById('tags-container');
  
  if (inputTech && btnAdd && containerTags) {
    let tagsList = [];
    
    function createTag(text) {
      const cleanedText = text.trim();
      
      if (cleanedText === '') return;
      if (tagsList.includes(cleanedText.toLowerCase())) {
        inputTech.value = '';
        return;
      }
      
      tagsList.push(cleanedText.toLowerCase());
      
      const tagDiv = document.createElement('div');
      tagDiv.classList.add('tech-tag');
      
      tagDiv.innerHTML = `
        <span>${escapeHtml(cleanedText)}</span>
        <input type="hidden" name="tecnologias[]" value="${escapeHtml(cleanedText.toLowerCase())}">
        <button type="button" class="btn-remove-tag">&times;</button>
      `;
      
      tagDiv.querySelector('.btn-remove-tag').addEventListener('click', () => {
        tagsList = tagsList.filter(t => t !== cleanedText.toLowerCase());
        tagDiv.remove();
      });
      
      containerTags.appendChild(tagDiv);
      inputTech.value = '';
    }
    
    // Función auxiliar para escapar HTML
    function escapeHtml(str) {
      const div = document.createElement('div');
      div.textContent = str;
      return div.innerHTML;
    }
    
    btnAdd.addEventListener('click', () => {
      createTag(inputTech.value);
    });
    
    inputTech.addEventListener('keydown', (e) => {
      if (e.key === 'Enter') {
        e.preventDefault();
        createTag(inputTech.value);
      }
    });
  }
}

// Inicializar filtros cuando el DOM esté listo
if (document.readyState === 'loading') {
  document.addEventListener('DOMContentLoaded', initFiltersSidebar);
} else {
  initFiltersSidebar();
}

/* ════════════════════════════════════════
   10. ANIMACIONES SMOOTH PARA FILTROS
   Efecto de fade al hacer scroll
════════════════════════════════════════ */

function animateFilterGroups() {
  const filterGroups = document.querySelectorAll('.filter-group, .filter-accordion');
  
  const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        entry.target.style.opacity = '0';
        entry.target.style.transform = 'translateY(20px)';
        entry.target.style.transition = 'opacity 0.4s ease, transform 0.4s ease';
        
        setTimeout(() => {
          entry.target.style.opacity = '1';
          entry.target.style.transform = 'translateY(0)';
        }, 50);
        
        observer.unobserve(entry.target);
      }
    });
  }, { threshold: 0.1, rootMargin: '50px' });
  
  filterGroups.forEach(group => {
    group.style.opacity = '0';
    observer.observe(group);
  });
}

// Ejecutar animación después de cargar
if (document.readyState === 'loading') {
  document.addEventListener('DOMContentLoaded', animateFilterGroups);
} else {
  animateFilterGroups();
}
/* ════════════════════════════════════════
   11. SISTEMA DE ROLES — KROW
   Gestiona nav, panel derecho y acciones
   de header según el rol del usuario.
════════════════════════════════════════ */
 
const KROW_ROLES = {
  invitado: {
    nav: [
      { label: 'Inicio',           url: '/proyecto_krow/index.php',              active: true  },
      { label: 'Empresas',         url: '/proyecto_krow/vistas/auth/login.php',  active: false },
      { label: 'Mis Postulaciones',url: '/proyecto_krow/vistas/auth/login.php',  active: false },
      { label: 'Ayuda',            url: '/proyecto_krow/vistas/ayuda.php',        active: false },
    ],
    rightPanel: () => `
      <div class="panel-card cta-card">
        <p class="panel-card-title">Encontrá tu primer trabajo</p>
        <p>Registrate gratis y accedé a cientos de ofertas para estudiantes UTN.</p>
        <a href="/proyecto_krow/vistas/auth/registro-estudiante.php" class="btn-primary-sm">Crear cuenta</a>
        <a href="/proyecto_krow/vistas/auth/login.php" class="btn-ghost-sm" style="display:block;text-align:center;margin-top:6px">Ya tengo cuenta</a>
      </div>
      <div class="panel-card featured-card">
        <div class="featured-badge"><i class="bi bi-star-fill"></i> Destacado</div>
        <p class="featured-title">Senior Backend Engineer</p>
        <p class="featured-company">MegaCorp Technologies</p>
        <button class="btn-quick-apply" onclick="location.href='/proyecto_krow/vistas/auth/login.php'">Postularme rápido</button>
      </div>
    `,
  },
  estudiante: {
    nav: [
      { label: 'Inicio',           url: '/proyecto_krow/index.php',                                  active: true  },
      { label: 'Empresas',         url: '/proyecto_krow/vistas/estudiante/empresas-lista.php',        active: false },
      { label: 'Mis Postulaciones',url: '/proyecto_krow/vistas/estudiante/postulaciones-lista.php',   active: false },
      { label: 'Ayuda',            url: '/proyecto_krow/vistas/ayuda.php',                            active: false },
    ],
    rightPanel: () => `
      <div class="panel-card">
        <p class="panel-card-title">Mis Estadísticas</p>
        <div class="stat-row"><span class="stat-label">Postulaciones enviadas</span><span class="stat-value">24</span></div>
        <div class="stat-row"><span class="stat-label">Empresas que te aceptaron</span><span class="stat-value">8</span></div>
        <div class="stat-row"><span class="stat-label">En revisión</span><span class="stat-value">12</span></div>
      </div>
      <div class="panel-card featured-card">
        <div class="featured-badge"><i class="bi bi-star-fill"></i> Destacado</div>
        <p class="featured-title">Senior Backend Engineer</p>
        <p class="featured-company">MegaCorp Technologies</p>
        <button class="btn-quick-apply">Postularme rápido</button>
      </div>
      <div class="panel-card">
        <p class="panel-card-title">Últimas empresas vistas</p>
        <div class="companies-grid">
          <div class="company-thumb"><span>TC</span></div>
          <div class="company-thumb"><span>DS</span></div>
          <div class="company-thumb"><span>MC</span></div>
          <div class="company-thumb"><span>DC</span></div>
        </div>
      </div>
    `,
  },
  empresa: {
    nav: [
      { label: 'Inicio',       url: '/proyecto_krow/index.php',  active: true  },
      { label: 'Panel Empresa',url: '#',                         active: false },
      { label: 'Mis Ofertas',  url: '#',                         active: false },
      { label: 'Ayuda',        url: '/proyecto_krow/vistas/ayuda.php', active: false },
    ],
    rightPanel: () => `
      <div class="panel-card">
        <p class="panel-card-title">Panel Empresa</p>
        <div class="stat-row"><span class="stat-label">Ofertas activas</span><span class="stat-value" style="color:#2ECC9A">7</span></div>
        <div class="stat-row"><span class="stat-label">Postulantes recibidos</span><span class="stat-value" style="color:#2ECC9A">143</span></div>
        <div class="stat-row"><span class="stat-label">Entrevistas pautadas</span><span class="stat-value" style="color:#2ECC9A">12</span></div>
        <button class="btn-new-offer">+ Nueva Oferta</button>
      </div>
      <div class="panel-card">
        <p class="panel-card-title">Postulantes destacados</p>
        <div class="companies-grid">
          <div class="company-thumb"><span>MA</span></div>
          <div class="company-thumb"><span>LG</span></div>
          <div class="company-thumb"><span>RD</span></div>
          <div class="company-thumb"><span>SV</span></div>
        </div>
      </div>
    `,
  },
  admin: {
    nav: [
      { label: 'Inicio',      url: '/proyecto_krow/index.php',          active: true  },
      { label: 'Administrar', url: '#',                                  active: false },
      { label: 'Usuarios',    url: '#',                                  active: false },
      { label: 'Reportes',    url: '#',                                  active: false },
      { label: 'Ayuda',       url: '/proyecto_krow/vistas/ayuda.php',    active: false },
    ],
    rightPanel: () => `
      <div class="panel-card">
        <p class="panel-card-title">Administración</p>
        <div class="admin-alert"><i class="bi bi-exclamation-triangle-fill"></i> 3 ofertas pendientes de revisión</div>
        <div class="admin-alert" style="background:rgba(46,204,154,.08);border-color:rgba(46,204,154,.3);color:#2ECC9A">
          <i class="bi bi-people-fill"></i> 8 nuevos registros hoy
        </div>
        <div class="stat-row"><span class="stat-label">Usuarios totales</span><span class="stat-value">1.2k</span></div>
        <div class="stat-row"><span class="stat-label">Empresas activas</span><span class="stat-value">38</span></div>
        <div class="stat-row"><span class="stat-label">Ofertas publicadas</span><span class="stat-value">124</span></div>
      </div>
    `,
  },
};
 
/**
 * Aplica un rol al layout: actualiza nav, acciones de header y panel derecho.
 * @param {string} role  - 'invitado' | 'estudiante' | 'empresa' | 'admin'
 */
function krowSetRole(role) {
  const data = KROW_ROLES[role];
  if (!data) return;
 
  /* ── Nav ── */
  const nav = document.getElementById('header-nav');
  if (nav) {
    nav.innerHTML = data.nav.map(item =>
      `<a href="${item.url}" class="nav-link${item.active ? ' active' : ''}">${item.label}</a>`
    ).join('');
  }
 
  /* ── Header actions ── */
  const loggedIn   = document.getElementById('logged-in-actions');
  const guestEl    = document.getElementById('guest-actions');
 
  if (role === 'invitado') {
    if (loggedIn) loggedIn.style.display = 'none';
    if (guestEl)  guestEl.style.display  = 'flex';
  } else {
    if (loggedIn) loggedIn.style.display = 'flex';
    if (guestEl)  guestEl.style.display  = 'none';
 
    const labelMap  = { estudiante: 'Mi Cuenta', empresa: 'Mi Empresa', admin: 'Admin' };
    const badgeMap  = { estudiante: 'Est.', empresa: 'Emp.', admin: 'Adm.' };
 
    const avatarEl  = document.getElementById('avatar-letter');
    const labelEl   = document.getElementById('account-label');
    const badgeEl   = document.getElementById('account-role-badge');
    const perfilEl  = document.getElementById('link-perfil');
 
    if (avatarEl) avatarEl.textContent = role.charAt(0).toUpperCase();
    if (labelEl)  labelEl.textContent  = labelMap[role] || 'Mi Cuenta';
    if (badgeEl) {
      badgeEl.textContent = badgeMap[role] || '';
      badgeEl.className   = `role-badge ${role}`;
    }
    if (perfilEl) {
      perfilEl.href = `/proyecto_krow/vistas/${role}/perfil-${role}.php`;
    }
  }
 
  /* ── Right panel ── */
  const panel = document.getElementById('right-panel');
  if (panel) panel.innerHTML = data.rightPanel();
 
  /* ── Role switcher buttons ── */
  document.querySelectorAll('.role-btn').forEach(btn => {
    btn.classList.toggle('active', btn.dataset.role === role);
  });
}
 
/* ── Init desde PHP (data-role en <html>) o default estudiante ── */
document.addEventListener('DOMContentLoaded', () => {
  const roleFromPHP = document.documentElement.dataset.role || 'invitado';
  krowSetRole(roleFromPHP);
 
  /* Role switcher demo (solo si existe en la página) */
  document.querySelectorAll('.role-btn').forEach(btn => {
    btn.addEventListener('click', () => krowSetRole(btn.dataset.role));
  });
});
 