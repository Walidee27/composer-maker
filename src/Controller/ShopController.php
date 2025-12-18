<?php

namespace App\Controller;

use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class ShopController extends AbstractController
{
    #[Route('/shop', name: 'app_product')]
    public function index(ProductRepository $productRepository, \Symfony\Component\HttpFoundation\Request $request): Response
    {
        $gender = $request->query->get('gender');

        if ($gender) {
            $products = $productRepository->createQueryBuilder('p')
                ->where('p.gender = :gender OR p.gender = :unisex')
                ->setParameter('gender', $gender)
                ->setParameter('unisex', 'UNISEX')
                ->getQuery()
                ->getResult();
        } else {
            $products = $productRepository->findAll();
        }

        return $this->render('shop/index.html.twig', [
            'products' => $products,
            'current_gender' => $gender
        ]);
    }
}
