<footer class="site-footer">
    &copy; <?= date('Y') ?> <strong>Game Collection Show</strong>
    <p>
        <a href="https://www.instagram.com/wilmerseventos/" target="_blank" style="color: #ccc; text-decoration: underline;">Instagram Wilmers Eventos</a> |
        <a href="https://www.facebook.com/profile.php?id=61557788171224" target="_blank" style="color: #ccc; text-decoration: underline;">Facebook</a> |
        <a href="https://www.instagram.com/gamecollectionshow/" target="_blank" style="color: #ccc; text-decoration: underline;">Instagram</a>
    </p>
</footer>

<script src="https://cdn.jsdelivr.net/npm/glightbox/dist/js/glightbox.min.js"></script>

<script>
    const lightbox = GLightbox({
        selector: '.glightbox'
    });
</script>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const toggle = document.querySelector(".menu-toggle");
        const menu = document.querySelector(".site-menu");
        const links = document.querySelectorAll(".site-menu a");

        if (toggle) {
            toggle.addEventListener("click", function() {
                menu.classList.toggle("is-open");
                toggle.classList.toggle("is-active");
            });
        }

        // Fecha o menu ao clicar em um link (mobile)
        links.forEach(link => {
            link.addEventListener("click", () => {
                menu.classList.remove("is-open");
                toggle.classList.remove("is-active");
            });
        });
    });
</script>

<script>
    window.addEventListener("scroll", function() {
        const header = document.querySelector(".site-header");
        header.classList.toggle("scrolled", window.scrollY > 10);
    });
</script>


</body>

</html>