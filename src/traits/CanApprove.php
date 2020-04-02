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

    public function canApprove(Model $model)
    {
      $approval = Approval::where('type', get_class($model))->where('type_id', $model->getKey())->where('approver_type', get_class())->where('approver_id', $this->getKey())->first();
      if($approval) {
          return true;
      } else {
        return false;
      }
    }

    public function hasApproved(Model $model)
    {
      $approval = Approval::where('type', get_class($model))->where('type_id', $model->getKey())->where('approver_type', get_class())->where('approver_id', $this->getKey())->first();
      if($approval) {
        return $approval->status == '1';
      }
      return false;
    }

    public function hasRejected(Model $model)
    {
      $approval = Approval::where('type', get_class($model))->where('type_id', $model->getKey())->where('approver_type', get_class())->where('approver_id', $this->getKey())->first();
      if($approval) {
        return $approval->status == '2';
      }
      return false;
    }

    public function allApprovals()
    {
      return Approval::where('approver_type', get_class())->where('approver_id', $this->getKey());
    }

    public function onlyPending()
    {
      return Approval::where('approver_type', get_class())->where('approver_id', $this->getKey())->where('status', '0');
    }

    public function onlyApproved()
    {
      return Approval::where('approver_type', get_class())->where('approver_id', $this->getKey())->where('status', '1');
    }

    public function onlyRejected()
    {
      return Approval::where('approver_type', get_class())->where('approver_id', $this->getKey())->where('status', '2');
    }
}
