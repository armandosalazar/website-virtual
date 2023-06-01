<?php
ob_start();
require_once('tcpdf/tcpdf.php'); //Llamando a la Libreria TCPDF
// require_once('config.php'); //Llamando a la conexión para BD
date_default_timezone_set('America/Mexico_City');


ob_end_clean(); //limpiar la memoria


class MYPDF extends TCPDF
{

    public function Header()
    {
        $bMargin = $this->getBreakMargin();
        $auto_page_break = $this->AutoPageBreak;
        $this->SetAutoPageBreak(false, 0);
        $img_file = dirname(__FILE__) . '/assets/img/logo.png';
        $this->Image($img_file, 85, 8, 20, 25, '', '', '', false, 30, '', false, false, 0);
        $this->SetAutoPageBreak($auto_page_break, $bMargin);
        $this->setPageMark();
    }
}


//Iniciando un nuevo pdf
$pdf = new MYPDF(PDF_PAGE_ORIENTATION, 'mm', 'Letter', true, 'UTF-8', false);

//Establecer margenes del PDF
$pdf->SetMargins(20, 35, 25);
$pdf->SetHeaderMargin(20);
$pdf->setPrintFooter(false);
$pdf->setPrintHeader(true); //Eliminar la linea superior del PDF por defecto
$pdf->SetAutoPageBreak(true, PDF_MARGIN_BOTTOM); //Activa o desactiva el modo de salto de página automático

include_once 'Session.php';
//Informacion del PDF
$pdf->SetCreator(Session::getUser()['name']);
$pdf->SetAuthor(Session::getUser()['last_name']);
$pdf->SetTitle('Reporte');

/** Eje de Coordenadas
 *          Y
 *          -
 *          - 
 *          -
 *  X ------------- X
 *          -
 *          -
 *          -
 *          Y
 * 
 * $pdf->SetXY(X, Y);
 */

//Agregando la primera página
$pdf->AddPage();
$pdf->SetFont('freemono', '', 10, ''); //Tipo de fuente y tamaño de letra
$pdf->SetXY(145, 20);
$pdf->Write(0, 'Código: 0014ABC');
$pdf->SetXY(145, 25);
$pdf->Write(0, 'Fecha: ' . date('d-m-Y'));
$pdf->SetXY(145, 30);
$pdf->Write(0, 'Hora: ' . date('h:i A'));

$canal = Session::getUser()['email'];
// $pdf->SetFont('helvetica', 'B', 10); //Tipo de fuente y tamaño de letra
$pdf->SetXY(15, 20); //Margen en X y en Y
// $pdf->SetTextColor(204, 0, 0);
$pdf->Write(0, 'Usuario: ' . Session::getUser()['name'] . ' ' . Session::getUser()['last_name']);
$pdf->SetTextColor(0, 0, 0); //Color Negrita
$pdf->SetXY(15, 25);
$pdf->Write(0, 'Email: ' . $canal);



$pdf->Ln(35); //Salto de Linea
$pdf->Cell(40, 26, '', 0, 0, 'C');
/*$pdf->SetDrawColor(50, 0, 0, 0);
$pdf->SetFillColor(100, 0, 0, 0); */
$pdf->SetTextColor(34, 68, 136);
//$pdf->SetTextColor(255,204,0); //Amarillo
//$pdf->SetTextColor(34,68,136); //Azul
//$pdf->SetTextColor(153,204,0); //Verde
//$pdf->SetTextColor(204,0,0); //Marron
//$pdf->SetTextColor(245,245,205); //Gris claro
//$pdf->SetTextColor(100, 0, 0); //Color Carne
// $pdf->SetFont('helvetica', 'B', 15);
if ($_GET['type'] === 'products') {
    $pdf->Cell(100, 6, 'LISTA DE PRODUCTOS', 0, 0, 'C');
} else if ($_GET['type'] === 'shopping') {
    $pdf->Cell(100, 6, 'LISTA DE COMPRAS', 0, 0, 'C');
} else {
    $pdf->Cell(100, 6, 'LISTA DE PRODUCTOS', 0, 0, 'C');
}


$pdf->Ln(10); //Salto de Linea
$pdf->SetTextColor(0, 0, 0);

