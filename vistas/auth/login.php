<?php

/**
 * KROW — login.php
 * Iniciar sesión (sin selector de rol)
 */
if (!isset($basePath)) {
    $basePath = '/guardalo_aca/proyecto_krow';
}
if (!isset($publicPath)) {
    $publicPath = $basePath . '/public';
}
?>
<!DOCTYPE html>
<html lang="es" data-theme="dark">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión - KROW</title>
    <link rel="stylesheet" href="<?php echo $publicPath; ?>/css/styles.css">
    <style>
        /* ── Login layout ── */
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
            max-width: 420px;
            background: var(--surface);
            border: 0.5px solid var(--border);
            border-radius: var(--radius);
            padding: 2.25rem 2rem;
            box-shadow: var(--shadow-card);
            animation: fadeInUp 0.35s ease;
        }

        .auth-head {
            margin-bottom: 1.5rem;
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

        /* ── Form ── */
        .auth-form {
            display: flex;
            flex-direction: column;
            gap: 1.1rem;
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

        .input-wrap input {
            width: 100%;
            padding: 0.7rem 2.8rem 0.7rem 2.6rem;
            border: 1px solid var(--border);
            border-radius: var(--radius);
            background: var(--bg-input);
            color: var(--text);
            font-size: 0.95rem;
            font-family: var(--font-body);
            transition: border-color 0.2s, box-shadow 0.2s;
        }

        .input-wrap input:focus {
            outline: none;
            border-color: var(--accent);
            box-shadow: 0 0 0 3px rgba(46, 204, 154, 0.12);
        }

        .input-wrap input::placeholder {
            color: var(--text-muted);
        }

        .input-wrap input.error {
            border-color: var(--destructive);
            box-shadow: 0 0 0 3px rgba(212, 24, 61, 0.12);
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

        /* ── Options row ── */
        .form-options {
            display: flex;
            align-items: center;
            justify-content: space-between;
            font-size: 0.85rem;
            margin-top: -0.2rem;
        }

        .checkbox-label {
            display: flex;
            align-items: center;
            gap: 0.4rem;
            cursor: pointer;
            color: var(--muted);
            font-size: 0.85rem;
        }

        .checkbox-label input {
            accent-color: var(--accent);
            width: 16px;
            height: 16px;
            cursor: pointer;
        }

        .link-recover {
            color: var(--primary);
            text-decoration: none;
            font-weight: 500;
            font-size: 0.85rem;
            transition: color 0.15s;
        }

        .link-recover:hover {
            color: var(--accent);
        }

        [data-theme="dark"] .link-recover {
            color: var(--accent);
        }

        /* ── Button ── */
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
    $pageTitle = 'Iniciar Sesión';
    $rol = 'invitado';
    include '../../includes/header.php';
    ?>

    <main class="auth-page">
        <div class="auth-card">
            <div class="auth-head">
                <h1>Iniciar Sesión</h1>
                <p>Accede a tu cuenta de Banco de Trabajo</p>
            </div>

            <form class="auth-form" id="loginForm" novalidate>
                <!-- Email -->
                <div class="form-group">
                    <label for="email">Email</label>
                    <div class="input-wrap">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                            <rect x="2" y="4" width="20" height="16" rx="2" />
                            <path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7" />
                        </svg>
                        <input type="email" id="email" name="email" placeholder="tu@email.com" autocomplete="email">
                    </div>
                    <span class="error-msg" id="err-email">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <circle cx="12" cy="12" r="10" />
                            <line x1="12" y1="8" x2="12" y2="12" />
                            <line x1="12" y1="16" x2="12.01" y2="16" />
                        </svg>
                        Ingresa un email válido.
                    </span>
                </div>

                <!-- Contraseña -->
                <div class="form-group">
                    <label for="password">Contraseña</label>
                    <div class="input-wrap">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                            <rect x="3" y="11" width="18" height="11" rx="2" ry="2" />
                            <path d="M7 11V7a5 5 0 0 1 10 0v4" />
                        </svg>
                        <input type="password" id="password" name="password" placeholder="••••••••" autocomplete="current-password">
                        <button type="button" class="btn-eye" aria-label="Mostrar contraseña" onclick="window.togglePass('password', this)">
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
                    <span class="error-msg" id="err-password">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <circle cx="12" cy="12" r="10" />
                            <line x1="12" y1="8" x2="12" y2="12" />
                            <line x1="12" y1="16" x2="12.01" y2="16" />
                        </svg>
                        Ingresa tu contraseña.
                    </span>
                </div>

                <!-- Opciones -->
                <div class="form-options">
                    <label class="checkbox-label">
                        <input type="checkbox" name="remember" id="remember">
                        Recordarme
                    </label>
                    <a href="<?php echo $basePath; ?>/vistas/auth/recuperar.php" class="link-recover">¿Olvidaste tu contraseña?</a>
                </div>

                <button type="submit" class="btn-submit">Iniciar Sesión</button>
            </form>

            <div class="auth-footer">
                ¿No tienes cuenta? <a href="<?php echo $basePath; ?>/vistas/auth/registro.php">Registrate aquí</a>
            </div>
        </div>
    </main>

    <script>
        /* ── Toggle password (global) ── */
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
            const form = document.getElementById('loginForm');
            const email = document.getElementById('email');
            const password = document.getElementById('password');
            const errEmail = document.getElementById('err-email');
            const errPassword = document.getElementById('err-password');

            function isValidEmail(v) {
                return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(v);
            }

            function showError(input, errEl, show) {
                if (show) {
                    input.classList.add('error');
                    errEl.classList.add('show');
                } else {
                    input.classList.remove('error');
                    errEl.classList.remove('show');
                }
            }

            email.addEventListener('input', () => showError(email, errEmail, false));
            password.addEventListener('input', () => showError(password, errPassword, false));

            form.addEventListener('submit', function(e) {
                e.preventDefault();
                let ok = true;

                const vEmail = email.value.trim();
                if (!vEmail || !isValidEmail(vEmail)) {
                    showError(email, errEmail, true);
                    ok = false;
                }

                const vPass = password.value;
                if (!vPass) {
                    showError(password, errPassword, true);
                    ok = false;
                }

                if (ok) {
                    console.log('Login OK', {
                        email: vEmail,
                        remember: document.getElementById('remember').checked
                    });
                }
            });
        })();
    </script>
    <?php include '../../includes/footer.php'; ?>
    <script src="../../public/js/main.js"></script>
</body>

</html>