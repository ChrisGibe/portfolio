<?php if (!empty($block['data']['is_preview']) || !empty($is_preview)) : ?>
<img src="<?= get_template_directory_uri() . '/acf/preview/cp-list-text.png' ?>" style="width:100%; height:auto;"
    alt="preview">
<?php return; ?>
<?php endif; ?>

<?php
$id = 'cp-list-text-' . (!empty($block['id'])) ? $block['id'] : '';
if (!empty($block['anchor'])) {
    $id = $block['anchor'];
}

$fields = get_fields();
?>

<div class="cp-list-text teq-container">
    <div class="teq-row max-w">
        <div class="col-6 col-lg-2 offset-lg-1 left">
            <?php if(!empty($fields["title_list"]["title"])): ?>
                <h2 class="text-uppercase"><?= $fields["title_list"]["title"] ?></h2>
            <?php endif; ?>
            <?php if(!empty($fields["title_list"]["list"])): ?>
                <ul class="d-flex column gap-16">
                    <?php foreach ($fields["title_list"]["list"] as $item):?>
                        <?php if(!empty($item["txt"])): ?>
                            <li class="txt-10 w-350 text-uppercase"><?= $item["txt"] ?></li>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>
        </div>
        <div class="col-12 col-lg-5 offset-lg-2 right">
            <?php if(!empty($fields["title_txt_cta"]["title"])): ?>
                <h2 class="text-uppercase"><?= $fields["title_txt_cta"]["title"] ?></h2>
            <?php endif; ?>
            <?php if(!empty($fields["title_txt_cta"]["txt"])): ?>
                <div class="paragraph"><?= $fields["title_txt_cta"]["txt"] ?></div>
            <?php endif; ?>
            <?php if(!empty($fields["title_txt_cta"]["cta"]["url"]) && !empty($fields["title_txt_cta"]["cta"]["title"])):?>
                <a href="<?= $fields["title_txt_cta"]["cta"]["url"] ?>" 
                    target="<?= (!empty($fields["title_txt_cta"]["cta"]["target"])) ? $fields["title_txt_cta"]["cta"]["target"] : ''?>" 
                    class="btn-tequila <?= (!empty($fields["title_txt_cta"]["cta"]["target"])) ? "new-tab" : "" ?>"
                    aria-label="<?= __($fields["title_txt_cta"]["cta"]["title"],"ampere") ?>">
                    <?= $fields["title_txt_cta"]["cta"]["title"] ?>
                    <?php if(!empty($fields["title_txt_cta"]["cta"]["target"])):?>
                        <svg class="icon-arrow-tab">
                            <use xlink:href="#icon-arrow-tab"></use>
                        </svg>
                    <?php endif; ?>
                </a>
            <?php endif; ?>
        </div>
    </div>
</div>