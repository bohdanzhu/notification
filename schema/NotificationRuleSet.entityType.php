<?php
use CRM_Notification_ExtensionUtil as E;
return [
  'name' => 'NotificationRuleSet',
  'table' => 'civicrm_notification_rule_set',
  'class' => 'CRM_Notification_DAO_NotificationRuleSet',
  'getInfo' => fn() => [
    'title' => E::ts('NotificationRuleSet'),
    'title_plural' => E::ts('NotificationRuleSets'),
    'description' => E::ts('FIXME'),
    'log' => TRUE,
  ],
  'getFields' => fn() => [
    'id' => [
      'title' => E::ts('ID'),
      'sql_type' => 'int unsigned',
      'input_type' => 'Number',
      'required' => TRUE,
      'description' => E::ts('Unique RuleSet ID'),
      'primary_key' => TRUE,
      'auto_increment' => TRUE,
    ],
    'title' => [
      'title' => E::ts('Title'),
      'sql_type' => 'varchar(255)',
      'input_type' => 'Text',
      'required' => TRUE,
    ],
    'description' => [
      'title' => E::ts('Description'),
      'sql_type' => 'text',
      'input_type' => 'TextArea',
      'required' => FALSE,
    ],
    'monitored_entity_type' => [
      'title' => E::ts('Monitored Entity Type'),
      'sql_type' => 'varchar(255)',
      'input_type' => 'Text',
      'required' => TRUE,
      'description' => E::ts('Entity type the rule set monitors for changes.'),
    ],
    'source_entity_type' => [
      'title' => E::ts('Source Entity Type'),
      'sql_type' => 'varchar(255)',
      'input_type' => 'Text',
      'required' => TRUE,
      'description' => E::ts('Entity type where the rule set is configured.'),
    ],
    'source_entity_id' => [
      'title' => E::ts('Source Entity ID'),
      'sql_type' => 'int unsigned',
      'input_type' => 'Number',
      'required' => TRUE,
      'description' => E::ts('ID of entity where the rule set is configured.'),
    ],
    'is_active' => [
      'title' => E::ts('Is Active?'),
      'sql_type' => 'boolean',
      'input_type' => 'Checkbox',
      'required' => TRUE,
      'default' => TRUE,
      'description' => E::ts('Is this rule set active?'),
    ],
    'is_execute_only_first_rule' => [
      'title' => E::ts('Execute Only First Rule?'),
      'sql_type' => 'boolean',
      'input_type' => 'Checkbox',
      'required' => TRUE,
      'default' => FALSE,
      'description' => E::ts('Execute only the first matching rule?'),
    ],
  ],
  'getIndices' => fn() => [
    'index_title' => [
      'fields' => [
        'title' => TRUE,
      ],
    ],
    'index_is_active' => [
      'fields' => [
        'is_active' => TRUE,
      ],
    ],
  ],
  'getPaths' => fn() => [],
];
