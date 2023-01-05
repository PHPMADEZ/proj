<?php

namespace App\Controller;

use App\Entity\AdminLog;
use App\Form\AdminLogType;
use App\Repository\AdminLogRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin_log')]
class AdminLogController extends AbstractController
{
    #[Route('/', name: 'app_admin_log_index', methods: ['GET'])]
    public function index(AdminLogRepository $adminLogRepository): Response
    {
        return $this->render('admin_log/index.html.twig', [
            'admin_logs' => $adminLogRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_admin_log_new', methods: ['GET', 'POST'])]
    public function new(Request $request, AdminLogRepository $adminLogRepository): Response
    {
        $adminLog = new AdminLog();
        $form = $this->createForm(AdminLogType::class, $adminLog);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $adminLogRepository->save($adminLog, true);

            return $this->redirectToRoute('app_admin_log_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin_log/new.html.twig', [
            'admin_log' => $adminLog,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_admin_log_show', methods: ['GET'])]
    public function show(AdminLog $adminLog): Response
    {

        return $this->render('admin_log/show.html.twig', [
            'admin_log' => $adminLog,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_admin_log_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, AdminLog $adminLog, AdminLogRepository $adminLogRepository): Response
    {
        $form = $this->createForm(AdminLogType::class, $adminLog);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $adminLogRepository->save($adminLog, true);

            return $this->redirectToRoute('app_admin_log_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin_log/edit.html.twig', [
            'admin_log' => $adminLog,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_admin_log_delete', methods: ['POST'])]
    public function delete(Request $request, AdminLog $adminLog, AdminLogRepository $adminLogRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$adminLog->getId(), $request->request->get('_token'))) {
            $adminLogRepository->remove($adminLog, true);
        }

        return $this->redirectToRoute('app_admin_log_index', [], Response::HTTP_SEE_OTHER);
    }
}
