<?php

namespace haza\DashboardBundle\Controller;

use haza\DashboardBundle\Entity\Bookmark;
use haza\DashboardBundle\Entity\Category;
use haza\DashboardBundle\Form\BookmarkType;
use haza\DashboardBundle\Form\CategoryType;
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
                $this->get('session')->getFlashBag()->set('dashboard-notice', 'Bookmark added!');
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

    public function addCategoryAction()
    {
        $category = new Category();
        $form = $this->createForm(new CategoryType(), $category);

        $request = $this->getRequest();
        if ($request->getMethod() == 'POST') {
            $form->bind($request);

            if ($form->isValid()) {
                $this->get('session')->getFlashBag()->set('dashboard-notice', 'Category added!');
                $em = $this->getDoctrine()
                    ->getEntityManager();

                $em->persist($category);
                $em->flush();
                // Redirect - This is important to prevent users re-posting
                // the form if they refresh the page
                return $this->redirect($this->generateUrl('haza_dashboard_adminAddCategory'));
            }
        }

        return $this->render('hazaDashboardBundle:Admin:category.html.twig', array(
            'form' => $form->createView()
        ));
    }
}
