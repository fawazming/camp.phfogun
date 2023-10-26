<?php
namespace App\Models;

use CodeIgniter\Model;

class Pinned extends Model
{
    protected $table = 'pinned';
    protected $primaryKey = 'id';

    protected $returnType = 'array';
    protected $useSoftDeletes = true;
    protected $allowedFields = ['pin','used'];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';
}
