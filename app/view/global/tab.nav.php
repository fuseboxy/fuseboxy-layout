<?php /*
<fusedoc>
	<io>
		<in>
			<structure name="$tabLayout">
				<string name="style" comments="tabs|pills" />
				<string name="position" comments="left|right|top|bottom" />
				<string name="orientation" comments="vertical|horizontal" />
				<boolean name="justify" />
				<string name="header" optional="yes" />
				<string name="footer" optional="yes" />
				<array name="nav">
					<structure name="+">
						<string name="name" />
						<string name="url" optinonal="yes" />
						<boolean name="active" optional="yes" />
						<boolean name="disabled" optional="yes" />
						<string name="remark" optinonal="yes" />
						<string name="class" optional="yes" />
						<string name="style" optional="yes" />
						<string name="linkClass" optional="yes" />
						<string name="linkStyle" optional="yes" />
						<structure name="button" optinonal="yes" comments="single button only">
							<string name="~buttonName~" value="~buttonURL~" />
						</structure>
						<array name="menus" optinonal="yes">
							<structure name="+">
								<string name="name" />
								<string name="url" />
								<string name="navHeader" />
								<string name="remark" />
								<string name="divider" comments="before|after" />
								<string name="className" />
							</structure>
						</array>
					</structure>
				</array>
			</structure>
		</in>
		<out />
	</io>
</fusedoc>
*/
// class combination for nav
$tabNavClass = array('nav', "nav-{$tabLayout['style']}");
$tabNavClass[] = "nav-{$tabLayout['style']}--{$tabLayout['position']}";
$tabNavClass[] = "nav-{$tabLayout['style']}--{$tabLayout['orientation']}";
if ( $tabLayout['justify'] ) $tabNavClass[] = 'nav-justified';
if ( $tabLayout['orientation'] == 'vertical' ) $tabNavClass[] = 'flex-column';


// quick fix for tab nav
/*
$tabNavStyle = "margin-bottom: 1em;";
if ( $tabLayout['style'] == 'tab' ) {
	$tabNavStyle .= 'margin-left: -1px; margin-right: -1px; padding-right: 0;';
}
*/
?>
<ul class="<?php echo implode(' ', $tabNavClass); ?>" role="navigation"><?php
	// nav header
	if ( !empty($tabLayout['header']) ) :
		?><li class="nav-header nav-item mb-3"><?php echo $tabLayout['header']; ?></li><?php
	endif;
	// nav items
	if ( !empty($tabLayout['nav']) ) :
		foreach ( $tabLayout['nav'] as $i => $tab ) :
/*
			<?php if ( !empty($tab['navHeader']) ) : ?>
				<li class="nav-header">
					<?php if ( $i != 0 ) : ?><br /><?php endif; ?>
					<h6 class="text-muted"><?php echo $tab['navHeader']; ?></h6>
				</li>
			<?php endif; ?>
*/
			// menu item
				$itemClass = array('nav-item');
//				if ( !empty($tab['menus'])    ) $itemClass[] = 'dropdown';
				if ( !empty($tab['class']) ) $itemClass[] = $tab['class'];
			?><li class="<?php echo implode(' ', $itemClass); ?>">
				<!-- show drop-down then url -->
				<?php
					$linkClass = array('nav-link');
					if ( !empty($tab['active']) ) $linkClass[] = 'active';
					if ( !empty($tab['linkClass']) ) $linkClass[] = $tab['linkClass'];
//					if ( !empty($tab['menus']) ) $linkClass = 'dropdown-toggle';
				?>
				<a 
					class="<?php echo implode(' ', $linkClass); ?>"
<?php /*
					<?php if ( !empty($tab['menus']) ) : ?>
						href="#"
						data-toggle="dropdown"
						role="button"
						aria-haspopup="true"
						aria-expanded="false"
					<?php elseif ( !empty($tab['url']) ) : ?>
*/ ?>
						href="<?php echo $tab['url']; ?>"
<?php /*
					<?php endif; ?>
*/ ?>
				>
