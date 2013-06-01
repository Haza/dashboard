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

        return $this->render('hazaDashboardBundle:Default:index.html.twig', array(
            'bookmarks' => $bookmarks
        ));
    }
}
