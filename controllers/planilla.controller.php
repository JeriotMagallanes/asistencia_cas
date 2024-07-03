<?php
class PlanillaController{
    private $planillamodel;
    public function __construct(){
        $this->planillamodel = new PlanillaModel();
    }
    public function listar_planilla(){
        return $this->planillamodel->get_planilla();
    }
    public function listar_planilla_fecha($mes, $anio){
        return $this->planillamodel->get_planilla_fecha($mes, $anio);
    }

}