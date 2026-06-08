<?php if (!empty($block['data']['is_preview']) || !empty($is_preview)) : ?>
    <img src="<?= get_template_directory_uri() . '/acf/preview/cp-video-txt-cta.png' ?>"
         style="width:100%; height:auto;"
         alt="preview">
    <?php return; ?>
<?php endif; ?>

<?php
$id = 'cp-video-txt-cta-' . (!empty($block['id'])) ? $block['id'] : '';
if (!empty($block['anchor'])) {
    $id = $block['anchor'];
}

$fields = get_fields();
?>

<div id="<?= esc_attr($id) ?>" class="cp-video-txt-cta teq-container">
    <?php if (!empty($fields['title'])): ?>
        <div class="teq-row max-w">
            <div class="col-12">
                <h2 class="txt-44 w-700 c-dark mb-2"><?= $fields['title'] ?></h2>
            </div>
        </div>
    <?php endif; ?>
    <div class="teq-row max-w column <?= (!empty($fields['pos_video']) && $fields['pos_video'] === 'gauche') ? 'row-lg' : 'row-r-lg' ?> justify-center">
        <div class="col-12 col-lg-6 col-tab-5 <?= (!empty($fields['pos_video']) && $fields['pos_video'] === 'gauche') ? '' : 'offset-tab-1' ?> mb-3 mb-tab-0 illust">
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
        </div>
        <div class="col-12 col-lg-6 <?= (!empty($fields['pos_video']) && $fields['pos_video'] === 'gauche') ? 'offset-tab-1' : '' ?> d-flex column my-auto">
            <div class="content">
                <?php if (!empty($fields['txt'])): ?>
                    <div class="cp-wysiwyg mb-3">
                        <?= $fields['txt'] ?>
                    </div>
                <?php endif; ?>
                <?php if (!empty($fields['cta'])): ?>
                    <a href="<?= $fields['cta']['url'] ?? '' ?>" target="<?= $fields['cta']['target'] ?: '_self' ?>"
                       class="btn-primary arrow-next <?= ($fields['format_img'] === 'portrait') ? '' : 'mb-4 mb-tab-0' ?>">
                        <?= $fields['cta']['title'] ?? '' ?>
                    </a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>