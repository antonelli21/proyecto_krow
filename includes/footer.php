<?php
// Configurar ruta base
if (!isset($basePath)) {
    $basePath = '/guardalo_aca/proyecto_krow';
}
if (!isset($publicPath)) {
    $publicPath = $basePath . '/public';
}

// Variables por defecto
$showSocialLinks = $showSocialLinks ?? true;
$socialLinks = $socialLinks ?? [
    ['name' => 'LinkedIn', 'url' => '#'],
    ['name' => 'Instagram', 'url' => '#'],
    ['name' => 'Twitter', 'url' => '#'],
];
$footerColumns = $footerColumns ?? [
    [
        'title' => 'Redes Sociales',
        'type' => 'social',
        'content' => $socialLinks
    ],
    [
        'title' => 'Sobre KROW',
        'type' => 'text',
        'content' => 'KROW es una plataforma dedicada a conectar profesionales y empresas.'
    ],
    [
        'title' => 'Contacto',
        'type' => 'links',
        'content' => [
            ['label' => 'Contacto', 'url' => $basePath . '/vistas/ayuda.php'],
            ['label' => 'Servicio', 'url' => '#'],
            ['label' => 'Privacidad', 'url' => '#'],
        ]
    ]
];

$currentYear = date('Y');
?>

<footer>
    <div class="site-footer">
        <?php foreach ($footerColumns as $column): ?>
        <div class="footer-column">
            <h4><?php echo htmlspecialchars($column['title']); ?></h4>
            
            <?php if ($column['type'] === 'social'): ?>
                <ul>
                    <?php foreach ($column['content'] as $social): ?>
                    <li><a href="<?php echo htmlspecialchars($social['url']); ?>"><?php echo htmlspecialchars($social['name']); ?></a></li>
                    <?php endforeach; ?>
                </ul>
            
            <?php elseif ($column['type'] === 'text'): ?>
                <p><?php echo htmlspecialchars($column['content']); ?></p>
            
            <?php elseif ($column['type'] === 'links'): ?>
                <ul>
                    <?php foreach ($column['content'] as $link): ?>
                    <li><a href="<?php echo htmlspecialchars($link['url']); ?>"><?php echo htmlspecialchars($link['label']); ?></a></li>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>
        </div>
        <?php endforeach; ?>
    </div>

    <div class="footer-bottom">
        <p>&copy; <?php echo $currentYear; ?> KROW. Todos los derechos reservados.</p>
    </div>
</footer>