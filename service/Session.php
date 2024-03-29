<?php
namespace Service;

use Model\Entity\User;

abstract class Session
{
    public static function destroy()
    {
        session_destroy();
    }

    public static function addMessage($type, $message)
    {
        $_SESSION["messages"][$type][] = $message;
    }

    public static function getMessages()
    {
        $messages = $_SESSION["messages"] ?? null;

        if (isset($_SESSION["messages"])) {
            unset($_SESSION["messages"]);
        }
        return $messages;
    }

    public static function authentication(User $user)
    {
        $_SESSION["user"] = $user;
    }

    public static function getUserConnected()
    {
        return $_SESSION["user"] ?? false;
    }

    public static function &getCart()
    {
        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = array();
        }
        return $_SESSION['cart'];
    }

    public static function deleteCart()
    {
        unset($_SESSION['cart']);
    }

    public static function isConnected()
    {
        if (isset($_SESSION["user"]))
            return true;
        return false;
    }

    public static function disconnected()
    {
        self::destroy();
    }

    public static function isAdmin(): bool
    {
        $user = self::getUserConnected();
        if (!empty($user) && ($user->getRole() == ROLE_ADMIN)) {
            return true;
        }
        return false;
    }
    public static function delete(array $keys)
    {
        foreach ($keys as $key) {
            unset($_SESSION[$key]);
        }
    }
}
// Ce code PHP représente une classe Session située dans le namespace Service. Cette classe fournit des méthodes statiques pour gérer les sessions PHP dans une application web. Voici une explication ligne par ligne :-->
// namespace Service;: Cette déclaration indique que la classe Session est définie dans le namespace Service.