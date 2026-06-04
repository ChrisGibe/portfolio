<?php

const ID_GOOGLE = 'VOTRE_ID_GA_GOOGLE';

/**
 * Generic gtm data so you DRY
 */
function gtm_data($append = null, $post = null)
{
    if (!$post) {
        $post = get_post($post);
    }

    //$locale = locale_parse(current_language()['default_locale']);

    $data = [
        'brand' => 'ex : dacia',
        'googleAccount' => ID_GOOGLE,
        'pageName' => $post->post_name,
        'businessType' => 'transverse',
        'pageType' => $post->post_type,
        'countryCode' => isset($locale['region']) ? $locale['region'] : 'FR',
        'languageCode' => isset($locale['language']) ? $locale['language'] : 'en'
    ];

    if (!empty($append)) {
        $data = array_merge($data, $append);
    }

    return wp_json_encode($data, JSON_UNESCAPED_UNICODE);
}

add_action('wp_head', function () {
    if (WP_ENV !== 'production') {
        return;
    } ?>
    <script>
        window.dataLayer = window.dataLayer || [];
        window.dataLayer.push(<?= gtm_data(); ?>)
    </script>

    <!-- Google Tag Manager -->
    <script>
        (function (w, d, s, l, i) {
            w[l] = w[l] || [];
            w[l].push({
                'gtm.start': new Date().getTime(),
                event: 'gtm.js'
            });
            var f = d.getElementsByTagName(s)[0],
                j = d.createElement(s),
                dl = l != 'dataLayer' ? '&l=' + l : '';
            j.async = true;
            j.src =
                'https://www.googletagmanager.com/gtm.js?id=' + i + dl;
            f.parentNode.insertBefore(j, f);
        })(window, document, 'script', 'dataLayer', <?= ID_GOOGLE?>);
    </script>
    <!-- End Google Tag Manager -->
    <?php
}, 1);

add_action('wp_body_open', function () {
    if (WP_ENV !== 'production') {
        return;
    } ?>
    <!-- Google Tag Manager (noscript) -->
    <noscript>
        <iframe src="https://www.googletagmanager.com/ns.html?id=<?= ID_GOOGLE ?>" height="0" width="0"
                style="display:none;visibility:hidden"></iframe>
    </noscript>
    <!-- End Google Tag Manager (noscript) -->
    <?php
}, 1);
