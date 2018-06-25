<div class="bv_page_wide">
  <div class="bv_inside_heading">
  	<a href="http://migrateguru.com/"><img src="<?php echo plugins_url('../img/migrateguru.png', __FILE__); ?>" style="height: 100px; width:226px" /></a>
    <a class='poweredlogo' href="http://blogvault.net/"><img src="<?php echo plugins_url('../img/logo.png', __FILE__); ?>" style="margin-top: 1rem; margin-left: -0.5rem"/></a>
  </div>
	<div class="bv_inside_column1" >
		<h3>Enter your email to get started</h3></br>
		<?php $this->showErrors(); ?>
		<form id="mgform" dummy=">" action="<?php echo $this->bvmain->appUrl(); ?>/migration/migrate" style="padding:0 2% 2em 1%;" method="post" name="signup">
			<input type="email" name="email" value="" class="form-field"/>
			<input type="submit" name="submit" value="Migrate Site" class="bv-primary-button"/> 
			<input type="hidden" name="bvsrc" value="wpplugin" />
			<input type="hidden" name="origin" value="migrateguru" />
			<?php echo $this->siteInfoTags(); ?>
		</form>
		<h3>Supported Hosts:</h3></br>
		<img src="<?php echo plugins_url('../img/supported_hosts.png', __FILE__); ?>" style="max-width: 720px"/>
	</div>
	<div class="bv_selectedinside_column2"> 
		<div>
			<iframe id="video" width="360" height="240" src="//www.youtube.com/embed/HBGcUdOhMcI?rel=0" frameborder="0" allowfullscreen></iframe>
		</div>
		<div>
      <ul class="bvheaderright">
      	<li><a href="https://migrateguru.freshdesk.com/support/solutions/33000046011" target="_blank">FAQs</a></li>
      	<li><a href="https://migrateguru.freshdesk.com/support/solutions/33000052052" target="_blank">Help Docs</a></li>
      	<li><a href="https://wordpress.org/support/plugin/migrate-guru" target="_blank">Support</a></li>
      	<li><a href="https://wordpress.org/support/plugin/migrate-guru/reviews/?filter=5#new-post" target="_blank">Rate us 5 stars</a></li>
      </ul>
    </div>
	</div>
</div>