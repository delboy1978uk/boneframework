<?php

declare(strict_types=1);

namespace BoneMvc\Module\Unicorn\Form;

use BoneMvc\Module\Unicorn\Entity\Unicorn;
use Del\Form\AbstractForm;
use Del\Form\Field\CheckBox;
use Del\Form\Field\Radio;
use Del\Form\Field\Select;
use Del\Form\Field\Submit;
use Del\Form\Field\Text;

class UnicornForm extends AbstractForm
{
    public function init(): void
    {
        $name = new Text('name');
        $name->setLabel('Name of Unicorn');
        $name->setRequired(true);
        $this->addField($name);

        $dob = new Text('dob');
        $dob->setClass('form-control datepicker');
        $dob->setLabel('Date of Birth');
        $this->addField($dob);

        $food = new Select('food');
        $food->setOptions([
             1 => 'Beef',
             2 => 'Chicken',
             3 => 'Pork',
             4 => 'Marshmallows',
        ]);
        $food->setLabel('Favourite Food');
        $this->addField($food);

        $canFly = new CheckBox('canFly');
        $canFly->setOptions([
             1 => 'qwer',
             2 => 'jgf',
        ]);
        $canFly->setLabel('Can Fly');
        $canFly->setRequired(true);
        $this->addField($canFly);

        $drink = new Radio('drink');
        $drink->setOptions([
             1 => 'Pepsi',
             2 => 'Coke',
             3 => 'Beer',
        ]);
        $drink->setLabel('Favourite Drink');
        $this->addField($drink);

        $submit = new Submit('submit');
        $this->addField($submit);
    }
}
