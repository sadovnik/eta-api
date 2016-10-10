<?php

namespace EtaApi;

interface CarRepositoryInterface
{
    /**
     * @param Point $point
     *
     * @return Car[]
     */
    public function findNearestAvailableCars(Point $point);
}
