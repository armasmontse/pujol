<?php
$home_molino = new Cltvo_Page_Molino() ;
$GLOBALS['home_molino'] = $home_molino;
 ?>
<?php get_header(); ?>

    <div class="grid__row">
        <!-- seccion 'menú' -->
        <?php  include get_stylesheet_directory() . '/inc/templates/nav-molino.php'  ?>

        <!-- seccion 'molino' -->
        <?php  include get_stylesheet_directory() . '/inc/templates/molino.php'  ?>

    </div>


<?php get_footer(); ?>
