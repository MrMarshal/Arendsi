<?php 
    class Invoices extends Admin{

        function GetActiveOrders() {
            $branch_id = 1;
            return $this->GetList(self::TABLE_INVOICES,"branch_id = ".$branch_id." AND status = 1");
        }

    }
?>