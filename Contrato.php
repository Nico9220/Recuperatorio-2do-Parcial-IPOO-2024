<?php
/*
 
Adquirir un plan implica un contrato. Los contratos tienen la fecha de inicio, la fecha de vencimiento, el plan, un estado (al día, moroso, suspendido), un costo, si se renueva o no y una referencia al cliente que adquirió el contrato.
*/
class Contrato{
    
    //ATRIBUTOS
    private $fechaInicio;   
    private $fechaVencimiento;
    private $objPlan;
    private $estado;  //al día, moroso, suspendido
    private $costo;
    private $seRennueva;
    private $objCliente;

 //CONSTRUCTOR
    public function __construct($fechaInicio, $fechaVencimiento, $objPlan,$costo,$seRennueva,$objCliente){
    
       $this->fechaInicio = $fechaInicio;
       $this->fechaVencimiento = $fechaVencimiento;
       $this->objPlan = $objPlan;
       $this->estado = 'AL DIA';
       $this->costo = $costo;
       $this->seRennueva = $seRennueva;
       $this->objCliente = $objCliente;
           

    }


         public function getFechaInicio(){
        return $this->fechaInicio;
    }

    public function setFechaInicio($fechaInicio){
         $this->fechaInicio= $fechaInicio;
    }

        public function getFechaVencimiento(){
        return $this->fechaVencimiento;
    }

    public function setFechaVencimiento($fechaVencimiento){
         $this->fechaVencimiento= $fechaVencimiento;
    }


            public function getObjPlan(){
        return $this->objPlan;
    }

    public function setObjPlan($objPlan){
         $this->objPlan= $objPlan;
    }

   public function getEstado(){
        return $this->estado;
    }

    public function setEstado($estado){
         $this->estado= $estado;
    }

 public function getCosto(){
        return $this->costo;
    }

    public function setCosto($costo){
         $this->costo= $costo;
    }

public function getSeRennueva(){
        return $this->seRennueva;
    }

    public function setSeRennueva($seRennueva){
         $this->seRennueva= $seRennueva;
    }


public function getObjCliente(){
        return $this->objCliente;
    }

    public function setObjCliente($objCliente){
         $this->objCliente= $objCliente;
    }

public function __toString(){
        //string $cadena
        $cadena = "Fecha inicio: ".$this->getFechaInicio()."\n";
        $cadena = "Fecha Vencimiento: ".$this->getFechaVencimiento()."\n";
        $cadena = $cadena. "Plan: ".$this->getObjPlan()."\n";
        $cadena = $cadena. "Estado: ".$this->getEstado()."\n";
        $cadena = $cadena. "Costo: ".$this->getCosto()."\n";
        $cadena = $cadena. "Se renueva: ".$this->getSeRennueva()."\n";
        $cadena = $cadena. "Cliente: ".$this->getObjCliente()."\n";

 
        return $cadena;
         }

     //Punto 1

     public function diasContratoVencido() {
          $fechaVencimiento = new DateTime($this->getFechaVencimiento());
          $fechaActual = new DateTime();
          $cantidad = 0;

          if ($fechaActual > $fechaVencimiento) {
          $diferencia = $fechaActual->diff($fechaVencimiento);
          $cantidad = $diferencia->days;
          }
     
          return $cantidad;
     }

     //Punto 2
     public function actualizarEstadoContrato(){
          $diasDeuda = $this->diasContratoVencido();
          $estadoActual = $this->getEstado();
          if ($diasDeuda > 10){
               $estadoActual = 'suspendido';
          }elseif ($diasDeuda > 0){
          $estadoActual = 'moroso';
          }else {
               $estadoActual = 'al dia';
          }
          return $estadoActual;
     }
     
     // Punto 5

     public function calcularImporte(){
          $estadoCliente = $this->getEstado();
          $importeFinal = $this->getObjPlan()->getImporte();
          $renueva = $this->getSeRennueva();
          $importe = null;
          $diasVenc = $this->diasContratoVencido();
          if ($estadoCliente == 'al dia'){
               $renueva = true;
               $importe = $importeFinal;
          }elseif ($estadoCliente == 'moroso'){
               $renueva = true;
               $importe = $importeFinal * 0.10 * $diasVenc;
               $this->setEstado('al dia');
          }else{
               $renueva = false;
               $importe = $importeFinal * 0.10 * $diasVenc;
               $this->setEstado('suspendido');
          }
          return $importe;
     }
     }    