<?php
// ─── CONFIGURACIÓN PARA HEADER ───
$isIncluded = true;
$pageTitle  = 'Base de Empresas';
$rol        = 'invitado'; // Cambiar según sesión real
$basePath   = '/guardalo_aca/proyecto_krow';
$publicPath = $basePath . '/public';

// ─── DATOS DE PRUEBA (reemplazar por consulta SQL real) ───
$empresas = [
    [
        'id' => 1,
        'nombre' => 'TechCorp',
        'slug' => 'techcorp',
        'rubro' => 'Tecnología',
        'ubicacion' => 'CABA, Argentina',
        'tamaño' => '50-200 empleados',
        'modalidades' => ['Presencial', 'Mixto'],
        'ofertas' => 5,
        'desc_corta' => 'Empresa líder en desarrollo de software y soluciones tecnológicas para el sector financiero y retail. Más de 10 años en el mercado...',
        'desc_larga' => 'Empresa líder en desarrollo de software y soluciones tecnológicas para el sector financiero y retail. Más de 10 años en el mercado argentino.',
        'web' => 'techcorp.com.ar',
        'linkedin' => 'techcorp-ar',
    ],
    [
        'id' => 2,
        'nombre' => 'DataCorp',
        'slug' => 'datacorp',
        'rubro' => 'Análisis de datos',
        'ubicacion' => 'Buenos Aires, Argentina',
        'tamaño' => '10-50 empleados',
        'modalidades' => ['Virtual', 'Mixto'],
        'ofertas' => 3,
        'desc_corta' => 'Consultora especializada en Business Intelligence, ciencia de datos y analítica avanzada para empresas de todos los rubros.',
        'desc_larga' => 'Consultora especializada en Business Intelligence, ciencia de datos y analítica avanzada para empresas de todos los rubros. Equipo multidisciplinario con certificaciones internacionales.',
        'web' => 'datacorp.com',
        'linkedin' => 'datacorp',
    ],
    [
        'id' => 3,
        'nombre' => 'DesignStudio',
        'slug' => 'designstudio',
        'rubro' => 'Diseño & UX',
        'ubicacion' => 'Remoto',
        'tamaño' => '10-50 empleados',
        'modalidades' => ['Virtual'],
        'ofertas' => 2,
        'desc_corta' => 'Agencia de diseño de producto enfocada en experiencias digitales. Trabajo 100% remoto con clientes en toda Latinoamérica.',
        'desc_larga' => 'Agencia de diseño de producto enfocada en experiencias digitales. Trabajo 100% remoto con clientes en toda Latinoamérica y España. Especialistas en UX Research, UI Design y Design Systems.',
        'web' => 'designstudio.ar',
        'linkedin' => 'designstudio-ar',
    ],
    [
        'id' => 4,
        'nombre' => 'CloudNet',
        'slug' => 'cloudnet',
        'rubro' => 'Infraestructura Cloud',
        'ubicacion' => 'Buenos Aires, Argentina',
        'tamaño' => '50-200 empleados',
        'modalidades' => ['Virtual', 'Mixto'],
        'ofertas' => 4,
        'desc_corta' => 'Proveedor líder de soluciones cloud, DevOps y ciberseguridad para empresas enterprise en el Cono Sur.',
        'desc_larga' => 'Proveedor líder de soluciones cloud, DevOps y ciberseguridad para empresas enterprise en el Cono Sur. Partners oficiales de AWS, Azure y Google Cloud.',
        'web' => 'cloudnet.io',
        'linkedin' => 'cloudnet-io',
    ],
    [
        'id' => 5,
        'nombre' => 'StartupXYZ',
        'slug' => 'startupxyz',
        'rubro' => 'Fintech',
        'ubicacion' => 'CABA, Argentina',
        'tamaño' => '10-50 empleados',
        'modalidades' => ['Presencial'],
        'ofertas' => 6,
        'desc_corta' => 'Startup en crecimiento que desarrolla soluciones de pagos digitales y wallets crypto para el mercado latinoamericano.',
        'desc_larga' => 'Startup en crecimiento que desarrolla soluciones de pagos digitales y wallets crypto para el mercado latinoamericano. Recaudó USD 8M en Serie A.',
        'web' => 'startupxyz.finance',
        'linkedin' => 'startupxyz',
    ],
    [
        'id' => 6,
        'nombre' => 'MegaCorp Technologies',
        'slug' => 'megacorp-technologies',
        'rubro' => 'Tecnología',
        'ubicacion' => 'Buenos Aires, Argentina',
        'tamaño' => '500+ empleados',
        'modalidades' => ['Presencial', 'Mixto', 'Virtual'],
        'ofertas' => 12,
        'desc_corta' => 'Multinacional con sede central en Buenos Aires. Desarrolla productos de software a gran escala para clientes Fortune 500.',
        'desc_larga' => 'Multinacional con sede central en Buenos Aires. Desarrolla productos de software a gran escala para clientes Fortune 500. Programas de rotación internacional y beneficios premium.',
        'web' => 'megacorp.tech',
        'linkedin' => 'megacorp-tech',
    ],
    [
        'id' => 7,
        'nombre' => 'GreenEnergy',
        'slug' => 'greenenergy',
        'rubro' => 'Energía renovable',
        'ubicacion' => 'Córdoba, Argentina',
        'tamaño' => '200-500 empleados',
        'modalidades' => ['Presencial'],
        'ofertas' => 3,
        'desc_corta' => 'Empresa dedicada al desarrollo de infraestructura de energía solar y eólica en toda la región pampeana.',
        'desc_larga' => 'Empresa dedicada al desarrollo de infraestructura de energía solar y eólica en toda la región pampeana. Certificada B-Corp y con fuerte compromiso ESG.',
        'web' => 'greenenergy.com.ar',
        'linkedin' => 'greenenergy-ar',
    ],
    [
        'id' => 8,
        'nombre' => 'HealthPlus',
        'slug' => 'healthplus',
        'rubro' => 'Salud / HealthTech',
        'ubicacion' => 'Rosario, Argentina',
        'tamaño' => '50-200 empleados',
        'modalidades' => ['Mixto', 'Virtual'],
        'ofertas' => 7,
        'desc_corta' => 'Plataforma de telemedicina y gestión de historias clínicas digitales. Conecta a pacientes con especialistas en tiempo real.',
        'desc_larga' => 'Plataforma de telemedicina y gestión de historias clínicas digitales. Conecta a pacientes con especialistas en tiempo real. Más de 2 millones de consultas realizadas.',
        'web' => 'healthplus.app',
        'linkedin' => 'healthplus-app',
    ],
];

