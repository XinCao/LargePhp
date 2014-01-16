Getting Started With LianzSimpleFormBundle
==========================================

The Symfony2 Framework has a build-in form and validation framework that allows you to
build and validate forms. But in my opinion, it contains to many things and hard to use.

So I create SimpleFormBundle. As it's name, it's Simple, and easy to use.

## Installation

### Step 1: Install as a Git Submodule

``` bash
$ git submodule add https://github.com/lianz/LianzSimpleFormBundle.git vendor/bundles/Lianz/SimpleFormBundle
$ git submodule init
```

### Step 2: Enable the bundle

Enable the bundle in the kernel:

```php
<?php
// app/AppKernel.php

public function registerBundles()
{
    $bundles = array(
        // ...
        new Lianz\SimpleFormBundle\LianzSimpleFormBundle(),
        // ...
    );
}

```

## Using SimpleFormBundle: Getting Started

### The simple way
``` php
<?php
namespace Lianz\SimpleFormBundle\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Lianz\SimpleFormBundle\Form;

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
        // add more fields if needed
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
}

```

### The flexible way

``` php
<?php
namespace Lianz\SimpleFormBundle\Controller;

use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Lianz\SimpleFormBundle\Form;

// <editor-fold defaultstate="collapsed" desc="Internal Class">
class FlexibleForm extends Form
{
    var $fieldDefs = array(
        // Field definition: array(<field_name>,  [validators], [preprocessors])
        //   field_name:      field name
        //   validators:      validator info, can be a string, array or null. null is treated as empty array
        //   preprocessors:   preprocessor array, null is treated as array('trim')
        array('username',   array('required', 'alpha_dash', 'min_length[5]', 'max_length[20]', 'regex[/[a-z0-9_-]/]')),
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

            $form->clear(); // clear the form so it's data will not shown in form after refresh
            $this->get('session')->getFlashBag()->add('success', "The form is validated successfully, username={$username}, age={$age}");
            $url = $this->generateUrl('simple_form_demo_flexible', array(), true);
            return $this->redirect($url);
        }

        return $this->get('templating')->renderResponse("LianzSimpleFormBundle:SimpleFormDemo:index.html.twig", array('form' => $form));
    }
}

```

### The view. Only supports Twig template for now.
```twig
<html><header><title>SimpleForm Demo</title></header>
<body>
    <form class="form-horizontal" id="test_form" method="POST" action="{{path('simple_form_demo_simple')}}">
    <!--
    <form class="form-horizontal" id="test_form" method="POST" action="{{path('simple_form_demo_flexible')}}">
    -->

      {# Import the form helpers #}
      {% import ('LianzSimpleFormBundle::helpers.html.twig') as sf %}

      {{ sf.field(form.username,  'text',     'Username',   true, {}, {'attrs': {'placeholder': 'A-Z, 0-9, _-'}}) }}
      {{ sf.field(form.email,     'text',     'Email',      true, {}, {'attrs': {'placeholder': 'Enter your email'} }) }}
      {{ sf.field(form.password1, 'password', 'Password',   true, {}, {'attrs': {'placeholder': 'Enter your password'} }) }}
      {{ sf.field(form.password2, 'password', 'Confirm',    true, {}, {'attrs': {'placeholder': 'Enter password again'} }) }}
      {{ sf.field(form.nickname,  'text',     'Nickname',   true, {}, {'attrs': {} }) }}
      {{ sf.field(form.firstname, 'text',     'Firstname',  true, {}, {'attrs': {} }) }}
      {{ sf.field(form.lastname,  'text',     'Lastname',   true, {}, {'attrs': {} }) }}
      {{ sf.field(form.intro,     'textarea', 'Introduce',  true, {}, {'attrs': {'rows': '3', 'placeholder': 'Enter you introduce'} }) }}

      <div class="control-group">
        <div class="controls">
          {{ sf.rest(form) }}
          {{ sf.submit('Submit', {'id': 'btn_submit', 'class': 'btn btn-primary'}) }}
        </div>
      </div>
    </form>
</body>
</html>
```

## References

### Provided Validators

SimpleForm has many build-in validators that help you validate your form easily.

Here is the list (In alphabetical order):

  * alpha_dash
  * alpha_numeric
  * alpha
  * decimal
  * extac_length[20]
  * greater_then[10]
  * integer
  * is_natural_no_zero
  * is_natural
  * less_then[10]
  * matches[input_name_to_match]
  * max_length[50]
  * min_length[5]
  * numeric
  * regex[/[a-z]+/]
  * required
  * valid_base64
  * valid_email

### Provided Form Helpers

For more infomation of each helpers, please dice into LianzSimpleFormBundle::helpers.html.twig by yourself.

#### Basic Helpers (In alphabetical order)

  * button(field, attrs={})
  * checkbox(field, value, text, attrs={}, label_attrs={})
  * error(field, translate=false, label_attrs={})
  * hidden(field, attrs={})
  * input(field, type, attrs={}, raw=false)
  * label(field, label_text, attrs={}, mark_required=' *')
  * label_begin(field, attrs={})
  * label_end()
  * password(field, attrs={})
  * radio(field, value, text, attrs={}, label_attrs={})
  * rest(form, type='hidden', attrs={}, raw=false)
  * select(field, options, translate=false, attrs={})
  * submit(text, attrs={})
  * text(field, attrs={}, raw=false)
  * textarea(field, attrs={}, raw=false)

#### Extended Helpers

 * rules(form)
    This helper generates jQuery validation rules base on SimpleForm validation rules.

 * field(field, type, label_title, translate=false, label_attrs={}, widget_settings={}, error_attrs={}, controls_attrs={})
    This helper render a "Form Field Group" with Bootstrap css framework. Useful if you use Bootstrap in your project.

## Unit Tests

```bash
$ cd vendor/bundles/Lianz/SimpleFormBundle
$ phpunit --bootstrap=/path/to/your/app/autoload.php Tests
```
