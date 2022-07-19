<?php

namespace App\Services\Application\Plan;

use App\Repositories\Plan\PlanRepositoryInterface;
use App\Repositories\PlanDescription\PlanDescriptionRepositoryInterface;
use App\Repositories\PlanDetail\PlanDetailRepositoryInterface;
use Illuminate\Support\Collection;

class PlanService
{

    private PlanRepositoryInterface $planRepository;
    private PlanDetailRepositoryInterface $planDetailRepository;
    private PlanDescriptionRepositoryInterface $planDescriptionRepository;

    public function __construct(
        PlanRepositoryInterface $planRepository,
        PlanDetailRepositoryInterface $planDetailRepository,
        PlanDescriptionRepositoryInterface $planDescriptionRepository,
    ){
        $this->planRepository = $planRepository;
        $this->planDetailRepository = $planDetailRepository;
        $this->planDescriptionRepository = $planDescriptionRepository;
    }

    /**
     * @return Collection
     */
    public function findAll(): Collection
    {
        $plans = $this->planRepository->findAll();

        foreach ($plans as $plan) {

            $plan->detalle = $this->planDetailRepository->findAllByPlanId($plan->idplan);
        }

        foreach ($plans as $plan) {
            $plan->content = $this->planDescriptionRepository->findAllByPlanId($plan->idplan);
        }

        $results = [];
        $collection = collect($plans)->groupBy('modulo');

        foreach($collection as $key => $item) {
            $results[] = [
                'group' => $key,
                'planes' => $item,
            ];
        }

        return collect($results);
    }
}
