<?php

namespace App\Services\Application\Comprobante;

use App\Repositories\Comprobante\ComprobanteRepositoryInterface;
use Illuminate\Support\Collection;
use Exception;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\Request;

class comprobanteService
{
    private ComprobanteRepositoryInterface $repository;

    public function __construct(
        ComprobanteRepositoryInterface $repository
    )
    {
        $this->repository = $repository;
    }

    public function getComprobante(string $idempresa,int $idtipodocumento,string $serie,int $numero,int $idsucursal):Collection
    {
        // dd($idempresa,$idtipodocumento,$serie,$numero,$idsucursal);
        return $this->repository->getComprobante($idempresa,$idtipodocumento,$serie,$numero,$idsucursal);
    }
    public function getVentasDetalleIdComprobante(string $idempresa, int $idtipodocumento,string $serie,int $numero):Collection
    {
        // dd('dfdfdf');

        return $this->repository->getVentasDetalleIdComprobante($idempresa,$idtipodocumento,$serie,$numero);
    }
    public function getVentaPagos(string $idempresa,int $idtipodocumento,string $serie, int $numero):Collection
    {
        return $this->repository->getVentaPagos($idempresa,$idtipodocumento,$serie,$numero);
    }

    public function getNameByRuc(string $ruc,string $date,string $filename): Collection
    {
        // dd($ruc,$date,$filename);
        $company=$this->repository->getNameByRuc($ruc);
        // dd($company);
        if(!$company) {
            throw new Exception(
                "No se encontró registro de empresa con el ruc \"{$ruc}\".",
                Response::HTTP_NOT_FOUND
            );
        };

        $companyNameAndRuc = substr(strrchr($company->RutFilXmlFacEleSerLoc, "\\"), 1);
        $stringDate = str_replace('-', '', $date);
      

        $server = config('services.facturacion_electronica.server');
        $remoteFile = $server['documents']['path_xml'] . '/' . "{$companyNameAndRuc}/{$stringDate}/{$filename}";
        
        $host = $server['host'];
        $username = $server['username'];
        $password = $server['password'];
        
        error_reporting(E_ERROR | E_PARSE | E_NOTICE);
        
        $connection = ftp_connect($host);
        // dd('ssdsd',$connection);

        if (!$connection) {
            throw new Exception('Problemas de conexión con el FTP.', Response::HTTP_BAD_REQUEST);
        }

        ftp_set_option($connection, FTP_TIMEOUT_SEC, 180);

        if (!ftp_login($connection, $username, $password)) {
            throw new Exception('Problemas de conexión con el FTP.', Response::HTTP_BAD_REQUEST);
        }

        // Turn passive mode on
        ftp_pasv($connection, true);

        // Obtenemos los ficheros que se encuentran en el directorio remoto.
        $list = ftp_nlist($connection, $remoteFile);
       

        if(!$foundedFile = current($list)) {
            throw new Exception('El fichero no existe en el FTP.', Response::HTTP_NOT_FOUND);
        }

        $foundedFileName = pathinfo($foundedFile, PATHINFO_BASENAME);
        $foundedFileExtension = strtolower(pathinfo($foundedFile, PATHINFO_EXTENSION));

        if($foundedFileExtension !== 'xml'){
            throw new Exception(
                'Sólo se pueden descargar ficheros con extensión "xml".',
                Response::HTTP_BAD_REQUEST
            );
        }

        // Creamos el fichero temporal
        $file = tempnam(sys_get_temp_dir(), 'tmp');

        if(file_exists($file)){
            unlink($file);
        }

        $download = ftp_nb_get($connection, $file, $foundedFile, FTP_BINARY);

        while ($download === FTP_MOREDATA){
            $download = ftp_nb_continue($connection);
        }

        if($download !== FTP_FINISHED){
            ftp_close($connection);

            throw new Exception(
                'Ocurrió un problema durante la descarga del fichero desde el FTP.',
                Response::HTTP_BAD_REQUEST
            );
        }

        ftp_close($connection);

        header('Content-type: "text/xml"; charset="utf8"');
        header("Content-Disposition: attachment;filename={$foundedFileName}");

        $content = file_get_contents($file);

        unlink($file);
        dd($content);
        return collect($content);

        echo $content;
        exit();

    }

    public function getDatoForExcel(Request $request):Collection
    {
        return $this->repository->getDatoForExcel($request->all());
    }

}