<?php if (!empty($block['data']['is_preview']) || !empty($is_preview)) : ?>
    <img src="<?= get_template_directory_uri() . '/acf/preview/cp-hero.png' ?>" style="width:100%; height:auto;"
         alt="preview">
    <?php return; ?>
<?php endif; ?>

<?php
$fields = get_fields();
$about_img = get_template_directory_uri() . '/_src/images/img-1.jpg';
$about_img_2 = get_template_directory_uri() . '/_src/images/img-2.jpg';
?>

<div class="cp-hero flex justify-center relative w-screen">
    <div class="content mt-14 lg:mt-0 w-full relative text-center cursor-default">
        <?php if(!empty($fields["tag_title_desc"]["tag"] )): ?>
            <p class="uppercase text-base mb-6 lg:mb-0"><?= $fields["tag_title_desc"]["tag"] ?></p>
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
            <div class="mt-[32px] lg:mt-12 description lg:w-1/2 mx-auto text-base">
                <?= $fields["tag_title_desc"]["desc"] ?>
            </div>
        <?php endif; ?>

        <div class="flex justify-center mt-[78px] lg:hidden">
            <button class="about-btn-mobile relative" aria-label="Open the about section">
                <img class="about-img absolute w-full h-full" src="<?= $about_img ?>" alt="Christophe Gibelli" />
            </button>
        </div>

        <?php if(!empty($fields["cta"]["url"]) && !empty($fields["cta"]["title"])):?>
            <a class="mt-20 lg:mt-12 cta-primary go-to-first-case"
                href="<?= $fields["cta"]["url"] ?>"
                target="_self">
                <?= $fields["cta"]["title"] ?>
            </a>
        <?php endif; ?>
        <div class="line-mobile mobile-only"></div>
    </div>
    <div class="about-wrapper absolute w-full h-full">
        <button class="close-btn absolute flex justify-center items-center" tabindex="0" aria-label="Close the about section">
            <svg aria-hidden="true" focusable="false" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                <path fill-rule="evenodd" clip-rule="evenodd" d="M14.0098 2.69684L13.3027 1.98973L7.99926 7.2932L2.69605 1.98999L1.98894 2.6971L7.29215 8.00031L1.98901 13.3034L2.69612 14.0105L7.99926 8.70741L13.3026 14.0108L14.0098 13.3037L8.70636 8.00031L14.0098 2.69684Z" fill="white"/>
            </svg>
        </button>
        <canvas id="about-experience-canvas"
                data-texture="<?= $about_img ?>"
                data-texture-reveal="<?= $about_img_2 ?>"></canvas>
        <div class="about-text absolute pointer-events-none">
            <?= $fields["about"] ?>
        </div>
    </div>
    <div class="overlay absolute w-full h-full bg-c-dark"></div>
</div>