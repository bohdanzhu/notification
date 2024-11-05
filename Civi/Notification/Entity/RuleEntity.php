<?php

namespace Civi\Notification\Entity;

use \Civi\Api4\NotificationRule;

class RuleEntity extends AbstractEntity {

  private ?array $fieldMonitorings = NULL;
  private ?array $conditions = NULL;

  public function __get($name) {
    if (!property_exists($this, $name)) {
      throw new \Exception("Property {$name} does not exist.");
    }

    if (!isset($this->$name)) {
      switch ($name) {
        case 'fieldMonitorings':
          $this->$name = FieldMonitoringEntity::loadByRuleId($this->getEntityValue('id'));
          break;
        case 'conditions':
          $this->$name = ConditionEntity::loadByRuleId($this->getEntityValue('id'));
          break;
      }
    }

    return $this->$name;
  }

  public static function loadByRuleSetId(int $ruleSetId): array {
    $notificationRules = NotificationRule::get()
      ->addWhere('rule_set_id', '=', $ruleSetId)
      ->addWhere('is_active', '=', TRUE)
      ->addOrderBy('weight')
      ->execute();

    // Convert results into array of RuleEntity objects
    $rules = [];
    foreach ($notificationRules as $rule) {
      $rules[] = new self($rule);
    }

    return $rules;
  }
}
