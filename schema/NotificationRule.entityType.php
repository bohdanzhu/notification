<?php
use CRM_Notification_ExtensionUtil as E;
return [
  'name' => 'NotificationRule',
  'table' => 'civicrm_notification_rule',
  'class' => 'CRM_Notification_DAO_NotificationRule',
  'getInfo' => fn() => [
    'title' => E::ts('NotificationRule'),
    'title_plural' => E::ts('NotificationRules'),
    'description' => E::ts('FIXME'),
    'log' => TRUE,
  ],
  'getFields' => fn() => [
    'id' => [
      'title' => E::ts('ID'),
      'sql_type' => 'int unsigned',
      'input_type' => 'Number',
      'required' => TRUE,
      'description' => E::ts('Unique Rule ID'),
      'primary_key' => TRUE,
      'auto_increment' => TRUE,
    ],
    'rule_set_id' => [
      'title' => E::ts('RuleSet ID'),
      'sql_type' => 'int unsigned',
      'input_type' => 'EntityRef',
      'required' => TRUE,
      'description' => E::ts('FK to NotificationRuleSet'),
      'entity_reference' => [
        'entity' => 'NotificationRuleSet',
        'key' => 'id',
        'on_delete' => 'CASCADE',
      ],
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
    'preferred_location_type_id' => [
      'title' => E::ts('Preferred Location Type'),
      'sql_type' => 'int unsigned',
      'input_type' => 'Select',
      'required' => FALSE,
      'description' => ts('Which location type shall be used to detect recipient address (fallback primary)?'),
      'pseudoconstant' => [
        'table' => 'civicrm_location_type',
        'key_column' => 'id',
        'name_column' => 'name',
        'description_column' => 'description',
        'label_column' => 'display_name',
        'abbr_column' => 'vcard_name',
      ],
    ],
    'email_addresses' => [
      'title' => E::ts('Email Addresses'),
      'sql_type' => 'text',
      'input_type' => 'Text',
      'required' => FALSE,
      'serialize' => CRM_Core_DAO::SERIALIZE_JSON,
      'description' => E::ts('List of email addresses to send the notification to instead of contacts.'),
    ],
    'is_active' => [
      'title' => E::ts('Is Active?'),
      'sql_type' => 'boolean',
      'input_type' => 'CheckBox',
      'required' => TRUE,
      'default' => TRUE,
    ],
    'is_respect_communication_suspension' => [
      'title' => E::ts('Respect Communication Suspension?'),
      'sql_type' => 'boolean',
      'input_type' => 'CheckBox',
      'required' => TRUE,
      'default' => FALSE,
      'description' => E::ts('Respect contact\'s communication suspension e.g. do not email?'),
    ],
    'is_stop_after_this_rule' => [
      'title' => E::ts('Stop After This Rule?'),
      'sql_type' => 'boolean',
      'input_type' => 'CheckBox',
      'required' => TRUE,
      'default' => FALSE,
      'description' => E::ts('Skip further rule if this rule was executed?'),
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
