<?php
class LocalUndc
{
    public static function nombre_local($local){
        if ($local =="" || $local > 7) {return "";}
        $locales = [
            "Casa de la Cultura",
            "Sede C.N.I.",
            "Casuarinas",
            "Lunahuaná",
            "San Agustin",
            "Hualcara",
            "San Luis"
        ];
        return $locales[$local-1];
    }
}