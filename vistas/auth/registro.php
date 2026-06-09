<!DOCTYPE html>
<html lang="es" data-theme="dark">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro - KROW</title>

    <style>
        .register-container {
            min-height: calc(100vh - 80px);
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 40px 20px;
        }

        .register-card {
            width: 100%;
            max-width: 480px;
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: var(--radius);
            padding: 2rem;
        }

        .register-card h1 {
            color: var(--text);
            margin-bottom: .25rem;
        }

        .subtitle {
            color: var(--muted);
            margin-bottom: 1.5rem;
        }

        .role-selector {
            display: flex;
            gap: .5rem;
            margin-bottom: 1.5rem;
        }

        .role-btn {
            flex: 1;
            padding: .75rem;
            border: 1px solid var(--border);
            border-radius: 4px;
            background: transparent;
            color: var(--text);
            cursor: pointer;
            transition: .2s;
        }

        .role-btn.active {
            background: var(--accent);
            color: var(--bg);
            border-color: var(--accent);
        }

        .form-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1rem;
        }

        .form-group {
            display: flex;
            flex-direction: column;
        }

        .form-group.full {
            grid-column: 1 / -1;
        }

        .form-group label {
            color: var(--text);
            font-size: .875rem;
            margin-bottom: .35rem;
        }

        .form-group input,
        .form-group select {
            height: 44px;
            border: 1px solid var(--border);
            border-radius: 4px;
            background: var(--bg);
            color: var(--text);
            padding: 0 .9rem;
        }

        .form-group input::placeholder {
            color: var(--muted);
        }

        .form-group input:focus,
        .form-group select:focus {
            outline: none;
            border-color: var(--accent);
        }

        .checkbox {
            display: flex;
            gap: .75rem;
            margin-top: 1.5rem;
        }

        .checkbox span {
            color: var(--text);
            font-size: .875rem;
        }

        .checkbox a {
            color: var(--accent);
            text-decoration: none;
        }

        .submit-btn {
            width: 100%;
            margin-top: 1.5rem;
            height: 46px;
            border: none;
            border-radius: 4px;
            background: var(--accent);
            color: var(--bg);
            font-weight: 600;
            cursor: pointer;
        }

        .login-link {
            text-align: center;
            margin-top: 1rem;
            color: var(--muted);
        }

        .login-link a {
            color: var(--accent);
            text-decoration: none;
        }

        @media(max-width:768px) {

            .form-grid {
                grid-template-columns: 1fr;
            }

        }
    </style>
</head>

<body>
    <?php include '../../includes/header.php'; ?>
    <main class="register-container">

        <div class="register-card">

            <h1>Crear Cuenta</h1>
            <p class="subtitle">Únete a KROW hoy</p>

            <div class="role-selector">
                <button class="role-btn active" data-role="candidate">
                    Candidato
                </button>

                <button class="role-btn" data-role="company">
                    Empresa
                </button>
            </div>

            <form>

                <div id="dynamic-fields"></div>

                <button class="submit-btn" type="submit">
                    Crear Cuenta
                </button>

                <div class="login-link">
                    ¿Ya tienes cuenta?
                    <a href="login.php">Iniciar sesión</a>
                </div>

            </form>

        </div>

    </main>

    <script>
        const candidateFields = `
<div class="form-grid">

    <div class="form-group">
        <label>Nombre</label>
        <input type="text" placeholder="Nombre" required>
    </div>

    <div class="form-group">
        <label>Apellido</label>
        <input type="text" placeholder="Apellido" required>
    </div>

    <div class="form-group full">
        <label>Email</label>
        <input type="email" placeholder="tu@alumnos.frh.utn.edu.ar" required>
    </div>

    <div class="form-group">
        <label>Teléfono</label>
        <input type="tel" placeholder="+54 11 1234-5678" required>
    </div>

    <div class="form-group">
        <label>Fecha de nacimiento</label>
        <input type="date" required>
    </div>

    <div class="form-group full">
        <label>Carrera</label>

        <select required>

            <option value="">
                Seleccionar carrera
            </option>

            <option>Ingeniería Aeronáutica</option>
            <option>Ingeniería Electrónica</option>
            <option>Ingeniería Industrial</option>
            <option>Ingeniería Mecánica</option>
            <option>Ingeniería Ferroviaria</option>
            <option>Licenciatura en Organización Industrial</option>
            <option>Tecnicatura Universitaria en Programación</option>
            <option>Tecnicatura Universitaria en Sistemas Informáticos</option>

        </select>

    </div>

    <div class="form-group">
        <label>Contraseña</label>
        <input type="password" placeholder="Contraseña" required>
    </div>

    <div class="form-group">
        <label>Confirmar contraseña</label>
        <input type="password" placeholder="Repetir Contraseña" required>
    </div>

</div>
`;

        const companyFields = `
<div class="form-grid">

    <div class="form-group full">
        <label>Nombre de la empresa</label>
        <input type="text" placeholder="KROW" required>
    </div>

    <div class="form-group full">
        <label>Razón social</label>
        <input type="text"  placeholder="KROW S.A." required>
    </div>

    <div class="form-group">
        <label>CUIT</label>
        <input type="text" placeholder="30-12345678-9" required>
    </div>

    <div class="form-group">
        <label>Teléfono</label>
        <input type="tel" placeholder="+54 11 1234-5678" required>
    </div>

    <div class="form-group full">
        <label>Ubicación</label>
        <input type="text" placeholder="Ciudad, Provincia" required>
    </div>

    <div class="form-group full">
        <label>Nombre del representante</label>
        <input type="text"  placeholder="Nombre" required>
    </div>

    <div class="form-group">
        <label>Email del representante</label>
        <input type="email" placeholder="juan.perez@empresa.com" required>
    </div>

    <div class="form-group">
        <label>Email empresarial</label>
        <input type="email" placeholder="rrhh@empresa.com" required>
    </div>

    <div class="form-group">
        <label>Contraseña</label>
        <input type="password" placeholder="Contraseña" required>
    </div>

    <div class="form-group">
        <label>Confirmar contraseña</label>
        <input type="password" placeholder="Repetir Contraseña" required>
    </div>

</div>
`;

        const container = document.getElementById('dynamic-fields');

        container.innerHTML = candidateFields;

        document.querySelectorAll('.role-btn').forEach(button => {

            button.addEventListener('click', () => {

                document
                    .querySelectorAll('.role-btn')
                    .forEach(btn => btn.classList.remove('active'));

                button.classList.add('active');

                container.innerHTML =
                    button.dataset.role === 'candidate' ?
                    candidateFields :
                    companyFields;

            });

        });
    </script>

</body>

</html>