<?php

class EmpresaCable{


    private $colPlanes;
    private $colContratos; 

    public function __construct($colPlanes, $colContratos){

        $this->colPlanes = $colPlanes;
        $this->colContratos = $colContratos;
    }

    //Metodos GET

    public function getColPlanes(){
        return $this->colPlanes;
    }
    public function getColContratos(){
        return $this->colContratos;
    }

    //Metodos SET

    public function setColPlanes($colPlanes){
        $this->colPlanes = $colPlanes;
    }
    public function setColContratos($colContratos){
        $this->colContratos = $colContratos;
    }

    public function retornarCadenaDesdeColeccion($coleccion){
        $cadena = "";
        foreach ($coleccion as $elemento){
            $cadena = $cadena . " " . $elemento . "\n";
        }
        return $cadena;
    }

    public function __toString(){

        $cadena = "coleccion Planes: " . $this->retornarCadenaDesdeColeccion($this->getColPlanes()) . "\n";
        $cadena .= "coleccion Contratos: " . $this->retornarCadenaDesdeColeccion($this->getColContratos()) . "\n";
        return $cadena;
    }

    //Punto 6
    public function incorporarPlan($objPlan){
        $planes = $this->getColPlanes();
        $planExiste = false; 
        foreach ($planes as $plan){
            if ($plan->getCodigo() === $objPlan->getCodigo()){
                $planExiste = true;
            }
        }
        if (!$planExiste){
            $planes [] = $objPlan;
            $this->setColPlanes($planes);
        }
        return !$planExiste;
    }

    public function incorporarContrato($objPlan, $objCliente, $fechaDesde, $fechaVenc, $esViaWeb){

        if($esViaWeb){
            $importeFinal = $objPlan->calcularImporte();
            $contrato = new ContratoWeb($fechaDesde, $fechaVenc, $objPlan,$importeFinal, true, $objCliente,);
        }else{
            $importeFinal = $objPlan->calcularImporte();
            $seRennueva = true;
            $contrato = new ContratoOficina($fechaDesde, $fechaVenc, $objPlan, $importeFinal, $seRennueva, $objCliente);
        }
        $contratos = $this->getColContratos();
        $contratos [] = $contrato;
        $this->setColContratos($contratos);
    }

    public function retornarImporteContratos($codigoPlan){
        $sumaImporte = 0;

        $colContratos = $this->getColContratos();
        $totalContratos = count($colContratos);
        $i = 0;

        while($i < $totalContratos){
            $contrato = $colContratos[$i];

            if ($contrato->getObjPlan()->getCodigo() === $codigoPlan){
                $sumaImporte = $sumaImporte + $contrato->calcularImporte();
            }
            $i++;
        }
        return $sumaImporte;
    }

    public function pagarContrato($objContrato){

        $objContrato->actualizarEstadoContrato();

        if ($objContrato->getEstado() != 'suspendido'){
            $objContrato->setEstado('al dia');
        }

        $importeFinal = $objContrato->calcularImporte();

        return $importeFinal;
    }
    
}

?>