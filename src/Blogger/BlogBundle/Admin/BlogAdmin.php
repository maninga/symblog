<?php

namespace Blogger\BlogBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Validator\ErrorElement;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
 
use Blogger\BlogBundle\Entity\Blog;

class BlogAdmin extends Admin
{
    // setup the default sort column and order
    protected $datagridValues = array(
        '_sort_order' => 'DESC',
        '_sort_by' => 'created'
    );
 
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('title')
            ->add('slug')
            ->add('author')
            ->add('blog')
            ->add('image')
            ->add('tags')
        ;
    }
 
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('title')
            ->add('tags')
            ->add('author')
        ;
    }
 
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('title')
            ->add('author')
            ->add('created')
            ->add('updated')
        ;
    }

    protected function configureShowField(ShowMapper $showMapper)
    {
        $showMapper
            ->add('title')
            ->add('slug')
            ->add('author')
            ->add('blog')
            ->add('image', 'string', array('template' => 'BloggerBlogBundle:BlogAdmin:list_image.html.twig'))
            ->add('tags')
        ;
    }
}

/*
+---------+--------------+------+-----+---------+----------------+
| Field   | Type         | Null | Key | Default | Extra          |
+---------+--------------+------+-----+---------+----------------+
| id      | int(11)      | NO   | PRI | NULL    | auto_increment |
| title   | varchar(255) | NO   |     | NULL    |                |
| slug    | varchar(255) | NO   |     | NULL    |                |
| author  | varchar(100) | NO   |     | NULL    |                |
| blog    | longtext     | NO   |     | NULL    |                |
| image   | varchar(20)  | NO   |     | NULL    |                |
| tags    | longtext     | NO   |     | NULL    |                |
| created | datetime     | NO   |     | NULL    |                |
| updated | datetime     | NO   |     | NULL    |                |
+---------+--------------+------+-----+---------+----------------+
*/
