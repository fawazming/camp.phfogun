<?php
namespace App\Models;

use CodeIgniter\Model;

class Delegates21 extends Model
{
    protected $table = 'delegates21';
    protected $primaryKey = 'id';

    protected $returnType = 'array';
    protected $useSoftDeletes = true;
    protected $allowedFields = ['fname','lname','lb','phone','email','category','school','ref','paid','gender'];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';
}
