<?php

class Account_Form_Avatar extends Media_Form_Media
{

    const MIME_IMAGE = 'image';

    public function init()
    {

        parent::init();

        $this->setName('Account_Form_Avatar');
        $this->getElement('tags')->setValue('avatar');

    }

}