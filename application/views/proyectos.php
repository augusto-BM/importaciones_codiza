<link rel="stylesheet" href="<?= css_url('assets/css/proyectos.css'); ?>">
<!-- Banner Proyectos -->
<div class="banner-proyectos" style="background-image: url('<?= img_url("images/proyectos/banner-fajas-transportadoras.jpg") ?>');">
    <div class="banner-proyectos-content">
        <h1>Nuestros Proyectos</h1>
        <p>Conoce los proyectos exitosos que hemos realizado para nuestros clientes</p>
    </div>
</div>

<!-- Sección Proyectos Realizados -->
<section class="section-proyectos">
    <div class="container">
        <h2>Proyectos Realizados</h2>  
        <?php
            $proyectos = [
                [
                    "imagen" => "Industria-en-General.jpg",
                    "icono" => "fas fa-industry",
                    "titulo_small" => "Faja modular Intralox",
                    "titulo" => "Industria en General",
                    "descripcion" => "En la Industria En General brindamos soluciones a la Industria Envasadora, Plásticos, Cartoneras, Maderera, Textil, Lavanderías, Industria Gráfica y entre muchas más Industrias que existen en el Perú. Nosotros te brindamos la Solución a tu necesidad."
                ],
                [
                    "imagen" => "Mineria-Agregados-y-Ceramicos.jpg",
                    "icono" => "fas fa-gem",
                    "titulo_small" => "Faja modular Intralox",
                    "titulo" => "Minería, Agregados y Cerámicos",
                    "descripcion" => "Nuestras fajas transportadoras se usan principalmente para transportar materiales granulados, como en la industria minera, cerámicos, agregados, agrícola y muchas otras. La mina Las Bambas, Chancadora Andalucita, Ladrillera Zúñiga, Agroindustria Casa Grande Utilizan nuestras fajas transportadoras y sus componentes. Dándole a Nuestros clientes la solución a sus problemas. Consulte las características de las fajas transportadoras con la recomendación de nuestro experto."
                ],
                [
                    "imagen" => "Agroindustria-y-Pesqueria1.jpg",
                    "icono" => "fas fa-fish",
                    "titulo_small" => "Faja modular Intralox",
                    "titulo" => "Agroindustria y Pesquería",
                    "descripcion" => "En Viru S.A. Estamos comprometidos con brindar el mejor producto y servicio de garantía y buena calidad. Suministramos la línea de fajas sanitarias PVC, bandas modulares Flat Top, Revestimiento de Poleas, Cortinas de PVC, entre otros. Estamos dirigidos a las Agroindustria, Pesqueras, Cerveceras."
                ],
                [
                    "imagen" => "Molinos-Agropecuario-y-Avicola.jpg",
                    "icono" => "fas fa-cog",
                    "titulo_small" => "Faja modular Intralox",
                    "titulo" => "Molinos, Agropecuario y Avícola",
                    "descripcion" => "En el Terminal Internacional del Sur (TISUR) – Arequipa. Solucionamos el desmontaje y montaje de las Fajas y Cangilones del Elevador Del Molino. Asimismo, se realizó el mantenimiento de sus piezas y el cambio de la Faja transportadora que sale del silo y es transportado a la tolva de salida."
                ]
            ];
            ?>

            <div class="proyectos-grid">
                <?php foreach ($proyectos as $p): ?>
                    <div class="proyecto-card">
                        <div class="proyecto-imagen">
                            <img src="<?= base_url("images/proyectos/".$p['imagen']) ?>" alt="<?= $p['titulo'] ?>">
                            <div class="proyecto-overlay"></div>
                            <div class="proyecto-icon">
                                <i class="<?= $p['icono'] ?>"></i>
                            </div>
                        </div>

                        <div class="proyecto-content">
                            <h4><?= $p['titulo_small'] ?></h4>
                            <h3><?= $p['titulo'] ?></h3>
                            <p><?= $p['descripcion'] ?></p>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>

    </div>
</section>

<!-- Incluir CSS del carrusel de clientes -->
<?php $this->load->view('partials/clientes_carousel_css'); ?>

<!-- Incluir componente de clientes -->
<?php $this->load->view('partials/clientes_carousel', ['clientes' => $clientes]); ?>

<script src="<?= js_url('assets/js/proyectos.js'); ?>"></script>

<!-- Incluir JavaScript del carrusel de clientes -->
<?php $this->load->view('partials/clientes_carousel_js'); ?>
