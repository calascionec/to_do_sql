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
  $app['debug'] =  true;
  $app->register(new Silex\Provider\TwigServiceProvider(), array(
      'twig.path' => __DIR__.'/../views'));

  //Database
  $server = 'mysql:host=localhost; db=to_do'; //connect to the localhost and DB 'to_do'
  $username = 'root';
  $password = 'root';
  $DB = new PDO($server, $username, $password);

  //routes

  $app->get("/", function() use ($app) {

      return $app['twig']->render('tasks.html.twig', array('tasks' => Task::getTasks(), 'count' => 0));
  });

  $app->post("/tasks", function() use ($app) {
    $task = new Task($_POST['description'], $_POST['dueDate']);
    $task->save();
    return $app['twig']->render('task_created.html.twig', array('newtask' => $task));

  });

  $app->post('/delete_one', function() use ($app) {

       $tasks = Task::getTasks();
       unset($tasks[$_POST['count']]);
       $tasks = array_values($tasks);

     //return $app['twig']->render('delete_one.html.twig');

    return $app['twig']->render('tasks.html.twig', array('tasks' => Task::getTasks(), 'count' => 0));
  });

  $app->post('/delete_tasks', function() use ($app) {

    Task::deleteTasks();

    return $app['twig']->render('tasks_deleted.html.twig');

  });

  return $app;


?>
