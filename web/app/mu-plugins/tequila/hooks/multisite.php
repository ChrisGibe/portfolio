<?php

/**
 * Correct the cookie domain when a custom domain is mapped to the site.
 * @see https://blog.handbuilt.co/2016/07/07/fixing-cookie_domain-for-mapped-domains-on-multisite/
 */
add_action('muplugins_loaded', function () {
    global $current_blog, $current_site;
    if (false === stripos($current_blog->domain, $current_site->cookie_domain)) {
        $current_site->cookie_domain = $current_blog->domain;
    }
});
