<?php

namespace BhaktijKoli\UserApproval;

use Illuminate\Database\Eloquent\Model;

class Approval extends Model
{
  public function getType()
  {
    return $this->belongsTo($this->type, 'type_id');
  }

  public function getApprover()
  {
    return $this->belongsTo($this->approver_type, 'approver_id');
  }

}
