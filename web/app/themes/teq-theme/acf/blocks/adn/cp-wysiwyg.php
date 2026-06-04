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
    <div class="teq-row max-w">
        <div class="col-12 col-md-10 offset-md-1 cp-wysiwyg">
            <?= $fields['contenu'] ?? '' ?>
        </div>
    </div>
</div>