//Almando la cabecera de la Tabla
$pdf->SetFillColor(232, 232, 232);
$pdf->SetFont('freemono', 'B', 10); //La B es para letras en Negritas
$pdf->Cell(40, 6, 'Nombre', 1, 0, 'C', 1);
$pdf->Cell(60, 6, 'Descripción', 1, 0, 'C', 1);
$pdf->Cell(35, 6, 'Precio', 1, 0, 'C', 1);
$pdf->Cell(35, 6, 'Stock', 1, 1, 'C', 1);
/*El 1 despues de  Fecha Ingreso indica que hasta alli 
llega la linea */

$pdf->SetFont('freemono', '', 10);


// //SQL para consultas Empleados
// $fechaInit = date("Y-m-d", strtotime($_POST['fecha_ingreso']));
// $fechaFin  = date("Y-m-d", strtotime($_POST['fechaFin']));

// $sqlTrabajadores = ("SELECT * FROM trabajadores WHERE (fecha_ingreso>='$fechaInit' and fecha_ingreso<='$fechaFin') ORDER BY fecha_ingreso ASC");
// //$sqlTrabajadores = ("SELECT * FROM trabajadores");
// $query = mysqli_query($con, $sqlTrabajadores);

// while ($dataRow = mysqli_fetch_array($query)) {
//         $pdf->Cell(40,6,($dataRow['nombre']),1,0,'C');
//         $pdf->Cell(60,6,$dataRow['email'],1,0,'C');
//         $pdf->Cell(35,6,('$ '. $dataRow['sueldo']),1,0,'C');
//         $pdf->Cell(35,6,(date('m-d-Y', strtotime($dataRow['fecha_ingreso']))),1,1,'C');
//     }

include_once 'Products.php';
include_once 'Session.php';
include_once 'Shopping.php';

if ($_GET['type'] === 'shopping') {
    $shoppings = Shopping::getShopping(Session::getUser()['id']);
    foreach ($shoppings as $shopping) {
        $pdf->Cell(40, 6, ($shopping['name']), 1, 0, 'C');
        $pdf->Cell(60, 6, $shopping['description'], 1, 0, 'C');
        $pdf->Cell(35, 6, ('$' . $shopping['price']), 1, 0, 'C');
        $pdf->Cell(35, 6, ($shopping['stock']), 1, 1, 'C');
    }
} else {
    $products = Products::getByIdUser(Session::getUser()['id']);

    foreach ($products as $product) {
        $pdf->Cell(40, 6, ($product['name']), 1, 0, 'C');
        $pdf->Cell(60, 6, $product['description'], 1, 0, 'C');
        $pdf->Cell(35, 6, ('$' . $product['price']), 1, 0, 'C');
        $pdf->Cell(35, 6, ($product['stock']), 1, 1, 'C');
    }
}

// Guardar el PDF en el servidor remoto por WebDAV
// $archivo_pdf = 'nombre_archivo.pdf';
$archivo_pdf = 'report_' . date('d-m-y_H:i:s') . '.pdf';
$webdav_url = 'http://webdav.armandosalazar.com/webdav/' . $archivo_pdf;
$webdav_usuario = 'armando';
$webdav_clave = 'hellofriend';

// Crear una instancia de cURL
$curl = curl_init($webdav_url);

// Configurar la solicitud
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'PUT');
curl_setopt($curl, CURLOPT_USERPWD, "$webdav_usuario:$webdav_clave");
curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/pdf'));
curl_setopt($curl, CURLOPT_POSTFIELDS, $pdf->Output($archivo_pdf, 'S'));

// Ejecutar la solicitud
$resultado = curl_exec($curl);

// Comprobar si se realizó la solicitud correctamente
if ($resultado === false) {
    echo 'Hubo un error al enviar el archivo PDF por WebDAV: ' . curl_error($curl);
} else {
    echo 'El archivo PDF se ha enviado correctamente por WebDAV.';
    include_once 'Reports.php';

    if (Reports::generate(Session::getUser()['id'], $webdav_url)) {
        header('Location: /reports.php');
    } else {
        echo 'Error al generar el reporte';
    }

}

// Cerrar la conexión cURL
curl_close($curl);

//$pdf->AddPage(); //Agregar nueva Pagina

// $pdf->Output('Resumen_Pedido_' . date('d-m-y') . '.pdf', 'I'); 
// Output funcion que recibe 2 parameros, el nombre del archivo, ver archivo o descargar,
// La D es para Forzar una descarga