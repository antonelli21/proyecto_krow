<?php
/**
 * ayuda.php
 * Página de ayuda y preguntas frecuentes
 */

session_start();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ayuda - Krow</title>
    <link rel="stylesheet" href="../public/css/styles.css">
</head>
<body class="dark-mode">
    <?php include '../includes/header.php'; ?>
    
    <div class="container">
        <main>
            <h1>Centro de Ayuda</h1>
            
            <div class="ayuda-container">
                <h2>Preguntas Frecuentes</h2>
                
                <div class="faq-item">
                    <h3>¿Cómo crear mi cuenta?</h3>
                    <p>Dirígete a la página de registro y selecciona si eres estudiante o empresa. Completa los datos requeridos y tu cuenta será creada.</p>
                </div>
                
                <div class="faq-item">
                    <h3>¿Cómo postularme a una oferta?</h3>
                    <p>Si eres estudiante, busca la oferta que te interesa y presiona el botón "Postularme". Tu aplicación será enviada a la empresa.</p>
                </div>
                
                <div class="faq-item">
                    <h3>¿Cómo crear ofertas de empleo?</h3>
                    <p>Si eres empresa, ve a tu Base de Ofertas y presiona "Nueva Oferta". Completa los datos del puesto y publícalo.</p>
                </div>
                
                <div class="faq-item">
                    <h3>¿Cómo calificar a otras personas?</h3>
                    <p>Puedes dejar votos positivos o negativos en los perfiles de otros usuarios para contribuir a la reputación comunitaria.</p>
                </div>
                
                <div class="faq-item">
                    <h3>¿Cómo cambiar mis datos personales?</h3>
                    <p>Ve a tu perfil y presiona "Editar Información" para actualizar tus datos.</p>
                </div>
            </div>
            
            <div class="contacto-ayuda">
                <h2>¿No encontraste lo que buscas?</h2>
                <p>Contáctanos a través del formulario de contacto o envía un email a support@krow.com</p>
            </div>
        </main>
    </div>
    
    <?php include '../includes/footer.php'; ?>
</body>
</html>
