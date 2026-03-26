<?php if (service('uri')->getSegment(1) !== 'newsletter'): ?>
    <?= view('newsletter/partials/subscribe_form') ?>
<?php endif; ?>

<footer class="site-footer">
    &copy; <?= date('Y') ?> <strong>Game Collection Show</strong>

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
