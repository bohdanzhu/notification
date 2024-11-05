<?php

namespace Civi\Notification\EventSubscriber;

use Civi\API\Request;
use Civi\Core\Event\PreEvent;
use Civi\Core\Event\PostEvent;
use Civi\Notification\Entity\RuleSetEntity;
use Civi\Notification\Handlers\RuleSetHandler;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

final class NotificationSubscriber implements EventSubscriberInterface {

  /**
   * Store the entity's old state in a cache
   *
   * @var array
   */
  private static array $entityCache = [];

  public static function getSubscribedEvents(): array {
    return [
      'hook_civicrm_pre' => 'onPre',
      'hook_civicrm_postCommit' => 'onPostCommit',
      'hook_civicrm_postProcess' => 'postProcess',
    ];
  }

  public function postProcess() {
    // This is temporary for debugging.
    // die;
  }

  public function onPre(PreEvent $event): void {
    [ , $entity, $id, ] = $event->getHookValues();

    if (RuleSetEntity::hasActiveRuleSets($entity)) {
      // Capture old values before the change
      $oldValues = $this->loadEntityValues($entity, $id);

      // Store the entity's old state in a cache
      self::$entityCache[$entity][$id] = $oldValues;
    }
  }

  public function onPostCommit(PostEvent $event): void {
    [ , $entity, $id, , ] = $event->getHookValues();

    // Check if old values exist for this entity in the cache
    if (isset(self::$entityCache[$entity][$id])) {
      $oldValues = self::$entityCache[$entity][$id];
      // Retrieve new values after the change
      $newValues = $this->loadEntityValues($entity, $id);

      $ruleSets = RuleSetEntity::loadByEntityType($entity);
      $ruleSetHandler = new RuleSetHandler();

      foreach ($ruleSets as $ruleSet) {
        // Evaluate relevant rule sets
        $ruleSetHandler->evaluateRuleSet($ruleSet, $newValues, $oldValues);
      }

      // Clean up cache after processing
      unset(self::$entityCache[$entity][$id]);
    }
  }

  private function loadEntityValues(string $entityType, int $entityID): array {
    // Load entity data with API v4
    $result = Request::create($entityType, 'get', [
      'version' => 4,
      'where' => [['id', '=', $entityID]]
    ])
      ->execute();

    return $result->first() ?? [];
  }

}
