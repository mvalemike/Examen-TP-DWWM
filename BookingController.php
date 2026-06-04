// src/Controller/BookingController.php
namespace App\Controller;

use App\Entity\Reservation;
use App\Entity\Resource;
use App\Repository\ReservationRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

class BookingController extends AbstractController
{
    #[Route('/book/{id}', name: 'app_book_resource', methods: ['POST'])]
    #[IsGranted('ROLE_USER')] // Sécurisation de la route
    public function book(
        Resource $resource, 
        Request $request, 
        ReservationRepository $repo, 
        EntityManagerInterface $em
    ): Response {
        // Récupération et conversion des dates du formulaire
        try {
            $start = new \DateTime($request->request->get('start'));
            $end = new \DateTime($request->request->get('end'));
        } catch (\Exception $e) {
            $this->addFlash('danger', 'Format de date invalide.');
            return $this->redirectToRoute('app_home');
        }

        // Validation logique : la date de début doit être antérieure à la fin
        if ($start >= $end) {
            $this->addFlash('danger', 'La date de début doit être inférieure à la date de fin.');
            return $this->redirectToRoute('app_home');
        }

        // Vérification du chevauchement via le Repository
        $overlap = $repo->findOverlappingReservations($resource, $start, $end);

        if (count($overlap) > 0) {
            $this->addFlash('danger', 'Ce créneau horaire est indisponible pour cette ressource.');
            return $this->redirectToRoute('app_home');
        }

        // Création et persistance de la nouvelle réservation
        $reservation = new Reservation();
        $reservation->setResource($resource);
        $reservation->setClient($this->getUser()); // Associe l'utilisateur connecté
        $reservation->setStartDate($start);
        $reservation->setEndDate($end);

        $em->persist($reservation);
        $em->flush(); // Validation de la transaction SQL

        $this->addFlash('success', 'Votre réservation a été enregistrée avec succès !');
        return $this->redirectToRoute('app_home');
    }
}