<?php

namespace Civi\Notification\Handlers;

use Civi\Notification\Entity\RuleEntity;

class RuleHandler {

  public function evaluateRule(RuleEntity $rule, array $oldValues, array $changeSet): bool {
    // Evaluate additional conditions
    foreach ($rule->conditions as $condition) {
      $conditionHandler = new ConditionHandler();

      // Evaluate condition logic
      if (!$conditionHandler->evaluateCondition($condition, $changeSet)) {
        return FALSE;
      }
    }

    // Evaluate field monitoring rules
    foreach ($rule->fieldMonitorings as $fieldMonitoring) {
      $fieldMonitorHandler = new FieldMonitoringHandler();
      // Evaluate field monitoring logic
      if (!$fieldMonitorHandler->evaluate($fieldMonitoring, $oldValues, $changeSet)) {
        return FALSE;
      }
    }

    // TODO: add logic for sending notification

    return TRUE;
  }
}
