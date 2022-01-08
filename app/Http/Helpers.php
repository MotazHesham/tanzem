<?php 


if (! function_exists('not_auth_recored')) {
    function not_auth_recored($owner_id , $requester_id) {
        if($owner_id != $requester_id){
            alert()->error('Not Auth!!');

            if(auth()->user()->user_type == 'companiesAndInstitution'){ 
                return 'company.home';
            }elseif(auth()->user()->user_type == 'client'){ 
                return 'client.home';
            }elseif(auth()->user()->user_type == 'governmental_entity'){ 
                return 'government.home';
            }else{
                return 'frontend.home';
            }
        }else{
            return 0;
        }
    }
}