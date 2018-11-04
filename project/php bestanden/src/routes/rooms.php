<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

$app = new \Slim\App;

$app->get('/api/rooms',function(Request $request, Response $response){
    $sql = "SELECT * FROM rooms";

    try{
        $db = new db();
        $db = $db->connect();

        $stmt = $db->query($sql);
        $rooms = $stmt->fetchAll(PDO::FETCH_OBJ);
        $db = null;
        echo json_encode($rooms);
    }
    catch (PDOException $e){
        echo '{error : {"text": '.$e->getMessage().'}';
    }
});
$app->get('/api/rooms/{name}',function(Request $request, Response $response){
    $name = $request->getAttribute('name');
    $sql = "SELECT * FROM rooms WHERE naam='$name'";

    try{
        $db = new db();
        $db = $db->connect();

        $stmt = $db->query($sql);
        $rooms = $stmt->fetchAll(PDO::FETCH_OBJ);
        $db = null;
        echo json_encode($rooms);
    }
    catch (PDOException $e){
        echo '{error : {"text": '.$e->getMessage().'}';
    }
});

$app->post('/api/rooms/add',function(Request $request, Response $response){
    $id = $request->getParam('id');
    $name=$request->getParam('name');

    $sql = "insert into rooms values (:id, :name)";

    try{
        $db = new db();
        $db = $db->connect();

        $stmt = $db->prepare($sql);

        $stmt->bindParam(':id',$id);
        $stmt->bindParam(':name',$name);

        $stmt->execute();

        echo'{"notice": {"text":"room added"}}';
    }
    catch(PDOException $ex){
        echo'{"error":{"text":'.$ex->getMessage().'}}';
    }
});
$app->get('/api/spelers',function(Request $request, Response $response){
    $sql = "SELECT * FROM spelers";

    try{
        $db = new db();
        $db = $db->connect();

        $stmt = $db->query($sql);
        $spelers = $stmt->fetchAll(PDO::FETCH_OBJ);
        $db = null;
        echo json_encode($spelers);
    }
    catch (PDOException $e){
        echo '{error : {"text": '.$e->getMessage().'}';
    }
});

$app->get('/api/spelers/{roomId}',function(Request $request, Response $response){
    $roomId = $request->getAttribute('roomId');
    $sql = "SELECT * FROM spelers WHERE roomId='$roomId'";

    try{
        $db = new db();
        $db = $db->connect();

        $stmt = $db->query($sql);
        $spelers = $stmt->fetchAll(PDO::FETCH_OBJ);
        $db = null;
        echo json_encode($spelers);
    }
    catch (PDOException $e){
        echo '{error : {"text": '.$e->getMessage().'}';
    }
});

$app->post('/api/rooms/join',function(Request $request, Response $response){
    $roomId = $request->getParam('roomId');
    $name=$request->getParam('name');

    $sql = "insert into spelers values (null,:name,:roomId)";

    try{
        $db = new db();
        $db = $db->connect();

        $stmt = $db->prepare($sql);

        $stmt->bindParam(':roomId',$roomId);
        $stmt->bindParam(':name',$name);

        $stmt->execute();

        echo'{"notice": {"text":"room joined"}}';
    }
    catch(PDOException $ex){
        echo'{"error":{"text":'.$ex->getMessage().'}}';
    }
});