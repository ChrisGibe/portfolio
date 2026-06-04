<?php if (!empty($block['data']['is_preview']) || !empty($is_preview)) : ?>
    <img src="<?= get_template_directory_uri() . '/acf/preview/cp-title-text-cta.png' ?>"
         style="width:100%; height:auto;"
         alt="preview">
    <?php return; ?>
<?php endif; ?>

<?php
$id = 'cp-title-txt-cta-' . (!empty($block['id'])) ? $block['id'] : '';
if (!empty($block['anchor'])) {
    $id = $block['anchor'];
}

$fields = get_fields();
?>

<div id="<?= esc_attr($id) ?>"
     class="teq-container cp-title-txt-cta <?= (!empty($fields['text_pos']) && $fields['text_pos'] === 'centre') ? 'centered' : '' ?>">
    <div class="teq-row max-w container">
        <div class="col-12 col-lg-10 col-tab-8">
            <?php if (!empty($fields['title'])): ?>
                <h2 class="txt-44 w-700 c-dark mb-2"><?= $fields['title'] ?></h2>
            <?php endif; ?>
            <?php if (!empty($fields['txt'])): ?>
                <p class="txt-20 w-400 c-dark mb-4"><?= $fields['txt'] ?></p>
            <?php endif; ?>
            <?php if (!empty($fields['cta'])): ?>
                <a href="<?= $fields['cta']['url'] ?? '' ?>" target="<?= $fields['cta']['target'] ?: '_self' ?>"
                   class="btn-primary arrow-next">
                    <?= $fields['cta']['title'] ?? '' ?>
                </a>
            <?php endif; ?>
        </div>
    </div>
</div>