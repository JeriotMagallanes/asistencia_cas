<?php
class Roles {
    public function rol_name($rol){
        switch ($rol) {
            case 'A':
                return "Admin";
                break;
        }
        return "";
    }
}