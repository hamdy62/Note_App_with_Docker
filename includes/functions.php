<?php
// sanitize user input
function sanitize($data){
    return htmlspecialchars(trim($data), ENT_QUOTES, 'UTF-8');
}

// validate email
function validateEmail($email){
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}

// validate password
function validatePassword($password){
    return strlen($password) >= 6;
}

?>