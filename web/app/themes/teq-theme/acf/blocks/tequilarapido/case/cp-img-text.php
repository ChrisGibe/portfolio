<?php if (!empty($block['data']['is_preview']) || !empty($is_preview)) : ?>
<img src="<?= get_template_directory_uri() . '/acf/preview/cp-img-text.png' ?>" style="width:100%; height:auto;"
    alt="preview">
<?php return; ?>
<?php endif; ?>

<?php
$id = 'cp-img-text-' . (!empty($block['id'])) ? $block['id'] : '';
if (!empty($block['anchor'])) {
    $id = $block['anchor'];
}

$fields = get_fields();
?>

<div class="cp-img-text teq-container">
    <div class="teq-row max-w">
        <div class="col-12 col-lg-2 offset-lg-1 left">
            <?php if(!empty($fields["title_img_desc"]["title"])): ?>
                <h2 class="text-uppercase"><?= $fields["title_img_desc"]["title"] ?></h2>
            <?php endif; ?>
            <?php if(!empty($fields["title_img_desc"]["img"]["url"])): ?>
                <img class="width-auto height-auto" 
                src="<?= $fields["title_img_desc"]["img"]["url"] ?>" 
                alt="<?= (!empty($fields["title_img_desc"]["img"]["alt"])) ? $fields["title_img_desc"]["img"]["alt"] : $fields["title_img_desc"]["img"]["title"]?>">
            <?php endif; ?>
            <?php if(!empty($fields["title_img_desc"]["desc"])): ?>
                <p><?= $fields["title_img_desc"]["desc"] ?></p>
            <?php endif; ?>
        </div>
        <div class="col-12 col-lg-5 offset-lg-2 right">
            <?php if(!empty($fields["title_txt"]["title"])): ?>
                <h2 class="text-uppercase"><?= $fields["title_txt"]["title"] ?></h2>
            <?php endif; ?>
            <?php if(!empty($fields["title_txt"]["txt"])): ?>
                <div class="paragraph"><?= $fields["title_txt"]["txt"] ?></div>
            <?php endif; ?>
        </div>
    </div>
</div>