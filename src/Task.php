<?php

  class Task {

    private $description;

    function __construct($description) {

        $this->description = $description;
    }

    function setDescription ($description) {

        $this->description = (string) $description;
    }

    function getDescription () {

        return $this->description;
    }

    function save() {

        array_push($_SESSION['list_of_tasks'], $this);
    }

    static function getTasks() {

        return $_SESSION['list_of_tasks'];
    }

    static function deleteTasks() {

        $_SESSION['list_of_tasks'] = array();
     }

  }

?>
