<?php

namespace Civi\Notification\Entity;

use Civi\Api4\NotificationFieldMonitoring;

class FieldMonitoringEntity extends AbstractEntity {

  public static function loadByRuleId(int $ruleId): array {
    $notificationFieldMonitorings = NotificationFieldMonitoring::get()
      ->addWhere('rule_id', '=', $ruleId)
      ->execute();

    // Convert results into array of FieldMonitoringEntity objects
    $fieldMonitorings = [];
    foreach ($notificationFieldMonitorings as $fieldMonitoring) {
      $fieldMonitorings[] = new self($fieldMonitoring);
    }

    return $fieldMonitorings;
  }
}
