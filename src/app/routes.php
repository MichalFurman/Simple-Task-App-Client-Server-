<?php
    /** definicje routingu dla REST API
     */
    

     /* autoload.php */
    if (file_exists(__DIR__ . '../../../vendor/autoload.php')) require __DIR__ . '../../../vendor/autoload.php';
    else if (file_exists(__DIR__ . '/../../../vendor/autoload.php')) require __DIR__ . '/../../../vendor/autoload.php';
    else if (file_exists('../../../vendor/autoload.php')) require '../../../vendor/autoload.php';
    else exit ('Can not load file "autoload.php" in: "src/app/routes.php", plase check path and file.');

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