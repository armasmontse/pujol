<div class="grid__container grid__container--no-padding" id="height_JS">
    <img class="header__img"
        src="<?= $home_page->thumbail_img ? $home_page->thumbail_img->getImgSrc("full") : "" ?>"
        alt="<?= $home_page->thumbail_img ? $home_page->thumbail_img->alt : "" ?>"
        >
     <a href="<?php echo BLOGURL ?> ">
          <h1 class="header__title" id="title_JS">
              <?= __('pujol',TRANSDOMAIN) ?>
          </h1>
     </a>
</div>
