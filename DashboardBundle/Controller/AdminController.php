<?php

namespace haza\DashboardBundle\Controller;

use haza\DashboardBundle\Entity\Bookmark;
use haza\DashboardBundle\Form\BookmarkType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class AdminController extends Controller
{
    public function indexAction()
    {
        return $this->render('hazaDashboardBundle:Admin:index.html.twig');
    }

    public function addAction()
    {
        $bookmark = new Bookmark();
        $form = $this->createForm(new BookmarkType(), $bookmark);

        $request = $this->getRequest();
        if ($request->getMethod() == 'POST') {
            $form->bind($request);

            if ($form->isValid()) {
              $this->get('session')->setFlash('bookmark-notice', 'Bookmark added!');
              $em = $this->getDoctrine()
                           ->getEntityManager();
              // Handle the file.
              $bookmark->upload();


              $em->persist($bookmark);
              $em->flush();
                // Redirect - This is important to prevent users re-posting
                // the form if they refresh the page
                return $this->redirect($this->generateUrl('haza_dashboard_adminAdd'));
            }
        }

        return $this->render('hazaDashboardBundle:Admin:add.html.twig', array(
            'form' => $form->createView()
        ));
    }
}
