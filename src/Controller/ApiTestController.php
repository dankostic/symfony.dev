<?php

namespace App\Controller;

use App\Entity\Article;
use App\Repository\ArticleRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ApiTestController extends AbstractController
{
    private const CREATED = 'Created successfully';
    private const UPDATED = 'Updated successfully';
    private const DELETED = 'Deleted successfully';


    public function __construct(
        private readonly EntityManagerInterface $doctrine,
        private readonly ArticleRepository $articleRepository
    ) {
    }

    #[Route('/api-test', name: 'app_api_test')]
    public function index(): Response
    {
        $articles = $this->articleRepository->findAll();
        foreach ($articles as $article) {
            $res[] = ['id' => $article->getId()];
        }
        return $this->json(
            $res
        );
    }

    #[Route('/api-test/create', name: 'app_api_test_create', methods: 'POST')]
    public function create(Request $request): Response
    {
        $parameters = json_decode($request->getContent());
        $article = new Article();
        $article->setName($parameters->name);
        $article->setDescription($parameters->description);
        $article->setCreatedAt(new \DateTimeImmutable(null));

        $this->doctrine->persist($article);

        $this->doctrine->flush();
        return $this->json([
            'message' => self::CREATED,
        ]);
    }

    #[Route('/api-test/update/{id}', name: 'app_api_test_update', methods: 'PUT')]
    public function update(Request $request, int $id): Response
    {
        $article = $this->articleRepository->find($id);

        $parameters = json_decode($request->getContent());

        $article->setName($parameters->name);
        $article->setDescription($parameters->description);
        $article->setCreatedAt(new \DateTimeImmutable(null));

        $this->doctrine->persist($article);

        $this->doctrine->flush();
        return $this->json([
            'message' => self::UPDATED,
        ]);
    }

    #[Route('/api-test/delete/{id}', name: 'app_api_test_delete', methods: 'DELETE')]
    public function delete(int $id): Response
    {
        $article = $this->articleRepository->find($id);

        $this->doctrine->remove($article);

        $this->doctrine->flush();
        return $this->json([
            'message' => self::DELETED,
        ]);
    }
}
