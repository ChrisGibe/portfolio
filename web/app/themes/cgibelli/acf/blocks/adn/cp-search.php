<?php if (!empty($block['data']['is_preview']) || !empty($is_preview)) : ?>
    <img src="<?= get_template_directory_uri() . '/acf/preview/cp-search.png' ?>"
         style="width:100%; height:auto;"
         alt="preview">
    <?php return; ?>
<?php endif; ?>

<?php

$fields = get_fields();

$filters = generateFilterSearch($fields);

if (function_exists('icl_get_current_language')) {
    $lang = (icl_get_current_language()) ?? 'fr';
} else {
    $lang = 'fr';
}

$add_filter_require = '&lang=' . $lang;

$add_filter_require .= '&post_ctp_list=' . htmlentities(json_encode($fields['post_type'])) . '&';

$urlAjax = str_replace('/wp', '', site_url()) . '/ajax.php';

// si test-mode=true alors on utilise les mocks
$path2 = get_template_directory() . '/acf/mocks/list.json';
$file_filters2 = file_get_contents($path2);
$data_filters2 = json_decode($file_filters2, true);

//$urlAjax = 'https://vgf-ppd.rec-volkswagengroup.fr/ajax.php?action=filter_search&slug_show_taxo=brand&posts_per_page=8&post_ctp_list=[%22post%22,%22page%22,%22evenement%22,%22communique_de_presse%22,%22document%22]&&taxo=%7B%7D';
?>
<div id="cp-search" class="teq-container cp-search">
    <cp-search base-url="<?= $urlAjax . '?action=filter_search' . $add_filter_require ?>"
               base-url-autocompletion="<?= $urlAjax . '?action=filter_search_autocompletion' . $add_filter_require ?>"
               text-search="<?= __('Rechercher', 'cgibelli') ?>"
               results="<?= __('résultats', 'cgibelli') ?>"
               :filters="<?php echo htmlentities(json_encode($filters)); ?>"
               :list2="<?php echo htmlentities(json_encode($data_filters2)); ?>"
               next-button="<?= __('suivant', 'cgibelli') ?>"
               prev-button="<?= __('précédent', 'cgibelli') ?>"
               :show-tag="true"
               :test-mode="false"
               :show-filter="true"
               :show-autocomplete="false"
               text-no-completion="<?= __("Il n'existe aucun résultat", 'cgibelli') ?>"
               text-reste="<?= __("Réinitialiser", 'cgibelli') ?>"
               text-empty-list="<?= __("Aucun contenu disponible avec ces filtres.", 'cgibelli') ?>"></cp-search>
</div>

<!-- 
baseurl : base ajax request
text-search : placeholder name
results : text number of resultats
filters : filters list 
next-button : pagination text next
prev-button : pagination text previous
text-empty-list : text if no results
show-tag
test-mode : fake data or not
list2 : fake data exist if test mode is use
-->
