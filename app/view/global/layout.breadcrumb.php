<?php /*
<fusedoc>
	<io>
		<in>
			<structure name="breadcrumb" scope="$arguments">
				<string name="~label~" />
			</structure>
		</in>
		<out />
	</io>
</fusedoc>
*/
if ( isset($arguments['breadcrumb']) and $arguments['breadcrumb'] !== false ) :
	?><nav id="breadcrumb" aria-label="breadcrumb">
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="<?php echo F::url(); ?>"><i class="fa fa-home"></i></a></li><?php
			foreach ( $arguments['breadcrumb'] as $key => $val ) :
				// item with link
				if ( is_string($key) ) :
					?><li class="breadcrumb-item"><a href="<?php echo $val; ?>"><?php echo $key; ?></a></li><?php
				// item without link
				elseif ( is_numeric($key) and !empty($val) ) :
					?><li class="breadcrumb-item active" aria-current="page"><?php echo $val; ?></li><?php
				endif;
			endforeach;
		?></ol>
	</nav><?php
endif;