<?php
$home_page = new Cltvo_Page_Home() ;
$GLOBALS['home_page'] = $home_page;
 ?>
<?php get_header(); ?>

    <div class="grid__row">

        <!-- seccion 'imagen y menú' -->
        <?php  include get_stylesheet_directory() . '/inc/templates/splash.php'  ?>
        <?php  include get_stylesheet_directory() . '/inc/templates/nav.php'  ?>


        <!-- seccion 'nosotros' -->
        <?php  include get_stylesheet_directory() . '/inc/templates/about.php'  ?>

        <!-- seccion 'reservaciones' -->
        <?php  include get_stylesheet_directory() . '/inc/templates/reservations.php'  ?>

        <!-- seccion 'cover' -->
        <?php if ($home_page->breaks->break_1): ?>
            <div class="grid__container grid__container--no-padding">
                <img class="header__img" src="<?= $home_page->breaks->break_1->getImgSrc("full") ?>" alt="<?= $home_page->breaks->break_1->alt ?>">
            </div>
        <?php endif; ?>


        <!-- seccion 'menú' -->
        <?php  include get_stylesheet_directory() . '/inc/templates/menu.php'  ?>

        <!-- seccion 'molino' -->
        <?php  //include get_stylesheet_directory() . '/inc/templates/molino.php'  ?>

        <!-- seccion 'cover' -->
        <?php if ($home_page->breaks->break_2): ?>
            <div class="grid__container grid__container--no-padding">
                <img class="header__img" src="<?= $home_page->breaks->break_2->getImgSrc("full") ?>" alt="<?= $home_page->breaks->break_2->alt ?>">
            </div>
        <?php endif; ?>


        <!-- seccion 'contacto' -->
        <?php  include get_stylesheet_directory() . '/inc/templates/contact.php'  ?>

    </div>


<?php get_footer(); ?>
