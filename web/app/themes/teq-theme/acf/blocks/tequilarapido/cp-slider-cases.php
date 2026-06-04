<?php if (!empty($block['data']['is_preview']) || !empty($is_preview)) : ?>
<img src="<?= get_template_directory_uri() . '/acf/preview/cp-slider-cases.png' ?>" style="width:100%; height:auto;"
    alt="preview">
<?php return; ?>
<?php endif; ?>

<?php
$id = 'cp-slider-cases-' . (!empty($block['id'])) ? $block['id'] : '';
if (!empty($block['anchor'])) {
    $id = $block['anchor'];
}

$fields = get_fields();

$nbCases = (!empty($fields["slides"])) ? count($fields["slides"]) -1 : 0;

?>
<?php if(!empty($fields["slides"])): ?>
    <div class="cp-slider-cases teq-container fixed bg-c-white desktop-only">
        <?php foreach ($fields["slides"] as $key => $item):?>
            <?php if($key === 0): ?>
                <?php /* CASE ONE */ ?>
                <div class="teq-row max-w align-center absolute inset-0 px-0 bg-c-white width-auto tequila-case" data-case="<?= $key ?>">
                    <?php if(!empty($item["img"]["desktop"]["url"]) && !empty($item["img"]["mobile"]["url"])): ?>
                        <div class="col-6">
                            <picture class="d-flex width-100 height-auto">
                                <source media="(max-width: 767px)"
                                    srcset="<?= $item["img"]["mobile"]["url"] ?>"/>
                                <source media="(min-width: 768px)"
                                    srcset="<?= $item["img"]["desktop"]["url"] ?>"/>
                                <img
                                    src="<?= $item["img"]["desktop"]["url"] ?>"
                                    alt="<?= (!empty($item["img"]["desktop"]["alt"])) ? $item["img"]["desktop"]["alt"] : $item["img"]["desktop"]["title"]?>"/>
                            </picture>
                        </div>
                    <?php endif; ?>
                    <div class="col-4 offset-1">
                        <div class="d-flex column justify-center align-center content">
                            <?php if(!empty($item["tag_title_desc"]["tag"] )): ?>
                                <p class="txt-10 text-uppercase"><?= $item["tag_title_desc"]["tag"] ?></p>
                            <?php endif; ?>
                            <?php if(!empty($item["tag_title_desc"]["title"]["line_1"]) || !empty($item["tag_title_desc"]["title"]["line_2"])): ?>
                                <h2 class="d-flex column title">
                                    <?php if(!empty($item["tag_title_desc"]["title"]["line_1"])): ?>
                                        <span class="w-700 text-uppercase neue first-line">
                                            <?= $item["tag_title_desc"]["title"]["line_1"] ?>
                                        </span>
                                    <?php endif; ?>
                                    <?php if(!empty($item["tag_title_desc"]["title"]["line_2"])): ?>
                                        <span class="saol-italic-ajusted second-line">
                                            <?= $item["tag_title_desc"]["title"]["line_2"] ?>            
                                        </span>
                                    <?php endif; ?>
                                </h2>
                            <?php endif; ?>
                            <?php if(!empty($item["tag_title_desc"]["desc"])): ?>
                                <div class="description"><?= $item["tag_title_desc"]["desc"] ?></div>
                            <?php endif; ?>
                            <?php if(!empty($item["cta"]["url"]) && !empty($item["cta"]["title"])): ?>
                                <a href="<?= $item["cta"]["url"] ?>" 
                                    target="<?= (!empty($item["cta"]["target"])) ? $item["cta"]["target"] : ''?>"
                                    aria-label="<?= __($item["cta"]["title"],"tequilarapido") ?>" 
                                    class="btn-tequila"><?= $item["cta"]["title"] ?></a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <?php else: ?>
                    <?php /* CASE TWO */ ?>
                    <div class="teq-row max-w align-center absolute inset-0 px-0 bg-c-white width-auto tequila-case" data-case="<?= $key ?>">
                        <?php if(!empty($item["img"]["desktop"]["url"]) && !empty($item["img"]["mobile"]["url"])): ?>
                            <div class="col-6">
                                <picture class="d-flex width-100 height-auto">
                                    <source media="(max-width: 767px)"
                                        srcset="<?= $item["img"]["mobile"]["url"] ?>"/>
                                    <source media="(min-width: 768px)"
                                        srcset="<?= $item["img"]["desktop"]["url"] ?>"/>
                                    <img
                                        src="<?= $item["img"]["desktop"]["url"] ?>"
                                        alt="<?= (!empty($item["img"]["desktop"]["alt"])) ? $item["img"]["desktop"]["alt"] : $item["img"]["desktop"]["title"]?>"/>
                                </picture>
                            </div>
                        <?php endif; ?>
                        <div class="col-4 offset-1">
                            <div class="d-flex column justify-center align-center content">
                                <?php if(!empty($item["tag_title_desc"]["tag"])): ?>
                                    <p class="txt-10 text-uppercase"><?= $item["tag_title_desc"]["tag"] ?></p>
                                <?php endif; ?>
                                <?php if(!empty($item["tag_title_desc"]["title"]["line_1"]) || !empty($item["tag_title_desc"]["title"]["line_2"])): ?>
                                    <h2 class="d-flex column title">
                                        <?php if(!empty($item["tag_title_desc"]["title"]["line_1"])): ?>
                                            <span class="w-700 text-uppercase neue first-line">
                                                <?= $item["tag_title_desc"]["title"]["line_1"] ?>
                                            </span>
                                        <?php endif; ?>
                                        <?php if(!empty($item["tag_title_desc"]["title"]["line_2"])): ?>
                                            <span class="saol-italic-ajusted second-line">
                                                <?= $item["tag_title_desc"]["title"]["line_2"] ?>            
                                            </span>
                                        <?php endif; ?>
                                    </h2>
                                <?php endif; ?>
                                <?php if(!empty($item["tag_title_desc"]["desc"])): ?>
                                    <div class="description"><?= $item["tag_title_desc"]["desc"] ?></div>
                                <?php endif; ?>
                                <?php if(!empty($item["cta"]["url"]) && !empty($item["cta"]["title"])): ?>
                                    <a href="<?= $item["cta"]["url"] ?>" 
                                        target="<?= (!empty($item["cta"]["target"])) ? $item["cta"]["target"] : ''?>"
                                        aria-label="<?= __($item["cta"]["title"],"tequilarapido") ?>" 
                                        class="btn-tequila"><?= $item["cta"]["title"] ?></a>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
            <?php endif;?>
        <?php endforeach; ?>

        <div class="absolute thumbnails-nav">
            <ul class="d-flex gap-8 list">
                    <?php foreach ($fields["slides"] as $key => $item):?>
                        <?php if(!empty($item["thumbnail"]["url"])): ?>
                            <li data-case="<?= $key ?>" class="thumbnail">
                                <button aria-label="Go to <?= $key ?>" role="button">
                                    <img src="<?= $item["thumbnail"]["url"] ?>" 
                                    alt="<?= (!empty($item["thumbnail"]["alt"])) ? $item["thumbnail"]["alt"] : $item["thumbnail"]["title"]?>"/>
                                </button>
                            </li>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </ul>
            <div class="indicator absolute"></div>
        </div>
    </div>

    <div class="container-fake-case">
        <?php foreach ($fields["slides"] as $key => $item):?>
            <div class="fake-case" data-case="<?= $key ?>"></div>
        <?php endforeach; ?>
    </div>
    <div class="fake-footer desktop-only"></div>

    <!-- CASES MOBILE -->
    <div class="cases-mobile mobile-only teq-container">
        <div class="teq-row max-w">
            <div class="col-12 tequila-case-mobile relative">
                <div class="relative top">
                    <!-- Image -->
                    <img src="https://tequilarapido.my/app/uploads/2023/11/mobilize-mobile.jpg" alt="">
                    <div class="line"></div>
                </div>
                <div class="d-flex column align-center bottom">
                    <!-- Tage -->
                    <p class="txt-10 text-uppercase">Dispositif</p>
                    <!-- Titre -->
                    <h2 class="d-flex column title">
                        <span class="w-700 text-uppercase neue first-line">
                            Mobilize
                        </span>
                        <span class="saol-italic-ajusted second-line">
                            Share
                        </span>
                    <h2>
                    <!-- Lien de la page, ici on reprend la desciption (si tu peux bien sur) -->
                    <a href="#1" target="" class="stretched-link w-400 description">Stratégie éditoriale, design et développement <br> du site Corporate de Mobilize</a>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>