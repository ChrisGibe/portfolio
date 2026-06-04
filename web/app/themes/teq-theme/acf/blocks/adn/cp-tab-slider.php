<?php if (!empty($block['data']['is_preview']) || !empty($is_preview)) : ?>
    <img src="<?= get_template_directory_uri() . '/acf/preview/cp-tab-slider.png' ?>"
         style="width:100%; height:auto;"
         alt="preview">
    <?php return; ?>
<?php endif; ?>

<?php
$id = 'cp-tab-slider-' . (!empty($block['id'])) ? $block['id'] : '';
if (!empty($block['anchor'])) {
    $id = $block['anchor'];
}

$fields = get_fields();
?>

<?php $curatedArray = [];
    function in_array_r($needle, $haystack, $strict = false) {
        foreach ($haystack as $item) {
            if (($strict ? $item === $needle : $item == $needle) || (is_array($item) && in_array_r($needle, $item, $strict))) {
                return true;
            }
        }
        return false;
    }

    foreach ($fields['list'] as $index=>$item) {
        $object = array();
        $object['content'] = $item['tag'];
        $object['slug'] = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $item['tag'])));
        if (!in_array_r($object['slug'], $curatedArray)) {
            $curatedArray[] = $object;
        }
    }
?>

<div id="<?= esc_attr($id) ?>" class="teq-container bg bg-c-grey-30 cp-tab-slider simple-s">
    <?php if ($fields['title']): ?>
    <div class="teq-row max-w">
        <div class="col-12">
            <h2 class="txt-44 w-700 c-dark mb-2"><?= $fields['title'] ?></h2>
        </div>
    </div>
    <?php endif; ?>
    <div class="teq-row max-w mb-8">
        <div class="col-12">
            <!-- Les labels (ou tag) -->
            <?php if ($curatedArray) : ?>
            <ul class="d-flex gap-16 label-ul">
                <?php foreach ($curatedArray as $item) { ?>
                <li>
                    <button class="btn-secondary label-btn" type="button" data-value="<?= $item['slug'] ?>" aria-current="0">
                        <?= $item['content'] ?>
                    </button>
                </li>
                <?php } ?>
            </ul>
            <div class="mb-4 custom-select label-select">
                <div class="select">
                    <select class="text-center" name="label" id="label">
                        <?php foreach ($curatedArray as $index=>$item) { ?>
                            <option value="<?= $item['slug'] ?>"><?= $item['content'] ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>
            <?php endif; ?>
        </div>
    </div>
    <div class="teq-row max-w">
        <div class="swiper cp-slider" data-nb-slides-desktop="4" data-nb-slides-tablet="2" data-nb-slides-mobile="1"
             data-space="32" data-space-mobile="16">
            <div class="swiper-navigation-prev">
                <button type="button" class="swiper-button-prev" aria-label="Slider à gauche">
                    <svg width="10" height="10" viewBox="0 0 10 10" fill="none"
                         xmlns="http://www.w3.org/2000/svg">
                        <path d="M6 9L2 5L6 1" stroke="white" stroke-width="2"/>
                        <rect width="8" height="2" transform="matrix(-1 0 0 1 10 4)" fill="white"/>
                    </svg>
                </button>
            </div>
            <div class="swiper-wrapper mb-8">
                <!-- Les slides -->
                <?php if ($fields['list']) : ?>
                    <?php foreach ($fields['list'] as $item) {
                        include(get_template_directory() . '/acf/blocks/adn/_partials/card-slider.php');
                    } ?>
                <?php endif; ?>
            </div>
            <div class="swiper-navigation-next">
                <button type="button" class="swiper-button-next" aria-label="Slider à droite">
                    <svg width="10" height="10" viewBox="0 0 10 10" fill="none"
                         xmlns="http://www.w3.org/2000/svg">
                        <path d="M4 9L8 5L4 1" stroke="white" stroke-width="2"/>
                        <rect y="4" width="8" height="2" fill="white"/>
                    </svg>
                </button>
            </div>
            <div class="swiper-scrollbar" role="scrollbar" aria-hidden="true"></div>
        </div>
    </div>
</div>