<?php
  //dependencies
  require_once __DIR__."/../vendor/autoload.php";
  require_once __DIR__."/../src/Task.php";

  //create and check cookie
  session_start();
  if (empty($_SESSION['list_of_tasks'])) {
      $_SESSION['list_of_tasks'] = array();
  }


  //initialize the application
  $app = new Silex\Application();

  //routes

  $app->get("/", function() {


      // $first_task = new Task("Wash dog");
      // $second_task = new Task("Groceries");
      // $third_task = new Task("Sweep");
      // $task_list = array($first_task, $second_task, $third_task);

      $output = "";

      foreach (Task::getAll() as $task) {
        $output = $output . $task->getDescription() . "</br>";
      }

      

      return $output;
  });

  return $app;


?>
