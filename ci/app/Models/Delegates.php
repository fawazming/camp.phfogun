<?php
namespace App\Models;

use CodeIgniter\Model;

class Delegates extends Model
{
    protected $table = 'delegates';
    protected $primaryKey = 'id';

    protected $returnType = 'array';
    protected $useSoftDeletes = true;
    protected $allowedFields = ['fname','lname','lb','phone','email','category','school','ref','paid'];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';
}
