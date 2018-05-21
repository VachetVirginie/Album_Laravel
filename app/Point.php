<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\Models\ { User, Category };



class Point extends Model
{
  public function user()
  {
      return $this->belongsTo(User::class);
  }

}
