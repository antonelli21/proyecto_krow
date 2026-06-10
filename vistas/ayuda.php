<?php
// ─── CONFIGURACIÓN PARA HEADER ───
$isIncluded = true;
$pageTitle  = 'Ayuda';
$rol        = 'invitado'; // Cambiar según sesión real
$basePath   = '/guardalo_aca/proyecto_krow';
$publicPath = $basePath . '/public';

// ─── DATOS DE PRUEBA: PREGUNTAS FRECUENTES ───
// Reemplazar por consulta SQL: SELECT * FROM faqs ORDER BY orden
$faqs = [
    [
        'id' => 1,
        'pregunta' => '¿Cómo creo una cuenta en KROW?',
        'respuesta' => 'Para crear una cuenta, hacé clic en "Registro" en la parte superior derecha de la página. Completá tus datos personales, verificá tu email y listo. El proceso toma menos de 2 minutos. Podés registrarte como estudiante para buscar ofertas laborales, o como empresa para publicar vacantes.',
    ],
    [
        'id' => 2,
        'pregunta' => '¿Cómo postulo a una oferta de trabajo?',
        'respuesta' => 'Iniciá sesión con tu cuenta de estudiante, navegá por la base de ofertas o usá los filtros para encontrar lo que buscás. Al hacer clic en una oferta, verás el botón "Postularme". Tu perfil y CV se enviarán automáticamente a la empresa. Podés seguir el estado de tu postulación desde "Mis Postulaciones".',
    ],
    [
        'id' => 3,
        'pregunta' => '¿Puedo editar mi perfil después de crearlo?',
        'respuesta' => 'Sí, en cualquier momento. Ingresá a "Mi Perfil" desde el menú desplegable de tu cuenta (arriba a la derecha). Ahí podés actualizar tus datos personales, experiencia laboral, estudios, habilidades y subir un nuevo CV. Los cambios se reflejan inmediatamente en tus futuras postulaciones.',
    ],
    [
        'id' => 4,
        'pregunta' => '¿Cómo puedo ver el estado de mis postulaciones?',
        'respuesta' => 'Accedé a la sección "Mis Postulaciones" desde el menú principal. Allí verás una tabla con todas tus postulaciones, la fecha de envío, el puesto, la empresa y el estado actual (Postulado, En revisión, Preseleccionado, Contacto directo o Rechazado). Hacé clic en cualquier postulación para ver más detalles.',
    ],
    [
        'id' => 5,
        'pregunta' => '¿Las empresas pueden contactarme directamente?',
        'respuesta' => 'Sí. Si tu perfil está completo y marcás la opción "Visible para empresas", las empresas registradas en KROW podrán encontrarte en la base de candidatos y contactarte directamente a través de la plataforma. Siempre recibirás una notificación cuando una empresa te envíe un mensaje.',
    ],
    [
        'id' => 7,
        'pregunta' => '¿Cómo publico una oferta laboral como empresa?',
        'respuesta' => 'Registrate como empresa, verificá tu cuenta y accedé al "Panel Empresa". Desde allí hacé clic en "Nueva Oferta", completá los datos del puesto (título, descripción, requisitos, modalidad, salario) y publicala. Las ofertas se revisan en menos de 24 horas antes de aparecer en la plataforma.',
    ],
    [
        'id' => 8,
        'pregunta' => '¿Qué hago si olvidé mi contraseña?',
        'respuesta' => 'En la pantalla de inicio de sesión, hacé clic en "¿Olvidaste tu contraseña?". Ingresá tu email registrado y te enviaremos un enlace seguro para restablecerla. El enlace expira en 1 hora por seguridad. Si no recibís el email, revisá tu carpeta de spam.',
    ],
];

