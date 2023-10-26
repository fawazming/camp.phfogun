<?php
namespace App\Models;

use CodeIgniter\Model;

class Tranx extends Model
{
    protected $table = 'tranx';
    protected $primaryKey = 'id';

    protected $returnType = 'array';
    protected $useSoftDeletes = true;
    protected $allowedFields = ['email','status','ref','url'];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';
}
