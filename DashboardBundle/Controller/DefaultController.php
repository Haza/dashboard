<?php

namespace haza\DashboardBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use haza\DashboardBundle\Entity\Bookmark;
use haza\DashboardBundle\Form\BookmarkType;

class DefaultController extends Controller
{
    public function indexAction()
    {

        $em = $this->getDoctrine()
                   ->getEntityManager();
        $bookmarks = $em->getRepository('hazaDashboardBundle:Bookmark')
                    ->getBookmarks();

        $em2 = $this->getDoctrine()
                   ->getEntityManager();
        $category = $em2->getRepository('hazaDashboardBundle:Category')
                    ->getCategories();
        return $this->render('hazaDashboardBundle:Default:index.html.twig', array(
          'categories' => $category,
          'bookmarks' => $bookmarks,
        ));
    }

    public function categoryAction($id)
    {
        $em = $this->getDoctrine()
                   ->getEntityManager();

        $bookmarks = $em->getRepository('hazaDashboardBundle:Bookmark')->findBy(array('category_id' => $id));
        $em2 = $this->getDoctrine()
                   ->getEntityManager();
        $category = $em2->getRepository('hazaDashboardBundle:Category')
                    ->getCategories();
        return $this->render('hazaDashboardBundle:Default:category.html.twig', array(
          'categories' => $category,
          'bookmarks' => $bookmarks,
        ));
    }
}
