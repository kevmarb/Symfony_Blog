<?php

namespace AppBundle\Controller;


use Sonata\AdminBundle\Tests\Fixtures\Bundle\Entity\Tag;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use AppBundle\Entity\Tag;
use AppBundle\Form\TagType;


class TagController extends Controller
{

    /**
     * Lists all Tags entities.
     *
     * @Route("/", name="tag")
     *
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $tags = $em->getRepository('AppBundle:Tag')->findAll();

        return $this->render('AppBundle:Tag:index.html.twig', [
            'tags' => $tags,
        ]);
    }
    /**
     * Creates a new Tag entity.
     *
     * @Route("/create", name="tag_create")
     *
     * @Method("GET|POST")
     */
    public function createAction(Request $request)
    {
        $tag = new Tag();

        $form = $this->createForm(new TagType(), $tag, array(
            'action' => $this->generateUrl('tag_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($tag);
            $em->flush();

            return $this->redirect($this->generateUrl('tag_show', array('id' => $tag->getId())));
        }

        return $this->render('AppBundle:Tag:new.html.twig', [
            'tag' => $tag,
            'form'    => $form->createView(),
        ]);
    }

    /**
     * Finds and displays a Tag entity.
     *
     * @Route("/{id}", name="tag_show")
     *
     * @Method("GET")
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $tag = $em->getRepository('AppBundle:Tag')->find($id);

        if (!$tag) {
            throw $this->createNotFoundException('Unable to find Tag entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('AppBundle:Tag:show.html.twig', [
            'tag'     => $tag,
            'delete_form' => $deleteForm->createView(),
        ]);
    }

    /**
     * Edits an existing Tag entity.
     *
     * @Route("/update/{id}", name="tag_update")
     *
     * @Method("GET|PUT")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $tag = $em->getRepository('AppBundle:Tag')->find($id);

        if (!$tag) {
            throw $this->createNotFoundException('Unable to find Tag entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        $editForm = $this->createForm(new TagType(), $tag, array(
            'action' => $this->generateUrl('tag_update', array('id' => $tag->getId())),
            'method' => 'PUT',
        ));

        $editForm->add('submit', 'submit', array('label' => 'Update'));

        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('tag_show', array('id' => $id)));
        }

        return $this->render('AppBundle:Tag:edit.html.twig', [
            'tag'     => $tag,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ]);
    }

    /**
     * Deletes an Tag entity.
     *
     * @Route("/{id}", name="tag_delete")
     *
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('AppBundle:Tag')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Tag entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('tag'));
    }

    /**
     * Creates a form to delete a Tag entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('tag_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
            ;
    }
}
