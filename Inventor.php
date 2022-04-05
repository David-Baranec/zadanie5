<?php

class Inventor
{
    protected $db;

    protected int $id;
    protected string $name;
    protected string $surname;
    protected DateTime $birth_date;
    protected string $birth_place;
    protected string $description;


public function __construct(MyPDO $db){
    $this->db = $db;
}
public function getName(): string {
    return $this->name;
}
public function setName(string $name): void {
    $this->name = $name;
}
public function getSurname():string{
    return $this->surname;
}
public function setSurname(string $surname): void {
    $this->surname = $surname;
}
public function getBirthdate():DateTime{
    return $this->birth_date;
}
public function setBirthDate(string $birth_date): void{
   // var_dump($birth_date);
    $this->birth_date = DateTime::createFromFormat('d.m.Y',$birth_date);
}
public function getBirthPlace():string{
    return $this->birth_place;
}
public function setBirthPlace(string $birth_place): void{
    $this->birth_place = $birth_place;
}
public function getDescription():string{
    return $this->description;
}
public function setDescription(string $description):void{
    $this->description = $description;
}

public function save(){
    $this->db->run("INSERT into inventors (`name`,`surname`,`birth_date`,`birth_place`,`description`) values(?,?,?,?,?)",
    [$this->name,$this->surname,$this->birth_date->format('Y-m-d'),$this->birth_place,$this->description]);
}





}

?>