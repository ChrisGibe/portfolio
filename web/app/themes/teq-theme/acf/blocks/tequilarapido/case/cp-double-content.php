<?php if (!empty($block['data']['is_preview']) || !empty($is_preview)) : ?>
<img src="<?= get_template_directory_uri() . '/acf/preview/cp-double-content.png' ?>" style="width:100%; height:auto;"
    alt="preview">
<?php return; ?>
<?php endif; ?>

<?php
$id = 'cp-double-content-' . (!empty($block['id'])) ? $block['id'] : '';
if (!empty($block['anchor'])) {
    $id = $block['anchor'];
}

$fields = get_fields();
?>

<div class="cp-double-content teq-container">
    <div class="teq-row max-w column row-md">
        <div class="col-12 col-md-7 left">
            <?php if(!empty($fields["bloc_1"]["img"]["desktop"]["url"]) && !empty($fields["bloc_1"]["img"]["mobile"]["url"])): ?>
                <picture class="d-flex width-100 height-auto">
                    <source media="(max-width: 767px)"
                        srcset="<?= $fields["bloc_1"]["img"]["mobile"]["url"] ?>"/>
                    <source media="(min-width: 768px)"
                        srcset="<?= $fields["bloc_1"]["img"]["desktop"]["url"] ?>"/>
                    <img
                        src="<?= $fields["bloc_1"]["img"]["desktop"]["url"] ?>"
                        alt="<?= (!empty($fields["bloc_1"]["img"]["desktop"]["alt"])) ? $fields["bloc_1"]["img"]["desktop"]["alt"] : $fields["bloc_1"]["img"]["desktop"]["title"]?>"/>
                </picture>
            <?php elseif(!empty($fields["bloc_1"]["video"]["webm"]["url"]) && !empty($fields["bloc_1"]["video"]["mp4"]["url"])): ?>
                <video class="d-flex width-100 height-100" autoplay>
                    <source src="<?= $fields["bloc_1"]["video"]["webm"]["url"] ?>" type="video/webm">
                    <source src="<?= $fields["bloc_1"]["video"]["mp4"]["url"] ?>" type="video/mp4">
                </video>
                <button class="absolute mx-auto btn-pause" role="button">
                    <svg class="icon-pause<?= (!empty($fields["bloc_1"]["video"]["btn_color"]) && $fields["bloc_1"]["video"]["btn_color"] == "-black") ? $fields["bloc_1"]["video"]["btn_color"] : "" ?>">
                        <use xlink:href="#icon-pause<?= (!empty($fields["bloc_1"]["video"]["btn_color"]) && $fields["bloc_1"]["video"]["btn_color"] == "-black") ? $fields["bloc_1"]["video"]["btn_color"] : "" ?>"></use>
                    </svg>
                </button>
            <?php endif; ?>
        </div>
        <div class="col-12 col-md-5 relative right">
            <?php if(!empty($fields["bloc_2"]["img"]["desktop"]["url"]) && !empty($fields["bloc_2"]["img"]["mobile"]["url"])): ?>
                <picture class="d-flex width-100 height-auto">
                    <source media="(max-width: 767px)"
                        srcset="<?= $fields["bloc_2"]["img"]["mobile"]["url"] ?>"/>
                    <source media="(min-width: 768px)"
                        srcset="<?= $fields["bloc_2"]["img"]["desktop"]["url"] ?>"/>
                    <img
                        src="<?= $fields["bloc_2"]["img"]["desktop"]["url"] ?>"
                        alt="<?= (!empty($fields["bloc_2"]["img"]["desktop"]["alt"])) ? $fields["bloc_2"]["img"]["desktop"]["alt"] : $fields["bloc_2"]["img"]["desktop"]["title"]?>"/>
                </picture>
            <?php elseif(!empty($fields["bloc_2"]["video"]["webm"]["url"]) && !empty($fields["bloc_2"]["video"]["mp4"]["url"])): ?>
                <video class="d-flex width-100 height-100" autoplay>
                    <source src="<?= $fields["bloc_2"]["video"]["webm"]["url"] ?>" type="video/webm">
                    <source src="<?= $fields["bloc_2"]["video"]["mp4"]["url"] ?>" type="video/mp4">
                </video>
                <button class="absolute mx-auto btn-pause" role="button">
                    <svg class="icon-pause<?= (!empty($fields["bloc_2"]["video"]["btn_color"]) && $fields["bloc_2"]["video"]["btn_color"] == "-black") ? $fields["bloc_2"]["video"]["btn_color"] : "" ?>">
                        <use xlink:href="#icon-pause<?= (!empty($fields["bloc_2"]["video"]["btn_color"]) && $fields["bloc_2"]["video"]["btn_color"] == "-black") ? $fields["bloc_2"]["video"]["btn_color"] : "" ?>"></use>
                    </svg>
                </button>
            <?php endif; ?>
        </div>
    </div>
</div>