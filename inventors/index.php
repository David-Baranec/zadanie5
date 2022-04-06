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
        header("HTTP/1.1 405 Method Not Allowed");
        $data = json_decode(file_get_contents('php://input'), true);
        $sql = "SELECT * FROM inventors WHERE des = ?;";
        $stmt = $conn->prepare($sql);
        //echo($data['description']);
        $result = $stmt->execute([htmlspecialchars($data['description'])]);
        $result = $stmt->fetch();
        //echo ($result);

        if ($result != null) {
            //echo ("existing");
            return false;
        }

        $sql = "INSERT INTO inventors (name, surname, birth,birth_place,des) VALUES (?,?,?,?,?) ";
        $stmt = $conn->prepare($sql);
        $result = $stmt->execute([$data['name'], $data['surname'], $data['birth_date'], $data['birth_place'], $data['description']]);
        if ($result) {
            header("HTTP/1.1 201 OK");
        }
        echo json_encode($data);
        break;
    case 'PUT':
        //header("HTTP/1.1 201 OK");
        $data = json_decode(file_get_contents('php://input'), true);
        $id = $_GET["id"];
        echo "m";
        echo ($id);

        $sql = "UPDATE inventors SET name=?, surname=?, birth=?, birth_place=?, death=?, death_place=?, des=? WHERE id=:id";
        $stmt = $conn->prepare($sql);
        // echo json_encode($stmt);
        $stmt->execute([htmlspecialchars($data['name']), htmlspecialchars($data['surname']), htmlspecialchars($data['birth_date']), htmlspecialchars($data['birth_place']), htmlspecialchars($data['death']), htmlspecialchars($data['death_place']), htmlspecialchars($data['desription']), htmlspecialchars($id)]);
        if ($result) {
            header("HTTP/1.1 201 OK");
        }
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
        $year = $_GET["year"];
        if ($year) {
            $query = "SELECT * FROM inventors WHERE YEAR(birth)=:year OR YEAR(death)=:year;";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':year', $year, PDO::PARAM_INT);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            echo json_encode($result);
            return;
        }
        $surname = $_GET["surname"];
        if ($surname) {
            $query = "SELECT * FROM inventors where surname=:surname";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':surname', $surname, PDO::PARAM_STR);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            echo json_encode($result);
            return;
        }

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