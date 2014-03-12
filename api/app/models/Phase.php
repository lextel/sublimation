<?php

/*
*期数表MODEL
*/

class Phase extends Eloquent  {
    protected $table = 'phases';

    /**
     * 前端条件
     */
    public function scopeFrontend($query)
    {
        return $query->whereRaw('is_delete = 0 and opentime = 0 and (status = 1 or status = 3)');
    }

}