// Rubros y modalidades únicos para los selects
$rubros = array_unique(array_column($empresas, 'rubro'));
$modalidades = [];
foreach ($empresas as $e) {
    foreach ($e['modalidades'] as $m) {
        $modalidades[$m] = true;
    }
}
$modalidades = array_keys($modalidades);

include '../includes/header.php';
?>
<link rel="stylesheet" href="../public/css/styles.css">
<style>
    /* ─── EMPRESAS — VISTA ESPECÍFICA ─── */
    .empresas-page {
        max-width: 1200px;
        margin: 0 auto;
        padding: 28px 24px 60px;
    }

    .empresas-header {
        margin-bottom: 24px;
    }

    .empresas-header h1 {
        font-family: var(--font-display, system-ui);
        font-size: 28px;
        font-weight: 800;
        color: var(--text);
        margin-bottom: 6px;
    }

    .empresas-header p {
        font-size: 15px;
        color: var(--muted);
    }

    /* ─── TOOLBAR ─── */
    .empresas-toolbar {
        display: flex;
        flex-wrap: wrap;
        gap: 12px;
        align-items: center;
        margin-bottom: 24px;
        padding: 14px 16px;
        background: var(--surface);
        border: 0.5px solid var(--border);
        border-radius: var(--radius);
    }

    .toolbar-search {
        position: relative;
        flex: 1 1 300px;
        min-width: 240px;
    }

    .toolbar-search svg {
        position: absolute;
        left: 12px;
        top: 50%;
        transform: translateY(-50%);
        color: var(--muted);
        pointer-events: none;
    }

    .toolbar-search input {
        width: 100%;
        padding: 10px 12px 10px 38px;
        border: 1px solid var(--border);
        border-radius: var(--radius);
        background: var(--bg);
        color: var(--text);
        font-size: 14px;
        transition: border-color .2s, box-shadow .2s;
    }

    .toolbar-search input:focus {
        outline: none;
        border-color: var(--accent);
        box-shadow: 0 0 0 3px rgba(46, 204, 154, .12);
    }

    .toolbar-select {
        position: relative;
        min-width: 180px;
    }

    .toolbar-select select {
        width: 100%;
        padding: 10px 32px 10px 12px;
        border: 1px solid var(--border);
        border-radius: var(--radius);
        background: var(--bg);
        color: var(--text);
        font-size: 14px;
        appearance: none;
        cursor: pointer;
        transition: border-color .2s;
    }

    .toolbar-select select:focus {
        outline: none;
        border-color: var(--accent);
    }

    .toolbar-select::after {
        content: "";
        position: absolute;
        right: 12px;
        top: 50%;
        transform: translateY(-50%);
        width: 10px;
        height: 10px;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='10' height='10' viewBox='0 0 24 24' fill='none' stroke='%236B6B78' stroke-width='2'%3E%3Cpolyline points='6 9 12 15 18 9'/%3E%3C/svg%3E");
        background-repeat: no-repeat;
        background-position: center;
        pointer-events: none;
    }

    .toolbar-count {
        margin-left: auto;
        font-size: 14px;
        color: var(--muted);
        font-weight: 500;
        white-space: nowrap;
    }

    /* ─── GRID ─── */
    .empresas-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 18px;
        grid-auto-rows: 1fr;
    }

    @media (max-width: 1024px) {
        .empresas-grid {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    @media (max-width: 640px) {
        .empresas-grid {
            grid-template-columns: 1fr;
        }

        .empresas-toolbar {
            flex-direction: column;
            align-items: stretch;
        }

        .toolbar-count {
            margin-left: 0;
        }
    }

    /* ─── CARD ─── */
    .empresa-card {
        background: var(--surface);
        border: 0.5px solid var(--border);
        border-radius: var(--radius);
        padding: 20px;
        display: flex;
        flex-direction: column;
        gap: 12px;
        transition: border-color .2s, box-shadow .2s, transform .2s;
        height: 100%;
    }

    .empresa-card:hover {
        border-color: var(--accent);
        box-shadow: var(--shadow-card, 0 2px 14px rgba(0, 0, 0, .10));
        transform: translateY(-1px);
    }

    .empresa-card-header {
        display: flex;
        align-items: flex-start;
        gap: 10px;
        flex-shrink: 0;
        min-width: 0;
    }

    .empresa-info-title {
        display: flex;
        align-items: flex-start;
        gap: 10px;
        min-width: 0;
        flex: 1 1 auto;
        overflow: hidden;
    }

    .empresa-info-text {
        min-width: 0;
        overflow: hidden;
        flex: 1 1 auto;
    }

    .empresa-icon {
        width: 40px;
        height: 40px;
        border-radius: var(--radius);
        background: var(--bg);
        border: 0.5px solid var(--border);
        display: grid;
        place-items: center;
        color: var(--accent);
        flex-shrink: 0;
        margin-top: 2px;
    }

    .empresa-nombre {
        font-family: var(--font-display, system-ui);
        font-weight: 700;
        font-size: 16px;
        color: var(--text);
        line-height: 1.25;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }

    .empresa-badge-ofertas {
        display: inline-flex;
        align-items: center;
        gap: 4px;
        padding: 4px 10px;
        border-radius: 20px;
        background: rgba(46, 204, 154, .12);
        border: 0.5px solid rgba(46, 204, 154, .3);
        color: var(--accent);
        font-size: 12px;
        font-weight: 700;
        font-family: var(--font-display, system-ui);
        white-space: nowrap;
        flex-shrink: 0;
        align-self: flex-start;
        margin-top: 2px;
    }

    [data-theme="dark"] .empresa-badge-ofertas {
        background: rgba(212, 168, 67, .12);
        border-color: rgba(212, 168, 67, .3);
        color: var(--accent);
    }

    .empresa-meta {
        display: flex;
        flex-wrap: wrap;
        gap: 4px 12px;
        font-size: 12.5px;
        color: var(--muted);
        margin-top: 2px;
        line-height: 1.3;
    }

    .empresa-meta span {
        display: inline-flex;
        align-items: center;
        gap: 4px;
    }

    .empresa-tags {
        display: flex;
        flex-wrap: wrap;
        gap: 6px;
        flex-shrink: 0;
    }

    .empresa-tag {
        padding: 3px 10px;
        border-radius: 20px;
        font-size: 11.5px;
        font-weight: 500;
        border: 0.5px solid var(--border);
        color: var(--muted);
        background: transparent;
    }

    .empresa-desc {
        font-size: 13.5px;
        color: var(--muted);
        line-height: 1.55;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
        flex: 1 0 auto;
        min-height: 0;
    }

    .empresa-toggle {
        display: inline-flex;
        align-items: center;
        gap: 4px;
        background: none;
        border: none;
        color: var(--accent);
        font-size: 13px;
        font-weight: 600;
        cursor: pointer;
        padding: 0;
        margin-top: auto;
        transition: opacity .2s;
        flex-shrink: 0;
    }

    .empresa-toggle:hover {
        opacity: .75;
    }

    .empresa-toggle svg {
        transition: transform .2s;
    }

    .empresa-toggle[aria-expanded="true"] svg {
        transform: rotate(180deg);
    }

    /* ─── EXPANDED ─── */
    .empresa-expanded {
        display: none;
        flex-direction: column;
        gap: 12px;
        padding-top: 4px;
        border-top: 0.5px solid var(--border);
        animation: fadeInUp .25s ease;
        flex-shrink: 0;
    }

    .empresa-expanded.open {
        display: flex;
    }

    .empresa-desc-full {
        font-size: 13.5px;
        color: var(--muted);
        line-height: 1.6;
    }

    .empresa-links {
        display: flex;
        flex-direction: column;
        gap: 6px;
    }

    .empresa-links a {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        font-size: 13px;
        color: var(--accent);
        text-decoration: none;
        transition: opacity .2s;
    }

    .empresa-links a:hover {
        opacity: .75;
    }

    .empresa-links a svg {
        color: var(--muted);
    }

    .empresa-btn-ofertas {
        width: 100%;
        padding: 10px;
        background: var(--primary);
        color: #fff;
        border: none;
        border-radius: var(--radius);
        font-family: var(--font-display, system-ui);
        font-weight: 700;
        font-size: 13px;
        cursor: pointer;
        transition: opacity .2s, box-shadow .2s;
        text-align: center;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 6px;
    }

    .empresa-btn-ofertas:hover {
        opacity: .9;
        box-shadow: 0 4px 14px rgba(13, 79, 60, .25);
    }

    [data-theme="dark"] .empresa-btn-ofertas {
        background: var(--accent);
        color: #111118;
    }

    [data-theme="dark"] .empresa-btn-ofertas:hover {
        box-shadow: var(--shadow-accent, 0 4px 20px rgba(212, 168, 67, .22));
    }

    /* ─── NO RESULTADOS ─── */
    .empresas-empty {
        grid-column: 1 / -1;
        text-align: center;
        padding: 48px 24px;
        color: var(--muted);
    }

    .empresas-empty h3 {
        font-family: var(--font-display, system-ui);
        font-size: 18px;
        color: var(--text);
        margin-bottom: 8px;
    }

    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(8px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
</style>

<main class="empresas-page">

    <div class="empresas-header">
        <h1>Base de Empresas</h1>
        <p>Explorá las empresas registradas en la plataforma y sus ofertas laborales activas.</p>
    </div>

    <div class="empresas-toolbar">
        <div class="toolbar-search">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <circle cx="11" cy="11" r="8" />
                <path d="m21 21-4.35-4.35" />
            </svg>
            <input type="text" id="buscador" placeholder="Buscar empresa, rubro, ubicación..." autocomplete="off">
        </div>

        <div class="toolbar-select">
            <select id="filtro-rubro">
                <option value="">Todos los rubros</option>
                <?php foreach ($rubros as $r): ?>
                    <option value="<?php echo htmlspecialchars($r); ?>"><?php echo htmlspecialchars($r); ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="toolbar-select">
            <select id="filtro-modalidad">
                <option value="">Todas las modalidades</option>
                <?php foreach ($modalidades as $m): ?>
                    <option value="<?php echo htmlspecialchars($m); ?>"><?php echo htmlspecialchars($m); ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="toolbar-count" id="contador"><?php echo count($empresas); ?> empresas</div>
    </div>

    <div class="empresas-grid" id="grid-empresas">
        <?php foreach ($empresas as $emp): ?>
            <article class="empresa-card"
                data-nombre="<?php echo strtolower(htmlspecialchars($emp['nombre'])); ?>"
                data-rubro="<?php echo strtolower(htmlspecialchars($emp['rubro'])); ?>"
                data-ubicacion="<?php echo strtolower(htmlspecialchars($emp['ubicacion'])); ?>"
                data-modalidades="<?php echo strtolower(implode(',', $emp['modalidades'])); ?>">

                <div class="empresa-card-header">
                    <div class="empresa-info-title">
                        <div class="empresa-icon">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                                <path d="M3 21h18M5 21V7l8-4 8 4v14M9 21v-6h6v6" />
                            </svg>
                        </div>
                        <div class="empresa-info-text">
                            <div class="empresa-nombre"><?php echo htmlspecialchars($emp['nombre']); ?></div>
                            <div class="empresa-meta">
                                <span><?php echo htmlspecialchars($emp['rubro']); ?></span>
                                <span>·</span>
                                <span><?php echo htmlspecialchars($emp['ubicacion']); ?></span>
                                <span>·</span>
                                <span><?php echo htmlspecialchars($emp['tamaño']); ?></span>
                            </div>
                        </div>
                    </div>
                    <div class="empresa-badge-ofertas">
                        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <rect x="2" y="7" width="20" height="14" rx="2" ry="2" />
                            <path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16" />
                        </svg>
                        <?php echo $emp['ofertas']; ?> oferta<?php echo $emp['ofertas'] > 1 ? 's' : ''; ?>
                    </div>
                </div>

                <div class="empresa-tags">
                    <?php foreach ($emp['modalidades'] as $mod): ?>
                        <span class="empresa-tag"><?php echo htmlspecialchars($mod); ?></span>
                    <?php endforeach; ?>
                </div>

                <div class="empresa-desc" id="desc-corta-<?php echo $emp['id']; ?>">
                    <?php echo htmlspecialchars($emp['desc_corta']); ?>
                </div>

                <button class="empresa-toggle" id="toggle-<?php echo $emp['id']; ?>"
                    onclick="togglePerfil(<?php echo $emp['id']; ?>)" aria-expanded="false">
                    <span>Ver perfil completo</span>
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <polyline points="6 9 12 15 18 9" />
                    </svg>
                </button>

                <div class="empresa-expanded" id="expanded-<?php echo $emp['id']; ?>">
                    <div class="empresa-desc-full">
                        <?php echo htmlspecialchars($emp['desc_larga']); ?>
                    </div>
                    <div class="empresa-links">
                        <a href="https://<?php echo htmlspecialchars($emp['web']); ?>" target="_blank" rel="noopener">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <circle cx="12" cy="12" r="10" />
                                <path d="M2 12h20" />
                                <path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z" />
                            </svg>
                            <?php echo htmlspecialchars($emp['web']); ?>
                        </a>
                        <a href="https://linkedin.com/company/<?php echo htmlspecialchars($emp['linkedin']); ?>" target="_blank" rel="noopener">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M16 8a6 6 0 0 1 6 6v7h-4v-7a2 2 0 0 0-2-2 2 2 0 0 0-2 2v7h-4v-7a6 6 0 0 1 6-6z" />
                                <rect x="2" y="9" width="4" height="12" />
                                <circle cx="4" cy="4" r="2" />
                            </svg>
                            @<?php echo htmlspecialchars($emp['linkedin']); ?>
                        </a>
                    </div>
                    <a href="ofertas.php?empresa=<?php echo urlencode($emp['slug']); ?>" class="empresa-btn-ofertas">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <rect x="2" y="7" width="20" height="14" rx="2" ry="2" />
                            <path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16" />
                        </svg>
                        Ver <?php echo $emp['ofertas']; ?> oferta<?php echo $emp['ofertas'] > 1 ? 's' : ''; ?> activas
                    </a>
                </div>

            </article>
        <?php endforeach; ?>

        <div class="empresas-empty" id="empty-state" style="display:none">
            <h3>No se encontraron empresas</h3>
            <p>Probá ajustando los filtros o el término de búsqueda.</p>
        </div>
    </div>

</main>

<script>
    (function() {
        const grid = document.getElementById('grid-empresas');
        const cards = Array.from(grid.querySelectorAll('.empresa-card'));
        const empty = document.getElementById('empty-state');
        const contador = document.getElementById('contador');
        const inputBuscar = document.getElementById('buscador');
        const selectRubro = document.getElementById('filtro-rubro');
        const selectModalidad = document.getElementById('filtro-modalidad');

        function filtrar() {
            const q = inputBuscar.value.trim().toLowerCase();
            const rubro = selectRubro.value.toLowerCase();
            const modalidad = selectModalidad.value.toLowerCase();
            let visibles = 0;

            cards.forEach(card => {
                const nombre = card.dataset.nombre;
                const cardRubro = card.dataset.rubro;
                const ubicacion = card.dataset.ubicacion;
                const mods = card.dataset.modalidades;

                const matchText = !q || nombre.includes(q) || cardRubro.includes(q) || ubicacion.includes(q);
                const matchRubro = !rubro || cardRubro === rubro;
                const matchModalidad = !modalidad || mods.split(',').includes(modalidad);

                if (matchText && matchRubro && matchModalidad) {
                    card.style.display = '';
                    visibles++;
                } else {
                    card.style.display = 'none';
                }
            });

            empty.style.display = visibles === 0 ? 'block' : 'none';
            contador.textContent = visibles + ' empresa' + (visibles !== 1 ? 's' : '');
        }

        inputBuscar.addEventListener('input', filtrar);
        selectRubro.addEventListener('change', filtrar);
        selectModalidad.addEventListener('change', filtrar);

        // Exponer globalmente para el onclick inline
        window.togglePerfil = function(id) {
            const expanded = document.getElementById('expanded-' + id);
            const toggle = document.getElementById('toggle-' + id);
            const isOpen = expanded.classList.contains('open');

            if (isOpen) {
                expanded.classList.remove('open');
                toggle.setAttribute('aria-expanded', 'false');
                toggle.querySelector('span').textContent = 'Ver perfil completo';
            } else {
                expanded.classList.add('open');
                toggle.setAttribute('aria-expanded', 'true');
                toggle.querySelector('span').textContent = 'Ver menos';
            }
        };
    })();
</script>
<script src="../public/js/main.js"></script>
<?php include '../includes/footer.php'; ?>