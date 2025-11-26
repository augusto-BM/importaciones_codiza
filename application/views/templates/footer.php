<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Footer Ejemplo</title>
<style>
    body {
        margin: 0;
        padding: 0;
        font-family: Arial, sans-serif;
        background-color: #f5f5f5;
    }

    footer {
        background-color: #333;
        color: white;
        padding: 40px 50px;
        display: flex;
        flex-direction: column;
    }

    .footer-top {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        gap: 50px;
        margin-bottom: 20px;
        flex-wrap: wrap;
    }

    .footer-left {
        flex: 1;
        max-width: 400px;
    }

    .footer-left .logo img {
        width: 430px;
        margin-bottom: 15px;
    }

    .footer-left p {
        margin: 5px 0;
        font-size: 14px;
    }

    .footer-right {
        flex: 2;
    }

    .footer-right h3 {
        margin-bottom: 15px;
    }

    .footer-products {
        display: flex;
        flex-wrap: wrap;
        gap: 30px;
    }

    .footer-products .columna h4 {
        margin-bottom: 5px;
        font-size: 14px;
    }

    .footer-products .columna a {
        display: block;
        color: #fff;
        text-decoration: none;
        font-size: 13px;
        margin-bottom: 3px;
    }

.footer-products .columna a:hover {
    text-decoration: none; /* o lo dejas si quieres subrayado */
    background-color: #fff; /* fondo blanco */
    color: #000;            /* texto negro */
    padding: 2px 4px;       /* opcional: un poco de espacio para que se vea mejor */
    border-radius: 3px;     /* opcional: bordes redondeados */
    transition: 0.3s;       /* suave transición */
}


.footer-bottom {
    display: flex;
    justify-content: space-between;
    align-items: center;
    border-top: 1px solid #444;
    padding-top: 20px;
    flex-wrap: wrap;
    font-size: 13px;
}

.footer-bottom .social-icons {
    display: flex;
    gap: 10px;
}

.footer-bottom .social-icons a {
    display: inline-flex;
    justify-content: center;
    align-items: center;
    width: 40px;
    height: 40px;
    border-radius: 50%;
    color: #fff;
    font-size: 18px;
    text-decoration: none;
    transition: all 0.3s ease;
}

/* ---- COLORES INDIVIDUALES ---- */
.footer-bottom .social-icons a.facebook {
    background-color: #1877F2;
}
.footer-bottom .social-icons a.twitter {
    background-color: #1DA1F2;
}
.footer-bottom .social-icons a.instagram {
    background: linear-gradient(45deg, #feda75, #d62976, #962fbf, #4f5bd5);
}
.footer-bottom .social-icons a.youtube {
    background-color: #FF0000;
}
.footer-bottom .social-icons a.whatsapp {
    background-color: #25D366;
}

/* 🔥 TIKTOK (colores oficiales) */
.footer-bottom .social-icons a.tiktok {
    background: linear-gradient(45deg, #25F4EE, #FE2C55);
}

/* Hover: agranda y aclara el color */
.footer-bottom .social-icons a:hover {
    transform: scale(1.15);
    filter: brightness(1.15);
}

/* Responsive */
@media screen and (max-width: 768px) {
    .footer-top {
        flex-direction: column;
    }

    .footer-right {
        margin-top: 30px;
    }

    .footer-bottom {
        flex-direction: column;
        gap: 10px;
    }

    .footer-bottom .social-icons {
        margin-top: 10px;
    }
}


/* aquí va todo tu CSS del footer y del body */

/* BOTÓN FLOTANTE DE WHATSAPP */
.whatsapp-float {
    position: fixed;      /* fijo en pantalla */
    bottom: 20px;         
    right: 20px;          
    background-color: #25D366;
    color: white;
    border-radius: 50%;
    width: 60px;
    height: 60px;
    display: flex;
    justify-content: center;
    align-items: center;
    font-size: 30px;
    box-shadow: 0 4px 8px rgba(0,0,0,0.3);
    z-index: 9999;
    text-decoration: none;
    transition: transform 0.3s, box-shadow 0.3s;
}
.whatsapp-float:hover {
    transform: scale(1.1);
    box-shadow: 0 6px 12px rgba(0,0,0,0.4);
}

</style>
</head>



<footer>
    
    <div class="footer-top">
        <div class="footer-left">
            <div class="logo">
                <img src="<?= base_url('images/logo/logo.png') ?>" alt="Logo">
            </div>
            <p>Ventas, importación y distribución de herramientas para la industria de metalmecánica</p>
            <p>+51 972 156 330</p>
            <p>Av. Argentina 469 lima lima, Lima 15082</p>
            <div class="footer-bottom">
                <div class="social-icons">
                    <a href="#" class="facebook"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" class="twitter"><i class="fab fa-twitter"></i></a>
                    <a href="#" class="instagram"><i class="fab fa-instagram"></i></a>
                    <a href="#" class="youtube"><i class="fab fa-youtube"></i></a>
                    <a href="#" class="whatsapp"><i class="fab fa-whatsapp"></i></a>
                    <a href="#" class="tiktok"><i class="fab fa-tiktok"></i></a>
                </div>
            </div>
        </div>

        <div class="footer-right">
            <h3>Productos</h3>
            <div class="footer-products">
                <?php foreach ($menu as $categoria => $productos): ?>
                    <div class="columna">
                        <h4><?= $categoria ?></h4>
                        <?php foreach ($productos as $p): ?>
                            <a href="<?= base_url('productos/ver/' . $p['id']); ?>" class="item">
                                <?= $p['nombre'] ?>
                            </a>
                        <?php endforeach; ?>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>

<div class="footer-bottom">
    <p>@2025 FERRETERIA MAYTA - Todos los derechos reservados.</p>
</div>
</footer>
<!-- BOTÓN FLOTANTE DE WHATSAPP -->
<!-- BOTÓN FLOTANTE DE WHATSAPP -->
<a href="https://wa.me/51972156330" target="_blank" class="whatsapp-float">
    <i class="fab fa-whatsapp"></i>
</a>
</body>
</html>
