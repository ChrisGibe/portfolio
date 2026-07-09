<?php if (!empty($block['data']['is_preview']) || !empty($is_preview)) : ?>
    <img src="<?= get_template_directory_uri() . '/acf/preview/cp-slider-cases.png' ?>" style="width:100%; height:auto;"
        alt="preview">
    <?php return; ?>
<?php endif; ?>

<?php
$fields = get_fields();

$nbCases = (!empty($fields["slides"])) ? count($fields["slides"]) -1 : 0;

?>

<?php if(!empty($fields["slides"])): ?>
    <div class="cp-slider-cases teq-container fixed inset-0 py-0 bg-white desktop-only">
        <?php foreach ($fields["slides"] as $key => $item):?>
            <?php if($key === 0): ?>
                <?php /* CASE ONE */ ?>
                <div class="teq-grid items-center absolute inset-0 px-4 bg-white w-screen tequila-case" data-case="<?= $key ?>">
                    <?php if(!empty($item["img"]["desktop"]["url"]) && !empty($item["img"]["mobile"]["url"])): ?>
                        <div class="col-span-6">
                            <picture class="flex w-full h-auto">
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
                    <div class="col-span-4 col-start-8">
                        <div class="flex flex-col justify-center items-center content">
                            <?php if(!empty($item["tag_title_desc"]["tag"] )): ?>
                                <p class="text-[10px] uppercase"><?= $item["tag_title_desc"]["tag"] ?></p>
                            <?php endif; ?>
                            <?php if(!empty($item["tag_title_desc"]["title"]["line_1"]) || !empty($item["tag_title_desc"]["title"]["line_2"])): ?>
                                <h2 class="flex flex-col title">
                                    <?php if(!empty($item["tag_title_desc"]["title"]["line_1"])): ?>
                                        <span class="font-bold uppercase neue first-line">
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
                                <div class="description text-xs"><?= $item["tag_title_desc"]["desc"] ?></div>
                            <?php endif; ?>
                            <?php if(!empty($item["cta"]["url"]) && !empty($item["cta"]["title"])): ?>
                                <a href="<?= $item["cta"]["url"] ?>"
                                    target="<?= (!empty($item["cta"]["target"])) ? $item["cta"]["target"] : ''?>"
                                    aria-label="<?= __($item["cta"]["title"],"tequilarapido") ?>"
                                    class="cta-primary"><?= $item["cta"]["title"] ?></a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <?php else: ?>
                    <?php /* CASE TWO */ ?>
                    <div class="teq-grid items-center absolute inset-0 px-4 bg-white w-screen tequila-case" data-case="<?= $key ?>">
                        <?php if(!empty($item["img"]["desktop"]["url"]) && !empty($item["img"]["mobile"]["url"])): ?>
                            <div class="col-span-6">
                                <picture class="flex w-full h-auto">
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
                        <div class="col-span-4 col-start-8">
                            <div class="flex flex-col justify-center items-center content">
                                <?php if(!empty($item["tag_title_desc"]["tag"])): ?>
                                    <p class="text-sm uppercase"><?= $item["tag_title_desc"]["tag"] ?></p>
                                <?php endif; ?>
                                <?php if(!empty($item["tag_title_desc"]["title"]["line_1"]) || !empty($item["tag_title_desc"]["title"]["line_2"])): ?>
                                    <h2 class="flex flex-col title">
                                        <?php if(!empty($item["tag_title_desc"]["title"]["line_1"])): ?>
                                            <span class="font-bold uppercase neue first-line">
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
                                    <div class="description text-xs"><?= $item["tag_title_desc"]["desc"] ?></div>
                                <?php endif; ?>
                                <?php if(!empty($item["cta"]["url"]) && !empty($item["cta"]["title"])): ?>
                                    <a href="<?= $item["cta"]["url"] ?>"
                                        target="<?= (!empty($item["cta"]["target"])) ? $item["cta"]["target"] : ''?>"
                                        aria-label="<?= __($item["cta"]["title"],"tequilarapido") ?>"
                                        class="cta-primary"><?= $item["cta"]["title"] ?></a>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
            <?php endif;?>
        <?php endforeach; ?>

        <div class="absolute thumbnails-nav">
            <ul class="flex gap-2 list">
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
            <div id="case-<?= $key ?>" class="fake-case" data-case="<?= $key ?>"></div>
        <?php endforeach; ?>
    </div>
    <div class="fake-footer desktop-only"></div>

    <!-- CASES MOBILE -->
     <div class="teq-container lg:hidden relative z-1">
        <div class="cases-mobile teq-grid">
            <?php foreach ($fields["slides"] as $key => $item): ?>
                <div class="col-span-6 tequila-case-mobile relative" data-case="<?= $key ?>">
                    <?php if(!empty($item["img"]["mobile"]["url"])): ?>
                        <div class="relative top">
                            <img src="<?= $item["img"]["mobile"]["url"] ?>"
                                    alt="<?= (!empty($item["img"]["mobile"]["alt"])) ? $item["img"]["mobile"]["alt"] : $item["img"]["mobile"]["title"] ?>">
                            <div class="line"></div>
                        </div>
                    <?php endif; ?>
                    <div class="flex flex-col items-center bottom">
                        <?php if(!empty($item["tag_title_desc"]["tag"])): ?>
                            <p class="text-sm uppercase"><?= $item["tag_title_desc"]["tag"] ?></p>
                        <?php endif; ?>
                        <?php if(!empty($item["tag_title_desc"]["title"]["line_1"]) || !empty($item["tag_title_desc"]["title"]["line_2"])): ?>
                            <h2 class="flex flex-col title">
                                <?php if(!empty($item["tag_title_desc"]["title"]["line_1"])): ?>
                                    <span class="font-bold uppercase neue first-line">
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
                        <?php if(!empty($item["cta"]["url"]) && !empty($item["tag_title_desc"]["desc"])): ?>
                            <a href="<?= $item["cta"]["url"] ?>"
                                target="<?= (!empty($item["cta"]["target"])) ? $item["cta"]["target"] : '' ?>"
                                aria-label="<?= __($item["cta"]["title"], "tequilarapido") ?>"
                                class="stretched-link font-normal description">
                                <?= $item["tag_title_desc"]["desc"] ?>
                            </a>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
     </div>
<?php endif; ?>
