<?php
use CRM_Notification_ExtensionUtil as E;
return [
  'name' => 'NotificationCondition',
  'table' => 'civicrm_notification_condition',
  'class' => 'CRM_Notification_DAO_NotificationCondition',
  'getInfo' => fn() => [
    'title' => E::ts('Notification Condition'),
    'title_plural' => E::ts('Notification Conditions'),
    'description' => E::ts('Condition a notification rule must apply to.'),
    'log' => TRUE,
  ],
  'getFields' => fn() => [
    'id' => [
      'title' => E::ts('ID'),
      'sql_type' => 'int unsigned',
      'input_type' => 'Number',
      'required' => TRUE,
      'description' => E::ts('Unique NotificationCondition ID'),
      'primary_key' => TRUE,
      'auto_increment' => TRUE,
    ],
    'rule_id' => [
      'title' => E::ts('Rule ID'),
      'sql_type' => 'int unsigned',
      'input_type' => 'EntityRef',
      'required' => TRUE,
      'description' => E::ts('FK to NotificationRule'),
      'entity_reference' => [
        'entity' => 'NotificationRule',
        'key' => 'id',
        'on_delete' => 'CASCADE',
      ],
    ],
    'field_name' => [
      'title' => E::ts('Field Name'),
      'sql_type' => 'varchar(255)',
      'input_type' => 'Text',
      'required' => TRUE,
      'description' => E::ts('Name of the field to which the condition applies.'),
    ],
    'operator' => [
      'title' => E::ts('Operator'),
      'sql_type' => 'varchar(255)',
      'input_type' => 'Text',
      'required' => TRUE,
      'description' => E::ts('The operator used to compare field value and condition value.'),
    ],
    'value' => [
      'title' => E::ts('Value'),
      'sql_type' => 'varchar(255)',
      'input_type' => 'Text',
      'required' => TRUE,
      'description' => E::ts('The value to compare the field value against.'),
    ],
  ],
  'getIndices' => fn() => [],
  'getPaths' => fn() => [],
];
