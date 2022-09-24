<?php

namespace App\Services\Application\Comprobante;

use App\Repositories\Comprobante\ComprobanteRepositoryInterface;
use Illuminate\Support\Collection;
use Exception;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\Request;
use App\Exceptions\Owner\BadRequestException;

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

 /**
     * Descarga de facturas con POST.
     *
     * @param array $params
     * @return array
     * @throws BadRequestException
     */
    public function getNameByRuc(array $params): array
    {
        // dd($ruc,$date,$filename);
        
        $ruc = $params['ruc'];
        $date = $params['date'];
        $filename = $params['filename'];

        // throw new BadRequestException('El fichero no se encuentra disponible o no existe.');

        $company=$this->repository->getNameByRuc($params['ruc']);
        // dd($company);
        if(!$company) {
            throw new Exception(
                "No se encontró registro de empresa con el ruc \"{$ruc}\".",
                Response::HTTP_NOT_FOUND
            );
        };
        // dd( $company);

        $companyNameAndRuc = substr(strrchr($company->RutFilXmlFacEleSerLoc, "\\"), 1);
        $stringDate = str_replace('-', '', $date);
        // dd($companyNameAndRuc);
        
        $server=config('services.facturacion_electronica.server');
        // dd($server);
        $remoteFile = $server['documents']['path_xml'] . '/' . "{$companyNameAndRuc}/{$stringDate}/{$filename}";
        // dd($remoteFile);
        $host = $server['host'];
        $username = $server['username'];
        $password = $server['password'];
        error_reporting(E_ERROR | E_PARSE | E_NOTICE);
        
        $connection = ftp_connect($host);
        // dd('ssdsd',$connection);

        if (!$connection) {
            throw new BadRequestException('Problemas de conexión.');
        }

        ftp_set_option($connection, FTP_TIMEOUT_SEC, 180);

        if (!ftp_login($connection, $username, $password)) {
            throw new BadRequestException('Problemas de conexión.');
        }

        // Turn passive mode on
        ftp_pasv($connection, true);

        // Obtenemos los ficheros que se encuentran en el directorio remoto.
        $list = ftp_nlist($connection, $remoteFile);
       

        if(!$foundedFile = current($list)) {
            throw new BadRequestException('El fichero no existe en el FTP.');
        }

        $foundedFileName = pathinfo($foundedFile, PATHINFO_BASENAME);
        $foundedFileExtension = strtolower(pathinfo($foundedFile, PATHINFO_EXTENSION));

        if($foundedFileExtension !== 'xml'){
            throw new BadRequestException('Sólo se pueden descargar ficheros con extensión "xml".');
        }

        // Creamos el fichero temporal
        $file = tempnam(sys_get_temp_dir(), 'tmp');
        // dd($file);
        if(file_exists($file)){
            unlink($file);
        }

        $download = ftp_nb_get($connection, $file, $foundedFile, FTP_BINARY);

        while ($download === FTP_MOREDATA){
            $download = ftp_nb_continue($connection);
        }

        if($download !== FTP_FINISHED){
            ftp_close($connection);

           
            throw new BadRequestException('Ocurrió un problema durante la descarga del fichero desde el FTP.');
        }

        ftp_close($connection);

        return [
            'file' => $file,
            'filename' => $foundedFileName,
        ];

    }
    public function getDatoForExcel(Request $request):Collection
    {
        return $this->repository->getDatoForExcel($request->all());
    }

}