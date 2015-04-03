<?php

namespace AppBundle\Controller;

use AppBundle\Entity\ArticleRepository;
use AppBundle\Entity\CategoryRepository;
use AppBundle\Entity\TagRepository;
use Doctrine\DBAL\Types\JsonArrayType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\JsonResponse;





/**
 * Class ApiController
 * @package AppBundle\Controller
 *
 * @Route("/api")
 */
class ApiController extends Controller
{
    /**
     * @Route("/article/{id}", name="api_article",defaults={"id"=null},requirements={"id" = "\d+"})
     *
     *
     * @return JsonResponse
     */
    public function ArticleAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        /** @var ArticleRepository $repo */
        $repo = $em->getRepository('AppBundle:Article');
        $articles = $repo->FindAllArticles($id);
        return new JsonResponse($articles);
    }
    /**
     *  @Route("/tag/{id}", name="api_tag",defaults={"id"=null},requirements={"id" = "\d+"})
     *
     *
     * @return JsonResponse
     */
    public function TagAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        /** @var TagRepository $repo */
        $repo = $em->getRepository('AppBundle:Tag');
        $tags = $repo->FindAllTags($id);
        return new JsonResponse($tags);
    }
    /**
     * @Route("/category/{id}", name="api_category",defaults={"id"=null},requirements={"id" = "\d+"})
     *
     *
     * @return JsonResponse
     */
    public function CategoryAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        /** @var CategoryRepository $repo */
        $repo = $em->getRepository('AppBundle:Category');
        $tags = $repo->FindAllCategories($id);
        return new JsonResponse($tags);
    }


}
