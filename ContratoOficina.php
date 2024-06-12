<?php 

Class ContratoOficina extends Contrato{

    public function __construct($fechaInicio, $fechaVencimiento, $objPlan,$costo,$seRennueva,$objCliente){
        parent :: __construct($fechaInicio, $fechaVencimiento, $objPlan,$costo,$seRennueva,$objCliente);
    }

    public function __toString(){
        return parent :: __toString();
    }

    // Punto 5

    public function calcularImporte(){
        $importeFinal = $this->getObjPlan()->getImporte();

        $canal = $this->getObjPlan()->getColCanales();
        foreach ($canal as $unCanal){
            $importeFinal = $importeFinal + $unCanal->getImporte();
        }
        return $importeFinal;
    }
}