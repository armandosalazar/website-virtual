<?php

include_once 'Connection.php';

class Reports
{

    static function generate($id, $url)
    {

        $connection = Connection::getConnection();

        return $connection->query("INSERT INTO reports (id_user, url) VALUES ($id, '$url')");
    }

    static function getReportsByIdUser($id)
    {

        $connection = Connection::getConnection();

        $result = $connection->query("SELECT * FROM reports WHERE id_user = $id");

        $reports = array();

        while ($row = $result->fetch_assoc()) {
            array_push($reports, $row);
        }

        return $reports;
    }
}
