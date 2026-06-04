<?php if (!empty($block['data']['is_preview']) || !empty($is_preview)) : ?>
    <img src="<?= get_template_directory_uri() . '/acf/preview/cp-tab-cards.png' ?>" style="width:100%; height:auto;"
         alt="preview">
    <?php return; ?>
<?php endif; ?>

<?php
$id = 'cp-tab-cards-' . (!empty($block['id'])) ? $block['id'] : '';
if (!empty($block['anchor'])) {
    $id = $block['anchor'];
}

$fields = get_fields();
?>

<div class="teq-container cp-tab-cards">
    <?php if (!empty($fields['title'])): ?>
        <div class="teq-row max-w">
            <div class="col-12">
                <h2 class="txt-44 w-700 c-dark mb-2"><?= $fields['title'] ?></h2>
            </div>
        </div>
    <?php endif; ?>
    <div class="teq-row max-w mb-4 mb-md-8">
        <div class="col-12 d-flex align-center tag-container">
            <!-- Les labels (ou tag) -->
            <?php if (!empty($fields['list'])) : ?>
                <ul class="d-flex gap-64 relative label-ul">
                    <?php foreach ($fields['list'] as $key => $item) : ?>
                        <li>
                            <button class="txt-16 w-400 c-dark label-btn <?= $key === 0 ? 'active' : '' ?>"
                                    type="button" aria-current="<?= $key === 0 ? 'true' : 'false' ?>" data-index="tab-<?= $key + 1 ?>">
                                <?= $item['tab_title'] ?? '' ?>
                            </button>
                        </li>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>
        </div>
    </div>
    <div class="teq-row max-w justify-center">
        <?php if (!empty($fields['list'])) : ?>
            <?php foreach ($fields['list'] as $key => $item) : ?>
                <div class="d-flex col-12 col-md-6 mb-6 <?= $key === 0 ? 'active' : '' ?>" id="tab-<?= $key + 1 ?>">
                    <div class="teq-row justify-start justify-md-end align-center">
                        <div class="col-6 col-sm-4 illust">
                            <?php if ($item['image']): ?>
                                <img src="<?= ($item['image']['url']) ?: '' ?>"
                                     alt="<?= ($item['image']['alt']) ?: $item['image']['title'] ?>">
                            <?php endif; ?>
                        </div>
                        <div class="col-6 col-sm-8 col-md-6 d-flex column content">
                            <?php if ($item['text']): ?>
                                <p class="txt-20 w-400 uppercase c-dark mb-2"><?= $item['text'] ?></p>
                            <?php endif; ?>
                            <?php if ($item['document_link']): ?>
                                <a class="mb-1" href="<?= $item['document']['url'] ?>" target="_blank">
                                    <svg class="icon-arrow-tab mr-1">
                                        <use xlink:href="#icon-arrow-tab"></use>
                                    </svg>
                                    <?= __('Consulter en ligne', 'teq-theme') ?>
                                </a>
                            <?php endif; ?>
                            <?php if ($item['document_download']): ?>
                                <a class="mb-1 dl-button" href="<?= $item['document']['url'] ?>" download>
                                    <svg class="icon-arrow-tab mr-1">
                                        <use xlink:href="#icon-arrow-tab"></use>
                                    </svg>
                                    <?= __('Télécharger', 'teq-theme') ?>
                                </a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</div>