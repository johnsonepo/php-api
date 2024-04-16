<?php
namespace app\api\model;

use app\api\Model;

class Customer extends Model {
    const TABLE_NAME = 'customers';

    public function __construct() {
        parent::__construct();
        $this->table(self::TABLE_NAME);
    }
}
