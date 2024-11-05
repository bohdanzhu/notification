<?php

namespace Civi\Notification\Handlers;

use Civi\Notification\Entity\RuleSetEntity;

class RuleSetHandler {

  public function evaluateRuleSet(RuleSetEntity $ruleSet, array $entityValues, array $changeSet): void {
    foreach ($ruleSet->rules as $rule) {
      // TODO: Add logic to check if rule set entity conditions are met (source_entity_type, source_entity_id)

      $ruleHandler = new RuleHandler();

      if ($ruleHandler->evaluateRule($rule, $entityValues, $changeSet)) {
        if ($ruleSet->isExecuteOnlyFirstRule()) {
          break;
        }
      }
    }
  }
}
