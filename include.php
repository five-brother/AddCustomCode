<?php
#注册插件
RegisterPlugin("AddCustomCode","ActivePlugin_AddCustomCode");

function ActivePlugin_AddCustomCode() {
    Add_Filter_Plugin("Filter_Plugin_Zbp_MakeTemplatetags","AddCustomCode_AddCode");
}

function AddCustomCode_AddCode(&$template){
    global $zbp;
    $template["header"] .= $zbp->Config('AddCustomCode')->headcode;
    $template["footer"] .= $zbp->Config('AddCustomCode')->footcode;
}
function InstallPlugin_AddCustomCode() {
    global $zbp;
    $zbp->Config('AddCustomCode')->version = '1.0';
}
function UninstallPlugin_AddCustomCode() {
    global $zbp;
	if($zbp->Config('AddCustomCode')->saveconfig == 0){
		$zbp->DelConfig('AddCustomCode');
	}
}

