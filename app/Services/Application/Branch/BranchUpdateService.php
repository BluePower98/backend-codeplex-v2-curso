<?php
namespace App\Services\Application\Branch;
use Illuminate\Http\Request;
use App\Helpers\FileHelper;
use App\Repositories\Branch\BranchRepositoryInterface;

class BranchUpdateService
{
    private BranchRepositoryInterface $repository;
    public function __construct(
        BranchRepositoryInterface $repository
    )
    {
        $this->repository = $repository;
    }
    function updateLogo(Request $request):void
    {
        // dd($request->only(['imagen1']));
        $logo=$request->only(['imagen1']);
        $this->saveLogo($request,$logo,$request->get("idempresa"),$request->get("idsucursal"));
    }

    private function saveLogo(Request $request,array $logo,string $idempresa,string $idsucursal)
    {
        $images=array_keys($logo);  
        $upload_path=$request->get('upload_path').'/';
        FileHelper::removeByUrl($upload_path);
        foreach ($images as $value) {
            if(!$request->hasFile($value)){
                continue;
            }
            $file=$request->file($value);
            // $fileName = FileHelper::sanitizerFileName($file->getClientOriginalName());
            // dd($fileName);
            $fileName = "logo" . '.' . $file->getClientOriginalExtension();
            $file->move($upload_path, $fileName);

            $url = $upload_path.'/'. $fileName;
            
            $this->repository->updatelogo([
                'idempresa' => $idempresa,
                'idsucursal' => $idsucursal,
                'logo' => $url
            ]);
        }

    }
}