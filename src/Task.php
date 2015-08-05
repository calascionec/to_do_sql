<?php

  class Task {

    private $description;
    private $dueDate;

    function __construct($description, $dueDate) {

        $this->description = $description;
        $this->dueDate = $dueDate;
    }

    function setDueDate ($dueDate) {
        $this->dueDate = $dueDate;
    }

    function getDueDate () {
        return $this->dueDate;
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
