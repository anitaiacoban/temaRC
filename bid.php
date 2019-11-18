<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once 'database.php';

class Bid extends Database
{
    function create($plasator, $valoare)
    {
        try {
            $data = [
                'plasator' => $plasator, 
                'valoare' => $valoare,
            ];

            $query = $this->connection->prepare("insert into bid (plasator, valoare, id_licitatie) values (:plasator, :valoare, 1)");
            $query->execute($data);
        } catch (Exception $e) {    
            echo $e->getMessage();
        }
    }

    function get($id)
    {
        $data = [
            'id' => $id,
        ];

        $query = $this->connection->prepare("select * from bid where id= :id");
        $query->execute($data);

        return $query->fetch();
    }

    function getAll($id_licitatie)
    {
        $data = [
            'id_licitatie' => $id_licitatie,
        ];

        $query = $this->connection->prepare("select * from bid where id_licitatie= :id_licitatie");
        $query->execute($data);
        return $query->fetchAll();
    }

    function delete($id)
    {
        $data = [
            'id' => $id,
        ];

        $query = $this->connection->prepare("delete from bid where id = :id");
        $query->execute($data);
    }

    function update($idLicitatie, $plasator, $valoare, $id)
    {
        $data = [
            'idLicitatie' => $idLicitatie,
            'plasator' => $plasator,
            'valoare' => $valoare,
            'id' => $id,
        ];

        $query = $this->connection->prepare("update bid set id_licitatie= :idLicitatie, plasator= :plasator, 
        valoare= :valoare where id= :id");
        $query->execute($data);
    }

    function iaValoareaMax($plasator)
    {
        $data = [
            'plasator' => $plasator,
        ];

        $query = $this->connection->prepare("select max(valoare) from bid where id_licitatie= 1 and plasator = :plasator group by plasator");
        
        $query->execute($data);
        return $query->fetch(); 
    }

    function sumaBid($id_licitatie)
    {
        $data=[
            'id_licitatie' => $id_licitatie,
        ];

        $query = $this->connection->prepare("select plasator, sum(valoare) from bid group by plasator");

        $query->execute($data);
        
        return $query->fetch(); 
    }
}

//-----verificare

// $bidDb = new Bid();
// $bidDb->create(1,'Mimi',66);

// $bidGet = $bidDb->get(1);
// print_r($bidGet);

// $bidGetAll = $bidDb->getAll(1);
// print_r($bidGetAll);

// $bidDb->delete(2);
// $bidDb->update(2,'player',67,1);
