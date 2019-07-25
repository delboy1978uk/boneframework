<?php

declare(strict_types=1);

namespace BoneMvc\Module\Dragon\Form;

use BoneMvc\Module\Dragon\Entity\Dragon;
use Del\Form\AbstractForm;
use Del\Form\Field\Submit;
use Del\Form\Field\Text;

class DragonForm extends AbstractForm
{
    public function init(): void
    {
        $name = new Text('name');
        $name->setLabel('Name');
        $name->setRequired(true);
        $this->addField($name);

        $dob = new Text('dob');
        $dob->setClass('form-control datepicker');
        $dob->setLabel('Dob');
        $this->addField($dob);

        $submit = new Submit('submit');
        $this->addField($submit);
    }
}
