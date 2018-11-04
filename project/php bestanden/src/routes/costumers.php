<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

$app = new \Slim\App;

$app->get('/api/costumers',function(Request $request, Response $response){
    $sql = "SELECT * FROM customers";

    try {
    $db = new db();
    $db = $db->connect();

    $stmt = $db->query($sql);
    $customers = $stmt->fetchAll(PDO::FETCH_OBJ);
    $db = null;
    echo json_encode($customers);
    }
    catch(PDOException $e){
        echo'{"error":{"text": '.$e->getMessage().'}}';
    }
});

$app->get('/api/costumers/{id}',function(Request $request, Response $response){
    $id = $request->getAttribute('id');

    $sql = "SELECT * FROM customers where id = $id";

    try {
    $db = new db();
    $db = $db->connect();

    $stmt = $db->query($sql);
    $customer = $stmt->fetchAll(PDO::FETCH_OBJ);
    $db = null;
    echo json_encode($customer);
    }
    catch(PDOException $e){
        echo'{"error":{"text": '.$e->getMessage().'}}';
    }
});

$app->post('/api/costumers/add',function(Request $request, Response $response){
    $id = $request->getParam('id');
    $first_name = $request->getParam('first_name');
    $last_name = $request->getParam('last_name');
    $phone = $request->getParam('phone');

    $sql = "insert into customers values (:id, :first_name,:last_name,:phone)";

    try {
    $db = new db();
    $db = $db->connect();

    $stmt = $db->prepare($sql);

    $stmt->bindParam(':id',$id);
    $stmt->bindParam(':first_name',$first_name);
    $stmt->bindParam(':last_name',$last_name);
    $stmt->bindParam(':phone',$phone);

    $stmt->execute();

    echo '{"notice": {"text":"customer added"}}';
    }
    catch(PDOException $e){
        echo'{"error":{"text": '.$e->getMessage().'}}';
    }
});

$app->put('/api/costumers/update/{id}',function(Request $request, Response $response){
    $id = $request->getParam('id');
    $first_name = $request->getParam('first_name');
    $last_name = $request->getParam('last_name');
    $phone = $request->getParam('phone');

    $sql = "update customers set first_name = :first_name, last_name = :last_name, phone = :phone where id = $id";

    try {
    $db = new db();
    $db = $db->connect();

    $stmt = $db->prepare($sql);

    $stmt->bindParam(':first_name',$first_name);
    $stmt->bindParam(':last_name',$last_name);
    $stmt->bindParam(':phone',$phone);

    $stmt->execute();

    echo '{"notice": {"text":"customer updated"}}';
    }
    catch(PDOException $e){
        echo'{"error":{"text": '.$e->getMessage().'}}';
    }
});