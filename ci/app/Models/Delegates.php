<?php
namespace App\Models;

use CodeIgniter\Model;

class Delegates extends Model
{
    // protected $table = 'delegates23';
    protected $table = 'delegates25';
    protected $primaryKey = 'id';

    protected $returnType = 'array';
    protected $useSoftDeletes = true;
    protected $allowedFields = ['txn','fname','lname','lb','phone','email','category','school','level','ref','old','paid','gender','org','house'];
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';
}
