<?php if (!empty($block['data']['is_preview']) || !empty($is_preview)) : ?>
    <img src="<?= get_template_directory_uri() . '/acf/preview/cp-img.png' ?>"
         style="width:100%; height:auto;"
         alt="preview">
    <?php return; ?>
<?php endif; ?>

<?php
$id = 'cp-img-' . (!empty($block['id'])) ? $block['id'] : '';
if (!empty($block['anchor'])) {
    $id = $block['anchor'];
}

$fields = get_fields();
?>

<div id="<?= esc_attr($id) ?>" class="cp-img <?= ($fields['full_width'] === 'oui') ? 'full-img' : '' ?> teq-container">
    <?php if (!empty($fields['title'])): ?>
        <div class="teq-row max-w justify-center">
            <div class="col-12 col-tab-10">
                <h2 class="txt-44 w-700 c-dark mb-2 <?= ($fields['full_width'] === 'oui') ? 'text-center' : '' ?>"><?= $fields['title'] ?></h2>
            </div>
        </div>
    <?php endif; ?>
    <div class="teq-row justify-center max-w">
        <figure class="col-12 col-tab-10 d-flex column width-fit height-auto <?= ($fields['full_width'] === 'oui') ? 'px-0' : '' ?>">
            <div class="img-wrapper relative">
                <?php if (!empty($fields['image'])): ?>
                    <img class="m-width-100 height-auto"
                         src="<?= ($fields['image']['url']) ?: '' ?>"
                         alt="<?= ($fields['image']['alt']) ?: $fields['image']['title'] ?>">
                <?php endif; ?>
                <?php if (!empty($fields['link'])): ?>
                    <a class="stretched-link" href="<?= $fields['link'] ?>"
                       aria-label="lien vers <?= $fields['link'] ?>"></a>
                <?php endif; ?>
            </div>
            <?php if (!empty($fields['legend'])): ?>
                <figcaption class="width-100 w-400 txt-16 text-center mt-2"><?= $fields['legend'] ?></figcaption>
            <?php endif; ?>
        </figure>
    </div>
</div>