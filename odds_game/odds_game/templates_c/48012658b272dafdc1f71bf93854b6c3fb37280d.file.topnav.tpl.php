<?php /* Smarty version Smarty-3.1.13, created on 2013-01-22 14:28:22
         compiled from "G:\odds_game\odds_game\templates\admin\topnav.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1904950fcc58111c3e0-02138933%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '48012658b272dafdc1f71bf93854b6c3fb37280d' => 
    array (
      0 => 'G:\\odds_game\\odds_game\\templates\\admin\\topnav.tpl',
      1 => 1358864898,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1904950fcc58111c3e0-02138933',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_50fcc58118b621_69624702',
  'variables' => 
  array (
    'currentnav' => 0,
    'domainname' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_50fcc58118b621_69624702')) {function content_50fcc58118b621_69624702($_smarty_tpl) {?><div class="navbar">
  <div class="navbar-inner">
    <div class="container">
 
      <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </a>
 
      <!-- Be sure to leave the brand out there if you want it shown -->
      <a class="brand" href="#">爱博博彩</a>
 
      <!-- Everything you want hidden at 940px or less, place within here -->
      <div class="nav-collapse collapse navbar-responsive-collapse">
	       <ul class="nav">
	       		<li <?php if ($_smarty_tpl->tpl_vars['currentnav']->value=='index'){?>class="active"<?php }?>><a href="<?php echo $_smarty_tpl->tpl_vars['domainname']->value;?>
index.php" >首页</a></li>
	       		<li <?php if ($_smarty_tpl->tpl_vars['currentnav']->value=='usermanage'){?>class="active"<?php }?>><a href="<?php echo $_smarty_tpl->tpl_vars['domainname']->value;?>
/admin/usermanage.php" >用户管理</a></li>
	       		<li <?php if ($_smarty_tpl->tpl_vars['currentnav']->value=='oddsmanage'){?>class="active"<?php }?>><a href="<?php echo $_smarty_tpl->tpl_vars['domainname']->value;?>
/admin/oddsmanage.php" >赛事管理</a></li>
	       </ul>
      </div>
 
    </div>
  </div>
</div><?php }} ?>