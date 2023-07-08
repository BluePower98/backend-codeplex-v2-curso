<?php

namespace App\Services\Application\ModuleCourse\CourseDetails;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use App\Repositories\ModuleCourse\CourseDetails\CourseDetailsRepositoryInterface;
use App\Helpers\FileHelper;

class CourseDetailsService
{
    private CourseDetailsRepositoryInterface $CourseDetailsRepository;

    public function __construct(
        CourseDetailsRepositoryInterface $CourseDetailsRepository
    )
    {
        $this->CourseDetailsRepository = $CourseDetailsRepository;
    }

    public function datatables(Request $request): Collection
    {
        return $this->CourseDetailsRepository->datatables($request);
    }

    public function store(Request $request): void
    {
        $logo=$request->only(['fotos']);
        $this->saveLogo($request,$logo);
    }
    private function saveLogo(Request $request,array $logo)
    {
        $images=array_keys($logo);
        $upload_path=$request->get('upload_path').'/';
        FileHelper::removeByUrl($upload_path);
        foreach ($images as $value) {

            if(!$request->hasFile($value)){
                continue;
            }
            $file=$request->file($value);
            $fileName = "fotos" . '.' . $file->getClientOriginalExtension();
            $file->move($upload_path, $fileName);

            $url = $upload_path.'/'. $fileName;

            $request->merge(["fotos"=>$url]);
            $this->CourseDetailsRepository->store($request->all());
        }

    }

    public function update(Request $request, string $idempresa, int $iddetallecurso): Collection
    {
        return $this->CourseDetailsRepository->update($request->all(), $idempresa, $iddetallecurso);
    }

    public function delete(string $idempresa, int $iddetallecurso): Collection
    {
        return $this->CourseDetailsRepository->delete($idempresa, $iddetallecurso);
    }
    
    public function show(string $idempresa, int $iddetallecurso): Collection
    {
        return $this->CourseDetailsRepository->show($idempresa, $iddetallecurso);
    } 

    public function getCursos(string $idempresa): Collection
    {
        return $this->CourseDetailsRepository->getCursos($idempresa);
    }

    public function getEspecialidades(string $idempresa, int $idespecialidad): Collection
    {
        return $this->CourseDetailsRepository->getEspecialidades($idempresa, $idespecialidad);
    }

}

