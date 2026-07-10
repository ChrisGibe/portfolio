<?php get_header(); ?>

    <div class="cp-404 h-[80vh]">
        <div class="teq-container h-full place-content-center">
            <div class="teq-grid">
                <div class="col-span-6 md:col-span-6 md:col-start-4 text-center place-items-center">
                    <h1 class="text-6xl neue font-bold">
                        404
                    </h1>
                    <p class="mt-6">The page you are looking for does not exist or has been moved.</p>
                    <a href="<?= esc_url(home_url()); ?>" class="cta-primary mt-14">
                        back to home
                    </a>
                </div>
            </div>
        </div>
    </div>

<?php get_footer();
