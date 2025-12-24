<?php
/**
 * Partial: Breadcrumbs
 * Genera breadcrumbs automáticamente según la página actual
 * Incluye Schema.org para SEO
 */

$ci = get_instance();
$controller = $ci->router->fetch_class();
$method = $ci->router->fetch_method();

// Construir breadcrumbs
$breadcrumbs = [
    ['url' => base_url(), 'title' => 'INICIO']
];

// Breadcrumbs según controlador
if ($controller == 'categoria' && $method == 'ver') {
    $breadcrumbs[] = ['url' => base_url('productos'), 'title' => 'PRODUCTOS'];
    if (isset($categoria_nombre)) {
        $breadcrumbs[] = ['url' => '', 'title' => $categoria_nombre];
    }
} elseif ($controller == 'producto' && $method == 'ver') {
    $breadcrumbs[] = ['url' => base_url('productos'), 'title' => 'PRODUCTOS'];
    if (isset($categoria_nombre)) {
        $breadcrumbs[] = ['url' => base_url('categoria/ver/' . $categoria_id), 'title' => $categoria_nombre];
    }
    if (isset($producto_nombre)) {
        $breadcrumbs[] = ['url' => '', 'title' => $producto_nombre];
    }
} elseif ($controller == 'nosotros') {
    $breadcrumbs[] = ['url' => '', 'title' => 'HOME'];
} elseif ($controller == 'servicios') {
    $breadcrumbs[] = ['url' => '', 'title' => 'VULCANIZADOS'];
} elseif ($controller == 'proyectos') {
    $breadcrumbs[] = ['url' => '', 'title' => 'INDUSTRIAS'];
} elseif ($controller == 'contacto') {
    $breadcrumbs[] = ['url' => '', 'title' => 'CONTACTO'];
}

// Solo mostrar si hay más de 1 nivel
if (count($breadcrumbs) > 1):
?>

<link rel="stylesheet" href="<?= css_url('assets/css/breadcrumb.css'); ?>">

<!-- Breadcrumbs HTML -->
<nav aria-label="breadcrumb" class="breadcrumb-container" id="mainBreadcrumb">
  <div class="container">
    <ol class="breadcrumb">
      <?php foreach ($breadcrumbs as $index => $crumb): ?>
        <?php if ($index == count($breadcrumbs) - 1 || empty($crumb['url'])): ?>
          <li class="breadcrumb-item active" aria-current="page"><?= htmlspecialchars($crumb['title']) ?></li>
        <?php else: ?>
          <li class="breadcrumb-item">
            <a href="<?= $crumb['url'] ?>"><?= htmlspecialchars($crumb['title']) ?></a>
          </li>
        <?php endif; ?>
      <?php endforeach; ?>
    </ol>
  </div>
</nav>

<!-- Schema.org para Breadcrumbs -->
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "BreadcrumbList",
  "itemListElement": [
    <?php foreach ($breadcrumbs as $index => $crumb): ?>
    {
      "@type": "ListItem",
      "position": <?= $index + 1 ?>,
      "name": "<?= htmlspecialchars($crumb['title'], ENT_QUOTES) ?>",
      "item": "<?= !empty($crumb['url']) ? $crumb['url'] : current_url() ?>"
    }<?= $index < count($breadcrumbs) - 1 ? ',' : '' ?>
    <?php endforeach; ?>
  ]
}
</script>

<?php endif; ?>
