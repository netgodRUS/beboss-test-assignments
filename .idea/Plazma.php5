<?php

// Establish database connection
$mysqli = new mysqli("localhost", "username", "password", "database");

// Check for connection errors
if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: " . $mysqli->connect_error;
    exit();
}

// Output the list of product groups
echo "<ul>";
$result = $mysqli->query("SELECT id, name FROM groups WHERE id_parent = 0");
while ($row = $result->fetch_assoc()) {
    echo "<li><a href=\"?group={$row['id']}\">{$row['name']}</a> (" . countProductsInGroup($mysqli, $row['id']) . ")";
    outputSubgroups($mysqli, $row['id']);
    echo "</li>";
}
echo "</ul>";

// Output the products in the selected group
if (isset($_GET['group'])) {
    echo "<h2>Products</h2>";
    outputProductsInGroup($mysqli, $_GET['group']);
}

// Recursive function to output all subgroups for a given group
function outputSubgroups($mysqli, $groupId)
{
    $result = $mysqli->query("SELECT id, name FROM groups WHERE id_parent = $groupId");
    if ($result->num_rows > 0) {
        echo "<ul>";
        while ($row = $result->fetch_assoc()) {
            echo "<li><a href=\"?group={$row['id']}\">{$row['name']}</a> (" . countProductsInGroup($mysqli, $row['id']) . ")";
            outputSubgroups($mysqli, $row['id']);
            echo "</li>";
        }
        echo "</ul>";
    }
}

// Function to count the number of products in a group (including subgroups)
function countProductsInGroup($mysqli, $groupId)
{
    $result = $mysqli->query("SELECT COUNT(*) AS count FROM products WHERE id_group = $groupId OR id_group IN (SELECT id FROM groups WHERE id_parent = $groupId)");
    $row = $result->fetch_assoc();
    return $row['count'];
}

// Function to output the products in a group (including subgroups)
function outputProductsInGroup($mysqli, $groupId)
{
    $result = $mysqli->query("SELECT name FROM products WHERE id_group = $groupId OR id_group IN (SELECT id FROM groups WHERE id_parent = $groupId)");
    if ($result->num_rows > 0) {
        echo "<ul>";
        while ($row = $result->fetch_assoc()) {
            echo "<li>{$row['name']}</li>";
        }
        echo "</ul>";
    }
}

// Close database connection
$mysqli->close();


