<?php
include 'config.php';

// READ - Get all menu items
function getAllMenuItems() {
    global $conn;
    $sql = "SELECT * FROM menu_items ORDER BY category, item_name";
    $result = $conn->query($sql);
    return $result;
}

// READ - Get single item by ID
function getMenuItemById($id) {
    global $conn;
    $id = intval($id);
    $sql = "SELECT * FROM menu_items WHERE item_id = $id";
    $result = $conn->query($sql);
    return $result->fetch_assoc();
}

// CREATE - Add new menu item
function addMenuItem($item_name, $category, $price, $description, $availability) {
    global $conn;
    
    $item_name = $conn->real_escape_string($item_name);
    $category = $conn->real_escape_string($category);
    $description = $conn->real_escape_string($description);
    $availability = $conn->real_escape_string($availability);
    $price = floatval($price);
    
    $sql = "INSERT INTO menu_items (item_name, category, price, description, availability) 
            VALUES ('$item_name', '$category', $price, '$description', '$availability')";
    
    if ($conn->query($sql) === TRUE) {
        return ["success" => true, "message" => "Menu item added successfully!"];
    } else {
        return ["success" => false, "message" => "Error: " . $conn->error];
    }
}

// UPDATE - Edit menu item
function updateMenuItem($item_id, $item_name, $category, $price, $description, $availability) {
    global $conn;
    
    $item_id = intval($item_id);
    $item_name = $conn->real_escape_string($item_name);
    $category = $conn->real_escape_string($category);
    $description = $conn->real_escape_string($description);
    $availability = $conn->real_escape_string($availability);
    $price = floatval($price);
    
    $sql = "UPDATE menu_items 
            SET item_name='$item_name', category='$category', price=$price, 
                description='$description', availability='$availability'
            WHERE item_id=$item_id";
    
    if ($conn->query($sql) === TRUE) {
        return ["success" => true, "message" => "Menu item updated successfully!"];
    } else {
        return ["success" => false, "message" => "Error: " . $conn->error];
    }
}

// DELETE - Remove menu item
function deleteMenuItem($item_id) {
    global $conn;
    
    $item_id = intval($item_id);
    $sql = "DELETE FROM menu_items WHERE item_id=$item_id";
    
    if ($conn->query($sql) === TRUE) {
        return ["success" => true, "message" => "Menu item deleted successfully!"];
    } else {
        return ["success" => false, "message" => "Error: " . $conn->error];
    }
}

// Handle form submissions
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? '';
    
    if ($action === 'add') {
        $result = addMenuItem(
            $_POST['item_name'],
            $_POST['category'],
            $_POST['price'],
            $_POST['description'],
            $_POST['availability']
        );
    } elseif ($action === 'update') {
        $result = updateMenuItem(
            $_POST['item_id'],
            $_POST['item_name'],
            $_POST['category'],
            $_POST['price'],
            $_POST['description'],
            $_POST['availability']
        );
    } elseif ($action === 'delete') {
        $result = deleteMenuItem($_POST['item_id']);
    }
}

?>
