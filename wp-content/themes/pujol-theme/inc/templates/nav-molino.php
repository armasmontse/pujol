<div class="grid__container grid__container--no-padding header__container--hover header__mobile-container header--padding" id="header-fixed_JS">
     <a href="<?php echo BLOGURL ?> ">
          <h1 class="header__title--small header__title--small-responsive <?php if(is_page('molino')): ?>none<?php endif ?>" id='title--small_JS'> <?= __('pujol',TRANSDOMAIN) ?> </h1>
     </a>
     <div class="mobile_btn_JS header__mobile--btn">
          <img src="<?php echo THEMEURL ?>/images/collapse.png " alt="">
     </div>
     <nav class="header__container header__mobile mobile_JS" id="header__navbar__JS">
          <ul class="header__menu">
               <a  class="header__mobile--item menu-link" href="<?php echo BLOGURL ?>/#us"><li> <?= __('Nosotros',TRANSDOMAIN) ?></li></a>
               <a  class="header__mobile--item menu-link" href="<?php echo BLOGURL ?>/#reservations"><li> <?= __('Reservaciones',TRANSDOMAIN) ?></li></a>
               <a  class="header__mobile--item menu-link" href="<?php echo BLOGURL ?>/#menu"><li> <?= __('Menú',TRANSDOMAIN) ?></li></a>
               <a  class="header__mobile--item menu-link" href="<?php echo BLOGURL ?>/#contact"><li> <?= __('Contacto',TRANSDOMAIN) ?></li></a>
          </ul>

          <a href="<?php echo BLOGURL ?> ">
               <div class="header__molino-logo">
                    <img src="<?php echo THEMEURL ?>/images/pujol.svg " alt="Pujol">
               </div>
          </a>

          <div class="header__languages" style="justify-content: flex-end; ">
               <!-- <div class="menu-link menu-link-home header__item header__comming-soon">
                    <span class="header__item--inactive">//__('Diario',TRANSDOMAIN) ?></span>
                    <span class="header__item--coming-soon"> //__('próximamente',TRANSDOMAIN) ?></span>
               </div> -->
               <!-- <div class="menu-link menu-link-home header__item header__comming-soon">
                    <span class="header__item--inactive"> //__('Tienda',TRANSDOMAIN) ?></span>
                    <span class="header__item--coming-soon"> //__('próximamente',TRANSDOMAIN) ?></span>
               </div>
               <div class="header__mobile--item header__molino header__item" style="width:  114px; text-align:  center;">
                    <span class="header__item--inactive"> //__('Molino "El pujol',TRANSDOMAIN) ?></span>
                    <span class="header__item--coming-soon"> //__('próximamente',TRANSDOMAIN) ?></span>
               </div> -->
               <?php if (function_exists("qts_language_menu")): ?>
               <?php qts_language_menu('text', ['short' => true,'class' => 'header__languages-link',]) ?>
               <?php endif; ?>
          </div>
    </nav>
</div>
