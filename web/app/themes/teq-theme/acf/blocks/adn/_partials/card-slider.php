<?php if (!empty($item)): ?>
    <div class="swiper-slide" data-value="<?= strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $item['tag']))) ?>">
        <div class="illust mb-3">
            <?php if ($item['image']): ?>
                <img style="aspect-ratio: 1/1"
                     src="<?= ($item['image']['url']) ?: '' ?>"
                     alt="<?= ($item['image']['alt']) ?: $item['image']['title'] ?>">
            <?php endif; ?>
        </div>
        <div class="content">
            <?php if ($item['tag']): ?>
                <p class="txt-16 w-500 uppercase c-dark mb-1"><?= $item['tag'] ?></p>
            <?php endif; ?>
            <?php if ($item['link']): ?>
                <a href="<?= $item['link'] ?>"
                   target="<?= ($item['target']) ? '_blank' : '_self' ?>"
                   role="link"
                   class="stretched-link txt-16 w-400 c-dark">
                    <?= $item['title'] ?? '' ?>
                </a>
            <?php endif; ?>
        </div>
    </div>
<?php endif; ?>