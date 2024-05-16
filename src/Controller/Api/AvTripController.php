<?php

namespace App\Controller\Api;

use App\Entity\AvCategory;
use App\Entity\AvCountry;
use App\Entity\AvReservation;
use App\Entity\AvStatus;
use App\Entity\AvTrip;
use App\Repository\AvCategoryRepository;
use App\Repository\AvCountryRepository;
use App\Repository\AvTripRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class AvTripController extends AbstractController
{

    #[Route('/api/av/trip', name: 'api_av_trip', methods: ["GET"])]
    public function allTrips(AvTripRepository $avTripRepository, AvCategoryRepository $avCategory, AvCountryRepository $avCountry): Response
    {

        $trips = $avTripRepository->findAll();
        $category = $avCategory->findAll();
        $country = $avCountry->findAll();

        return $this->json(["trips" => $trips, "categories" => $category, "countries" => $country], context: ['groups' => ['api_trips_show', 'api_miscallineous_show']]);
    }



    #[Route('/api/av/trip/{id}', name: 'api_av_specific_trip', methods: ["GET"])]
    public function singleTrip(AvTripRepository $avTripRepository, int $id): Response
    {

        $trips = $avTripRepository->find($id);
        return $this->json($trips, context: ['groups' => ['api_trips_show', 'api_trips_specific']]);
    }
 

    #[Route('/api/av/sortByCategory/{id}', name: 'api_av_categories', methods: ["GET"])]
    public function sortTripByCategory(EntityManagerInterface $em, int $id): JsonResponse
    {
        $qb = $em->createQueryBuilder();
        $trip = $qb->select('AvTrip')
            ->from(AvTrip::class, 'AvTrip')
            ->join('AvTrip.AvCategory', 'TripCategory')
            ->where('TripCategory.id = :id')
            ->setParameter('id', $id)
            ->getQuery()
            ->getResult();
        return $this->json($trip, context: [
            'groups' => [
                'api_trips_category_show',
            ]
        ]);
    }


    #[Route('/api/av/book', name: 'api_av_book', methods: ["POST"])]
    public function bookTrip(Request $request, EntityManagerInterface $em): JsonResponse
    {

        $data = json_decode($request->getContent(), true);

        $trip = $em->getRepository(AvTrip::class)->findOneBy(["id" => $data["trip"]]); // je recupere un objet trip existant
        $status = $em->getRepository(AvStatus::class)->findOneBy(["id" => $data["status"]]);
        $firstname = $data["firstName"];
        $lastname = $data["lastName"];
        $phone = $data["phone"];
        $email = $data["email"];
        $message = $data["message"] ?: "";

        $newReservation = new AvReservation();
        $newReservation->setFirstname($firstname);
        $newReservation->setLastname($lastname);
        $newReservation->setPhone($phone);
        $newReservation->setEmail($email);
        $newReservation->setMessage($message);
        $newReservation->setTripId($trip);
        $newReservation->setAvStatus($status);


        $em->persist($newReservation);
        $em->flush();

        $responseText = "Successfully created a new reservation";

        return new JsonResponse($responseText, Response::HTTP_OK);
    }

    // Exemple de controlleur symfo qui récupère de la donnée d'une requête http et insère en base de données. 


    //    #[Route('/new', name: 'add_listing', methods: ['POST'])]
    //     public function add(Request                 $request, ManagerRegistry $doctrine, SubCategoryRepository $subCategoryRepository,
    //                         ListingStatusRepository $listingStatusRepository, ListingTypeRepository $listingTypeRepository, UserRepository $userRepository
    //     ): JsonResponse
    //     {
    //         $entityManager = $doctrine->getManager();

    //         $decodedJwtToken = $this->jwtManager->decode($this->tokenStorageInterface->getToken());
    //         $activeUser = $userRepository->find($decodedJwtToken["id"]);

    //         if ($this->isGranted(ListingVoter::CREATE, new Listing())) {
    //             $data = json_decode($request->getContent(), true);
    //             $title = $data['title'];
    //             $description = $data['description'];
    //             $fkListingStatus = $data['fkListingStatus'];
    //             $fkListingType = $data['fkListingType'];
    //             $fkSubCategory = $data['fkSubCategory'];
    //             $longitude = $data['longitude'];
    //             $latitude = $data['latitude'];
    //             $country = $data['country'];
    //             $postCode = $data['postCode'];
    //             $city = $data['city'];

    //             $images = $data['images'];

    //             if (empty($city) || empty($country) || empty($description)
    //                 || empty($title) || empty($fkSubCategory) || empty($fkListingStatus)
    //                 || empty($fkListingType)
    //                 || empty($postCode)) {

    //                 throw new NotFoundHttpException('Expecting mandatory parameters!');
    //             }

    //             $newListing = new Listing();

    //             $subCategory = $subCategoryRepository->find($fkSubCategory);
    //             $status = $listingStatusRepository->find($fkListingStatus);
    //             $type = $listingTypeRepository->find($fkListingType);

    //             $newListing->setCity($city);
    //             $newListing->setCountry($country);
    //             $newListing->setDescription($description);
    //             $newListing->setSubCategory($subCategory);
    //             $newListing->setFkListingStatus($status);
    //             $newListing->setFkListingType($type);
    //             $newListing->setFkUser($activeUser);
    //             $newListing->setPostcode($postCode);
    //             $newListing->setTitle($title);
    //             $newListing->setLatitude($latitude);
    //             $newListing->setLongitude($longitude);

    //             $entityManager->persist($newListing);
    //             $entityManager->flush();

    //             foreach($images as $image){
    //         $newImage = new ListingImage();
    //         $newImage->setImage($image);
    //         $newImage->setFkListing($newListing);
    //         $newImage->setCreatedAt(new \DateTimeImmutable());
    //         $entityManager->persist($newImage);
    //         $entityManager->flush();
    // }

    //             $responseText = "Successfully created a new listing with id: " . $newListing->getId();
    //         } else {
    //             $responseText = "You are not authorized to do this.";
    //         }

    //         return new JsonResponse($responseText, Response::HTTP_OK);
    //     }


}
