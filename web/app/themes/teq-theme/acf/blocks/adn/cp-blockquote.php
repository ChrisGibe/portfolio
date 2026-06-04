<?php if (!empty($block['data']['is_preview']) || !empty($is_preview)) : ?>
    <img src="<?= get_template_directory_uri() . '/acf/preview/cp-blockquote.png' ?>" style="width:100%; height:auto;"
         alt="preview">
    <?php return; ?>
<?php endif; ?>

<?php
$id = 'cp-blockquote-' . (!empty($block['id'])) ? $block['id'] : '';
if (!empty($block['anchor'])) {
    $id = $block['anchor'];
}

$fields = get_fields();
?>

<div id="<?= esc_attr($id) ?>" class="cp-blockquote teq-container">
    <div class="teq-row max-w">
        <div class="d-flex align-center <?= !empty($fields['image']) ? '' : 'justify-center' ?> column row-md container pt-md-8 pb-md-8">
            <?php if (!empty($fields['image'])): ?>
                <div class="col-8 col-sm-5 col-md-3 offset-md-1 illust mb-4 mb-md-0">
                    <img src="<?= ($fields['image']['url']) ?: '' ?>"
                         alt="<?= ($fields['image']['alt']) ?: $fields['image']['title'] ?>">
                </div>
            <?php endif; ?>
            <figure class="col-12 col-md-7 d-flex <?= !empty($fields['image']) ? 'column-r' : 'column' ?> column-md mb-0">
                <blockquote>
                    <?php if (!empty($fields['citation'])): ?>
                        <p class="txt-18 w-400 mb-2 text-center <?= !empty($fields['image']) ? 'text-md-left' : '' ?>"><?= $fields['citation'] ?></p>
                    <?php endif; ?>
                </blockquote>
                <figcaption>
                    <?php if (!empty($fields['author'])): ?>
                        <p class="txt-16 w-400 text-center <?= $fields['image'] ? 'text-md-left' : '' ?> mb-2 mb-md-0"><?= $fields['author'] ?></p>
                    <?php endif; ?>
                </figcaption>
            </figure>
        </div>
    </div>
</div>