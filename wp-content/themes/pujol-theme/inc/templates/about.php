<?php

$home_page->about->image_1->transition = '33.333333333333';
$home_page->about->image_2->transition = '44';
$home_page->about->image_3->transition = '20';

$home_page->about->image_1->time = '0';
$home_page->about->image_2->time = '1.5';
$home_page->about->image_3->time = '0.1';

$home_page->about->image_1->duration = '3';
$home_page->about->image_2->duration = '100%';
$home_page->about->image_3->duration = '100%';

?>
<div class="grid__container about__container separations page-section_JS" id="us">
    <div class="grid__col-1-2--big about__responsive menu_parallax_JS" id="about__responsive__JS">
        <?php for ($i=1; $i <=3 ; $i++): if ($home_page->about->{ 'image_' . $i }): ?>
               <img
                    data-transition="<?php echo $home_page->about->{ 'image_' . $i }->transition; ?>"
                    data-duration="<?php echo $home_page->about->{ 'image_' . $i }->duration; ?>"
                    data-time="<?php echo $home_page->about->{ 'image_' . $i }->time; ?>"
                    class="about__img-<?= $i ?> about__img--<?= $i%2 == 0  ? "odd" : "even"?> y-scroll_JS"
                    src="<?= $home_page->about->{ 'image_' . $i }->getImgSrc('full') ?>" alt="<?= $home_page->about->{ 'image_' . $i }->alt ?>"
               >
        <?php endif; endfor; ?>
    </div>
    <div class="grid__col-1-2--small">
        <div class="about__text">
            <?= $home_page->about->content ?>
        </div>
    </div>
</div>
