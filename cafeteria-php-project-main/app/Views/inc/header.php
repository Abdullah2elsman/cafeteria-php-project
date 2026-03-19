<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($data['title']) ? $data['title'] : 'Sip & Savor Cafeteria'; ?></title>
    <!-- Add Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Dynamic CSS Link Based on View -->
    <?php if(isset($data['css_file'])): ?>
    <link rel="stylesheet" href="/PHP/cafeteria/public/css/<?php echo $data['css_file']; ?>">
    <?php endif; ?>

    <!-- Global Favicon -->
    <link rel="icon" type="image/png" href="/PHP/cafeteria/public/img/favicon.png">
</head>
<body>
