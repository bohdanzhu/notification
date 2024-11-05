<?php

namespace Civi\Notification\Handlers;

use Civi\Notification\Entity\ConditionEntity;

class ConditionHandler {

  public function evaluateCondition(ConditionEntity $condition, array $changeSet): bool {
    $operator = $condition->getEntityValue('operator');
    $fieldName = $condition->getEntityValue('field_name');
    $conditionValue = $condition->getEntityValue('value');
    $changeSetValue = $changeSet[$fieldName] ?? NULL; // New value

    // Use the comparison method to evaluate condition
    return $this->compareValues($conditionValue, $changeSetValue, $operator);
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
