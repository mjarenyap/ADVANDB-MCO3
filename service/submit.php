<?php
    include "fetcher.php";

    $db = new MySqlDatabase();

    $type = $_POST["type"];

    switch ($type) {
        case "insert":
            $country = $_POST["country"];

            $series = $_POST["series"];

            $year = $_POST["year"];
            $year = $year . " [YR" . $year . "]";

            $data = $_POST["data"];

            // $sql = "INSERT INTO wdi2.databyyear (CountryCode, SeriesCode, YearC, Data) VALUES (" . $country . ", " . $series . ", "  . $year . ", "  . $data . ")";
            $sql = "INSERT INTO wdi2.databyyear (CountryCode, SeriesCode, YearC, Data) VALUES (?, ?, ?, ?)";

            $connection = $db->connect();
            $connection->autocommit(FALSE);

            // $connection->begin_transaction();

            $statement = $connection->prepare($sql);
            if ($statement == false) {
                echo $sql;
            }

            $statement->bind_param("sssd", $country, $series, $year, $data);

            if (!$statement->execute())
            {
                $connection->rollback();
                exit();
            }
            
            $statement->close();
            $connection->commit();
            $connection->close();
            // $db->query($sql);
            // echo $db->error();
            break;

        case "update":
            $id = $_POST["id"];
            echo $id;
            
            $country = $_POST["country"];

            $series = $_POST["series"];

            $year = $_POST["year"];
            $year = $year . " [YR" . $year . "]";

            $data = $_POST["data"];

            // $sql = "INSERT INTO wdi2.databyyear (CountryCode, SeriesCode, YearC, Data) VALUES (" . $country . ", " . $series . ", "  . $year . ", "  . $data . ")";
            $sql = "UPDATE wdi2.databyyear SET CountryCode = ?, SeriesCode = ?, YearC = ?, Data = ? WHERE Id = ?";

            $connection = $db->connect();
            $connection->autocommit(FALSE);

            // $connection->begin_transaction();

            $statement = $connection->prepare($sql);
            if ($statement == false) {
                echo $sql;
            }

            $statement->bind_param("sssdi", $country, $series, $year, $data, $id);

            if (!$statement->execute())
            {
                $connection->rollback();
                exit();
            }
            
            $statement->close();
            $connection->commit();
            $connection->close();
            // $db->query($sql);
            // echo $db->error();
            break;

        case "delete":
            $data = json_decode($_POST["data"], true);

            $sql = "DELETE FROM wdi2.databyyear WHERE Id = ?";

            $connection = $db->connect();
            $connection->autocommit(FALSE);

            $connection->begin_transaction();

            $statement = $connection->prepare($sql);
            if ($statement == false) {
                echo $sql;
            }

            foreach($data as $id) {
                $statement->bind_param("i", $id);

                if (!$statement->execute())
                {
                    $connection->rollback();
                    exit();
                }
            }
            
            $statement->close();
            $connection->commit();
            $connection->close();

            break;
    }

    // header("Location: ../index.php");
    // exit();
?>