<?php
class FileValidate
{
    public static function fileAttached($file){
        if (isset($file)) {
            if ($file["tmp_name"] !== "") {
                return 1;//el usuario adjuntó un archivo
            }
        }
        return 0;//el usuario no adjuntó un archivo
    }
    public static function fileIsImage($file){
        $extension_valida = ["image/png", "image/PNG", "image/jpg", "image/JPG", "image/JPEG", "image/jpeg"];
        if (in_array($file["type"],$extension_valida)) {
            return 1;// si es un archivo valido
        }
        return 0;//no es un archivo valido
    }
    public static function fileIsPdf($file){
        $extension_valida = ["application/pdf","application/PDF"];
        if (in_array($file["type"],$extension_valida)) {
            return 1;// si es un archivo valido
        }
        return 0;// no es un archivo valido
    }
}
