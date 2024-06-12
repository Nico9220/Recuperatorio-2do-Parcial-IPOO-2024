<?php

Class ContratoWeb extends Contrato{
    private $porcentajeDescuento;

    public function __construct($fechaInicio, $fechaVencimiento, $objPlan,$costo,$seRennueva,$objCliente,$porcentajeDescuento = 0.10){
        parent :: __construct($fechaInicio, $fechaVencimiento, $objPlan,$costo,$seRennueva,$objCliente);
        $this->porcentajeDescuento = $porcentajeDescuento;
    }

    //Metodo GET
    public function getPorcentajeDescuento(){
        return $this->porcentajeDescuento;
    }
    //Metodo SET
    public function setPorcentajeDescuento($porcentajeDescuento){
        $this->porcentajeDescuento = $porcentajeDescuento;
    }

    public function __toString(){
        $cadena = parent :: __toString();
        $cadena .= "Porcentaje de Descuento: " . $this->getPorcentajeDescuento() . "\n";
    }

    //Punto 5 

    public function calcularImporte(){
        $importeFinal = parent :: calcularImporte();
        
        $descuento = $importeFinal * $this->getPorcentajeDescuento();
        $importeFinal = $importeFinal - $descuento;

        return $importeFinal;
    }
}