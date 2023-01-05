<?php

namespace App\Controller;

use App\Entity\Admin;
use App\Form\AdminControllerType;
use App\Entity\AdminLog;
use App\Repository\AdminRepository;
use App\Repository\AdminLogRepository;
use App\Repository\InvitesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Doctrine\ORM\EntityManagerInterface;

#[Route('/admin')]
class AdminController extends AbstractController
{
    

    

    #[Route('/', name: 'app_admin_index', methods: ['GET'])]
    public function index(AdminRepository $adminControllerRepository, InvitesRepository $invitesRepository): Response
    {
        
        return $this->render('admin/index.html.twig', [
            'admin_controllers' => $adminControllerRepository->findAll(),
            'invites' => $invitesRepository->findAll(),

        ]);
    }

    #[Route('/new', name: 'app_admin_new', methods: ['GET', 'POST'])]
    public function new(Request $request, AdminRepository $adminControllerRepository): Response
    {
        $adminController = new Admin();
        $form = $this->createForm(AdminControllerType::class, $adminController);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $adminControllerRepository->save($adminController, true);

            return $this->redirectToRoute('app_admin_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin/new.html.twig', [
            'admin_controller' => $adminController,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_admin_show', methods: ['GET'])]
    public function show(Admin $adminController): Response
    {

        return $this->render('admin/show.html.twig', [
            'admin_controller' => $adminController,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_admin_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Admin $adminController, AdminRepository $adminControllerRepository  ): Response
    {
        $form = $this->createForm(AdminControllerType::class, $adminController);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $adminControllerRepository->save($adminController, true);

            return $this->redirectToRoute('app_admin_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin/edit.html.twig', [
            'admin_controller' => $adminController,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_admin_delete', methods: ['POST'])]
    public function delete(Request $request, Admin $adminController, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$adminController->getId(), $request->request->get('_token'))) {

                $entityManager->remove($adminController);
                $entityManager->flush();

        }

        return $this->redirectToRoute('app_admin_index', [], Response::HTTP_SEE_OTHER);
    }
}
