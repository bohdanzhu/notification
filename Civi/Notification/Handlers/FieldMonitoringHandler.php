<?php

namespace Civi\Notification\Handlers;

use Civi\Notification\Entity\FieldMonitoringEntity;

class FieldMonitoringHandler {

  public function evaluate(FieldMonitoringEntity $fieldMonitoring, array $oldValues, array $changeSet): bool {
    $operatorBefore = $fieldMonitoring->getEntityValue('operator_before');
    $operatorAfter = $fieldMonitoring->getEntityValue('operator_after');
    $conditionBeforeValue = $fieldMonitoring->getEntityValue('value_before');
    $conditionAfterValue = $fieldMonitoring->getEntityValue('value_after');
    $fieldName = $fieldMonitoring->getEntityValue('field_name');
    $oldValue = $oldValues[$fieldName] ?? NULL; // Old value
    $newValue = $changeSet[$fieldName] ?? NULL; // New value

    // Use the comparison method to evaluate condition
    return
      $this->compareValues($conditionBeforeValue, $oldValue, $operatorBefore)
      && $this->compareValues($conditionAfterValue, $newValue, $operatorAfter);
  }

  // TODO: Move the method to avoid duplication
  private function compareValues($value1, $value2, string $operator): bool {
    switch ($operator) {
      case '=':
        return $value1 == $value2;
      case 'IN':
        return in_array($value2, $value1);
      default:
        throw new \InvalidArgumentException("Unsupported operator: $operator");
    }
  }
}