include '../includes//header.php';
?>
<link rel="stylesheet" href="../public/css/styles.css">
<style>
    /* ════════════════════════════════════════
   AYUDA — FAQ + FORMULARIO DE CONTACTO
════════════════════════════════════════ */
    .ayuda-page {
        max-width: 800px;
        margin: 0 auto;
        padding: 36px 24px 60px;
        display: flex;
        flex-direction: column;
        gap: 40px;
    }

    /* ── Títulos de sección ── */
    .ayuda-section-title {
        font-family: var(--font-display, system-ui);
        font-size: 24px;
        font-weight: 800;
        color: var(--text);
        margin-bottom: 10px;
        line-height: 1.2;
    }

    .ayuda-section-sub {
        font-size: 14.5px;
        color: var(--muted);
        margin-top: 10px;
        margin-bottom: 20px;
        line-height: 1.5;
    }

    /* ── FAQ Acordeones ── */
    .faq-list {
        display: flex;
        flex-direction: column;
        gap: 10px;
    }

    .faq-item {
        background: var(--surface);
        border: 0.5px solid var(--border);
        border-radius: var(--radius);
        overflow: hidden;
        transition: border-color .2s, box-shadow .2s;
    }

    .faq-item:hover {
        border-color: var(--accent);
    }

    .faq-item.active {
        border-color: var(--accent);
        box-shadow: 0 2px 12px rgba(0, 0, 0, .06);
    }

    [data-theme="dark"] .faq-item.active {
        box-shadow: 0 2px 12px rgba(0, 0, 0, .25);
    }

    .faq-question {
        width: 100%;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 16px;
        padding: 16px 20px;
        background: none;
        border: none;
        cursor: pointer;
        text-align: left;
        font-size: 15px;
        font-weight: 600;
        color: var(--text);
        transition: color .2s;
    }

    .faq-question:hover {
        color: var(--accent);
    }

    .faq-question-text {
        flex: 1;
        line-height: 1.4;
    }

    .faq-chevron {
        width: 20px;
        height: 20px;
        color: var(--muted);
        flex-shrink: 0;
        transition: transform .3s ease, color .2s;
    }

    .faq-item.active .faq-chevron {
        transform: rotate(180deg);
        color: var(--accent);
    }

    .faq-answer {
        max-height: 0;
        overflow: hidden;
        transition: max-height .35s ease, padding .35s ease;
    }

    .faq-item.active .faq-answer {
        max-height: 400px;
    }

    .faq-answer-inner {
        padding: 0 20px 18px 20px;
        font-size: 14px;
        color: var(--muted);
        line-height: 1.7;
    }

    /* ── Formulario de contacto ── */
    .contacto-card {
        background: var(--surface);
        border: 0.5px solid var(--border);
        border-radius: var(--radius);
        padding: 28px;
    }

    .contacto-form {
        display: flex;
        flex-direction: column;
        gap: 18px;
    }

    .form-row {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 16px;
    }

    @media (max-width: 560px) {
        .form-row {
            grid-template-columns: 1fr;
        }
    }

    .form-group {
        display: flex;
        flex-direction: column;
        gap: 6px;
    }

    .form-group label {
        font-size: 13px;
        font-weight: 600;
        color: var(--text);
    }

    .form-group label .required {
        color: var(--destructive, #d4183d);
        margin-left: 2px;
    }

    .form-input,
    .form-textarea {
        width: 100%;
        padding: 11px 14px;
        border: 1px solid var(--border);
        border-radius: var(--radius);
        background: var(--bg);
        color: var(--text);
        font-size: 14px;
        font-family: inherit;
        transition: border-color .2s, box-shadow .2s;
        resize: vertical;
    }

    .form-input::placeholder,
    .form-textarea::placeholder {
        color: var(--muted);
        opacity: .6;
    }

    .form-input:focus,
    .form-textarea:focus {
        outline: none;
        border-color: var(--accent);
        box-shadow: 0 0 0 3px rgba(46, 204, 154, .10);
    }

    [data-theme="dark"] .form-input:focus,
    [data-theme="dark"] .form-textarea:focus {
        box-shadow: 0 0 0 3px rgba(212, 168, 67, .12);
    }

    .form-textarea {
        min-height: 120px;
        line-height: 1.6;
    }

    .form-hint {
        font-size: 12px;
        color: var(--muted);
        margin-top: 2px;
    }

    /* Botón enviar */
    .btn-enviar {
        width: 100%;
        padding: 12px;
        background: var(--primary);
        color: #fff;
        border: none;
        border-radius: var(--radius);
        font-family: var(--font-display, system-ui);
        font-weight: 700;
        font-size: 14px;
        cursor: pointer;
        transition: opacity .2s, box-shadow .2s, transform .15s;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        margin-top: 4px;
    }

    .btn-enviar:hover {
        opacity: .9;
        box-shadow: 0 4px 16px rgba(13, 79, 60, .25);
        transform: translateY(-1px);
    }

    .btn-enviar:active {
        transform: translateY(0);
    }

    [data-theme="dark"] .btn-enviar {
        background: var(--accent);
        color: #111118;
    }

    [data-theme="dark"] .btn-enviar:hover {
        box-shadow: 0 4px 20px rgba(212, 168, 67, .25);
    }

    .btn-enviar:disabled {
        opacity: .5;
        cursor: not-allowed;
        transform: none;
    }

    /* Estado de envío */
    .form-status {
        display: none;
        align-items: center;
        gap: 8px;
        padding: 12px 16px;
        border-radius: var(--radius);
        font-size: 14px;
        font-weight: 500;
        animation: fadeInUp .3s ease;
    }

    .form-status.show {
        display: flex;
    }

    .form-status.success {
        background: rgba(46, 204, 154, .10);
        border: 0.5px solid rgba(46, 204, 154, .3);
        color: #2a9d6f;
    }

    [data-theme="dark"] .form-status.success {
        background: rgba(46, 204, 154, .08);
        color: #2ECC9A;
    }

    .form-status.error {
        background: rgba(212, 24, 61, .08);
        border: 0.5px solid rgba(212, 24, 61, .25);
        color: var(--destructive);
    }

    /* Spinner */
    .spinner {
        width: 16px;
        height: 16px;
        border: 2px solid rgba(255, 255, 255, .3);
        border-top-color: #fff;
        border-radius: 50%;
        animation: spin .8s linear infinite;
        display: none;
    }

    [data-theme="dark"] .spinner {
        border-color: rgba(17, 17, 24, .3);
        border-top-color: #111118;
    }

    .btn-enviar.loading .spinner {
        display: block;
    }

    .btn-enviar.loading .btn-text {
        display: none;
    }

    @keyframes spin {
        to {
            transform: rotate(360deg);
        }
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

<main class="ayuda-page">

    <!-- ════════════════════════════════════════
       PREGUNTAS FRECUENTES
  ════════════════════════════════════════ -->
    <section>
        <h1 class="ayuda-section-title">Preguntas Frecuentes</h1>
        <p class="ayuda-section-sub">Encontrá respuestas a las consultas más comunes sobre el uso de KROW.</p>

        <div class="faq-list" id="faq-list">
            <?php foreach ($faqs as $faq): ?>
                <div class="faq-item" data-faq-id="<?php echo $faq['id']; ?>">
                    <button class="faq-question" aria-expanded="false" onclick="toggleFaq(this)">
                        <span class="faq-question-text"><?php echo htmlspecialchars($faq['pregunta']); ?></span>
                        <svg class="faq-chevron" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <polyline points="6 9 12 15 18 9" />
                        </svg>
                    </button>
                    <div class="faq-answer">
                        <div class="faq-answer-inner">
                            <?php echo nl2br(htmlspecialchars($faq['respuesta'])); ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </section>

    <!-- ════════════════════════════════════════
       FORMULARIO DE CONTACTO
  ════════════════════════════════════════ -->
    <section>
        <div class="contacto-card">
            <h2 class="ayuda-section-title" style="margin-bottom: 4px;">Contáctanos</h2>
            <p class="ayuda-section-sub">¿No encontraste lo que buscabas? Envianos un mensaje y te responderemos lo antes posible.</p>

            <form class="contacto-form" id="form-contacto" novalidate>

                <div class="form-row">
                    <div class="form-group">
                        <label for="nombre">Nombre <span class="required">*</span></label>
                        <input type="text" id="nombre" name="nombre" class="form-input" placeholder="Tu nombre" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email <span class="required">*</span></label>
                        <input type="email" id="email" name="email" class="form-input" placeholder="tu@email.com" required>
                    </div>
                </div>

                <div class="form-group">
                    <label for="asunto">Asunto <span class="required">*</span></label>
                    <input type="text" id="asunto" name="asunto" class="form-input" placeholder="¿En qué podemos ayudarte?" required>
                </div>

                <div class="form-group">
                    <label for="mensaje">Mensaje <span class="required">*</span></label>
                    <textarea id="mensaje" name="mensaje" class="form-textarea" placeholder="Describí tu consulta o problema..." required></textarea>
                    <span class="form-hint">Mínimo 20 caracteres. Sé lo más específico posible para que podamos ayudarte mejor.</span>
                </div>

                <div class="form-status" id="form-status"></div>

                <button type="submit" class="btn-enviar" id="btn-enviar">
                    <span class="btn-text">Enviar mensaje</span>
                    <span class="spinner"></span>
                </button>

            </form>
        </div>
    </section>

</main>

<script>
    (function() {
        // ─── FAQ Acordeón ───
        window.toggleFaq = function(btn) {
            const item = btn.closest('.faq-item');
            const isOpen = item.classList.contains('active');

            // Cerrar todos los demás (comportamiento tipo acordeón)
            document.querySelectorAll('.faq-item.active').forEach(el => {
                if (el !== item) {
                    el.classList.remove('active');
                    el.querySelector('.faq-question').setAttribute('aria-expanded', 'false');
                }
            });

            if (isOpen) {
                item.classList.remove('active');
                btn.setAttribute('aria-expanded', 'false');
            } else {
                item.classList.add('active');
                btn.setAttribute('aria-expanded', 'true');
            }
        };

        // ─── Formulario de contacto ───
        const form = document.getElementById('form-contacto');
        const btn = document.getElementById('btn-enviar');
        const status = document.getElementById('form-status');

        form.addEventListener('submit', function(e) {
            e.preventDefault();

            const nombre = form.nombre.value.trim();
            const email = form.email.value.trim();
            const asunto = form.asunto.value.trim();
            const mensaje = form.mensaje.value.trim();

            // Validación básica
            if (!nombre || !email || !asunto || !mensaje) {
                showStatus('Completá todos los campos obligatorios.', 'error');
                return;
            }
            if (mensaje.length < 20) {
                showStatus('El mensaje debe tener al menos 20 caracteres.', 'error');
                return;
            }
            if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) {
                showStatus('Ingresá un email válido.', 'error');
                return;
            }

            // Simular envío (reemplazar por fetch a backend real)
            btn.disabled = true;
            btn.classList.add('loading');
            status.classList.remove('show', 'success', 'error');

            setTimeout(function() {
                btn.disabled = false;
                btn.classList.remove('loading');
                showStatus('¡Mensaje enviado con éxito! Te responderemos a la brevedad.', 'success');
                form.reset();

                // Ocultar mensaje después de 5 segundos
                setTimeout(function() {
                    status.classList.remove('show');
                }, 5000);
            }, 1500);
        });

        function showStatus(msg, type) {
            status.textContent = msg;
            status.className = 'form-status show ' + type;
        }
    })();
</script>
<script src="../public/js/main.js"></script>
<?php include '../includes/footer.php'; ?>