<?php
$fields = get_fields(wp_get_menu_by_location('footer'));
?>


<footer role="contentinfo" class="fixed overflow-hidden w-full h-auto lg:h-screen <?= is_front_page() ? '' : 'black' ?>">
    <div class="content w-full relative text-center mt-[144px] lg:mt-0">
        <div class="w-full">
            <h2 class="w-fit mx-auto cursor-none">
                <a href="mailto:cgibelli.dev@gmail.com" class="flex flex-col title-container hover-cursor cursor-none!">
                    <?php if($fields["title_line_one"]): ?>
                        <span class="font-bold uppercase neue relative title-top w-full">
                            <span class="inline-block"><?= $fields["title_line_one"]; ?></span>
                            <span class="line"></span>
                        </span>
                    <?php endif; ?>
                    <?php if($fields["title_line_two"]): ?>
                        <span class="font-light saol-italic-ajusted relative title-bottom w-full">
                            <span class="inline-block"><?= $fields["title_line_two"]; ?></span>
                            <span class="line bottom"></span>               
                        </span>
                    <?php endif; ?>
                </a>
            </h2>
            <?php if($fields["contact"]): ?>
                <div class="mt-12 flex items-center justify-center lg:hidden">
                    <a class="cta-primary purple" href="mailto:<?= $fields["contact"]["email_contact"]; ?>">
                        <?= $fields["contact"]["cta_contact_wording"]; ?>
                    </a>
                </div>
            <?php endif; ?>
        </div>
        <div class="flex flex-row lg:row justify-center items-center locations mt-20">
            <div>
                <?php if ($fields['location']): ?>
                    <h3 class="address">
                        <?= $fields['location']; ?>
                    </h3>
                <?php endif; ?>
                <?php if ($fields['availability']): ?>
                    <p class="address">
                        <?= $fields['availability']; ?>
                    </p>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <div class="flex flex-col-reverse lg:flex-row justify-between items-center static lg:absolute bottom px-12 w-full mt-12 mb-6 lg:mt-0 lg:mb-0">
        <div class="flex items-center flex-col-reverse lg:flex-row gap-8 left mt-20 lg:mt-0">
            <div class="flex justify-center items-center">
                <p class="copyright text-xs">© gibellichristophe. <?= date('Y') ?></p>
            </div>
            
            <?php if ($fields['bottom_links']): ?>
                <ul class="infos flex lg:hidden">
                    <?php foreach ($fields['bottom_links'] as $item): ?>
                        <li>
                            <a href="<?= $item["cta"]['url']; ?>" target="<?= $item["cta"]['target']; ?>" class="link-bottom">
                                <?= $item["cta"]['title']; ?>
                            </a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>
        </div>
        <div class="flex items-center flex-col lg:flex-row gap-8 right">
            <?php if ($fields['bottom_links']): ?>
                <ul class="infos hidden lg:flex">
                    <?php foreach ($fields['bottom_links'] as $item): ?>
                        <li>
                            <a href="<?= $item["cta"]['url']; ?>" target="<?= $item["cta"]['target']; ?>" class="link-bottom">
                                <?= $item["cta"]['title']; ?>
                            </a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>
            <?php if($fields["socials_network"]): ?>
                <nav>
                    <ul class="flex gap-6">
                        <?php foreach($fields["socials_network"] as $item): ?>
                            <li>
                                <a href="<?= $item["social"]["url"]; ?>" target="_blank" rel="noopener noreferrer" class="flex items-baseline justify-center gap-2 link-bottom social-link leading-none" aria-label="<?= $item["social"]['aria_label']; ?> - Open in a new tab">
                                    <?= $item["social"]['name']; ?>
                                    <div class="inline-flex w-2 h-2">
                                        <svg class="flex w-full h-full" aria-hidden="true" focusable="false" xmlns="http://www.w3.org/2000/svg" width="8" height="8" viewBox="0 0 8 8" fill="none">
                                            <path d="M1.5 0.5H7.5V6.5" stroke="white"/>
                                            <path d="M7 1L1 7" stroke="white"/>
                                        </svg>
                                    </div>
                                </a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </nav>
            <?php endif; ?>
            <?php if ($fields['designer']): ?>
                <div class="flex justify-center items-center">
                    <a href="<?= $fields['designer']['url']; ?>" target="<?= $fields['designer']['target']; ?>" rel="noopener noreferrer" class="flex items-baseline justify-center gap-2 link-bottom leading-none">
                        <?= $fields['designer']['title']; ?>
                        <div class="inline-flex w-2 h-2">
                            <svg class="flex w-full h-full" aria-hidden="true" focusable="false" xmlns="http://www.w3.org/2000/svg" width="8" height="8" viewBox="0 0 8 8" fill="none">
                                <path d="M1.5 0.5H7.5V6.5" stroke="white"/>
                                <path d="M7 1L1 7" stroke="white"/>
                            </svg>
                        </div>
                    </a>
                </div>
            <?php endif; ?>
        </div>
    </div>
</footer>
<div class="custom-cursor-footer">
    <?= $fields["contact"]["cta_contact_wording"]; ?>
</div>

