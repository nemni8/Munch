<div id="header">
	<div id="header_inner">
		<div style="float:left;">
			<?php echo HTML::image('media/images/logo_admin.png', array('alt' => 'Munch'));?>
		</div>
		<?php if ( ! empty($is_admin)) : ?>
			<div id="user_box" style="float:right;">
				<ul>
					<li style="padding-left:5px">
						<?php echo HTML::image("media/images/icon_user_22.png",array('alt' =>'User icon','style'=>'vertical-align:middle'));?>
						<?php echo $username;?>
					</li>
					<li>
						<span>|</span>
						<?php echo html::anchor(Request::factory('admin')
								   ->uri(array('controller' => 'main', 'action' => 'logout')), 'logout'); ?>
					</li>
					<li style="padding-right:5px">
						<span>|</span>
						<?php if ( ! empty($is_supadmin)) : ?>
							<?php echo 'super admin';?>
						<?php else : ?>
							<?php echo 'admin';?>
						<?php endif;?>
					</li>
				</ul>
			</div>
		<?php endif;?>
	</div>
	<?php echo View::factory("admin/nav")->bind('is_supadmin',$is_supadmin)->bind('is_admin',$is_admin); ?>
</div>

 
