<?php

namespace BhaktijKoli\UserApproval\Traits;

use Illuminate\Database\Eloquent\Model;
use BhaktijKoli\UserApproval\Approval;

trait CanApprove
{
    public function approve(Model $model)
    {
        $approval = Approval::where('type', get_class($model))->where('type_id', $model->getKey())->where('approver_type', get_class())->where('approver_id', $this->getKey())->first();
        if($approval) {
            $approval->status = '1';
            $approval->save();
        }
    }
    public function reject(Model $model)
    {
        $approval = Approval::where('type', get_class($model))->where('type_id', $model->getKey())->where('approver_type', get_class())->where('approver_id', $this->getKey())->first();
        if($approval) {
            $approval->status = '2';
            $approval->save();
        }
    }
}
