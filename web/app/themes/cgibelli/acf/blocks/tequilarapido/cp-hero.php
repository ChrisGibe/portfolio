<?php if (!empty($block['data']['is_preview']) || !empty($is_preview)) : ?>
    <img src="<?= get_template_directory_uri() . '/acf/preview/cp-hero.png' ?>" style="width:100%; height:auto;"
         alt="preview">
    <?php return; ?>
<?php endif; ?>

<?php
$fields = get_fields();
?>

<div class="cp-hero flex justify-center relative w-full">
    <div class="content w-full relative text-center">
        <?php if(!empty($fields["tag_title_desc"]["tag"] )): ?>
            <p class="text-sm uppercase"><?= $fields["tag_title_desc"]["tag"] ?></p>
        <?php endif; ?>
        <?php if(!empty($fields["tag_title_desc"]["title"]["line_1"]) || !empty($fields["tag_title_desc"]["title"]["line_2"])): ?>
            <h1>
                <div class="flex flex-col title-container">
                    <?php if(!empty($fields["tag_title_desc"]["title"]["line_1"])): ?>
                        <span class="font-bold uppercase neue relative title-top">
                            <?= $fields["tag_title_desc"]["title"]["line_1"] ?>
                            <span class="line"></span>
                        </span>
                    <?php endif; ?>
                    <?php if(!empty($fields["tag_title_desc"]["title"]["line_2"])): ?>
                        <span class="font-normal saol-italic-ajusted relative title-bottom">
                            <?= $fields["tag_title_desc"]["title"]["line_2"] ?>
                            <span class="line bottom"></span>
                        </span>
                    <?php endif; ?>
                </div>
            </h1>
        <?php endif; ?>
        <?php if(!empty($fields["tag_title_desc"]["desc"])): ?>
            <div class="mt-6 lg:mt-12 description lg:w-1/2 mx-auto"><?= $fields["tag_title_desc"]["desc"] ?></div>
        <?php endif; ?>
        <?php if(!empty($fields["cta"]["url"]) && !empty($fields["cta"]["title"])):?>
            <a class="mt-6 lg:mt-12 btn-tequila"
                href="<?= $fields["cta"]["url"] ?>"
                target="<?= (!empty($fields["cta"]["target"])) ? $fields["cta"]["target"] : ''?>"
                aria-label="<?= __($fields["cta"]["title"],"ampere") ?>">
                <?= $fields["cta"]["title"] ?>
            </a>
        <?php endif; ?>
        <div class="line-mobile mobile-only"></div>
    </div>
    <div class="showreel-wrapper absolute w-full h-full">
        <video src="<?= get_template_directory_uri() . '/_src/images/showreel.mp4' ?>" autoplay loop muted></video>
    </div>
    <div class="full-video-wrapper absolute w-full h-full">
        <button class="close-btn absolute flex justify-center items-center">
            <svg class="icon-close">
                <use xlink:href="#icon-close"></use>
            </svg>
        </button>
        <video src="<?= get_template_directory_uri() . '/_src/images/showreel.mp4' ?>" controls></video>
    </div>
    <div class="overlay absolute w-full h-full bg-c-dark"></div>
</div>