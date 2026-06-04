<?php if (!empty($block['data']['is_preview']) || !empty($is_preview)) : ?>
<img src="<?= get_template_directory_uri() . '/acf/preview/cp-footer-case.png' ?>" style="width:100%; height:auto;"
    alt="preview">
<?php return; ?>
<?php endif; ?>

<?php
$id = 'cp-footer-case-' . (!empty($block['id'])) ? $block['id'] : '';
if (!empty($block['anchor'])) {
    $id = $block['anchor'];
}

$fields = get_fields();
?>

<div class="cp-footer-case teq-container relative">
    <div class="teq-row max-w height-100 absolute container">
        <div class="col-12 d-flex column justify-center align-center">
            <?php if(!empty($fields["tag_title_desc"]["tag"] )): ?>
                <p class="txt-10 text-uppercase tag"><?= $fields["tag_title_desc"]["tag"] ?></p>
            <?php endif; ?>
            <?php if(!empty($fields["tag_title_desc"]["title"]["line_1"]) || !empty($fields["tag_title_desc"]["title"]["line_2"])): ?>
                <h1 class="d-flex column title">
                    <?php if(!empty($fields["tag_title_desc"]["title"]["line_1"])): ?>
                        <span class="w-700 text-uppercase neue first-line">
                            <?= $fields["tag_title_desc"]["title"]["line_1"] ?>
                        </span>
                    <?php endif; ?>
                    <?php if(!empty($fields["tag_title_desc"]["title"]["line_2"])): ?>
                        <span class="saol-italic-ajusted second-line">
                            <?= $fields["tag_title_desc"]["title"]["line_2"] ?>            
                        </span>
                    <?php endif; ?>
                </h1>
            <?php endif; ?>
            <?php if(!empty($fields["tag_title_desc"]["desc"])): ?>
                <div class="description"><?= $fields["tag_title_desc"]["desc"] ?></div>
            <?php endif; ?>
            <span class="line"></span>
            <?php if(!empty($fields["link"]["url"]) && !empty($fields["link"]["title"])): ?>
                <a href="<?= $fields["link"]["url"] ?>" 
                    target="<?= (!empty($fields["link"]["target"])) ? $fields["link"]["target"] : ''?>"
                    aria-label="<?= __($fields["link"]["title"],"tequilarapido") ?>" 
                    class="btn-tequila">
                    <?= $fields["link"]["title"] ?>
                </a>
            <?php endif; ?>
        </div>
    </div>
</div>