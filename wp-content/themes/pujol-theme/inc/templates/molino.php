<div class="grid__container molino__container molino__container--width">

     <div class="grid__col-1-1 molino__content-title">
          <div class="molino__title">
               <?= $home_molino->post->post_title ?>
          </div>
     </div>

    <div class="grid__col-1-2-molino--big molino__container molino__container--baseline">
        <div class="molino__col--big">
            <?php if ($home_molino->about->image_1): ?>
                <img class="molino__description-img" src="<?= $home_molino->about->image_1->getImgSrc("full")  ?>" alt="<?= $home_molino->about->image_1->alt  ?>">
            <?php endif; ?>
        </div>
        <div class="molino__col--small">
            <div class="molino__text about-paragraph">
                 <?= $home_molino->about->content ?>
            </div>
        </div>

    </div>

    <div class="grid__col-1-2-molino--small">
        <?php if ($home_molino->about->image_3): ?>
            <img class="molino__hours-img" src="<?= $home_molino->about->image_3->getImgSrc("full")  ?>" alt="<?= $home_molino->about->image_3->alt  ?>">
        <?php endif; ?>


    </div>



    <div class="grid__col-1-2-molino--big molino__container molino__container--baseline">

        <?php if ($home_molino->about->image_2): ?>
            <img class="molino__col--img" src="<?= $home_molino->about->image_2->getImgSrc("full")  ?>" alt="<?= $home_molino->about->image_2->alt  ?>">
        <?php endif; ?>
        <div class="molino__contact">
            <p class="molino__contact-title">Contacto</p>
            <a class="molino__contact-link" href="<?= $home_molino->about->email  ?>"><?= $home_molino->about->email  ?></a>
        </div>
    </div>

    <div class="grid__col-1-2-molino--small">

        <p class="molino__hours"><?= $home_molino->about->hours  ?></p>
        <?php if ($home_molino->about->image_4): ?>
            <img class="molino__map" src="<?= $home_molino->about->image_4->getImgSrc("full")  ?>" alt="<?= $home_molino->about->image_4->alt  ?>">
        <?php endif; ?>

        <p class="molino__addres">
            <?php if (!empty($home_molino->about->address->link)): ?>
                <a href="mailto:<?= $home_molino->about->address->link ?>" target="_blank"> <?= $home_molino->about->address->link_label ?></a> <br><br>
            <?php endif; ?>
            <?= $home_molino->about->address->address  ?>
        </p>

    </div>
</div>
