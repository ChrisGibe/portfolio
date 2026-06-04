<?php if (!empty($block['data']['is_preview']) || $is_preview) : ?>
    <img src="<?= get_template_directory_uri() . '/acf/preview/cp-contact-form.png'; ?>"
         style="width:100%; height:auto;">
    <?php return; ?>
<?php endif; ?>

<?php

/**
 * Setup Ninja Form for this block
 * Tuto for customise Style :  https://ninjaforms.com/docs/custom-css/
 *
 * - Active Dev Mode : https://ninjaforms.com/docs/developer-mode/
 * - Import Moula Example
 * - Copy the shortcode Block Gutenberg ACF
 * - You can add custom class name container or element : https://ninjaforms.com/docs/layouts-and-styles/
 * -
 */

$fields = get_fields();

?>

<?php if (!empty($fields['shortcode'])): ?>
    <div class="cp-contact-form teq-container">
        <div class="teq-row max-w justify-center">
            <div class="col-12 col-lg-10 form-container">
                <?php echo do_shortcode($fields['shortcode']) ?>
            </div>
        </div>
    </div>
<?php endif ?>