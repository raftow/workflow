function save_popup_done_on(mod, cls, idobj, col, val, aff)
{
    if(cls=="ApplicantFile" && col=="reupload_enum")
    {
        if(newval == 1) // مطلوب إعادة رفع
        {
            $('#'+mod+'-'+cls+'-'+idobj+'-approved').html("<img src='../lib/images/ofn.png' width='30' heigth='20'>");                                     
        }
        else if(newval == 2) // تمت
        {
        }
        else if(newval == 0) // غير مطلوب
        {

        }
    }
}


function switch_done_on(md, cl, swc_id, swc_col, newval)
{
    if(cl=="ApplicantFile" && swc_col=="approved")
    {
        if(newval == 'Y')
        {
            $("#span-adm-ApplicantFile-"+swc_id+"-reupload_enum").text(" -- ");
        }
        else if(newval == 'N')
        {
            $("#span-adm-ApplicantFile-"+swc_id+"-reupload_enum").text(" -- ");
        }
    }
}