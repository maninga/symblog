<?php

namespace Blogger\BlogBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Validator\ErrorElement;
use Sonata\AdminBundle\Form\FormMapper;
 
class CommentAdmin extends Admin
{
    // setup the default sort column and order
    protected $datagridValues = array(
        '_sort_order' => 'DESC',
        '_sort_by' => 'created'
    );
 
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('blog')
            ->add('user')
            ->add('comment')
            ->add('approved')
        ;
    }
 
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('blog')
            ->add('user')
            ->add('approved')
        ;
    }
 
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('user')
            ->add('blog')
            ->add('created')
            ->add('updated')
        ;
    }
}

/*
+----------+--------------+------+-----+---------+----------------+
| Field    | Type         | Null | Key | Default | Extra          |
+----------+--------------+------+-----+---------+----------------+
| id       | int(11)      | NO   | PRI | NULL    | auto_increment |
| blog_id  | int(11)      | YES  | MUL | NULL    |                |
| user     | varchar(255) | NO   |     | NULL    |                |
| comment  | longtext     | NO   |     | NULL    |                |
| approved | tinyint(1)   | NO   |     | NULL    |                |
| created  | datetime     | NO   |     | NULL    |                |
| updated  | datetime     | NO   |     | NULL    |                |
+----------+--------------+------+-----+---------+----------------+
*/
