<?php

class WorkflowEmployeeArTranslator
{
    public static function initData()
    {
        $trad = [];
        $trad['workflow_employee']['workflowemployee.single'] = 'موظف';
        $trad['workflow_employee']['workflowemployee.single.short'] = 'موظف';
        $trad['workflow_employee']['workflowemployee.new'] = 'جديد';
        $trad['workflow_employee']['workflow_employee'] = 'الموظفون';
        $trad['workflow_employee']['workflow_employee.short'] = 'الموظفون';
        $trad['workflow_employee']['orgunit_id'] = 'الإدارة';
        $trad['workflow_employee']['workflow_orgunit_id'] = 'الجهة التابع لها';

        $trad['workflow_employee']['wrole_mfk'] = 'المسؤوليات المناطة به';
        $trad['workflow_employee']['wscope_mfk'] = 'البرامج تحت مسؤوليته';


        $trad['workflow_employee']['employee_id'] = 'الموظف';

        $trad['workflow_employee']['ongoing_requests_count'] = 'عدد الطلبات الجاري العمل عليها';
        $trad['workflow_employee']['done_requests_count'] = 'عدد الطلبات التي تم التحقيق عليها';
        $trad['workflow_employee']['requests_count'] = 'مجموع عدد الطلبات المسندة';
        $trad['workflow_employee']['statif_pct'] = 'نسبة رضا العميل';
        $trad['workflow_employee']['inbox_count'] = 'طلبات واردة';

        $trad['workflow_employee']['ongoing_requests_count.short'] = 'الجاري';
        $trad['workflow_employee']['done_requests_count.short'] = 'تم التحقيق';
        $trad['workflow_employee']['requests_count.short'] = 'المسند';
        $trad['workflow_employee']['statif_pct.short'] = 'رضا العميل';

        $trad['workflow_employee']['assignedRequests'] = 'الطلبات المسندة';
        $trad['workflow_employee']['currentRequests'] = 'الطلبات الحالية';
        $trad['workflow_employee']['finishedRequests'] = 'الطلبات المنتهية';
        $trad['workflow_employee']['allOrgunitList'] = 'الجهات التي يعمل معها';

        $trad['workflow_employee']['active'] = 'نشط';
        $trad['workflow_employee']['admin'] = 'مشرف تنسيق';
        $trad['workflow_employee']['super_admin'] = 'مشرف عام';
        $trad['workflow_employee']['approved'] = 'موظف قبول معتمد';

        $trad['workflow_employee']['firstname'] = 'الاسم الأول';
        $trad['workflow_employee']['f_firstname'] = 'اسم الأب';
        $trad['workflow_employee']['g_f_firstname'] = 'اسم الجد';
        $trad['workflow_employee']['lastname'] = 'اسم العائلة';

        $trad['workflow_employee']['firstname_en'] = 'الاسم الأول بالانجليزي';
        $trad['workflow_employee']['f_firstname_en'] = 'اسم الأب بالانجليزي';
        $trad['workflow_employee']['g_f_firstname_en'] = 'اسم الجد بالانجليزي';
        $trad['workflow_employee']['lastname_en'] = 'اسم العائلة بالانجليزي';

        $trad['workflow_employee']['gender_id'] = 'الجنس';
        $trad['workflow_employee']['mobile'] = 'الجوال';
        $trad['workflow_employee']['country_id'] = 'الجنسية';
        $trad['workflow_employee']['hierarchy_level_enum'] = 'المستوى في الهيكل الوظيفي';

        $trad['workflow_employee']['step1'] = 'البيانات العامة';
        $trad['workflow_employee']['step2'] = 'البيانات الشخصية';
        $trad['workflow_employee']['step3'] = 'الصلاحيات';

        return $trad;
    }

    public static function getInstance()
    {
        return new WorkflowEmployee();
    }
}
