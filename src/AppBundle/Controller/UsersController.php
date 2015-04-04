<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use AppBundle\Entity\Users;
use AppBundle\Form\UsersType;

class UsersController extends Controller
{
    /**
     * Lists all Users entities.
     *
     * @Route("/", name="users")
     *
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $tags = $em->getRepository('AppBundle:Users')->findAll();

        return $this->render('AppBundle:Users:index.html.twig', [
            'tags' => $tags,
        ]);
    }
    /**
     * Creates a new Users entity.
     *
     * @Route("/create", name="users_create")
     *
     * @Method("GET|POST")
     */
    public function createAction(Request $request)
    {
        $users = new Users();

        $form = $this->createForm(new UsersType(), $users, array(
            'action' => $this->generateUrl('users_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($users);
            $em->flush();

            return $this->redirect($this->generateUrl('tag_show', array('id' => $users->getId())));
        }

        return $this->render('AppBundle:Users:new.html.twig', [
            'users' => $users,
            'form'    => $form->createView(),
        ]);
    }

    /**
     * Finds and displays a Users entity.
     *
     * @Route("/{id}", name="users_show")
     *
     * @Method("GET")
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $users = $em->getRepository('AppBundle:Users')->find($id);

        if (!$users) {
            throw $this->createNotFoundException('Unable to find Users entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('AppBundle:Users:show.html.twig', [
            'users'     => $users,
            'delete_form' => $deleteForm->createView(),
        ]);
    }

    /**
     * Edits an existing Users entity.
     *
     * @Route("/update/{id}", name="users_update")
     *
     * @Method("GET|PUT")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $users = $em->getRepository('AppBundle:Users')->find($id);

        if (!$users) {
            throw $this->createNotFoundException('Unable to find Users entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        $editForm = $this->createForm(new UsersType(), $users, array(
            'action' => $this->generateUrl('users_update', array('id' => $users->getId())),
            'method' => 'PUT',
        ));

        $editForm->add('submit', 'submit', array('label' => 'Update'));

        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('users_show', array('id' => $id)));
        }

        return $this->render('AppBundle:Tag:edit.html.twig', [
            'users'     => $users,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ]);
    }

    /**
     * Deletes an Users entity.
     *
     * @Route("/{id}", name="users_delete")
     *
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('AppBundle:Users')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Users entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('users'));
    }

    /**
     * Creates a form to delete a Users entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('users_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
            ;
    }

}
