<?php
// var_dump($_SERVER[script_name]);
// DIE;
switch ($_SERVER['SCRIPT_NAME']) {
    default:
        $CURRENT_PAGE = 'Backend.index';
        $page_title = 'myshop - Admin';
        break;
}