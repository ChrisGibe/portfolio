<?php if (!empty($block['data']['is_preview']) || !empty($is_preview)) : ?>
    <img src="<?= get_template_directory_uri() . '/acf/preview/cp-collapser.png' ?>"
         style="width:100%; height:auto;"
         alt="preview">
    <?php return; ?>
<?php endif; ?>

<?php
$id = 'cp-collapser-' . (!empty($block['id'])) ? $block['id'] : '';
if (!empty($block['anchor'])) {
    $id = $block['anchor'];
}

$fields = get_fields();
?>

<?php $i = 0 ?>
<div id="<?= esc_attr($id) ?>" class="cp-collapser teq-container <?= $fields['collapse'] ? 'auto-collapse' : '' ?>">
    <?php if (!empty($fields['title'])): ?>
    <div class="teq-row max-w">
        <div class="col-12 col-tab-10 offset-tab-1">
            <h2 class="txt-44 w-700 c-dark mb-2"><?= $fields['title'] ?></h2>
        </div>
    </div>
    <?php endif; ?>
    <?php if (!empty($fields['list'])) : ?>
        <?php foreach ($fields['list'] as $item) : ?>
            <div class="collapser-item teq-row max-w d-flex">
                <div class="col-12 col-tab-10 offset-tab-1 pt-2 pl-4 pr-4 container">
                    <button class="item-title txt-20 c-dark width-100 d-flex justify-between align-center"
                            aria-controls="item-<?php echo $i ?>" aria-expanded="false">
                        <?php if (!empty($item['title'])): ?>
                            <h4 class="txt-20 w-400 text-left">
                                <?= $item['title'] ?>
                            </h4>
                        <?php endif; ?>
                        <svg class="icon-plus ml-2">
                            <use xlink:href="#icon-plus"></use>
                        </svg>
                        <svg class="icon-minus ml-2">
                            <use xlink:href="#icon-minus"></use>
                        </svg>
                    </button>
                    <div class="item-content txt-16 pt-2" id="item-<?php echo $i ?>" aria-hidden="true">
                        <?php if (!empty($item['text'])): ?>
                            <div class="wysiwyg-wrapper">
                            <div class="cp-wysiwyg">
                                <?= $item['text'] ?>
                            </div>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <?php $i++ ?>
        <?php endforeach; ?>
    <?php endif; ?>
</div>