<?php
require '../../../zb_system/function/c_system_base.php';
require '../../../zb_system/function/c_system_admin.php';
$zbp->Load();
$action = 'root';
if (!$zbp->CheckRights($action)) {
  $zbp->ShowError(6);
  die();
}
if (!$zbp->CheckPlugin('AddCustomCode')) {
  $zbp->ShowError(48);
  die();
}

if (count($_POST) > 0) {
  CheckIsRefererValid();
  $zbp->Config('AddCustomCode')->headcode = $_POST['headcode'];
  $zbp->Config('AddCustomCode')->footcode = $_POST['footcode'];
  $zbp->Config('AddCustomCode')->saveconfig = $_POST['saveconfig'];
  $zbp->SaveConfig('AddCustomCode');
  $zbp->SetHint('good');
  Redirect('./main.php');
}

$blogtitle = '添加自定义代码';
require $blogpath . 'zb_system/admin/admin_header.php';
require $blogpath . 'zb_system/admin/admin_top.php';
?>

<style>
  textarea {
    width: 90%;
  }
</style>
<div id="divMain">
  <div class="divHeader"><?php echo $blogtitle; ?></div>
  <div class="SubMenu">
  </div>
  <div id="divMain2">
    <!--代码-->
    <form method="post">
      <div>
        <h2>添加头部代码，代码位于&lt;head&gt;&lt;/head&gt;之间</h2>
        <textarea name="headcode" cols="30" rows="10"><?php
                                                      echo $zbp->Config('AddCustomCode')->headcode;
                                                      ?></textarea>
      </div>

      <br>

      <div>
        <h2>添加底部代码，代码位于&lt;/body&gt;之前</h2>
        <textarea name="footcode" cols="30" rows="10"><?php
                                                      echo $zbp->Config('AddCustomCode')->footcode;
                                                      ?></textarea>
      </div>

      <br>

      <label>禁用插件时保留配置</label>
      <input type="text" name="saveconfig" class="checkbox" value="<?php echo isset($zbp->Config('AddCustomCode')->saveconfig) ? $zbp->Config('AddCustomCode')->saveconfig : 1; ?>" />
      <p>“ON”为保留配置数据；“OFF”为清空配置数据。</p>

      <div>
        <input type='hidden' name='csrfToken' value="<?php echo $zbp->GetCsrfToken(); ?>">
        <input type="Submit" value="保存" />
      </div>
    </form>

  </div>
</div>

<?php
require $blogpath . 'zb_system/admin/admin_footer.php';
RunTime();
?>