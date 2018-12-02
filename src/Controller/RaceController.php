<?php
/**
 * Filename: Race.
 * User: Mehdi
 * Date: Nov, 2018
 */

namespace App\Controller;


use App\Classes\HorseRace;
use App\Classes\HorseRaceResult;
use App\Classes\SimulatorHorseRace;
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

$session = new Session();

if(!$session->isStarted()){
    $session->start();
}
//$session->clear();
class RaceController extends AbstractController
{
    private $encoders;
    private $normalizers;
    private $serializer;
    private $raceRepository;
    private $raceResultRepository;

    public function __construct(
        RaceRepository $raceRepository,
        RaceResultRepository $raceResultRepository
    )
    {
        $this->raceResultRepository = $raceResultRepository;
        $this->raceRepository = $raceRepository;
        $this->encoders = array(new XmlEncoder(), new JsonEncoder());
        $this->normalizers = array(new ObjectNormalizer());
        $this->serializer =  new Serializer($this->normalizers, $this->encoders);
    }

    /**
     * @param Request $request
     * @Route("/", name="racing")
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $this->createRace($request);
        return $this->render("race/index.html.twig");

    }

    /**
     * @param Request $request
     * @Route("/patternCreateNew", name="patternCreateNew")
     * @return Response
     */

    public function createRace(Request $request)
    {
        $horseRaceSimulator = new SimulatorHorseRace();
        $horseRace = $horseRaceSimulator->makeHorseRace(8,1500);
        $session = $request->getSession();
        $session->set('race', $horseRace);

        $horseRace = $this->serializer->serialize($horseRace->getHorses(), 'json');
        return New Response($horseRace);
    }

    /**
     * @param Request $request
     * @Route("/getResultPattern", name="getResultPattern")
     * @return Response
     */

    public function getRaceResult(Request $request){
        $raceResult = new HorseRaceResult();
        $session =  $request->getSession();
        $currentRace = $session->get('race');
        $race = $raceResult->getResult($currentRace);
        if($race->getStatus() == HorseRace::FINISHED)
        {
            $raceInfo =
                ['numberOfParticipants' =>$race->getNumberOfParticipants(),
                 'distance' => $race->getDistance()
                 ];
            $raceId = $this->raceRepository->addRace($raceInfo);

            $this->raceResultRepository->addResultByRaceId($race->getHorses(), $raceId);
            return new JsonResponse(null);
        }
        $session->set('race', $race);
        $result = $this->serializer->serialize($race->getHorses(), 'json');
        return new Response($result);
    }


}