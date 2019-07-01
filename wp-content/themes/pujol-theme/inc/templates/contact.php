

<div class="grid__container contact page-section_JS" id='contact'>
    <div class="grid__col-1-2--contact display contact__container">
        <div class="contact__col-1-2">
            <h3 class="contact__title"> <?= __("contacto" ,TRANSDOMAIN) ?> </h3>

            <?php if (!empty($home_page->contact->address)): ?>
                <div class="contact__info contact__address reservation-label">
                    <?php echo nl2br($home_page->contact->address) ?>
                </div>
            <?php endif; ?>

            <div class="contact__info contact__phones reservation-label">
                <?php if (!empty($home_page->contact->phone_1)): ?>

                    <?= __("T." ,TRANSDOMAIN) ?> <a href="call:<?php echo $home_page->contact->phone_1 ?>"> <?php echo $home_page->contact->phone_1 ?></a> <br>
                <?php endif; ?>
                <?php if (!empty($home_page->contact->phone_2)): ?>

                    <?= __("T." ,TRANSDOMAIN) ?> <a href="call:<?php echo $home_page->contact->phone_2 ?>"> <?php echo $home_page->contact->phone_2 ?></a> <br>
                <?php endif; ?>
            </div>

            <a class="reservation-label" href="mailto:<?php echo $home_page->contact->mail ?>?Subject=Informes%20Pujol" target="_top"><?php echo $home_page->contact->mail ?></a>
            <a class="reservation-label border" href="http://esmeralda.frontonline.com.mx/PortalTickets-1.0/micros_index.xhtml?configuration=100" target="_blank"><?= __("Facturación" ,TRANSDOMAIN) ?></a>

            <?php if (!empty($home_page->contact->nets)): ?>
                <div class="contact__links">
                    <?php foreach ($home_page->contact->nets as $net): ?>
                        <a class="contact__link" href="<?php echo $net->url ?>" target="_blank"><?php echo $net->label ?></a>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>

        </div>
        <div class="contact__col-1-2">
            <?php if ($home_page->contact->image): ?>
                <img class="contact__image" src="<?= $home_page->contact->image->getImgSrc("full") ?>" alt="<?= $home_page->contact->image->alt ?>">
            <?php endif; ?>
        </div>
    </div>
    <div class="grid__col-1-2--contact contact__map-container display">

        <?php if ($home_page->contact->map): ?>
            <div class="contact__map">
                <img class="contact__map--image" src="<?= $home_page->contact->map->getImgSrc("full") ?>" alt="<?= $home_page->contact->map->alt ?>">
            </div>
        <?php endif; ?>

        <div class="flex-between">

            <?php if (filter_var($home_page->contact->google_maps , FILTER_VALIDATE_URL)): ?>
                <a class="contact__google-map" target="_blank" href="<?=  $home_page->contact->google_maps ?>"> <?= __('Google map',TRANSDOMAIN) ?></a>
            <?php endif; ?>

          <div class="contact__notice">
               <p class="contact__notice--text paddBottom10"><?= __('No contamos con Valet Parking. Estacionamiento en Anatole France 120.',TRANSDOMAIN) ?></p>
               <h5 class="contact__notice--title"><?= __('AVISO IMPORTANTE SI VIENES EN UBER',TRANSDOMAIN) ?></h5>
               <p class="contact__notice--text"><?= __('Te recomendamos introducir manualmente la dirección Tennyson 133, ya que aunque en tu pantalla la opción aparezca como Pujol, la aplicación que utilizan los conductores tiene un error de compatibilidad, y te puede enviar a nuestra antigua ubicación.',TRANSDOMAIN) ?></p>
          </div>
        </div>
      </div>
</div>
