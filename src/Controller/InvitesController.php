<?php

namespace App\Controller;

use App\Entity\Invite;
use App\Form\InvitesType;
use App\Repository\InvitesRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

#[Route('/invites')]
class InvitesController extends AbstractController
{
     public function __construct(
         private readonly InvitesRepository $invitesRepository,
         private EntityManagerInterface $entityManager,
         private TokenStorageInterface $tokenStorage)
    {


    }
    #[Route('/', name: 'app_invites_index', methods: ['GET'])]
    public function index(): Response
    {
        return $this->render('invites/index.html.twig', [
            'invites' => $this->invitesRepository->findAll(),
        ]);
    }
    #[Route('/new', name: 'app_invites_new')]
    public function new(): Response
    {
        $this->denyAccessUnlessGranted("ROLE_ADMIN", null, "MAG NIET");
        $invite = new Invite();
        $invite->setInvitecode($this->generateInviteCode());
        $this->invitesRepository->save($invite, true);

        return $this->redirectToRoute('app_invites_index', [], Response::HTTP_SEE_OTHER);
    }

    #[Route('/{id}', name: 'app_invites_show', methods: ['GET'])]
    public function show(Invite $invite): Response
    {
        return $this->render('invites/show.html.twig', [
            'invite' => $invite,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_invites_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Invite $invite, InvitesRepository $invitesRepository): Response
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
    public function delete(Request $request, Invite $invite, InvitesRepository $invitesRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$invite->getId(), $request->request->get('_token'))) {
            $invitesRepository->remove($invite, true);
        }

        return $this->redirectToRoute('app_invites_index', [], Response::HTTP_SEE_OTHER);
    }

    public function generateInviteCode(): string
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < 10; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
}
