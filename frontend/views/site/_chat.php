<?php
/**
 * Created by PhpStorm.
 * User: webndesign
 * Date: 06.05.20
 * Time: 17:27
 */
?>

<?php

if (isset($chat)) {

    foreach ($chat as $value) {

        echo '<div>' . $value . '</div>';
    }
}
