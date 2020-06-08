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

    $count = 10;
    foreach ($chat as $value) {

        $count += 10;
        echo '<div class="direct-chat-text" style="margin-left: ' . $count . 'px">' . $value->name . ' : ' . $value->message . '</div></br>';
        if ($count > 50)
            $count = 10;
    }
}
