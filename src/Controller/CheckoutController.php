<?php

namespace App\Controller;

use App\Entity\Order;
use App\Entity\OrderItem;
use App\Repository\ProductRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class CheckoutController extends AbstractController
{
    #[Route('/checkout', name: 'app_checkout')]
    public function index(Request $request, ProductRepository $productRepository, EntityManagerInterface $entityManager): Response
    {
        $user = $this->getUser();

        if (!$user) {
            $this->addFlash('error', 'Vous devez être connecté pour valider votre commande.');
            return $this->redirectToRoute('app_login');
        }

        $session = $request->getSession();
        $cart = $session->get('cart', []);

        if (empty($cart)) {
            return $this->redirectToRoute('app_cart');
        }

        $order = new Order();
        $order->setUser($user);
        $order->setCreatedAt(new \DateTimeImmutable());
        $order->setStatus('PENDING');

        $total = 0;

        foreach ($cart as $id => $quantity) {
            $product = $productRepository->find($id);

            if ($product) {
                $orderItem = new OrderItem();
                $orderItem->setProduct($product);
                $orderItem->setQuantity($quantity);
                $orderItem->setPrice($product->getPrice());
                $orderItem->setRelatedOrder($order);

                $entityManager->persist($orderItem);

                $total += $product->getPrice() * $quantity;
            }
        }

        $order->setTotal($total);
        $entityManager->persist($order);
        $entityManager->flush();

        $session->remove('cart');

        return $this->redirectToRoute('app_checkout_success');
    }

    #[Route('/checkout/success', name: 'app_checkout_success')]
    public function success(): Response
    {
        return $this->render('checkout/success.html.twig');
    }
}
