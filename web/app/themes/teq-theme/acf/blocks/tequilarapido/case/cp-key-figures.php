<?php if (!empty($block['data']['is_preview']) || !empty($is_preview)) : ?>
    <img src="<?= get_template_directory_uri() . '/acf/preview/cp-key-figures.png' ?>" style="width:100%; height:auto;"
         alt="preview">
    <?php return; ?>
<?php endif; ?>

<?php
$id = 'cp-key-figures-' . (!empty($block['id'])) ? $block['id'] : '';
if (!empty($block['anchor'])) {
    $id = $block['anchor'];
}

$fields = get_fields();
$count = count($fields['list']);
?>

<div class="cp-key-figures teq-container relative">
    <?php if (!empty($fields['title'])): ?>
        <div class="teq-row max-w">
            <div class="col-12 title">
                <h2 class="w-600 c-white text-uppercase"><?= $fields['title'] ?></h2>
            </div>
        </div>
    <?php endif; ?>
    <div class="teq-row max-w align-stretch gap-56 gap-lg-0 container">
        <?php if (!empty($fields['list'])): ?>
            <?php foreach ($fields['list'] as $item) : ?>
                <div class="card-wrapper col-12 col-sm-4 height-auto">
                    <div class="d-flex column align-center justify-center height-100 text-center pl-2 pr-2">
                        <?php if ($item['title']): ?>
                            <h2 class="c-white neue text-uppercase title-key">
                                <?= $item['title'] ?>
                            </h2>
                        <?php endif; ?>
                        <?php if ($item['text']): ?>
                            <p class="txt-16 c-white d-flex align-item height-100">
                                <?= $item['text'] ?>
                            </p>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
    <span class="line absolute"></span>
</div>