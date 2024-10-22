<?php
use CRM_Notification_ExtensionUtil as E;
return [
  'name' => 'NotificationRuleMessageTemplate',
  'table' => 'civicrm_notification_rule_msg_template',
  'class' => 'CRM_Notification_DAO_NotificationRuleMessageTemplate',
  'getInfo' => fn() => [
    'title' => E::ts('NotificationRuleMessageTemplate'),
    'title_plural' => E::ts('NotificationRuleMessageTemplates'),
    'description' => E::ts('Joining table to connect notification rules with message templates.'),
    'log' => TRUE,
  ],
  'getFields' => fn() => [
    'id' => [
      'title' => E::ts('ID'),
      'sql_type' => 'int unsigned',
      'input_type' => 'Number',
      'required' => TRUE,
      'description' => E::ts('Unique NotificationRuleMessageTemplate ID'),
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
    'msg_template_id' => [
      'title' => E::ts('MessageTemplate ID'),
      'sql_type' => 'int unsigned',
      'input_type' => 'EntityRef',
      'required' => TRUE,
      'description' => E::ts('FK to MessageTemplate'),
      'entity_reference' => [
        'entity' => 'MessageTemplate',
        'key' => 'id',
        'on_delete' => 'RESTRICT',
      ],
    ],
    'languages' => [
      'title' => E::ts('Languages'),
      'sql_type' => 'text',
      'input_type' => 'Select',
      'serialize' => CRM_Core_DAO::SERIALIZE_JSON,
      'required' => TRUE,
      'description' => E::ts('The languages the message template shall be used for. (Empty for any.)'),
      'input_attrs' => [
        'multiple' => '1',
      ],
      'pseudoconstant' => [
        'option_group_name' => 'languages',
        'key_column' => 'name',
      ],
    ]
  ],
  'getIndices' => fn() => [
    'UI_rule_msg_template_id' => [
      'fields' => [
        'rule_id' => TRUE,
        'msg_template_id' => TRUE,
      ],
      'unique' => TRUE,
    ],
  ],
  'getPaths' => fn() => [],
];
