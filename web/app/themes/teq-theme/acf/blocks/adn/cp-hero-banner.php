<?php if (!empty($block['data']['is_preview']) || !empty($is_preview)) : ?>
    <img src="<?= get_template_directory_uri() . '/acf/preview/cp-hero-banner.png' ?>"
         style="width:100%; height:auto;"
         alt="preview">
    <?php return; ?>
<?php endif; ?>

<?php
$id = 'cp-hero-banner-' . (!empty($block['id'])) ? $block['id'] : '';
if (!empty($block['anchor'])) {
    $id = $block['anchor'];
}

$fields = get_fields();
?>

<div id="<?= esc_attr($id) ?>" class="teq-container cp-hero-banner mt-0">
    <div class="teq-row">
        <div class="col-12">
            <div class="teq-row">
                <div class="swiper">
                    <div class="swiper-wrapper">
                        <?php if (!empty($fields['list'])): ?>
                            <?php foreach ($fields['list'] as $item) : ?>
                                <div class="flex-wrap swiper-slide d-flex align-center">
                                    <div class="col-12 col-md-6 content">
                                        <div class="<?= ($fields['text_align'] === 'centre') ? 'text-center' : '' ?>">
                                            <?php if (!empty($item['title'])): ?>
                                                <h2 class="txt-56 mb-3"><?= $item['title'] ?></h2>
                                            <?php endif; ?>
                                            <div class="txt <?= ($fields['text_align'] === 'centre') ? 'd-flex column align-center' : '' ?>">
                                                <?php if ($item['text']): ?>
                                                    <p class="txt-20 mb-5"><?= $item['text'] ?></p>
                                                <?php endif; ?>
                                                <?php if (!empty($item['cta'])): ?>
                                                    <a href="<?= $item['cta']['url'] ?? '' ?>"
                                                       target="<?= $item['cta']['target'] ?: '_self' ?>"
                                                       class="btn-primary arrow-nex">
                                                        <?= $item['cta']['title'] ?? '' ?>
                                                    </a>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6 images d-flex">
                                        <?php if (!empty($item['image'])): ?>
                                            <img src="<?= ($item['image']['url']) ?: '' ?>"
                                                 alt="<?= ($item['image']['alt']) ?: $item['image']['title'] ?>">
                                        <?php endif; ?>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                    <?php if (!empty($fields['list']) && count($fields['list']) > 1): ?>
                        <div class="cp-hero-banner-pagination d-flex <?= ($fields['text_align'] === 'centre') ? 'justify-center' : 'justify-end' ?>">

                        </div>

                        <div class="swiper-navigation">
                            <div class="swiper-button-prev cp-hero-banner-nav" data-dir="prev">
                                <button title="slide précédent" aria-label="slide précédent">
                                    <svg width="10" height="10" viewBox="0 0 10 10" fill="none"
                                         xmlns="http://www.w3.org/2000/svg">
                                        <path d="M6 9L2 5L6 1" stroke="white" stroke-width="2"/>
                                        <rect width="8" height="2" transform="matrix(-1 0 0 1 10 4)" fill="white"/>
                                    </svg>
                                </button>
                            </div>
                            <div class="swiper-button-next cp-hero-banner-nav" data-dir="next">
                                <button title="slide suivant" aria-label="slide suivant">
                                    <svg width="10" height="10" viewBox="0 0 10 10" fill="none"
                                         xmlns="http://www.w3.org/2000/svg">
                                        <path d="M4 9L8 5L4 1" stroke="white" stroke-width="2"/>
                                        <rect y="4" width="8" height="2" fill="white"/>
                                    </svg>
                                </button>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>