<?php
// Load the JSON file and decode it into an associative array
$config = file_get_contents('config.json');
$config_arr = json_decode($config, true);

// Check if the form has been submitted for adding a record
if(isset($_POST['submit'])) {
    // Get the input values from the form
    $provider = $_POST['provider'];
    $domain = $_POST['domain'];
    $host = $_POST['host'];
    $ip_method = $_POST['ip_method'];
    $delay = $_POST['delay'];
    $password = $_POST['password'];

    // Create a new record array
    $new_record = array(
        'provider' => $provider,
        'domain' => $domain,
        'host' => $host,
        'ip_method' => $ip_method,
        'delay' => $delay,
        'password' => $password
    );

    // Add the new record to the existing records
    $config_arr['settings'][] = $new_record;

    // Encode the array back into JSON and save the file
    $new_config = json_encode($config_arr, JSON_PRETTY_PRINT);
    file_put_contents('config.json', $new_config);

    // Display a success message
    echo '<p>Record added successfully.</p>';
}

// Check if the form has been submitted for deleting a record
if(isset($_POST['delete'])) {
    // Get the selected host value from the dropdown
    $host_to_delete = $_POST['host_to_delete'];

    // Loop through the existing records to find the record with the selected host value
    foreach($config_arr['settings'] as $key => $record) {
        if($record['host'] == $host_to_delete) {
            // Remove the record from the array
            unset($config_arr['settings'][$key]);
            // Re-index the array
            $config_arr['settings'] = array_values($config_arr['settings']);
            // Encode the array back into JSON and save the file
            $new_config = json_encode($config_arr, JSON_PRETTY_PRINT);
            file_put_contents('config.json', $new_config);
            // Display a success message
            echo '<p>Record deleted successfully.</p>';
            // Break out of the loop since we've found the record to delete
            break;
        }
    }
}

// Display the existing records in a table
echo '<table border="1">';
echo '<tr><th>Provider</th><th>Domain</th><th>Host</th><th>IP Method</th><th>Delay</th><th>Password</th></tr>';
foreach($config_arr['settings'] as $record) {
    echo '<tr><td>'.$record['provider'].'</td><td>'.$record['domain'].'</td><td>'.$record['host'].'</td><td>'.$record['ip_method'].'</td><td>'.$record['delay'].'</td><td>'.$record['password'].'</td></tr>';
}
echo '</table>';

// Display the form for adding a record
echo '<form method="post">';
echo '<h2>Add Record</h2>';
echo '<label>Provider:</label> <input type="text" name="provider" required><br>';
echo '<label>Domain:</label> <input type="text" name="domain" required><br>';
echo '<label>Host:</label> <input type="text" name="host" required><br>';
echo '<label>IP Method:</label> <input type="text" name="ip_method" required><br>';
echo '<label>Delay:</label> <input type="number" name="delay" required><br>';
echo '<label>Password:</label> <input type="password" name="password" required><br>';
echo '<input type="submit" name="submit" value="Add Record">';
echo '</form>';

// Display the form for deleting a record
echo '<form method="post">';
echo '<h2>Delete Record</h2>';
echo '<label>Host to delete:</label> <select name="host_to_delete">';
foreach($config_arr['settings'] as $record) {
    echo '<option value="'.$record['host'].'">'.$record['host'].'</option>';
}
echo '</select><br>';
echo '<input type="submit" name="delete" value="Delete Record">';
echo '</form>';
?>

