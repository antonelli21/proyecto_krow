<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login KROW</title>

    <style>
        .login-container {
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background: var(--bg);
        }

        .login-card {
            width: 100%;
            max-width: 420px;
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: 10px;
            padding: 28px;
        }

        .login-card h1 {
            color: var(--text);
            margin-bottom: 6px;
        }

        .subtitle {
            color: var(--muted);
            margin-bottom: 24px;
        }

        .role-selector {
            display: flex;
            gap: 8px;
            margin-bottom: 22px;
        }

        .role-btn {
            flex: 1;
            padding: 12px;
            background: transparent;
            border: 1px solid var(--border);
            color: var(--text);
            border-radius: 4px;
            cursor: pointer;
            transition: .2s;
        }

        .role-btn.active {
            background: var(--accent);
            color: var(--bg);
            border-color: var(--accent);
        }

        .form-group label {
            display: block;
            color: var(--text);
            margin-bottom: 8px;
        }

        .input-wrapper {
            position: relative;
        }

        .icon {
            position: absolute;
            left: 12px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--muted);
        }

        .input-wrapper input {
            width: 100%;
            padding: 12px 14px 12px 40px;
            background: var(--bg);
            color: var(--text);
            border: 1px solid var(--border);
            border-radius: 4px;
        }

        .input-wrapper input::placeholder {
            color: var(--muted);
        }

        .input-wrapper input:focus {
            border-color: var(--accent);
            outline: none;
        }

        .options {
            display: flex;
            justify-content: space-between;
            margin: 18px 0;
        }

        .remember {
            color: var(--text);
        }

        .forgot {
            color: var(--accent);
            text-decoration: none;
        }

        .login-btn {
            width: 100%;
            padding: 12px;
            border: none;
            border-radius: 4px;
            background: var(--accent);
            color: var(--bg);
            font-weight: 600;
            cursor: pointer;
        }

        .login-btn:hover {
            opacity: .9;
        }

        .register {
            margin-top: 20px;
            text-align: center;
            color: var(--muted);
        }

        .register a {
            color: var(--accent);
            text-decoration: none;
        }
    </style>
    <link rel="stylesheet" href="../../public/css/styles.css">
</head>

<body>
    <?php include '../../includes/header.php'; ?>
    <div class="login-container">
        <div class="login-card">

            <h1>Iniciar Sesión</h1>
            <p class="subtitle">Accede a tu cuenta de Banco de Trabajo</p>

            <div class="role-selector">
                <button class="role-btn active" onclick="changeRole(this)">
                    Candidato
                </button>

                <button class="role-btn" onclick="changeRole(this)">
                    Empresa
                </button>
            </div>

            <form>

                <div class="form-group">
                    <label>Email</label>

                    <div class="input-wrapper">
                        <span class="icon">✉</span>
                        <input type="email" placeholder="tu@alumnos.frh.utn.edu.ar">
                    </div>
                </div>

                <div class="form-group">
                    <label>Contraseña</label>

                    <div class="input-wrapper">
                        <span class="icon"><svg xmlns="http://www.w3.org/2000/svg"
                                width="18"
                                height="18"
                                viewBox="0 0 24 24"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="2"
                                stroke-linecap="round"
                                stroke-linejoin="round">
                                <rect x="3" y="11" width="18" height="11" rx="2" />
                                <path d="M7 11V7a5 5 0 0 1 10 0v4" />
                            </svg></span>
                        <input type="password" placeholder="••••••••">
                    </div>
                </div>

                <div class="options">

                    <label class="remember">
                        <input type="checkbox">
                        Recordarme
                    </label>

                    <a href="#" class="forgot">
                        ¿Olvidaste tu contraseña?
                    </a>

                </div>

                <button type="submit" class="login-btn">
                    Iniciar Sesión
                </button>

            </form>

            <div class="register">
                ¿No tienes cuenta?
                <a href="registro.php">Regístrate aquí</a>
            </div>

        </div>
    </div>

    <script>
        function changeRole(button) {

            document
                .querySelectorAll('.role-btn')
                .forEach(btn => btn.classList.remove('active'));

            button.classList.add('active');
        }
    </script>

</body>

</html>