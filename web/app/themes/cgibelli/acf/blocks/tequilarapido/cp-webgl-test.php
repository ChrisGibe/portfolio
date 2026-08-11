<?php if (!empty($block['data']['is_preview']) || !empty($is_preview)) : ?>
    <img src="<?= get_template_directory_uri() . '/acf/preview/cp-slider-cases.png' ?>" style="width:100%; height:auto;"
        alt="preview">
    <?php return; ?>
<?php endif; ?>

<?php
$fields = get_fields();

?>
<div class="cp-webgl-test">
    <h1>WebGL Test</h1>
    <canvas id="webgl-test-canvas"></canvas>
</div>