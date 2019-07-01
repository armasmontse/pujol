<?php

class Cltvo_Page_Molino extends Cltvo_Page
{
    public $about;

    function __construct(){
        parent::__construct(specialPage('molino',true));
    }


    public function setMetas()
    {
        $this->about = $this->getAbout();
    }

    protected function getAbout()
    {
        $about = Cltvo_Molino::getMetaValue($this->post);
        $about["content"] = wpautop($about["content"]);
        $about["hours"] = nl2br($about["hours"]);
        $about["email"] = filter_var($about["email"], FILTER_VALIDATE_EMAIL) ? $about["email"] : "info@grupolvera.com";

        $address = (object)($about["address"]);
        $address->link = filter_var($address->link, FILTER_VALIDATE_URL) ? $address->link : "";
        $address->address = nl2br($address->address);
        $about["address"] = $address;

        return (object)$about;
    }
}
