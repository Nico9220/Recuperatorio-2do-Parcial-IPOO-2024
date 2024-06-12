<?php

require_once 'EmpresaCable.php';
require_once 'Canal.php';
require_once 'Plan.php';
require_once 'Cliente.php';
require_once 'Contrato.php';
require_once 'ContratoOficina.php';
require_once 'ContratoWeb.php';

//Punto 7 

// a)

$objEmpresa = new EmpresaCable ([], []);

// b)

$objCanal1 = new Canal ("Noticias", 1000, false, false);
$objCanal2 = new Canal ("Musical", 900, true, false);
$objCanal3 = new Canal ("Deportivo", 1200, false, true);

// c) 

$objPlan1 = new Plan ("111", [$objCanal1, $objCanal2], 1900, 200);
$objPlan2 = new Plan ("222", [$objCanal2, $objCanal3], 2100, 200);

// d) 

$objCliente = new Cliente ("Lucas Perez", '20-26598486-0', "Las Lajas 333" );


// e) 

$objContratoOficina = new ContratoOficina (date("Y-m-d"), date("Y-m-d", strtotime("+30 days")), $plan1, 0, false, $cliente);
$objContratoWeb1 = new ContratoWeb(date("Y-m-d"), date("Y-m-d", strtotime("+30 days")), $plan1, 0, false, $cliente, 0.10);
$objContratoWeb2 = new ContratoWeb(date("Y-m-d"), date("Y-m-d", strtotime("+30 days")), $plan2, 0, false, $cliente, 0.10);

// f) 

$invocoOficina = $objContratoOficina->calcularImporte();
echo "Importe contrato Oficina: " . $invocoOficina;

$invocoWeb1 = $contratoWeb1->calcularImporte();
echo "importe contrato Web 1: " . $invocoWeb1;

$invocoWeb2 = $contratoWeb2->calcularImporte();
echo "importe contrato Web 2: " . $invocoWeb2;

// g) 

$invocoPlan1 = $empresaCable->incorporarPlan($objPlan1);
echo $invocoPlan1;

// h ) 

$invocoPlan2 = $empresaCable->incorporarPlan($objPlan2);

// i) 

$invocoContrato = $empresaCable->incorporarContrato($plan1, $cliente, date("Y-m-d"), date("Y-m-d", strtotime("+30 days")), false);
echo $invocoContrato;

// j)

$empresaCable->incorporarContrato($plan2, $cliente, date("Y-m-d"), date("Y-m-d", strtotime("+30 days")), true);

// k)

$pagarContrato = $empresaCable->pagarContrato($objContratoOficina);
echo "importe a abonar en la oficina : " . $pagarContrato;
// l) 
$pagarContratoWeb = $empresaCable->pagarContrato($objContratoWeb1);
echo "importe a abonar por Web: " . $pagarContratoWeb;

// m)

$importeContrato = $empresaCable->retornarImporteContratos("111");
