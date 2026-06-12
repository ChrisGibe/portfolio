<?php get_header(); ?>

    <div class="cp-404">
        <div class="teq-container">
            <h1>NO RESULTS FOUND <br>
                <span>
                    The page you requested could not be found. Try refining your search, or use the navigation above to locate the post.
                </span>
            </h1>
            <a href="<?= esc_url(home_url()); ?>" class="btn">
                retour à l’acceuil
            </a>
        </div>
    </div>

<?php get_footer();
