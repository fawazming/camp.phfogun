<?php

namespace App\Models;

use CodeIgniter\Model;

class PgtransactionsModel extends Model
{
    protected $table = 'pgtransactions';
    protected $primaryKey = 'id';
    protected $returnType = 'array';
    protected $useTimestamps = false;
    // protected $createdField  = 'created_at';
    // protected $updatedField  = 'updated_at';
    protected $dateFormat = 'datetime';

    protected $allowedFields = [
        'transaction_id',
        'business_id',
        'email',
        'amount',
        'access_code',
        'callback_url',
        'transaction_type',
        'currency',
        'timestamp',
        'status',
        'description',
        'related_transaction_id',
        'expires_at',
        'validated_at',
        'notification_status',
        'amount_paid',
        'settlement_amount',
        'settlement_fee',
        'transaction_status',
        'sender_name',
        'sender_account_number',
        'sender_bank',
        'receiver_name',
        'receiver_account_number',
        'receiver_bank',
        'customer_name',
        'customer_email',
        'customer_phone',
        'customer_id'
    ];
}
