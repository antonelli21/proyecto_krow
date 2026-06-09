/* Extracted JS from index.html - index.js */
/* ROLE SYSTEM + THEME + DROPDOWN + HAMBURGER + ACCORDIONS + CASCADE + TAGS + PAGINATION */
const ROLES = {
  invitado: {
    nav: [
      { label: 'Inicio', url: '#', active: true },
      { label: 'Empresas', url: '#login' },
      { label: 'Mis Postulaciones', url: '#login' },
      { label: 'Ayuda', url: '#' },
    ],
    rightPanel: `
      <div class="panel-card cta-card">
        <p class="panel-card-title">Encontrá tu primer trabajo</p>
        <p>Registrate gratis y accedé a cientos de ofertas para estudiantes UTN.</p>
        <a href="#" class="btn-primary-sm">Crear cuenta</a>
        <a href="#" class="btn-ghost-sm" style="display:block;text-align:center;margin-top:6px">Ya tengo cuenta</a>
      </div>
      <div class="panel-card featured-card">
        <div class="featured-badge"><i class="bi bi-star-fill"></i> Destacado</div>
        <p class="featured-title">Senior Backend Engineer</p>
        <p class="featured-company">MegaCorp Technologies</p>
        <button class="btn-quick-apply" onclick="alert('Iniciá sesión para postularte')">Postularme rápido</button>
      </div>
    `,
  },
  estudiante: {
    nav: [
      { label: 'Inicio', url: '#', active: true },
      { label: 'Empresas', url: '#empresas' },
      { label: 'Mis Postulaciones', url: '#postulaciones' },
      { label: 'Ayuda', url: '#' },
    ],
    rightPanel: `
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
      { label: 'Inicio', url: '#', active: true },
      { label: 'Panel Empresa', url: '#panel' },
      { label: 'Mis Ofertas', url: '#ofertas' },
      { label: 'Ayuda', url: '#' },
    ],
    rightPanel: `
      <div class="panel-card empresa-stats">
        <p class="panel-card-title">Panel Empresa</p>
        <div class="stat-row"><span class="stat-label">Ofertas activas</span><span class="stat-value" style="color:#48bb78">7</span></div>
        <div class="stat-row"><span class="stat-label">Postulantes recibidos</span><span class="stat-value" style="color:#48bb78">143</span></div>
        <div class="stat-row"><span class="stat-label">Entrevistas pautadas</span><span class="stat-value" style="color:#48bb78">12</span></div>
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
      { label: 'Inicio', url: '#', active: true },
      { label: 'Administrar', url: '#admin' },
      { label: 'Usuarios', url: '#usuarios' },
      { label: 'Reportes', url: '#reportes' },
      { label: 'Ayuda', url: '#' },
    ],
    rightPanel: `
      <div class="panel-card">
        <p class="panel-card-title">Administración</p>
        <div class="admin-alert"><i class="bi bi-exclamation-triangle-fill"></i> 3 ofertas pendientes de revisión</div>
        <div class="admin-alert" style="background:rgba(99,179,237,.1);border-color:rgba(99,179,237,.3);color:#63b3ed;"></div>
        <div class="stat-row"><span class="stat-label">Usuarios totales</span><span class="stat-value" style="color:#ed8936">1.2k</span></div>
        <div class="stat-row"><span class="stat-label">Empresas activas</span><span class="stat-value" style="color:#ed8936">38</span></div>
        <div class="stat-row"><span class="stat-label">Ofertas publicadas</span><span class="stat-value" style="color:#ed8936">124</span></div>
      </div>
    `,
  },
};

let currentRole = 'estudiante';

function setRole(role) {
  currentRole = role;
  const data = ROLES[role];

  // Nav
  const nav = document.getElementById('header-nav');
  nav.innerHTML = data.nav.map(item =>
    `<a href="${item.url}" class="nav-link${item.active ? ' active' : ''}">${item.label}</a>`
  ).join('');

  // Auth area
  const loggedIn = document.getElementById('logged-in-actions');
  const guestActions = document.getElementById('guest-actions');

  if (role === 'invitado') {
    loggedIn.style.display = 'none';
    guestActions.style.display = 'flex';
  } else {
    loggedIn.style.display = 'flex';
    guestActions.style.display = 'none';
    const badges = { estudiante: 'Est.', empresa: 'Emp.', admin: 'Adm.' };
    const badgeClass = { estudiante: 'estudiante', empresa: 'empresa', admin: 'admin' };
    document.getElementById('avatar-letter').textContent = role.charAt(0).toUpperCase();
    document.getElementById('account-label').textContent = role === 'empresa' ? 'Mi Empresa' : 'Mi Cuenta';
    const badge = document.getElementById('account-role-badge');
    badge.textContent = badges[role];
    badge.className = `role-badge ${badgeClass[role]}`;
  }

  // Right panel
  document.getElementById('right-panel').innerHTML = data.rightPanel;

  // Role switcher buttons
  document.querySelectorAll('.role-btn').forEach(btn => {
    btn.classList.remove('active');
    if (btn.textContent.toLowerCase().includes(role)) btn.classList.add('active');
  });
}

