<div class="grid__container separations page-section_JS" id="reservations">
    <div class="grid__col-1-2">
          <h3 class="reservations__title"><?= __('reservaciones',TRANSDOMAIN) ?></h3>

          <div class="flex reservations__1-2">
               <div class="reservations__menu">
                    <h5 class="reservations__menu-degustacion"> <?= __('Menú degustación',TRANSDOMAIN) ?> </h5>

                    <div class="reservations__menu-carta">
                         <p><?= __('Comida',TRANSDOMAIN) ?></p>
                         <p>13:30 - 15:00</p>
                         <br>
                         <p><?= __('Cena',TRANSDOMAIN) ?></p>
                         <p>18:15</p>
                         <p>21:45</p>
                         <br>
                         <p><?= __('Barra de Tacos',TRANSDOMAIN) ?></p>
                         <p>13:30</p>
                         <p>16:00</p>
                         <p>18:30</p>
                         <p>21:30</p>
                    </div>
                    <div class="form-group reservations__button">
                        <a  class="button" target="_blank" href="https://pujol.meitre.com/"><?= __('Reservar',TRANSDOMAIN) ?></a>
                    </div>
               </div>

               <div class="reservations__mesa">

                    <div class="reservations__restaurants--content">
                      <?= $home_page->reservations->content_1 ?>
                    </div>

               
                    <div class="reservations__restaurants--content">
                      <?= $home_page->reservations->content_2 ?>
                    </div>
                    <!-- <form class="reservaciones__form" >
                         <div class="form-group">
                              <input class="form-control" type="text" name="" placeholder="Name">
                         </div>
                         <div class="form-group">
                              <select class="reservations__form--select">
                                   <option value="volvo"> //__('No. de personas',TRANSDOMAIN) ?></option>
                              </select>
                         </div>
                         <div class="form-group">
                              <select class="reservations">
                                   <option value="volvo"> //__('Fecha/hora',TRANSDOMAIN) ?></option>
                              </select>
                         </div>
                         <div class="form-group reservations__button">
                             <a  class="button" target="_blank" href="https://pujol.meitre.com/"> //__('Reservar',TRANSDOMAIN) ?></a>
                         </div>


                         <p class="reservations__mesa--date"> //__('Fecha recomendada - <span>Fecha/hora</span>',TRANSDOMAIN) ?>  </p>

                    </form> -->
               </div>
          </div>



    </div>
    <div class="grid__col-1-2 display reservations__images">
        <div class="grid__col-1-2--images">
            <?php if ($home_page->reservations->location_1): ?>
                <img class="reservations__image"
                src="<?= $home_page->reservations->location_1->getImgSrc("full") ?>"
                alt="<?= $home_page->reservations->location_1->alt ?>">

            <?php endif; ?>
            <p class="reservations__restaurants-name"><?= __('Pujol',TRANSDOMAIN) ?></p>


        </div>
        <div class="grid__col-1-2--images">
            <?php if ($home_page->reservations->location_2): ?>
                <img class="reservations__image"
                src="<?= $home_page->reservations->location_2->getImgSrc("full") ?>"
                alt="<?= $home_page->reservations->location_2->alt ?>">

            <?php endif; ?>
            <p class="reservations__restaurants-name"><?= __('Barra de Tacos',TRANSDOMAIN) ?></p>

        </div>
    </div>
</div>