<?php /*
					<!-- buttons -->
					<?php if ( isset($tab['button']) ) : ?>
						<div class="pull-right" style="margin-left: 1em;">
							<?php foreach ( $tab['button'] as $buttonName => $buttonURL ) : ?>
								<button
									class="btn btn-xs btn-default"
									data-url="<?php echo $buttonURL; ?>"
								 	onclick="document.location.href = $(this).attr('data-url');"
								 	onmousedown="var parent = $(this).closest('a'); $(parent).attr('data-href', $(parent).attr('href')).removeAttr('href');"
								 	onmouseup="var parent = $(this).closest('a'); window.setTimeout(function(){ $(parent).attr('href', $(parent).attr('data-href')).removeAttr('data-href'); }, 0);">
									<?php echo $buttonName; ?>
								</button>
							<?php endforeach; ?>
						</div>
					<?php endif; ?>
*/ ?>
					<!-- tab name -->
					<span><?php echo $tab['name']; ?></span>
					<!-- tab remark -->
					<?php if ( !empty($tab['remark']) ) : ?>
						<em class="small ml-1 <?php echo empty($tab['active']) ? 'text-muted' : 'text-light'; ?>">
							(<?php echo $tab['remark']; ?>)
						</em>
					<?php endif; ?>
				</a><?php 
/*
				<!-- dropdown menu -->
				<?php if ( !empty($tab['menus']) ) : ?>
					<ul class="dropdown-menu">
						<?php foreach ( $tab['menus'] as $m ) : ?>
							<!-- divider -->
							<?php if ( !empty($m['divider']) and stripos($m['divider'], 'before') !== false ) : ?>
								<li class="divider <?php if ( !empty($m['className']) ) echo $m['className']; ?>"></i>
							<?php endif; ?>
							<!-- header -->
							<?php if ( !empty($m['navHeader']) ) : ?>
								<li class="dropdown-header <?php if ( !empty($m['className']) ) echo $m['className']; ?>"><?php echo $m['navHeader']; ?></li>
							<?php endif; ?>
							<!-- item -->
							<?php if ( !empty($m['name']) ) : ?>
								<li class="dropdown-item <?php if ( !empty($m['active']) ) echo 'active'; ?> <?php if ( !empty($m['className']) ) echo $m['className']; ?>">
									<a <?php if ( !empty($m['url']) ) : ?>href="<?php echo $m['url']; ?>"<?php endif; ?> <?php if ( !empty($m['newWindow']) ) : ?>target="_blank"<?php endif; ?>><?php echo $m['name']; ?></a>
									<?php if ( !empty($m['remark']) ) : ?>&nbsp;<em class='text-muted'>(<?php echo $m['remark']; ?>)</em><?php endif; ?>
								</li>
							<?php endif; ?>
							<!-- divider -->
							<?php if ( !empty($m['divider']) and stripos($m['divider'], 'after') !== false ) : ?>
								<li class="divider <?php if ( !empty($m['className']) ) echo $m['className']; ?>"></i>
							<?php endif; ?>
						<?php endforeach; ?>
					</ul>
				<?php endif; ?>
*/
			?></li><?php
		endforeach; // foreach-nav
	endif; // if-has-nav
	// nav footer
	if ( !empty($tabLayout['footer']) ) :
		?><li class="nav-footer nav-item mt-3"><?php echo $tabLayout['footer']; ?></li><?php
	endif;
?></ul>





