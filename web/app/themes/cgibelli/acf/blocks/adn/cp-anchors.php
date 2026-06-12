<?php if (!empty($block['data']['is_preview']) || !empty($is_preview)) : ?>
    <img src="<?= get_template_directory_uri() . '/acf/preview/cp-anchors.png' ?>" style="width:100%; height:auto;"
         alt="preview">
    <?php return; ?>
<?php endif; ?>

<?php
$id = 'cp-anchors-' . (!empty($block['id'])) ? $block['id'] : '';
if (!empty($block['anchor'])) {
    $id = $block['anchor'];
}

$fields = get_fields();
$count = count($fields['group']);
?>

<div id="<?= esc_attr($id) ?>" class="cp-anchors teq-container">
    <div class="teq-row max-w column row-tab">
        <div class="col-12 col-sm-9 col-tab-3 mb-8 mb-tab-0">
            <nav class="sticky-nav relative" role="navigation"
                 aria-labelledby="<?= $fields['menu_title'] ?? '' ?>">
                <?php if (!empty($fields['menu_title'])): ?>
                    <h4 id="<?= $fields['menu_title'] ?>" class="txt-24 w-600 mb-3"><?= $fields['menu_title'] ?></h4>
                <?php endif; ?>
                <ul>
                    <?php if (!empty($fields['group'])): ?>
                        <?php foreach ($fields['group'] as $i => $item) : ?>
                            <?php if ($item['lien']): ?>
                                <li>
                                    <a class="txt-20 mb-2 d-block" href="#<?= $id ?>-<?= $i ?>">
                                        <?= $item['lien'] ?>
                                    </a>
                                </li>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </ul>
            </nav>
        </div>
        <div class="col-12 col-tab-8 offset-tab-1">
            <?php if (!empty($fields['group'])): ?>
                <?php foreach ($fields['group'] as $i => $item) : ?>
                    <?php if (!empty($item['contenu'])): ?>
                        <div class="mb-6 cp-wysiwyg" id="<?= $id ?>-<?= $i ?>">
                            <?= $item['contenu'] ?>
                        </div>
                    <?php endif; ?>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>
</div>