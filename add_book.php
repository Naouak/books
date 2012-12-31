<?php
require_once("bootstrap.php");

if(!Utilities::is_logged()){
    echo "Connecte toi chenapan";
    exit;
}

//Get inputs

$data = filter_input_array(INPUT_POST,array(
    "bookname" => FILTER_SANITIZE_STRING,
    "volumenumber" => FILTER_SANITIZE_NUMBER_INT,
    "language" => FILTER_SANITIZE_STRING,
    "type" => FILTER_SANITIZE_STRING,
    "liked" => FILTER_SANITIZE_NUMBER_INT
));

//Verifying data
if($data === NULL){
    echo "missing all data";
    exit;
}
foreach($data as $k => $v){
    if($v === NULL){
        echo "Missing $k";
        exit;
    }
}

$db = DatabaseFactory::getDB();

$q = $db->prepare("
INSERT INTO book(bookname,volumenumber,language,type,liked,readdate)
VALUES(:bookname,:volumenumber,:language,:type,:liked,NOW())
");

$q->bindValue(":bookname",$data["bookname"]);
$q->bindValue(":volumenumber",$data["volumenumber"]);
$q->bindValue(":language",$data["language"]);
$q->bindValue(":type",$data["type"]);
$q->bindValue(":liked",$data["liked"]);

$q->execute();

if($q->errorCode() > 0){
    var_dump($q->errorInfo());
}
else {
    header("location:index.php");
}