<!-- https://codepen.io/jasongardner/pen/gxprVQ -->
<!-- https://getbootstrap.com/docs/4.3/components/navs/ -->
<style>
.nav-tabs--vertical {
  border-bottom: none;
  border-right: 1px solid #ddd;
  display: flex;
  flex-flow: column nowrap;
}
.nav-tabs--left {
  margin: 0 15px;
}
.nav-tabs--left .nav-item + .nav-item {
  margin-top: .25rem;
}
.nav-tabs--left .nav-link {
  transition: border-color .125s ease-in;
  white-space: nowrap;
}
.nav-tabs--left .nav-link:hover {
  background-color: #f7f7f7;
  border-color: transparent;
}
.nav-tabs--left .nav-link.active {
  border-bottom-color: #ddd;
  border-right-color: #fff;
  border-bottom-left-radius: 0.25rem;
  border-top-right-radius: 0;
  margin-right: -1px;
}
.nav-tabs--left .nav-link.active:hover {
  background-color: #fff;
  border-color: #0275d8 #fff #0275d8 #0275d8;
}

  </style>

<!--
<div class="d-flex flex-row mt-2">
	<ul class="nav nav-tabs nav-tabs--vertical nav-tabs--left" role="navigation">
		<li class="nav-item">
			<a href="#lorem" class="nav-link active" data-toggle="tab" role="tab" aria-controls="lorem">Lorem</a>
		</li>
		<li class="nav-item">
			<a href="#ipsum" class="nav-link" data-toggle="tab" role="tab" aria-controls="ipsum">Ipsum</a>
		</li>
		<li class="nav-item">
			<a href="#dolor" class="nav-link disabled" data-toggle="tab" role="tab" aria-controls="dolor">Dolor</a>
		</li>
		<li class="nav-item">
			<a href="#sit-amet" class="nav-link" data-toggle="tab" role="tab" aria-controls="sit-amet">Sit Amet</a>
		</li>
	</ul>
	<div class="tab-content">
		<div class="tab-pane fade show active" id="lorem" role="tabpanel">
			<h1>Lorem</h1>
			
			<p>Aenean sed lacus id mi scelerisque tristique. Nunc sed ex sed turpis fringilla aliquet in in neque. Praesent posuere, neque rhoncus sollicitudin fermentum, erat ligula volutpat dui, nec dapibus ligula lorem ac mauris. Etiam et leo venenatis purus pharetra dictum.</p>
			
			<p>Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Proin tempor mi ut risus laoreet molestie. Duis augue risus, fringilla et nibh ac, convallis cursus purus. Suspendisse potenti. Praesent pretium eros eleifend posuere facilisis. Proin ut magna vitae nulla suscipit eleifend. Ut bibendum pulvinar sapien, vel tristique felis scelerisque et. Sed elementum sapien magna, placerat interdum lacus placerat ut. Integer varius, ligula bibendum laoreet sollicitudin, eros metus fringilla lectus, quis consequat nisl nibh ut nisi. Aenean dignissim, nibh ac fermentum condimentum, ante nisl rutrum sapien, at commodo eros sapien vulputate arcu. Fusce neque leo, blandit nec lectus eu, vestibulum commodo tellus. Aliquam sem libero, tristique at condimentum ac, luctus nec nulla.</p>
		</div>
		<div class="tab-pane fade" id="ipsum" role="tabpanel">
			<h1>Ipsum</h1>
			
			<p>Aenean pharetra risus quis placerat euismod. Praesent mattis lorem eget massa euismod sollicitudin. Donec porta nulla ut blandit vehicula. Mauris sagittis lorem nec mauris placerat, et molestie elit vehicula. Donec libero ex, condimentum et mi dapibus, euismod ornare ligula.</p>
			
			<p>In faucibus tempus ante, et tempor magna luctus id. Ut a maximus ipsum. Duis eu velit nec libero pretium pellentesque. Maecenas auctor hendrerit pulvinar. Donec sed tortor interdum, sodales elit vel, tempor turpis. In tristique vestibulum eros vel congue. Vivamus maximus posuere fringilla. Nullam in est commodo, tristique ligula eu, tincidunt enim. Duis iaculis sodales lectus vitae cursus.</p>
		</div>
		<div class="tab-pane fade" id="dolor" role="tabpanel">
			<h1>Dolor</h1>
			
			<p>Ut eget lectus tristique, tempus purus sit amet, porta augue. Mauris lobortis sem nec augue ultricies blandit. Nullam sed sem venenatis, pretium urna eget, scelerisque dolor. Morbi nec volutpat leo, quis faucibus tortor. Aenean vel rutrum mauris. Pellentesque lectus massa, tincidunt quis leo non, sodales sagittis nulla. Proin interdum est at nulla laoreet, pulvinar pretium nisl rutrum. In vel elit a risus rhoncus accumsan vulputate non sapien. Sed et rhoncus velit. Nunc commodo augue fermentum, hendrerit neque at, ullamcorper arcu. Nulla tincidunt orci a lectus efficitur elementum. Donec molestie urna vestibulum augue placerat faucibus. In vitae orci vel mauris cursus viverra ac sit amet nisl. Phasellus odio tortor, ullamcorper eget ullamcorper eget, molestie eget justo. Integer elementum purus eget arcu fermentum tincidunt. Nullam erat tellus, dictum sit amet nisi eu, rutrum fermentum odio.</p>
		</div>
		<div class="tab-pane fade" id="sit-amet" role="tabpanel">
			<h1>Sit Amet</h1>
			
			<p>Aliquam hendrerit nunc vitae nisi efficitur, eu porta sem aliquam. Aenean tincidunt mi sed mi sodales bibendum. Proin dolor ipsum, mollis venenatis velit eu, iaculis laoreet mi. Mauris eget egestas felis, sit amet finibus nunc. Aliquam non dui sit amet erat auctor mollis ac eget ante. Quisque at quam augue. Nulla dignissim, augue nec cursus consequat, mi nulla efficitur augue, vel fringilla turpis quam eu nunc. Quisque rutrum vehicula lacus sodales molestie. Mauris vel felis sit amet erat maximus cursus ut a velit. In hac habitasse platea dictumst. Vestibulum vel neque sit amet nisl finibus fermentum.</p>
		</div>
	</div>
