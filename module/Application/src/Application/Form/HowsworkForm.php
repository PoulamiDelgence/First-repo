<?php


namespace Application\Form;


use Zend\Form\Form;

class HowsworkForm extends Form
{
    public function __construct($name = null)
    {
        parent::__construct('appForm2');

        $this->setAttribute('method', 'post');       
        
        $this->setAttribute('enctype','multipart/form-data');
        $this->add(array(
            'name' => 'id',
            'type' => 'hidden',
            'options' => array(
                'label' => 'id',
            )
            
        ));
       
        

        $this->add(array(
            'name' => 'bannerheader',
            'type' => 'Textarea',
            
            
        ));
        
        $this->add(array(
            'name' => 'imagename',
            'attributes' => array(
               'type'  => 'file',
     
               'class' => 'txtInput txtMedium'
            ),
        ));
      
        
        
         $this->add(array(
              'name' => 'submit',
              'attributes' => array(
                    'type'  => 'submit',
                    'value' => 'Send data',
                    'class' => 'save_btn'
              ),
        ));
        
    }
}
?>