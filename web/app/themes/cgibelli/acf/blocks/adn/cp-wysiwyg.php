<?php if (!empty($block['data']['is_preview']) || $is_preview) : ?>
    <img src="<?= get_template_directory_uri() . '/acf/preview/cp-wysiwyg.png'; ?>" style="width:100%; height:auto;">
    <?php return; ?>
<?php endif; ?>

<?php
$id = 'wysiwyg-' . $block['id'];
if (!empty($block['anchor'])) {
    $id = $block['anchor'];
}
$fields = get_fields();
?>

<div id="<?= esc_attr($id); ?>" class="teq-container">
    <div class="teq-grid">
        <div class="col-span-6 md:col-span-12 lg:col-span-16 lg:col-start-6 cp-wysiwyg">
            <?= $fields['contenu'] ?? '' ?>
        </div>
    </div>
</div>
