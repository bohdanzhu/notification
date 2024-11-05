<?php

namespace Civi\Notification\Entity;

use Civi\Api4\NotificationRuleSet;

class RuleSetEntity extends AbstractEntity {

  private ?array $rules = NULL;

  /**
   * Magic method to load properties dynamically, ex. rules
   */
  public function __get($name) {
    if (!property_exists($this, $name)) {
      throw new \Exception("Property {$name} does not exist.");
    }

    if (!isset($this->$name)) {
      switch ($name) {
        case 'rules':
          $this->$name = RuleEntity::loadByRuleSetId($this->getEntityValue('id'));
          break;
      }
    }

    return $this->$name;
  }

  public static function loadByEntityType(string $entityType): array {
    $notificationRuleSets = NotificationRuleSet::get()
      ->addSelect('*')
      ->addWhere('monitored_entity_type', '=', $entityType)
      ->addWhere('is_active', '=', 1)
      ->execute();

    $ruleSets = [];

    foreach ($notificationRuleSets as $ruleSet) {
      $ruleSets[] = new self($ruleSet);
    }

    return $ruleSets;
  }

  public static function hasActiveRuleSets(string $entityType): bool {
    $result = NotificationRuleSet::get()
      ->selectRowCount()
      ->addWhere('monitored_entity_type', '=', $entityType)
      ->addWhere('is_active', '=', TRUE)
      ->execute();

    return $result->count() > 0;
  }

  public function isExecuteOnlyFirstRule() {
    return $this->getEntityValue('is_execute_only_first_rule');
  }

}
