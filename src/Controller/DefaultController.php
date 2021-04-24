<?php

namespace App\Controller;

use App\Entity\Album;
use App\Form\ImageFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Image;
use Symfony\Component\HttpFoundation\Request;
use App\Repository\AlbumRepository;
use Knp\Component\Pager\PaginatorInterface;

class DefaultController extends AbstractController
{
    /**
     * @Route("/", name="default")
     */
    public function index(AlbumRepository $albumRepository, Request $request, PaginatorInterface $paginator): Response
    {
        $datas = $albumRepository->findBy(['isPublic' => 1]);

        $albums = $paginator->paginate(
            $datas,
            $request->query->getInt('page', 1),
            10
        );

        return $this->render('default/index.html.twig', [
            'albums' => $albums
        ]);
    }

    /**
     * @Route("/album/{slug}", name="album_detail", methods={"GET"})
     */
    public function albumDetail($slug, AlbumRepository $albumRepository): Response
    {
        return $this->render('default/album-detail.html.twig', [
            'album' => $albumRepository->findOneBy(['slug' => $slug])
        ]);
    }

    /**
     * @Route("/about", name="about")
     */
    public function about(): Response
    {
        return $this->render('default/about.html.twig', [
        ]);
    }

    /**
     * @Route("/add", name="add_image")
     */
    public function addImage(Request $request): Response
    {
        $image = new Image();

        $form = $this->createForm(ImageFormType::class, $image);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $image->setCreatedAt(new \DateTime());

            $em = $this->getDoctrine()->getManager();
            $em->persist($image);
            $em->flush();

            $this->addFlash('success', 'Votre image a bien été ajoutée !');
            return $this->redirectToRoute('add_image');
        }

        return $this->render('default/form-image.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
