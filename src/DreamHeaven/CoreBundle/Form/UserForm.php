<?php

namespace DreamHeaven\CoreBundle\Form;

use Symfony\Component\Form\Form;
use Symfony\Component\Form\TextField;
use Symfony\Component\Form\RepeatedField;
use Symfony\Component\Form\PasswordField;

use Symfony\Component\Validator\ValidatorInterface;

use Symfony\Component\HttpFoundation\Request;
use FOS\UserBundle\Model\UserInterface;
use FOS\UserBundle\Model\UserManagerInterface;

class UserForm extends Form
{
    public function configure()
    {
        $this->add(new TextField('username'), array('max_length' => 100));
        $this->add(new TextField('email'), array('max_length' => 100));
        $this->add(new RepeatedField(new PasswordField('plainPassword')));
    }

    public function bind(Request $request, $data = null)
    {
        if (!$this->getName()) {
            throw new FormException('You cannot bind anonymous forms. Please give this form a name');
        }

        // Store object from which to read the default values and where to
        // write the submitted values
        if (null !== $data) {
            $this->setData($data);
        }

        // Store the submitted data in case of a post request
        if ('POST' == $request->getMethod()) {
            $values = $request->request->get($this->getName(), array());
            $files = $request->files->get($this->getName(), array());

            $this->submit(self::deepArrayUnion($values, $files));

            $this->userManager->updateCanonicalFields($this->getData());

            $this->validate();
        }
    }
}