</div>


<div class="row">
  <div class="col-3">
    <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
      <a class="nav-link active" id="v-pills-home-tab" data-toggle="pill" href="#v-pills-home" role="tab" aria-controls="v-pills-home" aria-selected="true">Home</a>
      <a class="nav-link" id="v-pills-profile-tab" data-toggle="pill" href="#v-pills-profile" role="tab" aria-controls="v-pills-profile" aria-selected="false">Profile</a>
      <a class="nav-link" id="v-pills-messages-tab" data-toggle="pill" href="#v-pills-messages" role="tab" aria-controls="v-pills-messages" aria-selected="false">Messages</a>
      <a class="nav-link" id="v-pills-settings-tab" data-toggle="pill" href="#v-pills-settings" role="tab" aria-controls="v-pills-settings" aria-selected="false">Settings</a>
    </div>
  </div>
  <div class="col-9">
    <div class="tab-content" id="v-pills-tabContent">
      <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">...</div>
      <div class="tab-pane fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">...</div>
      <div class="tab-pane fade" id="v-pills-messages" role="tabpanel" aria-labelledby="v-pills-messages-tab">...</div>
      <div class="tab-pane fade" id="v-pills-settings" role="tabpanel" aria-labelledby="v-pills-settings-tab">...</div>
    </div>
  </div>
</div>
-->


<?php /*

<ul class="nav nav-pills nav-justified">
  <li class="nav-item">
    <a class="nav-link active" href="#">Active</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="#">Link</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="#">Link</a>
  </li>
  <li class="nav-item">
    <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
  </li>
</ul>


<ul class="nav nav-tabs">
  <li class="nav-item">
    <a class="nav-link active" href="#">Active</a>
  </li>
  <li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Dropdown</a>
    <div class="dropdown-menu">
      <a class="dropdown-item" href="#">Action</a>
      <a class="dropdown-item" href="#">Another action</a>
      <a class="dropdown-item" href="#">Something else here</a>
      <div class="dropdown-divider"></div>
      <a class="dropdown-item" href="#">Separated link</a>
    </div>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="#">Link</a>
  </li>
  <li class="nav-item">
    <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
  </li>
</ul>

*/ ?>
