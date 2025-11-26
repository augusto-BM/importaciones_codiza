
<style>
     /* ======================================= */
/* BANNER FULL ANCHO RESPONSIVO           */
/* ======================================= */
.banner {
    width: 100%;
    height: 700px;
    background-image: url('<?= base_url("images/banner/contacto.jpg") ?>');
    background-size: cover;
    background-position: center;
    display: flex;
    justify-content: center;
    align-items: center;
    text-align: center;

    color: white;
    font-size: 36px;
    font-weight: bold;
    padding: 20px;
    text-shadow: 2px 2px 4px rgba(0,0,0,0.5);

    box-sizing: border-box;
}

/* Tablet y celular → esconder banner */
@media (max-width: 992px) {
    .banner {
        display: none !important;
    }
}

</style>

<div class="banner">
</div>

<section style="padding:60px 20px; background:white; text-align:center;">
    
    <h2 style="font-size:48px; font-weight:900; margin-bottom:15px;">
        ¿Cómo podemos ayudarte?
    </h2>

    <p style="font-size:20px; color:#555; margin-bottom:40px;">
        Estamos listos para atenderle, póngase en contacto con nosotros.
    </p>

    <form style="max-width:800px; margin:auto; text-align:left;">

        <div style="display:flex; gap:40px; margin-bottom:30px;">
            <div style="flex:1;">
                <label style="font-weight:600; margin-bottom:6px; display:block;">Apellidos:</label>
                <input type="text" name="apellidos" required
                style="width:100%; padding:14px; border-radius:8px; border:1px solid #ccc;">
            </div>

            <div style="flex:1;">
                <label style="font-weight:600; margin-bottom:6px; display:block;">Nombres:</label>
                <input type="text" name="nombres" required
                style="width:100%; padding:14px; border-radius:8px; border:1px solid #ccc;">
            </div>
        </div>

        <div style="display:flex; gap:40px; margin-bottom:30px;">
            <div style="flex:1;">
                <label style="font-weight:600; margin-bottom:6px; display:block;">Correo electrónico:</label>
                <input type="email" name="correo" required
                style="width:100%; padding:14px; border-radius:8px; border:1px solid #ccc;">
            </div>

            <div style="flex:1;">
                <label style="font-weight:600; margin-bottom:6px; display:block;">Celular:</label>
                <input type="text" name="celular" required
                style="width:100%; padding:14px; border-radius:8px; border:1px solid #ccc;">
            </div>
        </div>


        <div style="margin-bottom:20px;">
            <label style="font-weight:600;">Mensaje:</label>
            <textarea name="mensaje" rows="5" required
            style="width:100%; padding:12px; border-radius:8px; border:1px solid #ccc; resize:none;"></textarea>
        </div>

        <div style="text-align:center;">
            <button type="submit"
            style="
                background:#e63946;
                color:white;
                padding:14px 40px;
                border:none;
                border-radius:50px;
                font-size:18px;
                font-weight:700;
                cursor:pointer;
                transition:0.3s;
            "
            onmouseover="this.style.background='#c92e3a'"
            onmouseout="this.style.background='#e63946'">
                Enviar mensaje
            </button>
        </div>

    </form>

</section>

