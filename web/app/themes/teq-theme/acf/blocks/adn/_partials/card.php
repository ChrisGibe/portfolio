<?php if (!empty($item)):
    $post = $item['post'];
    if (!empty($post)):
        $post->fields = get_fields($post->ID); ?>
        <div class="col-12 col-sm-6 col-md-4 card mb-3">
            <div class="illust relative">
                <?php if (get_the_post_thumbnail_url($post->ID)): ?>
                    <img src="<?= get_the_post_thumbnail_url($post->ID) ?>" alt="">
                <?php endif; ?>
                <?php if ($post->fields['tag']): ?>
                    <p class="txt-12 w-400 c-dark absolute bg-c-white tag">
                        <?= $post->fields['tag'] ?>
                    </p>
                <?php endif; ?>
            </div>
            <div class="content bg-c-grey">
                <?php if ($post->post_date): ?>
                    <p class="txt-14 w-700 c-dark mb-1">
                        <?= date('j/n/Y', strtotime($post->post_date)) ?>
                    </p>
                <?php endif; ?>
                <?php if (get_post_permalink($post->ID)): ?>
                    <a class="txt-16 w-400 c-dark stretched-link" href="<?= get_post_permalink($post->ID) ?>">
                        <?= $post->post_title ?>
                    </a>
                <?php endif; ?>
            </div>
        </div>
    <?php endif; ?>
<?php endif; ?>