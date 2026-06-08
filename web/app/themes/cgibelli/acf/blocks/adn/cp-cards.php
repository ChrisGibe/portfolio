<?php if (!empty($block['data']['is_preview']) || $is_preview) : ?>
    <img src="<?= get_template_directory_uri() . '/acf/preview/cp-cards.png'; ?>" style="width:100%; height:auto;">
    <?php return; ?>
<?php endif; ?>

<?php
$id = 'cp-cards-' . $block['id'];
if (!empty($block['anchor'])) {
    $id = $block['anchor'];
}
$fields = get_fields();
?>

<div id="<?= esc_attr($id); ?>" class="cp-cards teq-container">
    <?php if (!empty($fields['title'])): ?>
    <div class="teq-row max-w">
        <div class="col-12">
            <h2 class="txt-44 w-700 c-dark mb-2"><?= $fields['title'] ?></h2>
        </div>
    </div>
    <?php endif; ?>
    <div class="teq-row max-w">
        <?php if (!empty($fields['list'])) : ?>
            <?php foreach ($fields['list'] as $item) {
                include(get_template_directory() . '/acf/blocks/adn/_partials/card.php');
            } ?>
        <?php endif; ?>
    </div>
</div>