<?php

function createTable($conn, $sql, $tableName) {
    if (mysqli_query($conn, $sql)) {
        echo "<h3>Table $tableName created successfully</h3>";
    } else {
        echo "Error creating table $tableName: " . mysqli_error($conn);
    }
}

function insertRecords($conn, $sql) {
    if (mysqli_multi_query($conn, $sql)) {
        do {
            // store first result set
            if ($result = mysqli_store_result($conn)) {
                while ($row = mysqli_fetch_row($result)) {
                    // process results
                }
                mysqli_free_result($result);
            }
            // if there are more result-sets, the next line will prepare the next result set
        } while (mysqli_more_results($conn) && mysqli_next_result($conn));

        echo "<h3>New records created successfully</h3>";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}

?>
