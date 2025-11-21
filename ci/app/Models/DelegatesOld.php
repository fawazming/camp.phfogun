<?php
namespace App\Models;

use CodeIgniter\Model;

class DelegatesOld extends Model
{
    protected $table = 'delegates24';
    protected $primaryKey = 'id';

    protected $returnType = 'array';
    protected $useSoftDeletes = true;
    protected $allowedFields = ['fname','lname','lb','phone','email','category','school','ref','paid'];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

            
    public function getDCbTG()
    {
        return $this->select('lb, gender, COUNT(*) as count')
                    ->groupBy('lb, gender')
                    ->findAll();
    }
    
    public function getDCbAG()
    {
        return $this->select('category, gender, COUNT(*) as count')
                    ->groupBy('category, gender')
                    ->findAll();
    }
}