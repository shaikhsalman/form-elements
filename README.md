#Features
* use it on any open-source projects: (ie: wordpress, Yii, MVC! and etc)
* Support for UTF-8 content
* Compatible with PHP 5.0 +
* Quick form (in a minute) // not in initail version
* send email (in a minute) // not in initail version
* form validation // not in initail version
* Much more will be introducing soon!

#Installation & loading
just copy the file (form.elements.inc.php) of the FORM ELEMENTS folder.
Create a new object

* #A that means, get all attributes which you write next to it
* && that means, seprate attributes
* :: that means, set between attribute's property. { property (class) and value (test) (ie: class::test) }
* INPUT() // radio, checkbox, text, password, hidden, submit
* TEXTAREA()
* BUTTON()
* SELECT()
* LABEL()

#A Simple Example

* remember ( #A ) that means, get all attributes which you write next to it
* Here's a simple hint on how to dynamically activate/deactivate (or enable/disable, however 
* you want to call it) HTML/XHTML form elements (input boxes, select lists, radio buttons, checkboxes & etc).

```
required_once('form.elements.inc.php');
$form = new FORM_ELEMENTS;
```

#Label:
```
echo $form->LABEL('label text goes here#Aclass=label_class');
```

#Input:
```
/*
Input: (type=radio or checkbox or text or password or hidden or submit or etc)
if you add radio or checkbox then you can use sencond parameter
$args = array('radio 1', 'radio 2');
*/
echo $form->INPUT('#Atype::password&&placeholder::my password&&class::label_class', $args);
```

#Textarea:
```
echo $form->TEXTAREA('message goes here#Aclass::textarea_class&&rows::10');
```

#Select:
```
$options = range('a','z');

//or without attributes
$options = array('option 1','option 2');

//or with attributes 
$options = array('option 1#Avalue::1', 'option 2#Avalue::2');

echo $form->SELECT($options, '#Aname::alpha&&class::select_class');
```

#button:
```
echo $form->BUTTON('button text goes here#Aclass::button-class');
```
