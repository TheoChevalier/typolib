
<div id="mainform">
<?php
if (! empty($result)) {
    foreach ($result as $string => $error) {
        echo $string . " -> " . $error[0];
        if (! empty($error[1][0][0][1])) {
            echo ' (' . $error[1][0][0][1] . ')';
        }
        echo "\n<br/>";
    }
}
?>
</div>
