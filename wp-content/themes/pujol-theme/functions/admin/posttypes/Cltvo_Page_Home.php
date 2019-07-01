<?php

class Cltvo_Page_Home extends Cltvo_Page
{
    public $contact;
    public $breaks;
    public $reservations;
    public $about;
    public $menu;

    function __construct(){
        parent::__construct(specialPage('home',true));
    }


    public function setMetas()
    {
        $this->contact = $this->getSocialNets();
        $this->breaks = (object)Cltvo_Breaks::getMetaValue($this->post);
        $this->reservations = $this->getReservations();
        $this->about = $this->getAbout();
        $this->menu = $this->getMenu();

    }

    public function getReservations()
    {
      $revervations = (object)Cltvo_Reservations::getMetaValue($this->post);

      $revervations->content_1 = wpautop($revervations->content_1);
      $revervations->content_2 = wpautop($revervations->content_2);

      return $revervations ;

    }
    protected function getMenu()
    {
        $menu = Cltvo_Menu::getMetaValue($this->post);

        $menu["items"] = array_values( array_map(function($item){
            $item->content = nl2br($item->content);
            return $item;
        }, $menu["items"]));

        $menu["gallery"] = Cltvo_Menu::getGalleryImages( $menu["gallery"]);

        $menu["gallery_gap"]  = empty($menu["gallery"]) ? 0 : 100/count($menu["gallery"]);

        return (object)$menu;
    }

    protected function getSocialNets()
    {
        $social_nets = Cltvo_SocialNet::getMetaValue($this->post);

        $redes = [];

        foreach (Cltvo_SocialNet::$redesConUrl as $net => $label) {
            if (filter_var($social_nets[$net]["url"], FILTER_VALIDATE_URL)) {
                $redes[] = (object) [
                    "label" => empty($social_nets[$net]["label"]) ? $label : $social_nets[$net]["label"],
                    "url"   => $social_nets[$net]["url"],
                ];
            }
        }

        $social_nets["mail"] = filter_var($social_nets["mail"], FILTER_VALIDATE_EMAIL) ? $social_nets["mail"] : "info@grupolvera.com";

        $social_nets["nets"] = $redes;
        return (object) $social_nets;
    }

    protected function getAbout()
    {
        $about = Cltvo_About::getMetaValue($this->post);
        $about["content"] = wpautop($about["content"]);
        return (object)$about;
    }
}
