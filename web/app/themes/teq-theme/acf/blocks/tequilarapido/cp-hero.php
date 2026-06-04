<?php if (!empty($block['data']['is_preview']) || !empty($is_preview)) : ?>
    <img src="<?= get_template_directory_uri() . '/acf/preview/cp-hero.png' ?>" style="width:100%; height:auto;"
         alt="preview">
    <?php return; ?>
<?php endif; ?>

<?php
$id = 'cp-hero-' . (!empty($block['id'])) ? $block['id'] : '';
if (!empty($block['anchor'])) {
    $id = $block['anchor'];
}

$fields = get_fields();
?>

<div class="cp-hero d-flex justify-center relative width-100">
    <div class="content width-100 relative text-center">
        <?php if(!empty($fields["tag_title_desc"]["tag"] )): ?>
            <p class="txt-10 text-uppercase"><?= $fields["tag_title_desc"]["tag"] ?></p>
        <?php endif; ?>
        <?php if(!empty($fields["tag_title_desc"]["title"]["line_1"]) || !empty($fields["tag_title_desc"]["title"]["line_2"])): ?>
            <h1>
                <div class="d-flex column title-container">
                    <?php if(!empty($fields["tag_title_desc"]["title"]["line_1"])): ?>
                        <span class="w-700 text-uppercase neue relative title-top">
                            <?= $fields["tag_title_desc"]["title"]["line_1"] ?>
                            <span class="line"></span>
                        </span>
                    <?php endif; ?>
                    <?php if(!empty($fields["tag_title_desc"]["title"]["line_2"])): ?>
                        <span class="w-400 saol-italic-ajusted relative title-bottom">
                            <?= $fields["tag_title_desc"]["title"]["line_2"] ?>  
                            <span class="line bottom"></span>          
                        </span>
                    <?php endif; ?>
                </div>
            </h1>
        <?php endif; ?>
        <?php if(!empty($fields["tag_title_desc"]["desc"])): ?>
            <div class="mt-9 description"><?= $fields["tag_title_desc"]["desc"] ?></div>
        <?php endif; ?>
        <?php if(!empty($fields["cta"]["url"]) && !empty($fields["cta"]["title"])):?>
            <a class="mt-14 btn-tequila" 
                href="<?= $fields["cta"]["url"] ?>" 
                target="<?= (!empty($fields["cta"]["target"])) ? $fields["cta"]["target"] : ''?>"
                aria-label="<?= __($fields["cta"]["title"],"ampere") ?>">
                <?= $fields["cta"]["title"] ?>
            </a>
        <?php endif; ?>
        <div class="line-mobile mobile-only"></div>
    </div>
    <div class="showreel-wrapper absolute width-100 height-100">
        <video src="<?= get_template_directory_uri() . '/_src/images/showreel.mp4' ?>" autoplay loop muted></video>
    </div>
    <div class="full-video-wrapper absolute width-100 height-100">
        <button class="close-btn absolute d-flex justify-center align-center">
            <svg class="icon-close">
                <use xlink:href="#icon-close"></use>
            </svg>
        </button>
        <video src="<?= get_template_directory_uri() . '/_src/images/showreel.mp4' ?>" controls></video>
    </div>
    <div class="overlay absolute width-100 height-100 bg-c-dark"></div>
</div>