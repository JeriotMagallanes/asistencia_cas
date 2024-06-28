<?php
class Estado{
    function estado_usuario($estado){
        return ($estado == "A") ? '<span class="badge badge-success">Activo</span>':'<span class="badge badge-warning">Inactivo</span>';
    }
}