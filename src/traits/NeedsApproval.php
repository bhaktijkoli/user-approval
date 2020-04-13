<?php

namespace BhaktijKoli\UserApproval\Traits;

use Illuminate\Database\Eloquent\Model;
use BhaktijKoli\UserApproval\Approval;

trait NeedsApproval
{
  public function addApprover(Model $approver)
  {
    $approval = new Approval();
    $approval->type = get_class();
    $approval->type_id = $this->getKey();
    $approval->approver_type = get_class($approver);
    $approval->approver_id = $approver->getKey();
    $approval->status = '0';
    $approval->save();
    if(method_exists($this, 'requested')) {
      $this->requested($approver);
    }
  }

  public function getApprovers()
  {
    $approvals = Approval::where('type', get_class())->where('type_id', $this->getKey())->get();
    $approvers = collect();
    foreach ($approvals as $approval) {
      $approver = new $approval->approver_type;
      $approvers->add($approver);
    }
    return $approvers;
  }

  public function isApproved()
  {
    $approvals = Approval::where('type', get_class())->where('type_id', $this->getKey())->get();
    $isApproved = true;
    foreach ($approvals as $approval) {
      if($approval->status != '1') $isApproved = false;
    }
    return $isApproved;
  }

  public function isRejected()
  {
    $approvals = Approval::where('type', get_class())->where('type_id', $this->getKey())->get();
    $isRejected = false;
    foreach ($approvals as $approval) {
      if($approval->status == '2') $isRejected = true;
    }
    return $isRejected;
  }

  public function requested(Model $approver)
  {

  }

  public function approved(Model $approver)
  {

  }

  public function rejected(Model $approver)
  {

  }
}
