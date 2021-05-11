<?php

namespace App\Controller;

use App\Repository\CalendarEventRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CalendarEventController extends AbstractController
{
   /**
    * @Route("/calendar_event", name="calendar_event_index")
    */
   public function index(CalendarEventRepository $calendarEventRepository): Response
   {
      $events = $calendarEventRepository->findAll();

      $evenements = [];

      foreach($events as $event){
         $evenements[] = [
            'id' => $event->getId(),
            'start' => $event->getStartAt()->format('d-m-Y H:i'),
            'end' => $event->getEndAt()->format('d-m-Y H:i'),
            'title' => $event->getTitle(),
            'description' => $event->getDescription(),
            'backgroundColor' => $event->getBackgroundColor(),
            'textColor' => $event->getTextColor(),
            'allDay' => $event->getAllday()
         ];
      }
      $data = json_encode($evenements);
      
      return $this->render('calendar_event/index.html.twig', compact('data'));
   }
}
