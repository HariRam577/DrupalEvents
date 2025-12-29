<?php

namespace Drupal\events_api\Controller;

use Drupal\Core\Controller\ControllerBase;
use Symfony\Component\HttpFoundation\JsonResponse;
use Drupal\node\Entity\Node;
use Drupal\file\Entity\File;
use Drupal\taxonomy\Entity\Term;

/**
 * Controller for Events API endpoints.
 */
class EventsApiController extends ControllerBase {

  /**
   * Returns upcoming events as JSON.
   *
   * @return \Symfony\Component\HttpFoundation\JsonResponse
   *   JSON response with upcoming events.
   */
//   public function upcoming() {
//     $current_time = \Drupal::time()->getRequestTime();

//     // Query for upcoming events using correct field
//     $query = \Drupal::entityQuery('node')
//       ->condition('type', 'event')
//       ->condition('status', 1)
//       ->condition('field_event_date_time', "ASC")
//       ->sort('field_event_date_time', 'ASC')
//       ->accessCheck(TRUE);

//     $nids = $query->execute();
//     $events = [];

//     if (!empty($nids)) {
//       $nodes = Node::loadMultiple($nids);

//       foreach ($nodes as $node) {
//         $event = [
//           'id' => $node->id(),
//           'title' => $node->getTitle(),
//           'date' => $node->hasField('field_event_date_time') ? $node->get('field_event_date_time')->value : null,
//           'location' => $node->hasField('field_location') ? $node->get('field_location')->value : null,
//           'summary' => $node->hasField('field_summary') ? $node->get('field_summary')->value : null,
//           'body' => $node->hasField('field_body') ? $node->get('field_body')->value : null,
//         ];

//         // Get category
//         if ($node->hasField('field_category') && !$node->get('field_category')->isEmpty()) {
//           $category_tid = $node->get('field_category')->target_id;
//           $category = Term::load($category_tid);
//           if ($category) {
//             $event['category'] = [
//               'id' => $category->id(),
//               'name' => $category->getName(),
//             ];
//           }
//         }

//         // Get image URL
//         if ($node->hasField('field_image_event') && !$node->get('field_image_event')->isEmpty()) {
//           $image_fid = $node->get('field_image_event')->target_id;
//           $file = File::load($image_fid);
//           if ($file) {
//             $event['image_url'] = \Drupal::service('file_url_generator')
//               ->generateAbsoluteString($file->getFileUri());
//           }
//         }

//         $events[] = $event;
//       }
//     }

//     return new JsonResponse([
//       'status' => 'success',
//       'count' => count($events),
//       'events' => $events,
//     ]);
//   }
public function upcoming() {
  // Get current time if you want to filter by future events (optional)
  //$current_time = \Drupal::time()->getRequestTime();

  // Query for all published events
  $query = \Drupal::entityQuery('node')
    ->condition('type', 'event')   // event content type
    ->condition('status', 1)       // only published
    ->sort('field_event_date_time', 'ASC') // sort by event date
    ->accessCheck(TRUE);

  $nids = $query->execute();
  $events = [];

  if (!empty($nids)) {
    $nodes = Node::loadMultiple($nids);

    foreach ($nodes as $node) {
      $event = [
        'id' => $node->id(),
        'title' => $node->getTitle(),
        'date' => $node->hasField('field_event_date_time') ? $node->get('field_event_date_time')->value : null,
        'location' => $node->hasField('field_location') ? $node->get('field_location')->value : null,
        'summary' => $node->hasField('field_summary') ? $node->get('field_summary')->value : null,
        'body' => $node->hasField('field_body') ? $node->get('field_body')->value : null,
      ];

      // Get category
      if ($node->hasField('field_category') && !$node->get('field_category')->isEmpty()) {
        $category_tid = $node->get('field_category')->target_id;
        $category = Term::load($category_tid);
        if ($category) {
          $event['category'] = [
            'id' => $category->id(),
            'name' => $category->getName(),
          ];
        }
      }

      // Get image URL
      if ($node->hasField('field_image_event') && !$node->get('field_image_event')->isEmpty()) {
        $image_fid = $node->get('field_image_event')->target_id;
        $file = File::load($image_fid);
        if ($file) {
          $event['image_url'] = \Drupal::service('file_url_generator')
            ->generateAbsoluteString($file->getFileUri());
        }
      }

      $events[] = $event;
    }
  }

  return new JsonResponse([
    'status' => 'success',
    'count' => count($events),
    'events' => $events,
  ]);
}


}
