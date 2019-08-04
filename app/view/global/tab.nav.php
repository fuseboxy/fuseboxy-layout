<?php /*
<fusedoc>
	<io>
		<in>
			<structure name="$tabLayout">
				<string name="style" comments="tab|pill" />
				<string name="position" comments="left|right|top|bottom" />
				<number name="navWidth" comments="1 ~ 12" />
				<string name="header" optional="yes" />
				<string name="footer" optional="yes" />
				<array name="nav">
					<structure name="+">
						<string name="name" />
						<string name="url" />
						<string name="navHeader" />
						<string name="remark" />
						<structure name="button" comments="single button only">
							<string name="~buttonName~" value="~buttonURL~" />
						</structure>
						<array name="menus">
							<structure name="+">
								<string name="name" />
								<string name="url" />
								<string name="navHeader" />
								<string name="remark" />
								<string name="divider" comments="before|after" />
								<string name="className" />
							</structure>
						</array>
						<boolean name="active" />
						<string name="className" />
					</structure>
				</array>
			</structure>
		</in>
		<out />
	</io>
</fusedoc>
*/
// class combination for nav
$tabNavClass = "nav nav-{$tabLayout['style']}s ";
if ( !empty($tabLayout['justify']) ) {
	$tabNavClass .= "nav-justified ";
}
if ( $tabLayout['position'] == 'left' or $tabLayout['position'] == 'right' ) {
	$tabNavClass .= "nav-stacked col-sm-{$tabLayout['navWidth']} ";
}
if ( $tabLayout['position'] == 'right' ) {
	$tabNavClass .= 'pull-right ';
}

// quick fix for tab nav
$tabNavStyle = "margin-bottom: 1em;";
if ( $tabLayout['style'] == 'tab' ) {
	$tabNavStyle .= 'margin-left: -1px; margin-right: -1px; padding-right: 0;';
}
?>


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


<ul class="<?php echo $tabNavClass; ?>" style="<?php echo $tabNavStyle; ?>">
	<!-- nav : header -->
	<?php if ( !empty($tabLayout['header']) ) : ?>
		<li class="tab-header"><?php echo $tabLayout['header']; ?><br /></li>
	<?php endif; ?>
	<!-- nav : tabs -->
	<?php if ( !empty($tabLayout['nav']) ) : ?>
		<?php foreach ( $tabLayout['nav'] as $i => $tab ) : ?>
			<?php if ( !empty($tab['navHeader']) ) : ?>
				<li class="nav-header">
					<?php if ( $i != 0 ) : ?><br /><?php endif; ?>
					<h6 class="text-muted"><?php echo $tab['navHeader']; ?></h6>
				</li>
			<?php endif; ?>
			<!-- menu item -->
			<?php
				$itemClass = array('nav-item');
				if ( !empty($tab['active'])   ) $itemClass[] = 'active';
				if ( !empty($tab['menus'])    ) $itemClass[] = 'dropdown';
				if ( isset($tab['className']) ) $itemClass[] = $tab['className'];
			?>
			<li class="<?php echo implode(' ', $itemClass); ?>">
				<!-- show drop-down then url -->
				<?php
					$linkClass = array('nav-link');
					if ( !empty($tab['menus']) ) $linkClass = 'dropdown-toggle';
				?>
				<a 
					class="<?php echo implode(' ', $linkClass); ?>"
					<?php if ( !empty($tab['menus']) ) : ?>
						href="#"
						data-toggle="dropdown"
						role="button"
						aria-haspopup="true"
						aria-expanded="false"
					<?php elseif ( !empty($tab['url']) ) : ?>
						href="<?php echo $tab['url']; ?>"
					<?php endif; ?>
				>
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
					<!-- tab name -->
					<span><?php echo $tab['name']; ?></span>
					<!-- tab remark -->
					<?php if ( !empty($tab['remark']) ) : ?>&nbsp;<em class='text-muted'>(<?php echo $tab['remark']; ?>)</em><?php endif; ?>
					<!-- arrow for dropdown -->
					<?php if ( !empty($tab['menus']) ) : ?>
						<span class="caret"></span>
					<?php endif; ?>
				</a>
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
			</li>
		<?php endforeach; ?>
	<?php endif; ?>
	<!-- nav : footer -->
	<?php if ( !empty($tabLayout['footer']) ) : ?>
		<li class="tab-footer"><br /><?php echo $tabLayout['footer']; ?></li>
	<?php endif; ?>
</ul>