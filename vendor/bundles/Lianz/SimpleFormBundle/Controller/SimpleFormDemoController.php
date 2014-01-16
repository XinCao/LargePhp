<?php
namespace Lianz\SimpleFormBundle\Controller;

use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Lianz\SimpleFormBundle\Form;

// <editor-fold defaultstate="collapsed" desc="Internal Class">
class FlexibleForm extends Form
{
    var $fieldDefs = array(
        // array('field_name',  'validators', 'preprocessor')
        //   field_name:      field name
        //   validators:      validator info, can be a string, array or null. null is treated as empty array
        //   preprocessors:   preprocessor array, null is treated as array('trim')
        array('username',   'required, alpha_dash, min_length[5], max_length[20], regex[/[a-z0-9_-]/]'),
        array('nickname',   'required, alpha, min_length[5], max_length[20]'),
        array('firstname',  'required, alpha, min_length[5], max_length[20]'),
        array('lastname',   'required, alpha, min_length[5], max_length[20]'),
        array('email',      'required, valid_email'),
        array('password1',  'required, min_length[6], max_length[100]', array()),
        array('password2',  'required, min_length[6], max_length[100], matches[password1]', array()),
        array('age',        'is_natural_no_zero', array()),
        array('intro',      'max_length[1000]', array()),
        array('_hidden1',   '', array()),
        array('_hidden2',   '', array()),
    );

    public function __construct(ContainerInterface $container, $keyValues = null)
    {
        parent::__construct($container, true, 'demo_form');

        $this->init($this->fieldDefs);

        if ($keyValues)
        {
            $this->bind($keyValues);
        }
    }
};
// </editor-fold>

class SimpleFormDemoController extends Controller
{
    public function simpleAction()
    {
        // create a from
        $form = new Form($this->container, true/* auto restore */, 'simple_way_form');

        // setting up fields
        $form->addField('email',    'required, valid_email');
        $form->addField('password', 'required, min_length[6], max_length[100]'); // validator with parameter
        $form->addField('age',      'is_natural_no_zero');

        // use a array when validators is complex and may failed to parsed
        $usernameValidators = array('required', 'alpha_dash', 'min_length[5]', 'max_length[20]', 'regex[/[a-z0-9_-]/]');
        $form->addField('username', $usernameValidators);

        // ...
        // add more fields as needed
        // ...

        // bind the request
        $request = $this->container->get('request');
        $parameters = $request->request;
        $form->bind($parameters); // bind a ParameterBag
        // $form->bind(array('username' => 'lianz', ...)); // bind a associate array
        // $form->bind($_POST); // or event bind a php super globals

        if($request->isMethod('POST') && $form->validate())
        {
            $username = $form->get('username');
            $age      = $form->getInt('age');

            // ...
            // Do whatever you need...
            // ...

            $form->clear();
            $this->get('session')->getFlashBag()->add('success', "The form is validated successfully, username={$username}, age={$age}");
            $url = $this->generateUrl('simple_form_demo_simple', array(), true);
            return $this->redirect($url);
        }

        return $this->get('templating')->renderResponse("LianzSimpleFormBundle:SimpleFormDemo:index.html.twig", array('form' => $form));
    }

    public function flexibleAction()
    {
        // Create a class inherits from Lianz\SimpleFormBundle\Form
        // like the FlexibleForm above and use it like this:
        $request = $this->container->get('request');
        $form = new FlexibleForm($this->container, $request->request);

        if($request->isMethod('POST') && $form->validate())
        {
            $username = $form->get('username');
            $age      = $form->getInt('age');

            // ...
            // Do whatever you need...
            // ...

            $form->clear();
            $this->get('session')->getFlashBag()->add('success', "The form is validated successfully, username={$username}, age={$age}");
            $url = $this->generateUrl('simple_form_demo_flexible', array(), true);
            return $this->redirect($url);
        }

        return $this->get('templating')->renderResponse("LianzSimpleFormBundle:SimpleFormDemo:index.html.twig", array('form' => $form));
    }
}
