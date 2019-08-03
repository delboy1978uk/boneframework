<?php

declare(strict_types=1);

namespace BoneMvc\Module\Orc\Form;

use BoneMvc\Module\Orc\Entity\Orc;
use Del\Form\AbstractForm;
use Del\Form\Field\Submit;
use Del\Form\Field\Text;

class OrcForm extends AbstractForm
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

        $eventTime = new Text('eventTime');
        $eventTime->setClass('form-control datetimepicker');
        $eventTime->setLabel('EventTime');
        $this->addField($eventTime);

        $submit = new Submit('submit');
        $this->addField($submit);
    }
}
