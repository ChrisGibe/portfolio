<?php if (!empty($block['data']['is_preview']) || !empty($is_preview)) : ?>
    <img src="<?= get_template_directory_uri() . '/acf/preview/cp-video.png' ?>"
         style="width:100%; height:auto;"
         alt="preview">
    <?php return; ?>
<?php endif; ?>

<?php
$id = 'cp-video-' . (!empty($block['id'])) ? $block['id'] : '';
if (!empty($block['anchor'])) {
    $id = $block['anchor'];
}

$fields = get_fields();
?>

<div class="cp-video teq-container <?= ($fields['full_width'] === 'oui') ? 'full-img' : '' ?>">
    <?php if (!empty($fields['title'])): ?>
        <div class="teq-row max-w justify-center mb-2">
            <div class="col-12 col-tab-10">
                <h2 class="txt-44 w-700 c-dark mb-2 text-center"><?= $fields['title'] ?></h2>
            </div>
        </div>
    <?php endif; ?>
    <div class="teq-row max-w">
        <figure class="col-12 <?= ($fields['full_width'] === 'oui') ? '' : 'col-tab-10 offset-tab-1' ?>">
            <?php if (!empty($fields['video_type']) && $fields['video_type'] === 'mp4'): ?>
                <video id="player"
                       src="<?= $fields['video_mp4']['url'] ?? '' ?>"
                       data-poster="<?= $fields['image']['url'] ?? '' ?>"
                       controls></video>
                </video>
            <?php endif; ?>
            <?php if (!empty($fields['video_type']) && $fields['video_type'] === 'youtube'): ?>
                <div id="player"
                     class="plyr__video-embed"
                     data-plyr-provider="youtube"
                     data-plyr-config='{ "youtube": {controls: false} }'
                     data-plyr-embed-id="<?= $fields['id_youtube'] ?? '' ?>"
                     data-poster="<?= $fields['image']['url'] ?? '' ?>">
                </div>
            <?php endif; ?>
            <?php if (!empty($fields['video_type']) && $fields['video_type'] === 'vimeo'): ?>
                <div id="player"
                     class="plyr__video-embed"
                     data-plyr-provider="vimeo"
                     data-plyr-embed-id="<?= $fields['id_vimeo'] ?? '' ?>"
                     data-poster="<?= $fields['image']['url'] ?? '' ?>">
                </div>
            <?php endif; ?>
            <?php if (!empty($fields['text'])): ?>
                <figcaption class="cp-wysiwyg mt-2">
                    <?= $fields['text'] ?>
                <?php endif; ?>
            </figcaption>
        </figure>
    </div>
</div>