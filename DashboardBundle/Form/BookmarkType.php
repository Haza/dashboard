<?php

namespace haza\DashboardBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;


class BookmarkType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('title');
        $builder->add('url');
        $builder->add('file');
    }

    public function getName()
    {
        return 'bookmark';
    }
}
