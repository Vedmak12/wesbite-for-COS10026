<?php
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: login.php");
    exit;
}
?> 
<?php
// Function to sanitize user inputs
function sanitizeInput($input) {
    // Remove leading and trailing white spaces
    $input = trim($input);
    // Remove HTML and PHP tags
    $input = strip_tags($input);
    // Convert special characters to HTML entities
    $input = htmlspecialchars($input);
    return $input;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {


    require_once "settings.php"; // Load MySQL login credentials

    $conn = @mysqli_connect($host, $username, $password, $dbname);

    if (!$conn) {
        echo "<p>Database connection error</p>";
        exit;
    }

    // Check if the "allEOIs" checkbox is checked
    if (isset($_POST['allEOIs'])) {
        // Construct the query to select all EOIs
        $sql_table = "EOI";
        $query = "SELECT * FROM $sql_table";

        // Execute the query
        $result = mysqli_query($conn, $query);
        if (!$result) {
            echo "<p>Something is wrong: " . mysqli_error($conn) . "</p>";
        } else {
            // Display search results in a table
            if (mysqli_num_rows($result) > 0) {
                echo "<table border=\"1\">\n";
                echo "<tr>\n";
                echo "<th scope=\"col\">EOI_reference</th>\n";
                echo "<th scope=\"col\">Job_reference</th>\n";
                echo "<th scope=\"col\">First_name</th>\n";
                echo "<th scope=\"col\">Last_name</th>\n";
                echo "<th scope=\"col\">Date_of_birth</th>\n";
                echo "<th scope=\"col\">Gender</th>\n";
                echo "<th scope=\"col\">Street_address</th>\n";
                echo "<th scope=\"col\">Suburb_town</th>\n";
                echo "<th scope=\"col\">State</th>\n";
                echo "<th scope=\"col\">Postcode</th>\n";
                echo "<th scope=\"col\">Email_address</th>\n";
                echo "<th scope=\"col\">Phone_number</th>\n";
                echo "<th scope=\"col\">Other_skills</th>\n";
                echo "<th scope=\"col\">status</th>\n";
                echo "</tr>\n";
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>\n";
                    echo "<td>", htmlspecialchars($row["EOI_reference"]), "</td>\n";
                    echo "<td>", htmlspecialchars($row["Job_reference"]), "</td>\n";
                    echo "<td>", htmlspecialchars($row["First_name"]), "</td>\n";
                    echo "<td>", htmlspecialchars($row["Last_name"]), "</td>\n";
                    echo "<td>", htmlspecialchars($row["Date_of_birth"]), "</td>\n";
                    echo "<td>", htmlspecialchars($row["Gender"]), "</td>\n";
                    echo "<td>", htmlspecialchars($row["Street_address"]), "</td>\n";
                    echo "<td>", htmlspecialchars($row["Suburb_town"]), "</td>\n";
                    echo "<td>", htmlspecialchars($row["State"]), "</td>\n";
                    echo "<td>", htmlspecialchars($row["Postcode"]), "</td>\n";
                    echo "<td>", htmlspecialchars($row["Email_address"]), "</td>\n";
                    echo "<td>", htmlspecialchars($row["Phone_number"]), "</td>\n";
                    echo "<td>", htmlspecialchars($row["Other_skills"]), "</td>\n";
                    echo "<td>", htmlspecialchars($row["status"]), "</td>\n";
                    echo "</tr>\n";
                }
                echo "</table>\n";
                mysqli_free_result($result);
            } else {
                echo "<p>No records found</p>";
            }
        }
    }

    // Check if the "allEOIsp" checkbox and "position" are selected
    if (isset($_POST['allEOIsp']) && isset($_POST['position'])) {
        $position = sanitizeInput($_POST['position']);
        // Construct the query to select specific EOIs based on position
        $sql_table = "EOI";
        echo "<h1> Here</h1>" . $_POST['position'];
        echo "<p>Position $position </p>";
        $query = "SELECT * FROM $sql_table WHERE Job_reference = '$position'";

        // Debugging output to check the constructed query
        echo "The query is: $query<br>";

        // Execute the query
        $result = mysqli_query($conn, $query);
        if (!$result) {
            echo "<p>Something is wrong: " . mysqli_error($conn) . "</p>";
        } else {
            // Display search results in a table
            if (mysqli_num_rows($result) > 0) {
                echo "<table border=\"1\">\n";
                echo "<tr>\n";
                echo "<th scope=\"col\">EOI_reference</th>\n";
                echo "<th scope=\"col\">Job_reference</th>\n";
                echo "<th scope=\"col\">First_name</th>\n";
                echo "<th scope=\"col\">Last_name</th>\n";
                echo "<th scope=\"col\">Date_of_birth</th>\n";
                echo "<th scope=\"col\">Gender</th>\n";
                echo "<th scope=\"col\">Street_address</th>\n";
                echo "<th scope=\"col\">Suburb_town</th>\n";
                echo "<th scope=\"col\">State</th>\n";
                echo "<th scope=\"col\">Postcode</th>\n";
                echo "<th scope=\"col\">Email_address</th>\n";
                echo "<th scope=\"col\">Phone_number</th>\n";
                echo "<th scope=\"col\">Other_skills</th>\n";
                echo "<th scope=\"col\">status</th>\n";
                echo "</tr>\n";
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>\n";
                    echo "<td>", htmlspecialchars($row["EOI_reference"]), "</td>\n";
                    echo "<td>", htmlspecialchars($row["Job_reference"]), "</td>\n";
                    echo "<td>", htmlspecialchars($row["First_name"]), "</td>\n";
                    echo "<td>", htmlspecialchars($row["Last_name"]), "</td>\n";
                    echo "<td>", htmlspecialchars($row["Date_of_birth"]), "</td>\n";
                    echo "<td>", htmlspecialchars($row["Gender"]), "</td>\n";
                    echo "<td>", htmlspecialchars($row["Street_address"]), "</td>\n";
                    echo "<td>", htmlspecialchars($row["Suburb_town"]), "</td>\n";
                    echo "<td>", htmlspecialchars($row["State"]), "</td>\n";
                    echo "<td>", htmlspecialchars($row["Postcode"]), "</td>\n";
                    echo "<td>", htmlspecialchars($row["Email_address"]), "</td>\n";
                    echo "<td>", htmlspecialchars($row["Phone_number"]), "</td>\n";
                    echo "<td>", htmlspecialchars($row["Other_skills"]), "</td>\n";
                    echo "<td>", htmlspecialchars($row["status"]), "</td>\n";
                    echo "</tr>\n";
                }
                echo "</table>\n";
                mysqli_free_result($result);
            } else {
                echo "<p>No records found</p>";
            }
        }
    }



    // Close the database connection
    // mysqli_close($conn);
    // Check if the "listallEOIsname" checkbox and "position" are selected
    if (isset($_POST['listallEOIsname']) ) {
        $firstName = sanitizeInput($_POST['first_Name']);
        $lastName = sanitizeInput($_POST['last_Name']);
        $sql_table = "EOI";
        echo "<p> $firstName</p>";
        $query = $sql = "SELECT * FROM $sql_table WHERE first_name = '$firstName ' OR last_name = '$lastName'";

        // Debugging output to check the constructed query
        echo "The query is: $query<br>";

        // Execute the query
        $result = mysqli_query($conn, $query);
        if (!$result) {
            echo "<p>Something is wrong: " . mysqli_error($conn) . "</p>";
        } else {
            // Display search results in a table
            if (mysqli_num_rows($result) > 0) {
                echo "<table border=\"1\">\n";
                echo "<tr>\n";
                echo "<th scope=\"col\">EOI_reference</th>\n";
                echo "<th scope=\"col\">Job_reference</th>\n";
                echo "<th scope=\"col\">First_name</th>\n";
                echo "<th scope=\"col\">Last_name</th>\n";
                echo "<th scope=\"col\">Date_of_birth</th>\n";
                echo "<th scope=\"col\">Gender</th>\n";
                echo "<th scope=\"col\">Street_address</th>\n";
                echo "<th scope=\"col\">Suburb_town</th>\n";
                echo "<th scope=\"col\">State</th>\n";
                echo "<th scope=\"col\">Postcode</th>\n";
                echo "<th scope=\"col\">Email_address</th>\n";
                echo "<th scope=\"col\">Phone_number</th>\n";
                echo "<th scope=\"col\">Other_skills</th>\n";
                echo "<th scope=\"col\">status</th>\n";
                echo "</tr>\n";
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>\n";
                    echo "<td>", htmlspecialchars($row["EOI_reference"]), "</td>\n";
                    echo "<td>", htmlspecialchars($row["Job_reference"]), "</td>\n";
                    echo "<td>", htmlspecialchars($row["First_name"]), "</td>\n";
                    echo "<td>", htmlspecialchars($row["Last_name"]), "</td>\n";
                    echo "<td>", htmlspecialchars($row["Date_of_birth"]), "</td>\n";
                    echo "<td>", htmlspecialchars($row["Gender"]), "</td>\n";
                    echo "<td>", htmlspecialchars($row["Street_address"]), "</td>\n";
                    echo "<td>", htmlspecialchars($row["Suburb_town"]), "</td>\n";
                    echo "<td>", htmlspecialchars($row["State"]), "</td>\n";
                    echo "<td>", htmlspecialchars($row["Postcode"]), "</td>\n";
                    echo "<td>", htmlspecialchars($row["Email_address"]), "</td>\n";
                    echo "<td>", htmlspecialchars($row["Phone_number"]), "</td>\n";
                    echo "<td>", htmlspecialchars($row["Other_skills"]), "</td>\n";
                    echo "<td>", htmlspecialchars($row["status"]), "</td>\n";
                    echo "</tr>\n";
                }
                echo "</table>\n";
                mysqli_free_result($result);
            } else {
                echo "<p>No records found</p>";
            }
        }
    }
    if (isset($_POST['changeEOIstatus']) && isset($_POST['status'])) {
        // $firstName1 = sanitizeInput($_POST['first_Name1']);
        // $lastName1 = sanitizeInput($_POST['last_Name1']);
        $status = sanitizeInput($_POST['status']);
        $JobNumber = sanitizeInput($_POST['Job_Number']);
        $sql_table = "EOI";
        
        echo "<p>$status</p>";
        $query = "UPDATE $sql_table SET status = '$status' WHERE EOI_reference = '$JobNumber'";
    
        // Debugging output to check the constructed query
        echo "The query is: $query<br>";
    
        // Execute the query
        $result = mysqli_query($conn, $query);
        if (!$result) {
            echo "<p>Something is wrong: " . mysqli_error($conn) . "</p>";
        } else {
            if (mysqli_affected_rows($conn) > 0) {
                echo "<p>Record updated successfully</p>";
                // Fetch and display the updated records (if necessary)
                // $select_query = "SELECT * FROM $sql_table WHERE EOI_reference = '$Job_Number'";
                $result = mysqli_query($conn, $query);
                echo "<p>Result for the query: $result </p>";
                // if {(echo"records updated";)} 
                // else {
                //     echo "<p>No records found</p>";
                // }
            } else {
                echo "<p>No records updated</p>";
            }
        }
    }
    
        // Check if the "delallEOIsp" checkbox and "position" are selected
        if (isset($_POST['delallEOIsp']) && isset($_POST['position'])) {
            $position = sanitizeInput($_POST['position']);
            // Construct the query to delete specific EOIs based on position
            $sql_table = "EOI";
            $query = "DELETE FROM $sql_table WHERE Job_reference = '$position'";
    
            // Debugging output to check the constructed query
            echo "Query: $query<br>";
    
            // Execute the query
            $result = mysqli_query($conn, $query);
            if (!$result) {
                echo "<p>Something is wrong: " . mysqli_error($conn) . "</p>";
            } else {
                echo "<p>Records deleted successfully for Job_reference: $position</p>";
            }
        }
}
?>
