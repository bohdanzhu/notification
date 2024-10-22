<?php
use CRM_Notification_ExtensionUtil as E;
return [
  'name' => 'NotificationFieldMonitoring',
  'table' => 'civicrm_notification_field_monitoring',
  'class' => 'CRM_Notification_DAO_NotificationFieldMonitoring',
  'getInfo' => fn() => [
    'title' => E::ts('Notification Field Monitoring'),
    'title_plural' => E::ts('Notification Field Monitorings'),
    'description' => E::ts('Specifies the value change of a field a notification rule watches for.'),
    'log' => TRUE,
  ],
  'getFields' => fn() => [
    'id' => [
      'title' => E::ts('ID'),
      'sql_type' => 'int unsigned',
      'input_type' => 'Number',
      'required' => TRUE,
      'description' => E::ts('Unique NotificationFieldMonitoring ID'),
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
      'description' => E::ts('The name of the field which is monitored for changes.'),
    ],
    'operator_before' => [
      'title' => E::ts('Operator Before'),
      'sql_type' => 'varchar(255)',
      'input_type' => 'Text',
      'required' => TRUE,
      'description' => E::ts('The operator which is used to compare the previous field value.'),
    ],
    'value_before' => [
      'title' => E::ts('Value Before'),
      'sql_type' => 'varchar(255)',
      'input_type' => 'Text',
      'required' => TRUE,
      'description' => E::ts('The value against the previous field value is compared to.'),
    ],
    'operator_after' => [
      'title' => E::ts('Operator After'),
      'sql_type' => 'varchar(255)',
      'input_type' => 'Text',
      'required' => TRUE,
      'description' => E::ts('The operator which is used to compare the new field value.'),
    ],
    'value_after' => [
      'title' => E::ts('Value After'),
      'sql_type' => 'varchar(255)',
      'input_type' => 'Text',
      'required' => TRUE,
      'description' => E::ts('The value against the new field value is compared to.'),
    ],
  ],
  'getIndices' => fn() => [],
  'getPaths' => fn() => [],
];
