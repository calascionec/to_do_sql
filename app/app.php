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
  $app->register(new Silex\Provider\TwigServiceProvider(), array('twig.path' => __DIR__.'/../views'));


  //routes

  $app->get("/", function() use ($app) {

      return $app['twig']->render('tasks.html.twig', array('tasks' => Task::getTasks()));
  });

  $app->post("/tasks", function() use ($app) {
    $task = new Task($_POST['description']);
    $task->save();
    return $app['twig']->render('task_created.html.twig', array('newtask' => $task));

  });

  $app->post('/delete_tasks', function() use ($app) {

    Task::deleteTasks();

    return $app['twig']->render('tasks_deleted.html.twig'); 

  });

  return $app;


?>
