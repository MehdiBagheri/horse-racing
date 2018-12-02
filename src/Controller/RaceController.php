<?php
/**
 * Filename: Race.
 * User: Mehdi Bagheri
 * Date: Nov, 2018
 */

namespace App\Controller;


use App\Classes\HorseRace;
use App\Classes\HorseRaceResult;
use App\Classes\SimulatorHorseRace;
use App\Repository\BestRecordRepository;
use App\Repository\RaceRepository;
use App\Repository\RaceResultRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\HttpFoundation\Session\Session;

class RaceController extends AbstractController
{
    private $encoders;
    private $normalizers;
    private $serializer;
    private $raceRepository;
    private $raceResultRepository;
    private $bestRecordRepository;

    public function __construct (
        RaceRepository $raceRepository,
        RaceResultRepository $raceResultRepository,
        BestRecordRepository $bestRecordRepository
    ) {
        $this->bestRecordRepository = $bestRecordRepository;
        $this->raceResultRepository = $raceResultRepository;
        $this->raceRepository = $raceRepository;
        $this->encoders = array(new XmlEncoder(), new JsonEncoder());
        $this->normalizers = array(new ObjectNormalizer());
        $this->serializer = new Serializer($this->normalizers, $this->encoders);
    }

    /**
     * @param Request $request
     * @Route("/", name="racing")
     *
     * @return Response
     */
    public function index (Request $request)
    {
        $session = $request->getSession();
        if(!$session->isStarted()){
            $session->start();
        }

        if ($session->get('race') == null) {
            $this->createRace($request);
        }

        return $this->render("race/index.html.twig");

    }

    /**
     * @param Request $request
     * @Route("/create", name="create")
     *
     * @return Response
     *
     * create race using builder pattern for create horses and factory pattern for creating races
     */

    public function createRace (Request $request)
    {
        $horseRaceSimulator = new SimulatorHorseRace();
        $horseRace = $horseRaceSimulator->makeHorseRace(8, 1500);
        $session = $request->getSession();
        $session->set('race', $horseRace);

        $horseRace = $this->serializer->serialize($horseRace->getHorses(), 'json');

        return New Response($horseRace);
    }

    /**
     * @param Request $request
     * @Route("/getResult", name="getResult")
     *
     * @return Response
     *
     *races result calculation and save into database at the end
     */

    public function getRaceResult (Request $request)
    {

        $raceResult = new HorseRaceResult();
        $session = $request->getSession();
        $currentRace = $session->get('race');

        if ($currentRace->getStatus() == HorseRace::FINISHED) {
            $raceInfo =
                [
                    'numberOfParticipants' => $currentRace->getNumberOfParticipants(),
                    'distance'             => $currentRace->getDistance(),
                ];
            $raceId = $this->raceRepository->addRace($raceInfo);

            $bestRecord = $this->raceResultRepository->addResultByRaceId($currentRace->getHorses(), $raceId);
            $this->bestRecordRepository->setBestRecord($bestRecord);

            return new JsonResponse('null');
        }
        $race = $raceResult->getResult($currentRace);
        $session->set('race', $race);
        $result = $this->serializer->serialize($race->getHorses(), 'json');

        return new Response($result);
    }


}