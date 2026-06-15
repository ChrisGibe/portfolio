<?php if(is_front_page()): ?>
    <footer role="contentinfo" class="fixed overflow-hidden">
        <div class="content w-full relative text-center">
            <a href="#" class="w-full">
                <h2>
                    <div class="flex flex-col title-container">
                        <span class="w-700 uppercase neue relative title-top w-full">
                            Parlons
                            <span class="line"></span>
                        </span>
                        <span class="w-400 saol-italic-ajusted relative title-bottom w-full">
                            de votre projet
                            <span class="line bottom"></span>               
                        </span>
                    </div>
                </h2>
            </a>
            <ul class="flex flex-row lg:row justify-center items-center locations gap-8">
                <li>
                    <h3 class="neue uppercase town">Nice</h3>
                    <p class="address">6 Place Garibaldi - 06300 Nice <br> +33 (0)4 92 00 80 30</p>
                </li>
                <li>
                    <h3 class="neue uppercase town">Paris</h3>
                    <p class="address">22 Bd Malesherbes - 75008 Paris <br> +33 (0)4 92 00 80 30</p>
                </li>
                <li>
                    <h3 class="neue uppercase town">Alger</h3>
                    <p class="address">Bd du 11 Décembre 1960 - El Biar <br> +213 21 79 32 09</p>
                    </li>
                <li>
                    <h3 class="neue uppercase town">Abu Dhabi</h3>
                    <p class="address">Bd du 11 Décembre 1960 - El Biar <br> +213 21 79 32 09</p>
                </li>
            </ul>
        </div>
        <div class="flex col lg:row-lg justify-between absolute bottom">
            <div class="flex align-center col lg:row-lg gap-55 left">
                <p class="copyright w-600">© tequilarapido. 2023</p>
                <nav class="infos">
                    <ul class="flex gap-24">
                        <li>
                            <a href="" target="" class="link-bottom">Accessibilité : Totalement conforme</a>
                        </li>
                        <li>
                            <a href="" target="" class="link-bottom">Eco-index : B</a>
                        </li>
                        <li>
                            <a href="" target="" class="link-bottom">Mentions légales</a>
                        </li>
                        <li>
                            <a href="" target="" class="link-bottom">Données personnelles</a>
                        </li>
                    </ul>
                </nav>
            </div>
            <div class="flex align-center col lg:row-lg gap-57 right">
                <a href="" target="" class="flex gap-5 link-bottom">
                    Nous rejoindre
                    <svg class="icon-arrow-tab">
                        <use xlink:href="#icon-arrow-tab"></use>
                    </svg>
                </a>
                <nav>
                    <ul class="flex gap-16">
                        <li>
                            <a href="" target="" class="flex gap-5 link-bottom">
                                IG.
                                <svg class="icon-arrow-tab">
                                    <use xlink:href="#icon-arrow-tab"></use>
                                </svg>
                            </a>
                        </li>
                        <li>
                            <a href="" target="" class="flex gap-5 link-bottom">
                                X.
                                <svg class="icon-arrow-tab">
                                    <use xlink:href="#icon-arrow-tab"></use>
                                </svg>
                            </a>
                        </li>
                        <li>
                            <a href="" target="" class="flex gap-5 link-bottom">
                                LK.
                                <svg class="icon-arrow-tab">
                                    <use xlink:href="#icon-arrow-tab"></use>
                                </svg>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </footer>
<?php endif; ?>

<div id="grid" class="teq-container max-w-full w-full h-screen py-0 fixed top-0 left-1/2 -translate-x-1/2 z-10">
    <div class="teq-grid w-full">
        <?php for($i=0;$i < 24; $i++){ ?>
        <div class="col-span-1 bg-grid"></div>
        <?php } ?>
    </div>
</div>
