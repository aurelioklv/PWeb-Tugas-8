<!DOCTYPE html>
<html>

<head>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
  <title>Silaturahmi Online</title>
</head>

<body>
  <h1 class="text-center">Show All Data</h1>

  <?php

    include("config.php");

    // SQL query to retrieve all table names in the database
    $tables_query = "SHOW TABLES";

    // Execute the query
    $tables_result = $db->query($tables_query);

    // Check if there are any results
    if ($tables_result->num_rows > 0) {
      // Output data of each table
      while($table_row = $tables_result->fetch_assoc()) {
        // Get the name of the current table
        $table_name = $table_row['Tables_in_' . $database];
        
        // SQL query to retrieve all data from the current table
        $data_query = "SELECT * FROM " . $table_name;
        
        // Execute the query
        $data_result = $db->query($data_query);
        
        // Check if there are any results
        if ($data_result->num_rows > 0) {
          // Output data of each row in the current table
          echo "<p class='text-center bg-success'>Table: " . $table_name . "</p>";
          echo "<table class='table table-info table-bordered border-primary'>";
          echo "<thead><tr>";
          // Get the column names of the current table
          $columns_query = "SHOW COLUMNS FROM " . $table_name;
          $columns_result = $db->query($columns_query);
          if ($columns_result->num_rows > 0) {
            while($column_row = $columns_result->fetch_assoc()) {
              echo "<th scope='col'>" . $column_row["Field"] . "</th>";
            }
          }
          echo "</tr></thead>";
          echo "<tbody>";
          while($data_row = $data_result->fetch_assoc()) {
            echo "<tr>";
            foreach ($data_row as $key => $value) {
              // Check if the field has a data type of BLOB or MEDIUMBLOB
              $field_query = "SHOW FIELDS FROM " . $table_name . " WHERE Field = '" . $key . "' AND (Type = 'BLOB' OR Type = 'MEDIUMBLOB')";
              $field_result = $db->query($field_query);
              if ($field_result->num_rows == 0) {
                echo "<td>" . $value . "</td>";
              }
            }
            echo "</tr>";
          }
          echo "</tbody>";
          echo "</table><br>";
        } else {
          echo "Table: " . $table_name . " - 0 results<br>";
        }
      }
    } else {
      echo "0 tables";
    }

    $db->close();

  ?>
</body>

</html>
