<?php if (!empty($block['data']['is_preview']) || !empty($is_preview)) : ?>
    <img src="<?= get_template_directory_uri() . '/acf/preview/cp-img-txt-cta.png' ?>"
         style="width:100%; height:auto;"
         alt="preview">
    <?php return; ?>
<?php endif; ?>

<?php
$id = 'cp-img-txt-cta-' . (!empty($block['id'])) ? $block['id'] : '';
if (!empty($block['anchor'])) {
    $id = $block['anchor'];
}

$fields = get_fields();
?>

<div id="<?= esc_attr($id) ?>" class="cp-img-txt-cta teq-container">
    <div class="teq-row max-w <?= (!empty($fields['format_img']) && $fields['format_img'] === 'portrait') ? 'column-r' : 'column' ?>  <?= (!empty($fields['pos_img']) && $fields['pos_img'] === 'gauche') ? 'row-lg' : 'row-r-lg' ?>">
        <div class="col-12 <?= (!empty($fields['format_img']) && $fields['format_img'] === 'portrait') ? 'col-lg-5 col-tab-4' : 'col-lg-6 col-tab-5' ?> mb-3 mb-tab-0 illust">
            <?php if (!empty($fields['image'])): ?>
                <img style="<?= ($fields['format_img'] === 'portrait') ? ' aspect-ratio: 3 / 4;' : 'aspect-ratio: 4 / 3;' ?>"
                     src="<?= ($fields['image']['url']) ?: '' ?>"
                     alt="<?= ($fields['image']['alt']) ?: $fields['image']['title'] ?>">
            <?php endif; ?>
        </div>
        <div class="col-12 <?= (!empty($fields['format_img']) && $fields['format_img'] === 'portrait') ? 'col-lg-7' : 'col-lg-6' ?> offset-tab-1 d-flex column my-auto">
            <div class="content">
                <?php if (!empty($fields['title'])): ?>
                    <h2 class="txt-44 w-700 c-dark mb-2"><?= $fields['title'] ?></h2>
                <?php endif; ?>
                <?php if (!empty($fields['txt'])): ?>
                    <div class="cp-wysiwyg mb-3">
                        <?= $fields['txt'] ?>
                    </div>
                <?php endif; ?>
                <?php if (!empty($fields['cta'])): ?>
                    <a href="<?= $fields['cta']['url'] ?? '' ?>" target="<?= $fields['cta']['target'] ?: '_self' ?>"
                       class="btn-primary arrow-next <?= (!empty($fields['format_img']) && $fields['format_img'] === 'portrait') ? 'mb-4 mb-tab-0' : '' ?>">
                        <?= $fields['cta']['title'] ?? '' ?>
                    </a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>