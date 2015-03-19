<?php
namespace wvus\prototypeBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class DonorType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('first_name', 'text')
            ->add('last_name', 'text')
            ->add('email', 'email')
            ->add('phone', 'text')
            ->add('address_1', 'text')
            ->add('address_2', 'text')
            ->add('city', 'text')
            ->add('state', 'text')
            ->add('zip_code', 'text')
            ->add('save', 'submit');
    }

    public function getName()
    {
        return 'donor';
    }
}