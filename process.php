<?php

// <!-- DATABASE CONNECTION -->
$conn = mysqli_connect('localhost', 'root', '', 'ajax');
if (!$conn) {
    die("Connection error... ".mysqli_connect_error());
}

if (isset($_POST['query'])) {
    $search = mysqli_real_escape_string($conn, $_POST['query']);
    
    $output = '';

    $selectData = "SELECT * FROM tbl_customer
                    WHERE CustomerId LIKE '%".$search."%'
                    OR CustomerName LIKE '%".$search."%'
                    OR Address LIKE '%".$search."%'
                    OR City LIKE '%".$search."%'
                    OR PostalCode LIKE '%".$search."%'
                    OR Country LIKE '%".$search."%'";
    $queryData = mysqli_query($conn, $selectData);
    
    if (mysqli_num_rows($queryData) > 0) {

        $output .= "<table class='table table-bordered'>
                    <thead>
                        <tr class='text-center'>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Address</th>
                            <th>City</th>
                            <th>Postal Code</th>
                            <th>Country</th>
                        <tr>
                    </thead>
                    <tbody>";

        while ($row = mysqli_fetch_assoc($queryData)) {
            $output .= "<tr class='text-center'>
                            <td>".$row['CustomerID']."</td>
                            <td>".$row['CustomerName']."</td>
                            <td>".$row['Address']."</td>
                            <td>".$row['City']."</td>
                            <td>".$row['PostalCode']."</td>
                            <td>".$row['Country']."</td>
                        <tr>";
        }

        $output .= "</tbody>
                </table>";

    } else {
        $output .= "<table class='table table-danger'><tr><td class='text-center' colspan='6'>No data found</td></tr></table>";
    }

    echo $output;

}
