<?php
    /** definicje routingu dla REST API
     */
    

     /* autoload.php */
    require '../../../vendor/autoload.php';

    require 'cors_policy.php';
    header('Content-Type: application/json');

    $router = new \Bramus\Router\Router();
    
    use Myvendor\Actaskman\Controllers\TaskController;
    use Myvendor\Actaskman\Controllers\Controller;
    $taskController = new TaskController();
    $controller = new Controller();

    /** deklaracje routera dla REST API */
    
    $router->get('/', fn() => $taskController->index());
    $router->get('/(\d+)', fn($id) =>  $taskController->show($id));
    $router->post('/', fn() =>  $taskController->store());
    $router->post('/(\w+)', fn($id) => $taskController->update($id));     
    $router->put('/', fn() => $controller->notFound());
    $router->put('/(\w+)', fn($id) => $controller->notFound());     
    $router->delete('/', fn() => $controller->notFound());
    $router->delete('/(\d+)', fn($id) =>  $taskController->delete($id));
    
    $router->set404(fn() => $controller->notFound());

    $router->run();

?>
