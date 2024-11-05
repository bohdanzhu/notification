<?php

namespace Civi\Notification\Entity;

abstract class AbstractEntity {

  private array $entityValues;

  public function __construct(array $entityValues) {
    $this->entityValues = $entityValues;
  }

  public function __get($name) {

  }

  public function getEntityValue(string $key) {
    // Check if the value is JSON-encoded and decode if so
    if (\CRM_Utils_JSON::isValidJSON($this->entityValues[$key])) {
      return json_decode($this->entityValues[$key], true);
    }

    return $this->entityValues[$key];
  }

}
