<?php
/*ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);*/

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
$inventor = 0;


switch ($_SERVER['REQUEST_METHOD']) {
    case 'POST':
        header("HTTP/1.1 405 Method Not Allowed");
        $data = json_decode(file_get_contents('php://input'), true);
        $sql = "SELECT * FROM inventions WHERE name = ?;";
        $stmt = $conn->prepare($sql);
        //echo($data['description']);
        $result = $stmt->execute([htmlspecialchars($data['name'])]);
        $result = $stmt->fetch();
        //echo ($result);

        if ($result != null) {
            //echo ("existing");
            return false;
        }


        $sql = "INSERT INTO inventions (name, year, inventor_id) VALUES (?,?,?) ";
        $stmt = $conn->prepare($sql);
        //var_dump($data);
        $result = $stmt->execute([$data['name'], $data['year'], $data['inventor_id']]);
        echo json_encode($data);
        header("HTTP/1.1 201 OK");
        break;

    case 'DELETE':
        header("HTTP/1.1 204 OK");
        $id = $_GET["id"];
        $sql = "DELETE FROM inventions WHERE id=:id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $result =  $stmt->execute();
        echo json_encode($result);
        break;
    case 'GET':
        $inventor = $_GET["inventor"];
        if ($inventor) {
            $query = "SELECT * FROM inventions where inventor_id=:inventor_id";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':inventor_id', $inventor, PDO::PARAM_INT);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            echo json_encode($result);
            return;
        }
        $year = $_GET["year"];
        if ($year) {
            $query = "SELECT * FROM inventions WHERE year=:yeaar";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':yeaar', $year, PDO::PARAM_INT);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            echo json_encode($result);
            return;
        }
        $century = $_GET['century'];
        $century *= 100;
        if ($century) {
            $query = "SELECT * FROM inventions where year>:century AND year<(:century+100)";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':century', $century, PDO::PARAM_INT);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            echo json_encode($result);
        }
        $id = $_GET["id"];
        if ($id) {
            $query = "SELECT * FROM inventions where id=:id";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            echo json_encode($result);
        } else {

            $query = "SELECT * FROM inventions ";
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