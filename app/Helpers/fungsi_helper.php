<?php

function indo_date($date)
{
    $month = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Ags', 'Sep', 'Okt', 'Nov', 'Des'];
    $d = substr($date, 8, 2);
    $m = intval(substr($date, 5, 2));
    $y = substr($date, 0, 4);

    return $d . ' - ' . $month[$m - 1] . ' - ' . $y;
}

function check_login()
{
    $user_id = session('username');

    if ($user_id) {
        return true;
    }

    return false;
}

function generate_menu()
{
    $db = \config\Database::connect();

    $menu = "SELECT DISTINCT mst_menu.id, mst_menu.menu FROM `mst_menu` LEFT JOIN `mst_submenu` ON `mst_submenu`.`menu_id` = `mst_menu`.`id` WHERE `mst_submenu`.`mainMenu` = 1 ORDER BY `mst_menu`.`id` ASC";

    return $db->query($menu)->getResultObject();
}

function generate_submenu($menuID)
{
    $db = \config\Database::connect();

    $subMenu = "SELECT `mst_submenu`.* FROM `mst_submenu` WHERE `mst_submenu`.`menu_id` = $menuID and `mst_submenu`.`active` = 1 and `mst_submenu`.`mainMenu` = 1";

    return $db->query($subMenu)->getResultObject();
}

function generate_drop_menu($userId)
{
    $db = \config\Database::connect();

    $subMenu = "SELECT `mst_sub_menu`.* FROM `mst_sub_menu` WHERE `mst_sub_menu`.`active` = 1 and `mst_sub_menu`.`mainMenu` = 0";

    return $db->query($subMenu)->getResultObject();
}
