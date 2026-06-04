<?php if (!empty($block['data']['is_preview']) || !empty($is_preview)) : ?>
    <img src="<?= get_template_directory_uri() . '/acf/preview/cp-multiple-img-txt.png' ?>"
         style="width:100%; height:auto;"
         alt="preview">
    <?php return; ?>
<?php endif; ?>

<?php
$id = 'cp-multiple-img-txt-' . (!empty($block['id'])) ? $block['id'] : '';
if (!empty($block['anchor'])) {
    $id = $block['anchor'];
}

$fields = get_fields();
$count = count($fields['list']);
?>

<div id="<?= esc_attr($id) ?>" class="cp-multiple-img-txt teq-container">
    <?php if (!empty($fields['title'])): ?>
        <div class="teq-row max-w">
            <div class="col-12">
                <h2 class="txt-44 w-700 c-dark mb-2"><?= $fields['title'] ?></h2>
            </div>
        </div>
    <?php endif; ?>
    <div class="teq-row max-w d-flex">
        <?php if (!empty($fields['list'])): ?>
            <?php foreach ($fields['list'] as $item) : ?>
                <figure class="col-12 <?= ($count > 2) ? 'col-md-4' : 'col-sm-6' ?> d-flex column width-fit height-auto relative">
                    <div class="illust">
                        <?php if (!empty($item['image'])): ?>
                            <img
                                    style="aspect-ratio: 4/3"
                                    class="m-width-100 height-auto"
                                    src="<?= ($item['image']['url']) ?: '' ?>"
                                    alt="<?= ($item['image']['alt']) ?: $item['image']['title'] ?>">
                        <?php endif; ?>
                    </div>
                    <?php if (!empty($item['legend'])): ?>
                        <figcaption class="width-100 w-400 txt-16 text-center mt-2"><?= $item['legend'] ?></figcaption>
                    <?php endif; ?>
                    <?php if (!empty($item['link'])): ?>
                        <a class="stretched-link" href="<?= $item['link'] ?>"
                           aria-label="lien vers <?= $item['link'] ?>"></a>
                    <?php endif; ?>
                </figure>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</div>