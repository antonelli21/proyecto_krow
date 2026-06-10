<?php

/**
 * KROW — registro.php
 * Registro dual: Candidato / Empresa
 */
if (!isset($basePath)) {
    $basePath = '/guardalo_aca/proyecto_krow';
}
if (!isset($publicPath)) {
    $publicPath = $basePath . '/public';
}

$carreras = [
    'Tecnicatura Universitaria en Programación',
    'Tecnicatura Universitaria en Operación de Aeronaves',
    'Tecnicatura Universitaria en Material Rodante Ferroviario',
    'Ingeniería Aeronáutica',
    'Ingeniería Aeroespacial',
    'Ingeniería Electrónica',
    'Ingeniería Industrial',
    'Ingeniería Mecánica',
    'Ingeniería Ferroviaria',
    'Bioingeniería',
    'Especialización en Ingeniería Estructural',
    'Especialización en Higiene y Seguridad en el Trabajo',
    'Maestría en Ingeniería Estructural Mecánica',
    'Doctorado en Ingeniería Mención Materiales'
];
?>
<!DOCTYPE html>
<html lang="es" data-theme="dark">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Cuenta - KROW</title>
    <link rel="stylesheet" href="<?php echo $publicPath; ?>/css/styles.css">
    <style>
        /* ── Auth layout ── */
        .auth-page {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem 1rem;
            background: var(--bg);
        }

        .auth-card {
            width: 100%;
            max-width: 480px;
            background: var(--surface);
            border: 0.5px solid var(--border);
            border-radius: var(--radius);
            padding: 2.25rem 2rem;
            box-shadow: var(--shadow-card);
            animation: fadeInUp 0.35s ease;
        }

        .auth-head {
            margin-bottom: 1.25rem;
        }

        .auth-head h1 {
            font-family: var(--font-display);
            font-size: 1.75rem;
            font-weight: 800;
            color: var(--text);
            margin-bottom: 0.35rem;
            line-height: 1.2;
        }

        .auth-head p {
            font-size: 0.9rem;
            color: var(--muted);
        }

        /* ── Tabs ── */
        .role-tabs {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 0.5rem;
            margin-bottom: 1.5rem;
        }

        .role-tab {
            padding: 0.6rem;
            border: 1px solid var(--border);
            border-radius: var(--radius);
            background: var(--bg-input);
            color: var(--muted);
            font-family: var(--font-display);
            font-weight: 700;
            font-size: 0.9rem;
            cursor: pointer;
            transition: all 0.2s;
            text-align: center;
        }

        .role-tab:hover {
            border-color: var(--accent);
            color: var(--text);
        }

        .role-tab.active {
            background: var(--primary);
            color: #fff;
            border-color: var(--primary);
        }

        [data-theme="dark"] .role-tab.active {
            background: var(--accent);
            color: #111118;
            border-color: var(--accent);
        }

        /* ── Forms ── */
        .auth-form {
            display: none;
            flex-direction: column;
            gap: 1.1rem;
        }

        .auth-form.active {
            display: flex;
        }

        .form-group {
            display: flex;
            flex-direction: column;
            gap: 0.4rem;
        }

        .form-group label {
            font-size: 0.8rem;
            font-weight: 600;
            color: var(--text);
            text-transform: uppercase;
            letter-spacing: 0.6px;
        }

        .input-wrap {
            position: relative;
            display: flex;
            align-items: center;
        }

        .input-wrap>svg:first-child {
            position: absolute;
            left: 12px;
            color: var(--muted);
            pointer-events: none;
        }

        .input-wrap input,
        .input-wrap select {
            width: 100%;
            padding: 0.7rem 2.8rem 0.7rem 2.6rem;
            border: 1px solid var(--border);
            border-radius: var(--radius);
            background: var(--bg-input);
            color: var(--text);
            font-size: 0.95rem;
            font-family: var(--font-body);
            transition: border-color 0.2s, box-shadow 0.2s;
            appearance: none;
        }

        .input-wrap select {
            cursor: pointer;
        }

        .input-wrap input:focus,
        .input-wrap select:focus {
            outline: none;
            border-color: var(--accent);
            box-shadow: 0 0 0 3px rgba(46, 204, 154, 0.12);
        }

        .input-wrap input::placeholder {
            color: var(--text-muted);
        }

        .input-wrap input.error,
        .input-wrap select.error {
            border-color: var(--destructive);
            box-shadow: 0 0 0 3px rgba(212, 24, 61, 0.12);
        }

        .select-chevron {
            position: absolute;
            right: 12px;
            color: var(--muted);
            pointer-events: none;
        }

        /* ── Botón ojo ── */
        .btn-eye {
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            cursor: pointer;
            color: var(--muted);
            padding: 4px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            z-index: 2;
            transition: color 0.15s;
        }

        .btn-eye:hover {
            color: var(--accent);
        }

        /* ── Error msg ── */
        .error-msg {
            font-size: 0.8rem;
            color: var(--destructive);
            display: none;
            align-items: center;
            gap: 4px;
            margin-top: 2px;
        }

        .error-msg.show {
            display: flex;
        }

        /* ── Checkbox términos ── */
        .terms-row {
            display: flex;
            align-items: flex-start;
            gap: 0.5rem;
            font-size: 0.85rem;
            color: var(--muted);
            margin-top: -0.2rem;
        }

        .terms-row input {
            accent-color: var(--accent);
            width: 16px;
            height: 16px;
            cursor: pointer;
            margin-top: 2px;
            flex-shrink: 0;
        }

        .terms-row a {
            color: var(--primary);
            font-weight: 600;
            text-decoration: none;
        }

        .terms-row a:hover {
            text-decoration: underline;
        }

        [data-theme="dark"] .terms-row a {
            color: var(--accent);
        }

        /* ── Submit ── */
        .btn-submit {
            width: 100%;
            padding: 0.85rem;
            border: none;
            border-radius: var(--radius);
            background: var(--primary);
            color: #fff;
            font-family: var(--font-display);
            font-weight: 700;
            font-size: 1rem;
            cursor: pointer;
            transition: opacity 0.2s, transform 0.15s;
            margin-top: 0.25rem;
        }

        .btn-submit:hover {
            opacity: 0.9;
            transform: translateY(-1px);
        }

        [data-theme="dark"] .btn-submit {
            background: var(--accent);
            color: #111118;
        }

        /* ── Footer link ── */
        .auth-footer {
            text-align: center;
            margin-top: 1.25rem;
            font-size: 0.85rem;
            color: var(--muted);
        }

        .auth-footer a {
            color: var(--primary);
            font-weight: 600;
            text-decoration: none;
        }

        .auth-footer a:hover {
            text-decoration: underline;
        }

        [data-theme="dark"] .auth-footer a {
            color: var(--accent);
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(12px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>

<body>

    <?php
    $isIncluded = true;
    $pageTitle = 'Crear Cuenta';
    $rol = 'invitado';
    include '../../includes/header.php';
    ?>

    <main class="auth-page">
        <div class="auth-card">
            <div class="auth-head">
                <h1>Crear Cuenta</h1>
                <p>Únete a Banco de Trabajo hoy</p>
            </div>

            <!-- Tabs -->
            <div class="role-tabs" id="roleTabs">
                <button type="button" class="role-tab active" data-role="candidato">Candidato</button>
                <button type="button" class="role-tab" data-role="empresa">Empresa</button>
            </div>

            <!-- FORM CANDIDATO -->
            <form class="auth-form active" id="formCandidato" novalidate>
                <div class="form-row" style="display:grid;grid-template-columns:1fr 1fr;gap:1rem;">
                    <div class="form-group">
                        <label for="c-nombre">Nombre</label>
                        <div class="input-wrap">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                                <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2" />
                                <circle cx="12" cy="7" r="4" />
                            </svg>
                            <input type="text" id="c-nombre" name="nombre" placeholder="Juan" autocomplete="given-name">
                        </div>
                        <span class="error-msg" id="err-c-nombre">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <circle cx="12" cy="12" r="10" />
                                <line x1="12" y1="8" x2="12" y2="12" />
                                <line x1="12" y1="16" x2="12.01" y2="16" />
                            </svg>
                            Ingresa tu nombre.
                        </span>
                    </div>
                    <div class="form-group">
                        <label for="c-apellido">Apellido</label>
                        <div class="input-wrap">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                                <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2" />
                                <circle cx="12" cy="7" r="4" />
                            </svg>
                            <input type="text" id="c-apellido" name="apellido" placeholder="Pérez" autocomplete="family-name">
                        </div>
                        <span class="error-msg" id="err-c-apellido">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <circle cx="12" cy="12" r="10" />
                                <line x1="12" y1="8" x2="12" y2="12" />
                                <line x1="12" y1="16" x2="12.01" y2="16" />
                            </svg>
                            Ingresa tu apellido.
                        </span>
                    </div>
                </div>

                <div class="form-group">
                    <label for="c-email">Email institucional</label>
                    <div class="input-wrap">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                            <rect x="2" y="4" width="20" height="16" rx="2" />
                            <path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7" />
                        </svg>
                        <input type="email" id="c-email" name="email" placeholder="tu@frh.utn.edu.ar" autocomplete="email">
                    </div>
                    <span class="error-msg" id="err-c-email">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <circle cx="12" cy="12" r="10" />
                            <line x1="12" y1="8" x2="12" y2="12" />
                            <line x1="12" y1="16" x2="12.01" y2="16" />
                        </svg>
                        Ingresa un email institucional válido.
                    </span>
                </div>

                <div class="form-row" style="display:grid;grid-template-columns:1fr 1fr;gap:1rem;">
                    <div class="form-group">
                        <label for="c-telefono">Teléfono</label>
                        <div class="input-wrap">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                                <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z" />
                            </svg>
                            <input type="tel" id="c-telefono" name="telefono" placeholder="11 2345-6789" autocomplete="tel">
                        </div>
                        <span class="error-msg" id="err-c-telefono">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <circle cx="12" cy="12" r="10" />
                                <line x1="12" y1="8" x2="12" y2="12" />
                                <line x1="12" y1="16" x2="12.01" y2="16" />
                            </svg>
                            Ingresa un teléfono válido.
                        </span>
                    </div>
                    <div class="form-group">
                        <label for="c-nacimiento">Fecha de nacimiento</label>
                        <div class="input-wrap">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                                <rect x="3" y="4" width="18" height="18" rx="2" ry="2" />
                                <line x1="16" y1="2" x2="16" y2="6" />
                                <line x1="8" y1="2" x2="8" y2="6" />
                                <line x1="3" y1="10" x2="21" y2="10" />
                            </svg>
                            <input type="date" id="c-nacimiento" name="nacimiento" autocomplete="bday">
                        </div>
                        <span class="error-msg" id="err-c-nacimiento">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <circle cx="12" cy="12" r="10" />
                                <line x1="12" y1="8" x2="12" y2="12" />
                                <line x1="12" y1="16" x2="12.01" y2="16" />
                            </svg>
                            Selecciona tu fecha de nacimiento.
                        </span>
                    </div>
                </div>

                <div class="form-group">
                    <label for="c-carrera">Carrera (UTN Haedo)</label>
                    <div class="input-wrap">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                            <path d="M22 10v6M2 10l10-5 10 5-10 5z" />
                            <path d="M6 12v5c0 2 2 3 6 3s6-1 6-3v-5" />
                        </svg>
                        <select id="c-carrera" name="carrera">
                            <option value="" disabled selected>Seleccioná tu carrera</option>
                            <?php foreach ($carreras as $c): ?>
                                <option value="<?php echo htmlspecialchars($c); ?>"><?php echo htmlspecialchars($c); ?></option>
                            <?php endforeach; ?>
                        </select>
                        <svg class="select-chevron" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <polyline points="6 9 12 15 18 9" />
                        </svg>
                    </div>
                    <span class="error-msg" id="err-c-carrera">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <circle cx="12" cy="12" r="10" />
                            <line x1="12" y1="8" x2="12" y2="12" />
                            <line x1="12" y1="16" x2="12.01" y2="16" />
                        </svg>
                        Seleccioná una carrera.
                    </span>
                </div>

                <div class="form-group">
                    <label for="c-password">Contraseña</label>
                    <div class="input-wrap">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                            <rect x="3" y="11" width="18" height="11" rx="2" ry="2" />
                            <path d="M7 11V7a5 5 0 0 1 10 0v4" />
                        </svg>
                        <input type="password" id="c-password" name="password" placeholder="••••••••" autocomplete="new-password">
                        <button type="button" class="btn-eye" aria-label="Mostrar contraseña" onclick="window.togglePass('c-password', this)">
                            <svg class="icon-open" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                                <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z" />
                                <circle cx="12" cy="12" r="3" />
                            </svg>
                            <svg class="icon-closed" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" style="display:none">
                                <path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24" />
                                <line x1="1" y1="1" x2="23" y2="23" />
                            </svg>
                        </button>
                    </div>
                    <span class="error-msg" id="err-c-password">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <circle cx="12" cy="12" r="10" />
                            <line x1="12" y1="8" x2="12" y2="12" />
                            <line x1="12" y1="16" x2="12.01" y2="16" />
                        </svg>
                        Mínimo 6 caracteres.
                    </span>
                </div>

                <div class="form-group">
                    <label for="c-password2">Confirmar contraseña</label>
                    <div class="input-wrap">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                            <rect x="3" y="11" width="18" height="11" rx="2" ry="2" />
                            <path d="M7 11V7a5 5 0 0 1 10 0v4" />
                        </svg>
                        <input type="password" id="c-password2" name="password2" placeholder="••••••••" autocomplete="new-password">
                        <button type="button" class="btn-eye" aria-label="Mostrar contraseña" onclick="window.togglePass('c-password2', this)">
                            <svg class="icon-open" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                                <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z" />
                                <circle cx="12" cy="12" r="3" />
                            </svg>
                            <svg class="icon-closed" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" style="display:none">
                                <path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24" />
                                <line x1="1" y1="1" x2="23" y2="23" />
                            </svg>
                        </button>
                    </div>
                    <span class="error-msg" id="err-c-password2">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <circle cx="12" cy="12" r="10" />
                            <line x1="12" y1="8" x2="12" y2="12" />
                            <line x1="12" y1="16" x2="12.01" y2="16" />
                        </svg>
                        Las contraseñas no coinciden.
                    </span>
                </div>

                <label class="terms-row">
                    <input type="checkbox" id="c-terms" name="terms">
                    <span>Acepto los <a href="#">términos y condiciones</a> y la <a href="#">política de privacidad</a></span>
                </label>
                <span class="error-msg" id="err-c-terms" style="margin-top:-8px;">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <circle cx="12" cy="12" r="10" />
                        <line x1="12" y1="8" x2="12" y2="12" />
                        <line x1="12" y1="16" x2="12.01" y2="16" />
                    </svg>
                    Debes aceptar los términos.
                </span>

                <button type="submit" class="btn-submit">Crear Cuenta</button>
            </form>

            <!-- FORM EMPRESA -->
            <form class="auth-form" id="formEmpresa" novalidate>
                <div class="form-group">
                    <label for="e-nombre">Nombre de la empresa</label>
                    <div class="input-wrap">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                            <path d="M3 21h18M5 21V7l8-4 8 4v14M9 21v-6h6v6" />
                        </svg>
                        <input type="text" id="e-nombre" name="nombre_empresa" placeholder="Ej: TechCorp SA" autocomplete="organization">
                    </div>
                    <span class="error-msg" id="err-e-nombre">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <circle cx="12" cy="12" r="10" />
                            <line x1="12" y1="8" x2="12" y2="12" />
                            <line x1="12" y1="16" x2="12.01" y2="16" />
                        </svg>
                        Ingresa el nombre de la empresa.
                    </span>
                </div>

                <div class="form-group">
                    <label for="e-razon">Razón social</label>
                    <div class="input-wrap">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                            <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z" />
                            <polyline points="14 2 14 8 20 8" />
                            <line x1="16" y1="13" x2="8" y2="13" />
                            <line x1="16" y1="17" x2="8" y2="17" />
                        </svg>
                        <input type="text" id="e-razon" name="razon_social" placeholder="Ej: TechCorp S.A." autocomplete="organization">
                    </div>
                    <span class="error-msg" id="err-e-razon">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <circle cx="12" cy="12" r="10" />
                            <line x1="12" y1="8" x2="12" y2="12" />
                            <line x1="12" y1="16" x2="12.01" y2="16" />
                        </svg>
                        Ingresa la razón social.
                    </span>
                </div>

                <div class="form-group">
                    <label for="e-email">Email</label>
                    <div class="input-wrap">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                            <rect x="2" y="4" width="20" height="16" rx="2" />
                            <path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7" />
                        </svg>
                        <input type="email" id="e-email" name="email" placeholder="contacto@empresa.com" autocomplete="email">
                    </div>
                    <span class="error-msg" id="err-e-email">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <circle cx="12" cy="12" r="10" />
                            <line x1="12" y1="8" x2="12" y2="12" />
                            <line x1="12" y1="16" x2="12.01" y2="16" />
                        </svg>
                        Ingresa un email válido.
                    </span>
                </div>

                <div class="form-row" style="display:grid;grid-template-columns:1fr 1fr;gap:1rem;">
                    <div class="form-group">
                        <label for="e-cuit">CUIT</label>
                        <div class="input-wrap">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                                <line x1="4" y1="9" x2="20" y2="9" />
                                <line x1="4" y1="15" x2="20" y2="15" />
                                <line x1="10" y1="3" x2="8" y2="21" />
                                <line x1="16" y1="3" x2="14" y2="21" />
                            </svg>
                            <input type="text" id="e-cuit" name="cuit" placeholder="30-12345678-9" maxlength="13" autocomplete="off">
                        </div>
                        <span class="error-msg" id="err-e-cuit">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <circle cx="12" cy="12" r="10" />
                                <line x1="12" y1="8" x2="12" y2="12" />
                                <line x1="12" y1="16" x2="12.01" y2="16" />
                            </svg>
                            Ingresa un CUIT válido (11 dígitos).
                        </span>
                    </div>
                    <div class="form-group">
                        <label for="e-telefono">Teléfono</label>
                        <div class="input-wrap">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                                <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z" />
                            </svg>
                            <input type="tel" id="e-telefono" name="telefono" placeholder="11 2345-6789" autocomplete="tel">
                        </div>
                        <span class="error-msg" id="err-e-telefono">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <circle cx="12" cy="12" r="10" />
                                <line x1="12" y1="8" x2="12" y2="12" />
                                <line x1="12" y1="16" x2="12.01" y2="16" />
                            </svg>
                            Ingresa un teléfono válido.
                        </span>
                    </div>
                </div>

                <div class="form-group">
                    <label for="e-ubicacion">Ubicación</label>
                    <div class="input-wrap">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                            <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z" />
                            <circle cx="12" cy="10" r="3" />
                        </svg>
                        <input type="text" id="e-ubicacion" name="ubicacion" placeholder="Ciudad / Provincia" autocomplete="address-level1">
                    </div>
                    <span class="error-msg" id="err-e-ubicacion">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <circle cx="12" cy="12" r="10" />
                            <line x1="12" y1="8" x2="12" y2="12" />
                            <line x1="12" y1="16" x2="12.01" y2="16" />
                        </svg>
                        Ingresa la ubicación.
                    </span>
                </div>

                <div class="form-group">
                    <label for="e-password">Contraseña</label>
                    <div class="input-wrap">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                            <rect x="3" y="11" width="18" height="11" rx="2" ry="2" />
                            <path d="M7 11V7a5 5 0 0 1 10 0v4" />
                        </svg>
                        <input type="password" id="e-password" name="password" placeholder="••••••••" autocomplete="new-password">
                        <button type="button" class="btn-eye" aria-label="Mostrar contraseña" onclick="window.togglePass('e-password', this)">
                            <svg class="icon-open" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                                <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z" />
                                <circle cx="12" cy="12" r="3" />
                            </svg>
                            <svg class="icon-closed" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" style="display:none">
                                <path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24" />
                                <line x1="1" y1="1" x2="23" y2="23" />
                            </svg>
                        </button>
                    </div>
                    <span class="error-msg" id="err-e-password">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <circle cx="12" cy="12" r="10" />
                            <line x1="12" y1="8" x2="12" y2="12" />
                            <line x1="12" y1="16" x2="12.01" y2="16" />
                        </svg>
                        Mínimo 6 caracteres.
                    </span>
                </div>

                <div class="form-group">
                    <label for="e-password2">Confirmar contraseña</label>
                    <div class="input-wrap">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                            <rect x="3" y="11" width="18" height="11" rx="2" ry="2" />
                            <path d="M7 11V7a5 5 0 0 1 10 0v4" />
                        </svg>
                        <input type="password" id="e-password2" name="password2" placeholder="••••••••" autocomplete="new-password">
                        <button type="button" class="btn-eye" aria-label="Mostrar contraseña" onclick="window.togglePass('e-password2', this)">
                            <svg class="icon-open" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                                <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z" />
                                <circle cx="12" cy="12" r="3" />
                            </svg>
                            <svg class="icon-closed" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" style="display:none">
                                <path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24" />
                                <line x1="1" y1="1" x2="23" y2="23" />
                            </svg>
                        </button>
                    </div>
                    <span class="error-msg" id="err-e-password2">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <circle cx="12" cy="12" r="10" />
                            <line x1="12" y1="8" x2="12" y2="12" />
                            <line x1="12" y1="16" x2="12.01" y2="16" />
                        </svg>
                        Las contraseñas no coinciden.
                    </span>
                </div>

                <label class="terms-row">
                    <input type="checkbox" id="e-terms" name="terms">
                    <span>Acepto los <a href="#">términos y condiciones</a> y la <a href="#">política de privacidad</a></span>
                </label>
                <span class="error-msg" id="err-e-terms" style="margin-top:-8px;">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <circle cx="12" cy="12" r="10" />
                        <line x1="12" y1="8" x2="12" y2="12" />
                        <line x1="12" y1="16" x2="12.01" y2="16" />
                    </svg>
                    Debes aceptar los términos.
                </span>

                <button type="submit" class="btn-submit">Crear Cuenta</button>
            </form>

            <div class="auth-footer">
                ¿Ya tienes cuenta? <a href="<?php echo $basePath; ?>/vistas/auth/login.php">Inicia sesión</a>
            </div>
        </div>
    </main>

    <script>
        /* ── Toggle password (global, fuera del IIFE) ── */
        window.togglePass = function(inputId, btn) {
            const input = document.getElementById(inputId);
            if (!input || !btn) return;
            const open = btn.querySelector('.icon-open');
            const closed = btn.querySelector('.icon-closed');
            if (input.type === 'password') {
                input.type = 'text';
                if (open) open.style.display = 'none';
                if (closed) closed.style.display = 'inline';
                btn.setAttribute('aria-label', 'Ocultar contraseña');
            } else {
                input.type = 'password';
                if (open) open.style.display = 'inline';
                if (closed) closed.style.display = 'none';
                btn.setAttribute('aria-label', 'Mostrar contraseña');
            }
        };

        (function() {
            const tabs = document.querySelectorAll('.role-tab');
            const formCand = document.getElementById('formCandidato');
            const formEmp = document.getElementById('formEmpresa');

            tabs.forEach(tab => {
                tab.addEventListener('click', () => {
                    tabs.forEach(t => t.classList.remove('active'));
                    tab.classList.add('active');
                    const role = tab.dataset.role;
                    if (role === 'candidato') {
                        formCand.classList.add('active');
                        formEmp.classList.remove('active');
                    } else {
                        formEmp.classList.add('active');
                        formCand.classList.remove('active');
                    }
                });
            });

            function isValidEmail(v) {
                return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(v);
            }

            function isValidPhone(v) {
                return /^[\d\s\-+()]{7,20}$/.test(v);
            }

            function isValidCuit(v) {
                const digits = v.replace(/\D/g, '');
                return digits.length === 11;
            }

            function showError(input, errEl, show) {
                if (!input || !errEl) return;
                if (show) {
                    input.classList.add('error');
                    errEl.classList.add('show');
                } else {
                    input.classList.remove('error');
                    errEl.classList.remove('show');
                }
            }

            /* ── Candidato ── */
            const c = {
                nombre: document.getElementById('c-nombre'),
                apellido: document.getElementById('c-apellido'),
                email: document.getElementById('c-email'),
                telefono: document.getElementById('c-telefono'),
                nacimiento: document.getElementById('c-nacimiento'),
                carrera: document.getElementById('c-carrera'),
                pass: document.getElementById('c-password'),
                pass2: document.getElementById('c-password2'),
                terms: document.getElementById('c-terms'),
            };
            const ce = {
                nombre: document.getElementById('err-c-nombre'),
                apellido: document.getElementById('err-c-apellido'),
                email: document.getElementById('err-c-email'),
                telefono: document.getElementById('err-c-telefono'),
                nacimiento: document.getElementById('err-c-nacimiento'),
                carrera: document.getElementById('err-c-carrera'),
                pass: document.getElementById('err-c-password'),
                pass2: document.getElementById('err-c-password2'),
                terms: document.getElementById('err-c-terms'),
            };
            Object.keys(c).forEach(k => {
                const el = c[k];
                if (!el) return;
                el.addEventListener('input', () => showError(el, ce[k], false));
                el.addEventListener('change', () => showError(el, ce[k], false));
            });
            formCand.addEventListener('submit', function(e) {
                e.preventDefault();
                let ok = true;
                if (!c.nombre.value.trim()) {
                    showError(c.nombre, ce.nombre, true);
                    ok = false;
                }
                if (!c.apellido.value.trim()) {
                    showError(c.apellido, ce.apellido, true);
                    ok = false;
                }
                if (!c.email.value.trim() || !isValidEmail(c.email.value.trim())) {
                    showError(c.email, ce.email, true);
                    ok = false;
                }
                if (!c.telefono.value.trim() || !isValidPhone(c.telefono.value.trim())) {
                    showError(c.telefono, ce.telefono, true);
                    ok = false;
                }
                if (!c.nacimiento.value) {
                    showError(c.nacimiento, ce.nacimiento, true);
                    ok = false;
                }
                if (!c.carrera.value) {
                    showError(c.carrera, ce.carrera, true);
                    ok = false;
                }
                if (!c.pass.value || c.pass.value.length < 6) {
                    showError(c.pass, ce.pass, true);
                    ok = false;
                }
                if (c.pass.value !== c.pass2.value || !c.pass2.value) {
                    showError(c.pass2, ce.pass2, true);
                    ok = false;
                }
                if (!c.terms.checked) {
                    showError(c.terms, ce.terms, true);
                    ok = false;
                }
                if (ok) {
                    console.log('Registro candidato OK', Object.fromEntries(new FormData(formCand)));
                }
            });

            /* ── Empresa ── */
            const e = {
                nombre: document.getElementById('e-nombre'),
                razon: document.getElementById('e-razon'),
                email: document.getElementById('e-email'),
                cuit: document.getElementById('e-cuit'),
                telefono: document.getElementById('e-telefono'),
                ubicacion: document.getElementById('e-ubicacion'),
                pass: document.getElementById('e-password'),
                pass2: document.getElementById('e-password2'),
                terms: document.getElementById('e-terms'),
            };
            const ee = {
                nombre: document.getElementById('err-e-nombre'),
                razon: document.getElementById('err-e-razon'),
                email: document.getElementById('err-e-email'),
                cuit: document.getElementById('err-e-cuit'),
                telefono: document.getElementById('err-e-telefono'),
                ubicacion: document.getElementById('err-e-ubicacion'),
                pass: document.getElementById('err-e-password'),
                pass2: document.getElementById('err-e-password2'),
                terms: document.getElementById('err-e-terms'),
            };
            Object.keys(e).forEach(k => {
                const el = e[k];
                if (!el) return;
                el.addEventListener('input', () => showError(el, ee[k], false));
                el.addEventListener('change', () => showError(el, ee[k], false));
            });
            e.cuit.addEventListener('input', function() {
                let v = this.value.replace(/\D/g, '').slice(0, 11);
                if (v.length > 2 && v.length <= 10) v = v.slice(0, 2) + '-' + v.slice(2, 10) + '-' + v.slice(10);
                else if (v.length > 10) v = v.slice(0, 2) + '-' + v.slice(2, 10) + '-' + v.slice(10);
                this.value = v;
            });
            formEmp.addEventListener('submit', function(ev) {
                ev.preventDefault();
                let ok = true;
                if (!e.nombre.value.trim()) {
                    showError(e.nombre, ee.nombre, true);
                    ok = false;
                }
                if (!e.razon.value.trim()) {
                    showError(e.razon, ee.razon, true);
                    ok = false;
                }
                if (!e.email.value.trim() || !isValidEmail(e.email.value.trim())) {
                    showError(e.email, ee.email, true);
                    ok = false;
                }
                if (!isValidCuit(e.cuit.value)) {
                    showError(e.cuit, ee.cuit, true);
                    ok = false;
                }
                if (!e.telefono.value.trim() || !isValidPhone(e.telefono.value.trim())) {
                    showError(e.telefono, ee.telefono, true);
                    ok = false;
                }
                if (!e.ubicacion.value.trim()) {
                    showError(e.ubicacion, ee.ubicacion, true);
                    ok = false;
                }
                if (!e.pass.value || e.pass.value.length < 6) {
                    showError(e.pass, ee.pass, true);
                    ok = false;
                }
                if (e.pass.value !== e.pass2.value || !e.pass2.value) {
                    showError(e.pass2, ee.pass2, true);
                    ok = false;
                }
                if (!e.terms.checked) {
                    showError(e.terms, ee.terms, true);
                    ok = false;
                }
                if (ok) {
                    console.log('Registro empresa OK', Object.fromEntries(new FormData(formEmp)));
                }
            });
        })();
    </script>
    <?php include '../../includes/footer.php'; ?>
    <script src="../../public/js/main.js"></script>
</body>

</html>