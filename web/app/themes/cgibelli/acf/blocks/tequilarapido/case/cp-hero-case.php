<?php if (!empty($block['data']['is_preview']) || !empty($is_preview)) : ?>
<img src="<?= get_template_directory_uri() . '/acf/preview/cp-hero-case.png' ?>" style="width:100%; height:auto;"
    alt="preview">
<?php return; ?>
<?php endif; ?>

<?php
$id = 'cp-hero-case-' . (!empty($block['id'])) ? $block['id'] : '';
if (!empty($block['anchor'])) {
    $id = $block['anchor'];
}

$fields = get_fields();
?>

<!-- 🚧 J'ai ajouté l'attribut style pour le bg_color 👇🏻 -->

<div class="cp-hero-case teq-container <?= ($fields["bg_color"]) ? 'background' : '' ?>" style="background-color:<?= $fields["bg_color"] ?>">
    <?php if (!empty($fields["q_display_title_block"]) && $fields["q_display_title_block"]): ?>
        <div class="teq-row max-w">
                <div class="col-12 d-flex column align-center text-center content">
                    <?php if(!empty($fields["tag_title_desc"]["tag"] )): ?>
                        <p class="text-sm text-uppercase"><?= $fields["tag_title_desc"]["tag"] ?></p>
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
                </div>
        </div>
    <?php endif; ?>
    <div class="teq-row max-w img-video-row">
        <?php /* BG IMAGE */ ?>
        <?php if(!empty($fields["bg_visual"]["img"]["desktop"]["url"]) && !empty($fields["bg_visual"]["img"]["mobile"]["url"])): ?>
            <div class="col-12 d-flex img-bg">
                <picture class="d-flex width-100 height-auto">
                    <source srcset="<?= $fields["bg_visual"]["img"]["mobile"]["url"] ?>" media="(max-width: 767px)"  />
                    <source srcset="<?= $fields["bg_visual"]["img"]["desktop"]["url"] ?>" media="(min-width: 768px)"  />
                    <img src="<?= $fields["bg_visual"]["img"]["desktop"]["url"] ?>" 
                        alt="<?= (!empty($fields["bg_visual"]["img"]["desktop"]["alt"])) ? $fields["bg_visual"]["img"]["desktop"]["alt"] : $fields["bg_visual"]["img"]["desktop"]["title"]?>"/>
                </picture>
            </div>
            <?php /* BG VIDEO */ ?>
            <?php elseif(!empty($fields["bg_visual"]["video"]["webm"]["url"]) && !empty($fields["bg_visual"]["video"]["mp4"]["url"])): ?>
                <!-- ❌ Autoplay ne fonctionne pas 👇🏻 -->

                <video class="d-flex width-100 height-auto" controls <?= (!empty($fields["q_autoplay"]) && $fields["q_autoplay"]) ? "autoplay" : "" ?>>
                    <source src="<?= $fields["bg_visual"]["video"]["webm"]["url"] ?>" type="video/webm">
                    <source src="<?= $fields["bg_visual"]["video"]["mp4"]["url"] ?>" type="video/mp4">
                </video>
        <?php endif; ?>

        <?php /* VISUEL IMAGE */ ?>
        <?php if(!empty($fields["visual"]["img"]["desktop"]["url"]) && !empty($fields["visual"]["img"]["mobile"]["url"])): ?>
            <div class="col-8 absolute px-0 img-principal">
                    <picture class="d-flex width-100 height-auto">
                        <source srcset="<?= $fields["visual"]["img"]["mobile"]["url"] ?>" media="(max-width: 767px)"  />
                        <source srcset="<?= $fields["visual"]["img"]["desktop"]["url"] ?>" media="(min-width: 768px)"  />
                        <img src="<?= $fields["visual"]["img"]["desktop"]["url"] ?>" 
                            alt="<?= (!empty($fields["visual"]["img"]["desktop"]["alt"])) ? $fields["visual"]["img"]["desktop"]["alt"] : $fields["visual"]["img"]["desktop"]["title"]?>"/>
                    </picture>
            </div>
        <?php /* VISUEL VIDEO */ ?>
        <?php elseif(!empty($fields["visual"]["video"]["webm"]["url"]) && !empty($fields["visual"]["video"]["mp4"]["url"])): ?>
            <div class="col-8 absolute px-0 video-principal">

                <!-- ❌ Autoplay ne fonctionne pas 👇🏻 -->

                <video class="d-flex width-100 height-auto" controls <?= (!empty($fields["q_autoplay"]) && $fields["q_autoplay"]) ? "autoplay" : "" ?>>
                    <source src="<?= $fields["visual"]["video"]["webm"]["url"] ?>" type="video/webm">
                    <source src="<?= $fields["visual"]["video"]["mp4"]["url"] ?>" type="video/mp4">
                </video>
                <?php /* COVER VIDEO */ ?>
                <?php if(!empty($fields["visual"]["video"]["preview"])):?>
                    <picture class="d-flex width-100 height-auto absolute inset-0">
                        <source srcset="<?= $fields["visual"]["video"]["preview"]["mobile"]["url"] ?>" media="(max-width: 767px)"  />
                        <source srcset="<?= $fields["visual"]["video"]["preview"]["desktop"]["url"] ?>" media="(min-width: 768px)"  />
                        <img src="<?= $fields["visual"]["video"]["preview"]["desktop"]["url"] ?>" 
                        alt="<?= (!empty($fields["visual"]["video"]["preview"]["desktop"]["alt"])) ? $fields["visual"]["video"]["preview"]["desktop"]["alt"] : $fields["visual"]["video"]["preview"]["desktop"]["title"]?>"/>
                    </picture>
                <?php endif; ?>
            </div>
        <?php endif; ?>

        <?php /* PAUSE BTN VISUEL VIDEO */ ?>
        <?php if (!empty($fields["q_autoplay"]) && $fields["q_autoplay"]):?>
            <button class="btn-pause desktop absolute desktop-only" role="button">
                <svg class="icon-pause<?= (!empty($fields["btn_color"]) && $fields["btn_color"] == "-black") ? $fields["btn_color"] : "" ?>">
                <use xlink:href="#icon-pause<?= (!empty($fields["btn_color"]) && $fields["btn_color"] == "-black") ? $fields["btn_color"] : "" ?>"></use>
                </svg>
            </button>
        <?php endif; ?>
    </div>

    <?php /* PAUSE BTN BACKGROUND VIDEO */ ?>
    <?php if (!empty($fields["q_autoplay"]) && $fields["q_autoplay"]):?>
        <button class="d-flex mx-auto btn-pause mobile mobile-only" role="button">
            <svg class="icon-pause<?= (!empty($fields["btn_color"]) && $fields["btn_color"] == "-black") ? $fields["btn_color"] : "" ?>">
                <use xlink:href="#icon-pause<?= (!empty($fields["btn_color"]) && $fields["btn_color"] == "-black") ? $fields["btn_color"] : "" ?>"></use>
            </svg>
        </button>
    <?php endif; ?>

    <a href="" class="d-block mx-auto relative cta-primary big mobile-only" aria-label="<?= __((!empty($fields["scroll_label"])) ? $fields["scroll_label"] : "Scroll","tequilarapido") ?>">
        <?= (!empty($fields["scroll_label"])) ? $fields["scroll_label"] : __("Scroll","tequilarapido")?>
        <span class="absolute line"></span>
    </a>
</div>