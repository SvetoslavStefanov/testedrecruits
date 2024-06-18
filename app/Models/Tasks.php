<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tasks extends Model {
  use HasFactory;

  protected $fillable = [
    'name',
    'description',
    'due_date',
    'priority',
    'status',
    'project_id',
  ];

  public $timestamps = true;

  public function project() {
    return $this->belongsTo(Projects::class);
  }

  public function getPriorityOrderAttribute(): int {
    $priorityOrder = [
      'high' => 1,
      'medium' => 2,
      'low' => 3,
    ];

    return $priorityOrder[$this->priority];
  }
}
