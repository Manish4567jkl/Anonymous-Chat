<?php
// This function determines whether a message should be blurred or displayed
function getBlurredMessage($content, $isLoggedIn) {
    return $isLoggedIn ? htmlspecialchars($content) : "Message hidden. Please log in to view.";
}
?>
