<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    use HasFactory;

    protected $connection = 'mysql';

    protected $table = 'sections';

    protected $primaryKey = 'section_id';

    protected $fillable = ['section'];


//    public function taking_test(){
//        return $this->hasOne(TakingTest::class, 'section_id', 'section_id');
//    }


}
