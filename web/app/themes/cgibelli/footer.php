<div aria-hidden="true" id="grid" class="teq-container max-w-full w-full h-screen py-0 fixed top-0 left-1/2 -translate-x-1/2 z-10">
    <div class="teq-grid w-full">
        <?php for($i=0;$i < 24; $i++){ ?>
        <div class="col-span-1 bg-grid"></div>
        <?php } ?>
    </div>
</div>

</main>

<?php get_template_part('template-parts/footer'); ?>

<?php wp_footer(); ?>

</body>

</html>
