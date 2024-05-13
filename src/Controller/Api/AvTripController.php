<?php

namespace App\Controller\Api;

use App\Entity\AvReservation;
use App\Repository\AvTripRepository;
use Symfony\Bridge\Doctrine\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Validator\Constraints\Json;

class AvTripController extends AbstractController
{

    #[Route('/api/av/trip', name: 'api_av_trip', methods: ["GET"])]
    public function allTrips(AvTripRepository $avTripRepository): Response
    {

        $trips = $avTripRepository->findAll();
        return $this->json($trips, context: ['groups' => 'api_trips_show']);
    }



    #[Route('/api/av/trip/{id}', name: 'api_av_specific_trip', methods: ["GET"])]
    public function singleTrip(AvTripRepository $avTripRepository, int $id): Response
    {

        $trips = $avTripRepository->find($id);
        return $this->json($trips, context: ['groups' => ['api_trips_show', 'api_trips_specific']]);
    }

    #[Route('/api/av/book', name: 'api_av_book', methods: ["POST"])]
    public function bookTrip(Request $request, ManagerRegistry $doctrine): JsonResponse
    {

        $entityManager = $doctrine->getManager();
        $data = json_decode($request->getContent(), true);
        $firstname = $data["firstname"];
        $lastname = $data["lastname"];
        $phone = $data["phone"];
        $email = $data["email"];
        $message = $data["message"] ?: "";
        $trip = $data["trip"];
        $status = $data["status"];

        $newReservation = new AvReservation();
        $newReservation->setFirstname($firstname);
        $newReservation->setLastname($lastname);
        $newReservation->setPhone($phone);
        $newReservation->setEmail($email);
        $newReservation->setMessage($message);
        $newReservation->setTripId($trip);
        $newReservation->setAvStatus($status);


        $entityManager->persist($newReservation);
        $entityManager->flush();

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
