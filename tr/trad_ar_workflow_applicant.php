<?php

class WorkflowApplicantArTranslator{
    public static function initData()
    {
        $trad = [];
      
		$trad["workflow_applicant"]["step1"] = "هوية المتقدم";
		$trad["workflow_applicant"]["step2"] = "بيانات المتقدم";
		$trad["workflow_applicant"]["step4"] = "الحالة الاكاديمية";
		$trad["workflow_applicant"]["step5"] = "الترشحات";
		$trad["workflow_applicant"]["step6"] = "رفع المرفقات";
		$trad["workflow_applicant"]["step7"] = "استخدام المرفقات";
		$trad["workflow_applicant"]["step9"] = "معلومات متقدمة";
		$trad["workflow_applicant"]["step11"] = "بيانات فنية";

		$trad["workflow_applicant"]["workflowApplicantFileList"] = "قائمة مرفقات المتقدم";
		
		$trad["workflow_applicant"]["applicationList"] = "طلبات التقديم";
		

		$trad["workflow_applicant"]["workflow_applicant.single"] = "متقدم";
		$trad["workflow_applicant"]["workflow_applicant.new"] = "جديد";
		$trad["workflow_applicant"]["workflow_applicant"] = "المتقدمون";
		$trad["workflow_applicant"]["workflow_applicant_"] = "المتقدمين";
		$trad["workflow_applicant"]["workflow_applicant.short_"] = "المتقدمين";

		// $trad["workflow_applicant"]["id"] = "رقم الهوية";
		$trad["workflow_applicant"]["idn"] = "رقم الهوية";
		$trad["workflow_applicant"]["idn-infos"] = "اعدادات ملف المتقدم"; //معلومات الهوية
		$trad["workflow_applicant"]["idn_type_id"] = "نوع الهوية";
		$trad["workflow_applicant"]["id_issue_place"] = "مكان إصدار الهوية";
		$trad["workflow_applicant"]["id_issue_date"] = "تاريخ إصدار الهوية";
		$trad["workflow_applicant"]["id_expiry_date"] = "تاريخ إنتهاء الهوية";
		$trad["workflow_applicant"]["gender_enum"] = "الجنس";
		$trad["workflow_applicant"]["country_id"] = "الجنسية";
		$trad["workflow_applicant"]["passeport_num"] = "جواز السفر";
		$trad["workflow_applicant"]["passeport_expiry_gdate"] = "تاريخ إنتهاء جواز السفر";
		$trad["workflow_applicant"]["username"] = "اسم المستخدم";
		$trad["workflow_applicant"]["password"] = "كلمة المرور";
		$trad["workflow_applicant"]["email"] = "البريد الالكتروني الشخصي";
		$trad["workflow_applicant"]["mobile"] = "الجوال الشخصي";
		$trad["workflow_applicant"]["signup _acknoldgment"] = "تعهد بصحة البيانات";
		$trad["workflow_applicant"]["first_name_ar"] = "الاسم الأول";
		$trad["workflow_applicant"]["father_name_ar"] = "اسم الأب";
		$trad["workflow_applicant"]["middle_name_ar"] = "اسم الجد";
		$trad["workflow_applicant"]["last_name_ar"] = "اسم العائلة";
		$trad["workflow_applicant"]["first_name_en"] = "الاسم الأول بالإنجليزية";
		$trad["workflow_applicant"]["father_name_en"] = "اسم الأب بالإنجليزية";
		$trad["workflow_applicant"]["middle_name_en"] = "اسم الجد بالإنجليزية";
		$trad["workflow_applicant"]["last_name_en"] = "اسم العائلة بالإنجليزية";
		$trad["workflow_applicant"]["profile_approved"] = "تم التحقق من البيانات";
		$trad["workflow_applicant"]["religion_enum"] = "الديانة";
		$trad["workflow_applicant"]["birth_date"] = "تاريخ الميلاد بالهجري";
		$trad["workflow_applicant"]["birth_gdate"] = "تاريخ الميلاد بالميلادي";
		$trad["workflow_applicant"]["place_of_birth"] = "مكان الميلاد";
		$trad["workflow_applicant"]["signup_acknowldgment"] = "تعهد بصحة البيانات";
		$trad["workflow_applicant"]["signup_acknowldgment.EUH"] = "ليس بعد";
		$trad["workflow_applicant"]["profile"] = "البيانات الشخصية";
		

		return $trad;
    }

    public static function getInstance()
	{
		return new WorkflowApplicant();
	}
}
