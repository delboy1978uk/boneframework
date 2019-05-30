<?php

namespace BoneMvc\Module\Dragon\Form;

use BoneMvc\Module\Dragon\Entity\Dragon;
use Del\Form\AbstractForm;
use Del\Form\Field\Submit;
use Del\Form\Field\Text;

class DragonForm extends AbstractForm
{
    public function init()
    {
        $name = new Text('name');
        $name->setLabel('Name');
        $name->setRequired(true);
        $this->addField($name);

        $submit = new Submit('submit');
        $this->addField($submit);
    }
}
