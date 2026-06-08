<?php if (!empty($block['data']['is_preview']) || !empty($is_preview)) : ?>
    <img src="<?= get_template_directory_uri() . '/acf/preview/cp-full-banner.png' ?>"
         style="width:100%; height:auto;"
         alt="preview">
    <?php return; ?>
<?php endif; ?>

<?php
$id = 'cp-full-banner' . (!empty($block['id'])) ? $block['id'] : '';
if (!empty($block['anchor'])) {
    $id = $block['anchor'];
}

$fields = get_fields();
?>

<div id="<?= esc_attr($id) ?>" class="cp-full-banner teq-container">
    <div class="teq-row sub-wrapper">
        <div class="swiper">
            <div class="swiper-wrapper mb-5 mb-tab-0 align-stretch">
                <?php if (!empty($fields['list'])): ?>
                    <?php foreach ($fields['list'] as $item) : ?>
                        <div class="swiper-slide relative">
                            <div class="col-12 d-flex column max-w content-wrapper <?= ($item['content_position'] === 'centre') ? 'centered' : '' ?> relative">
                                <div class="col-12 col-tab-7 offset-tab-1 content">
                                    <?php if (!empty($item['title'])): ?>
                                        <h2 class="txt-56 mb-2"><?= $item['title'] ?></h2>
                                    <?php endif; ?>
                                    <div class="txt <?= ($item['content_position'] === 'centre') ? 'justify-center d-flex flex-wrap' : '' ?>">
                                        <?php if (!empty($item['text'])): ?>
                                            <p class="txt-20 mb-4"><?= $item['text'] ?></p>
                                        <?php endif; ?>
                                        <?php if (!empty($item['cta'])): ?>
                                            <a href="<?= $item['cta']['url'] ?? '' ?>"
                                               target="<?= $item['cta']['target'] ?: '_self' ?>"
                                               class="btn-primary arrow-nex <?= ($item['content_position'] === 'centre') ? 'mb-6' : '' ?>">
                                                <?= $item['cta']['title'] ?? '' ?>
                                            </a>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 images d-flex mb-3 mb-tab-0 <?= ($item['add_background'] === 'oui') ? 'gradient' : '' ?>">
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
                <div class="cp-full-banner-pagination"></div>

                <div class="swiper-navigation">
                    <div class="swiper-button-prev cp-full-banner-nav ml-tab-2" data-dir="prev">
                        <button role="button" title="slide précédent" aria-label="slide précédent">
                            <svg width="10" height="10" viewBox="0 0 10 10" fill="none"
                                 xmlns="http://www.w3.org/2000/svg">
                                <path d="M6 9L2 5L6 1" stroke="white" stroke-width="2"/>
                                <rect width="8" height="2" transform="matrix(-1 0 0 1 10 4)" fill="white"/>
                            </svg>
                        </button>
                    </div>
                    <div class="swiper-button-next cp-full-banner-nav mr-tab-2" data-dir="next">
                        <button role="button" title="slide suivant" aria-label="slide suivant">
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