/* THEME */
const root = document.documentElement;
const themeBtn = document.getElementById('theme-toggle');
const saved = localStorage.getItem('krow-theme') || 'dark';
applyTheme(saved);

themeBtn.addEventListener('click', () => {
  const next = root.getAttribute('data-theme') === 'dark' ? 'light' : 'dark';
  applyTheme(next);
  localStorage.setItem('krow-theme', next);
});

function applyTheme(t) {
  root.setAttribute('data-theme', t);
  const sun = themeBtn.querySelector('.icon-sun');
  const moon = themeBtn.querySelector('.icon-moon');
  sun.style.display = t === 'dark' ? 'block' : 'none';
  moon.style.display = t === 'light' ? 'block' : 'none';
}

/* DROPDOWN */
document.addEventListener('click', e => {
  const toggle = document.getElementById('account-toggle');
  const menu = document.getElementById('account-menu');
  if (!toggle || !menu) return;
  if (toggle.contains(e.target)) {
    const open = menu.classList.toggle('open');
    toggle.setAttribute('aria-expanded', open);
  } else if (!menu.contains(e.target)) {
    menu.classList.remove('open');
    toggle.setAttribute('aria-expanded', false);
  }
});

document.addEventListener('keydown', e => {
  if (e.key === 'Escape') {
    document.getElementById('account-menu')?.classList.remove('open');
  }
});

/* HAMBURGER */
document.getElementById('hamburger')?.addEventListener('click', () => {
  const nav = document.getElementById('header-nav');
  nav.classList.toggle('open');
});

/* ACCORDIONS */
document.querySelectorAll('.accordion-header').forEach(h => {
  h.addEventListener('click', () => h.closest('.filter-accordion').classList.toggle('open'));
});

/* CASCADE PROVINCIA / LOCALIDAD */
const localidades = {
  'Buenos Aires': ['La Plata', 'Mar del Plata', 'Bahía Blanca', 'Castelar', 'Haedo', 'Morón'],
  'CABA': ['Palermo', 'Recoleta', 'Belgrano', 'Caballito', 'San Telmo'],
  'Córdoba': ['Córdoba Capital', 'Villa Carlos Paz', 'Río Cuarto'],
  'Santa Fe': ['Rosario', 'Santa Fe Capital', 'Rafaela'],
  'Mendoza': ['Mendoza Capital', 'San Rafael', 'Godoy Cruz'],
};

document.getElementById('provincia')?.addEventListener('change', e => {
  const sel = document.getElementById('localidad');
  const opts = localidades[e.target.value] || [];
  sel.innerHTML = '<option value="" disabled selected>Seleccioná una localidad</option>' +
    opts.map(l => `<option>${l}</option>`).join('');
  sel.disabled = false;
});

/* TAGS */
let tags = [];
const tagInput = document.getElementById('tecnologia-input');
const tagContainer = document.getElementById('tags-container');

function addTag(val) {
  val = val.trim();
  if (!val || tags.includes(val.toLowerCase())) { if (tagInput) tagInput.value = ''; return; }
  tags.push(val.toLowerCase());
  const div = document.createElement('div');
  div.className = 'tech-tag';
  div.innerHTML = `<span>${val}</span><button class="btn-remove-tag">×</button>`;
  div.querySelector('.btn-remove-tag').onclick = () => {
    tags = tags.filter(t => t !== val.toLowerCase());
    div.remove();
  };
  tagContainer?.appendChild(div);
  if (tagInput) tagInput.value = '';
}

document.getElementById('btn-add-tag')?.addEventListener('click', () => addTag(tagInput.value));
tagInput?.addEventListener('keydown', e => { if (e.key === 'Enter') { e.preventDefault(); addTag(tagInput.value); } });

/* PAGINATION */
document.querySelectorAll('.pagination').forEach(p => {
  p.querySelectorAll('.pg-btn').forEach(btn => {
    btn.addEventListener('click', () => {
      p.querySelectorAll('.pg-btn').forEach(b => b.classList.remove('active'));
      btn.classList.add('active');
    });
  });
});

/* Init with estudiante */
setRole('estudiante');
