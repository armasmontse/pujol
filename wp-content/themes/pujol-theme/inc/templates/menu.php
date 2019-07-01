<div class="grid__container separations page-section_JS" id="menu">
    <div class="grid__col-1-2-menu--big menu__images-container menu_parallax_JS" id="menu_parallax_JS" >
        <?php foreach ($home_page->menu->gallery as $key => $image): ?>
            <div class="menu__contain-image menu__image--<?= $key%2 == 0  ? "odd" : "even"?> y-scroll_JS "
               data-transition="<?= ($key+1)*$home_page->menu->gallery_gap?>"
               data-time="0">
                 <img class="menu__contain-image--img"
                     src="<?= $image->getImgSrc("full") ?>"
                     alt="<?= $image->alt ?>"
                     >
            </div>
        <?php endforeach; ?>
    </div>
    <div class="grid__col-1-2-menu--small menu__images-container">
        <h3 class="menu__title"><?= __('menú',TRANSDOMAIN) ?></h3>

        <?php foreach ($home_page->menu->items as $key => $item): ?>
            <div class="menu__col">

                <h3 class="menu__title menu__title--separations">
                  <span class="menu__title--span">
                    <?= $item->title ?>
                  </span>
                  <span class="menu__title--span-num">
                    <?= str_pad( $key+1, 2 , "0", STR_PAD_LEFT); ?>
                  </span>
                </h3>
                <div class="menu__foods">
                    <?= $item->content ?>
                </div>
            </div>
        <?php endforeach; ?>

    </div>
</div>
