<?php if (!empty($block['data']['is_preview']) || !empty($is_preview)) : ?>
    <img src="<?= get_template_directory_uri() . '/acf/preview/cp-simple-slider.png' ?>"
         style="width:100%; height:auto;"
         alt="preview">
    <?php return; ?>
<?php endif; ?>

<?php
$id = 'cp-simple-slider-' . (!empty($block['id'])) ? $block['id'] : '';
if (!empty($block['anchor'])) {
    $id = $block['anchor'];
}

$fields = get_fields();
?>

<div id="<?= esc_attr($id) ?>" class="teq-container cp-simple-slider simple-s">
    <div class="teq-row max-w mb-8">
        <div class="col-8 column">
            <?php if (!empty($fields['title'])) : ?>
                <h3 class="txt-32 w-700 c-dark mb-2"><?= $fields['title'] ?></h3>
            <?php endif; ?>
            <?php if (!empty($fields['txt'])) : ?>
                <p class="txt-20 w-400 c-dark"><?= $fields['txt'] ?></p>
            <?php endif; ?>
        </div>
    </div>
    <div class="teq-row max-w">
        <div class="swiper cp-slider" data-nb-slides-desktop="4" data-nb-slides-tablet="2" data-nb-slides-mobile="1"
             data-space="32" data-space-mobile="16">
            <div class="swiper-navigation-prev">
                <button type="button" class="swiper-button-prev" aria-label="Slider à gauche">
                    <svg width="10" height="10" viewBox="0 0 10 10" fill="none"
                         xmlns="http://www.w3.org/2000/svg">
                        <path d="M6 9L2 5L6 1" stroke="white" stroke-width="2"/>
                        <rect width="8" height="2" transform="matrix(-1 0 0 1 10 4)" fill="white"/>
                    </svg>
                </button>
            </div>
            <?php if (!empty($fields['list'])) : ?>
                <div class="swiper-wrapper mb-8">
                    <?php foreach ($fields['list'] as $item) {
                        include(get_template_directory() . '/acf/blocks/adn/_partials/card-slider.php');
                    } ?>
                </div>
                <div class="swiper-navigation-next">
                    <button type="button" class="swiper-button-next" aria-label="Slider à droite">
                        <svg width="10" height="10" viewBox="0 0 10 10" fill="none"
                             xmlns="http://www.w3.org/2000/svg">
                            <path d="M4 9L8 5L4 1" stroke="white" stroke-width="2"/>
                            <rect y="4" width="8" height="2" fill="white"/>
                        </svg>
                    </button>
                </div>
                <div class="swiper-scrollbar" role="scrollbar" aria-hidden="true"></div>
            <?php endif; ?>
        </div>
    </div>
</div>