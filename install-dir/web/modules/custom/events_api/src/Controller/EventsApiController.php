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
  // Get filter parameters from request
  $request = \Drupal::request();
  $category = $request->query->get('category');
  $date = $request->query->get('date');

  // Build base query
  $query = \Drupal::entityQuery('node')
    ->condition('type', 'event')
    ->condition('status', 1)
    ->sort('field_event_date_time', 'ASC')
    ->accessCheck(TRUE);

  // ADD FILTERS - This was missing!
  if ($category) {
    $query->condition('field_category', $category, 'IN');
  }

  if ($date) {
    $query->condition('field_event_date_time', $date, '=');
  }

  $query->range(0, 50); // Limit results for performance
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

  // Frontend always shows first 3
  return new JsonResponse([
    'status' => 'success',
    'count' => count($events),
    'events' => array_slice($events, 0, 3),
  ]);
}


}
