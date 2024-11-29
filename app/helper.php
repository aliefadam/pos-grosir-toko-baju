<?php

session_start();

function asset($path)
{
    return "/assets/{$path}";
}

function view_asset($path)
{
    return "/view/pages/{$path}";
}

function routing_asset($name = null, $id = null)
{

    if (isset($name) && !isset($id)) {
        return "/config/routing.php?name={$name}";
    } else if (isset($name) && isset($id)) {
        return "/config/routing.php?name={$name}&id={$id}";
    }
    return "/config/routing.php";
}

function controller_asset($name)
{
    require_once "../app/controller/{$name}.php";
}

function model_asset($name, $includeFrom = "controller"): void
{
    if ($includeFrom == "view") {
        require_once "../../../app/model/{$name}.php";
    } else {
        require_once "../app/model/{$name}.php";
    }
}

function redirect($path)
{
    $view_asset = view_asset($path);
    return header("Location: {$view_asset}");
}

function setNotification($title, $text, $icon)
{
    $_SESSION["notification"] = [
        "title" => $title,
        "text" => $text,
        "icon" => $icon
    ];
}

function formatMoney($number)
{
    return "Rp. " . number_format($number, 0, ',', '.');
}

function getTitle()
{
    $url = parse_url($_SERVER['REQUEST_URI']);
    $path = explode("/", $url['path']);
    $title = $path[3];
    return ucwords($title);
}
