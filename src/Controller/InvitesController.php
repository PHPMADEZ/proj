<?php

namespace App\Controller;

use App\Entity\Invites;
use App\Form\InvitesType;
use App\Repository\InvitesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;

#[Route('/invites')]
class InvitesController extends AbstractController
{
     public function __construct(private InvitesRepository $invitesRepository, private EntityManagerInterface $entityManager)
    {
        $this->invitesRepository = $invitesRepository;
        $this->entityManager = $entityManager;
    }
    #[Route('/', name: 'app_invites_index', methods: ['GET'])]
    public function index(InvitesRepository $invitesRepository): Response
    {
        return $this->render('invites/index.html.twig', [
            'invites' => $invitesRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_invites_new', methods: ['GET', 'POST'])]
    public function new(Request $request, InvitesRepository $invitesRepository): Response
    {


        $invite = new Invites();
        $form = $this->createForm(InvitesType::class, $invite);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {


            $invite->setInvitecode($invitesRepository->generateInviteCode());
            $invite->setIsUsed(0);
            $invite->setDoc(new \DateTime());
            $invite->set


            $this->entityManager->persist($invite);
            $this->entityManager->flush();



            return $this->redirectToRoute('app_invites_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('invites/new.html.twig', [
            'invite' => $invite,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_invites_show', methods: ['GET'])]
    public function show(Invites $invite): Response
    {
        return $this->render('invites/show.html.twig', [
            'invite' => $invite,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_invites_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Invites $invite, InvitesRepository $invitesRepository): Response
    {
        $form = $this->createForm(InvitesType::class, $invite);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $invitesRepository->save($invite, true);

            return $this->redirectToRoute('app_invites_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('invites/edit.html.twig', [
            'invite' => $invite,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_invites_delete', methods: ['POST'])]
    public function delete(Request $request, Invites $invite, InvitesRepository $invitesRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$invite->getId(), $request->request->get('_token'))) {
            $invitesRepository->remove($invite, true);
        }

        return $this->redirectToRoute('app_invites_index', [], Response::HTTP_SEE_OTHER);
    }
}
