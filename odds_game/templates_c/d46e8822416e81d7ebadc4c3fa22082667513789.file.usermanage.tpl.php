<?php /* Smarty version Smarty-3.1.13, created on 2013-03-05 15:02:44
         compiled from "G:\odds_game\odds_game\templates\admin\usermanage.tpl" */ ?>
<?php /*%%SmartyHeaderCode:3201351360914689b50-68893298%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'd46e8822416e81d7ebadc4c3fa22082667513789' => 
    array (
      0 => 'G:\\odds_game\\odds_game\\templates\\admin\\usermanage.tpl',
      1 => 1357452483,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '3201351360914689b50-68893298',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'mgtype' => 0,
    'managetpl' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_513609147e2243_67028987',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_513609147e2243_67028987')) {function content_513609147e2243_67028987($_smarty_tpl) {?>
<?php echo $_smarty_tpl->getSubTemplate ('admin/header.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>



<?php echo $_smarty_tpl->getSubTemplate ('admin/topnav.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

<div class="container-fluid">
	<div class="row">
		<div class="span3 well">
			<ul class="nav nav-list">
			  <li class="nav-header">用户管理</li>
			  <li <?php if ($_smarty_tpl->tpl_vars['mgtype']->value=='user'){?>class="active"<?php }?>><a href="usermanage.php?type=user">注册用户管理</a></li>
			  <li <?php if ($_smarty_tpl->tpl_vars['mgtype']->value=='admin'){?>class="active"<?php }?>><a href="usermanage.php?type=admin">后台管理员</a></li>
			</ul>
		</div>
		<div class="span12">
			
			<?php echo $_smarty_tpl->getSubTemplate ($_smarty_tpl->tpl_vars['managetpl']->value, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
		
		</div>
	</div>

</div>



<?php echo $_smarty_tpl->getSubTemplate ('admin/footer.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

<?php }} ?>