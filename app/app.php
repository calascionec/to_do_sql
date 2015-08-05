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

      //display all the available tasks
      foreach (Task::getTasks() as $task) {
        $output = $output . $task->getDescription() . "</br>";
      }

      //create new task form
      $output = "<h1>List of tasks</h1>" . $output . "</br>
          <form action='/tasks' method='POST'>
              <label for='description'>Description of task:</label>
              <input id='description' name='description' type='text'></input>
          </form>
          <button type='submit'>Submit</button>

      ";

      return $output;
  });

  $app->post("/tasks", function(){
    $task = new Task($_POST['description']);
    $task->save();
    return "
    <h1>You created a task!</h1>
    <h3>Task created: " . $task->getDescription() . "</h3>
    <p><a href='/'>Look at list</a></p>
    ";

  });

  return $app;


?>
