<?php
/*ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);*/

require_once "../MyPDO.php";
-require_once "../Inventor.php";
require_once "../config.php";

header('Content-type: application/json; charset=utf-8');
try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //echo "Connected successfully";
    //echo "connected";
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}






switch ($_SERVER['REQUEST_METHOD']) {
    case 'POST':
        header("HTTP/1.1 201 OK");
        $data = json_decode(file_get_contents('php://input'), true);
        $sql = "INSERT INTO inventors (name, surname, birth,birth_place,des) VALUES (?,?,?,?,?) ";
        $stmt = $conn->prepare($sql);
        $result = $stmt->execute([$data['name'], $data['surname'], $data['birth_date'], $data['birth_place'], $data['description']]);
        echo json_encode($data);
        break;

    case 'DELETE':
        header("HTTP/1.1 204 OK");
        $id = $_GET["id"];
        $sql = "DELETE FROM inventors WHERE id=:id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $result =  $stmt->execute();
        echo json_encode($result);
        break;
    case 'GET':
        $surname = $_GET["surname"];
        if ($surname) {
            $query = "SELECT * FROM inventors where surname=:surname";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':surname', $surname, PDO::PARAM_STR);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            echo json_encode($result);
        } else {
            $id = $_GET["id"];
            if ($id) {
                $query = "SELECT * FROM inventors where id=:id";
                $stmt = $conn->prepare($query);
                $stmt->bindParam(':id', $id, PDO::PARAM_INT);
                $stmt->execute();
                $result = $stmt->fetch(PDO::FETCH_ASSOC);
                echo json_encode($result);
            } else {

                $query = "SELECT * FROM inventors ";
                $stmt = $conn->prepare($query);
                $stmt->execute();
                $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                echo json_encode($result);
            }
        }
        header("HTTP/1.1 200 OK");
        break;
}

/*

$myPdo= new MyPDO("mysql:host=$servername;dbname=$dbname", $username, $password);



$file=fopen("vynalezy.csv", "r");
while(!feof($file)){
    $pole=fgetcsv($file);
    if($pole[0]){
        print_r($pole);


        $inventor=new Inventor($myPdo);
        $inventor->setName($data['name']);
        $inventor->setSurname($data['surname']);
        $inventor->setBirthDate($data['birth_date']);
        $inventor->setBirthPlace($data['birth_place']);
        $inventor->setDescription($data['description']);
        try{
            $inventor->save();
        }catch(Exception $e){

        }
   }
}*/