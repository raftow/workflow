<?php

class WorkflowEmployeeArTranslator{
    public static function initData()
    {
        $trad = [];	
        $trad["workflow_employee"]["workflowemployee.single"] = "موظف إدارة أعمال";
        $trad["workflow_employee"]["workflowemployee.single.short"] = "موظف";
        $trad["workflow_employee"]["workflowemployee.new"] = "جديد";
        $trad["workflow_employee"]["workflow_employee"] = "موظفي إدارة أعمال";
        $trad["workflow_employee"]["workflow_employee.short"] = "الموظفين";
        $trad["workflow_employee"]["orgunit_id"] = "الجهة المتابعة";
        $trad["workflow_employee"]["workflow_orgunit_id"] = "الجهة التابع لها";
        
        $trad["workflow_employee"]["service_category_mfk"] = "المسؤوليات المناطة به";
        $trad["workflow_employee"]["service_category_mfk_tooltip"] = "أصناف الخدمات  التي يقدمها";
        $trad["workflow_employee"]["service_mfk"] = "الخدمات التي يقدمها";
        $trad["workflow_employee"]["requests_nb"] = "طاقة استيعاب الطلبات يوميا";
        $trad["workflow_employee"]["employee_id"] = "الموظف";

        $trad["workflow_employee"]["ongoing_requests_count"] = "عدد الطلبات الجاري العمل عليها";
        $trad["workflow_employee"]["done_requests_count"] = "عدد الطلبات التي تم التحقيق عليها";
        $trad["workflow_employee"]["requests_count"] = "مجموع عدد الطلبات المسندة";
        $trad["workflow_employee"]["statif_pct"] = "نسبة رضا العميل";


        $trad["workflow_employee"]["ongoing_requests_count.short"] = "الجاري";
        $trad["workflow_employee"]["done_requests_count.short"] = "تم التحقيق";
        $trad["workflow_employee"]["requests_count.short"] = "المسند";
        $trad["workflow_employee"]["statif_pct.short"] = "رضا العميل";
        

        $trad["workflow_employee"]["assignedRequests"] = "الطلبات المسندة";
        $trad["workflow_employee"]["currentRequests"] = "الطلبات الحالية";
        $trad["workflow_employee"]["finishedRequests"] = "الطلبات المنتهية";
        $trad["workflow_employee"]["allOrgunitList"] = "الجهات التي يعمل معها";


        $trad["workflow_employee"]["active"] = "نشط";
        $trad["workflow_employee"]["admin"] = "مشرف تنسيق";
        $trad["workflow_employee"]["super_admin"] = "مشرف عام";
        $trad["workflow_employee"]["approved"] = "منسق معتمد"; 
        $trad["workflow_employee"]["step1"] = "البيانات العامة";
        $trad["workflow_employee"]["step2"] = "الطلبات المسندة";
        $trad["workflow_employee"]["step3"] = "جهات المتابعة";
    
        return $trad;
    }

    public static function getInstance()
	{
		return new WorkflowEmployee();
	}
}
    

    
	

	 
?>