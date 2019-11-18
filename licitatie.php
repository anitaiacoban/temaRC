<?php

error_reporting(E_ALL); 
ini_set('display_errors', 1);

require_once 'database.php';

class Licitatie extends Database{
 
    public function create($oferta_inceput, $oferta_final, $durata, $castigator)
    {
        $data = [
            'oferta_inceput' => $oferta_inceput,
            'oferta_final' => $oferta_final,
            'durata' => $durata,
            'castigator' => $castigator,
        ];

        $query = $this->connection->prepare("insert into licitatie (oferta_inceput,oferta_final,durata,castigator) values (:oferta_inceput, :oferta_final, :durata, :castigator)");
        $query->execute($data);
    }

    function get($id)
    {
        $data = [
            'id' => $id,
        ];

        $query = $this->connection->prepare("select * from licitatie where id =:id ");
        $query->execute($data);
        
        return $query->fetch(); 
    }

    function getAll()
    {
        $query = $this->connection->query("select * from licitatie");

        return $query->fetchAll();
    }

    function delete($id)
    {
        $data = [
            'id'=> $id,
        ]; 

        $query = $this->connection->prepare("delete from licitatie where id = :id");
        $query->execute($data);
    }

    function update($oferta_inceput, $oferta_final, $durata, $castigator,$id)
    {
        $data = [
            'oferta_inceput' => $oferta_inceput,
            'oferta_final' => $oferta_final,
            'durata' => $durata,
            'castigator' => $castigator,
            'id' => $id,
        ];
        
        $query = $this->connection->prepare("update licitatie set oferta_inceput= :oferta_inceput, oferta_final= :oferta_final, durata= :durata, castigator= :castigator where id= :id");
        $query->execute($data);
    }

    function updateOferta($valoare){
        $data =[
            'valoare' => $valoare,
        ];

        $query = $this->connection->prepare ("update licitatie set oferta_inceput = :valoare where id=1");
        $query->execute($data);
    }   
    
    function updateCastigator($valoare){
        $data =[
            'valoare' => $valoare,
        ];

        $query = $this->connection->prepare ("update licitatie set castigator = :valoare where id=1");
        $query->execute($data);
    }   
}


// ----------verificare functii 

// $licitatieDb = new Licitatie();
// $licitatieDb->create(20,500,'14:13:13','Elena');

// $licitatieGet = $licitatieDb->get(1);
// print_r($licitatieGet);

// $licitatieGetAll = $licitatieDb->getAll();
// print_r($licitatieGetAll);

// $licitatieDb->delete(2);

// $licitatieDb->update(20,100,'14:13:13','Anita',1);