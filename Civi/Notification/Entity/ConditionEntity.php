<?php

namespace Civi\Notification\Entity;

use Civi\Api4\NotificationCondition;

class ConditionEntity extends AbstractEntity {

  public static function loadByRuleId(int $ruleId): array {
    $notificationConditions = NotificationCondition::get()
      ->addWhere('rule_id', '=', $ruleId)
      ->execute();

    // Convert results into array of ConditionEntity objects
    $conditions = [];
    foreach ($notificationConditions as $condition) {
      $conditions[] = new self($condition);
    }

    return $conditions;
  }

}
