<?php /*
<fusedoc>
	<responsibilities>
		pagination needs {$arguments['pagination']['recordCount']} at least
	</responsibilities>
	<io>
		<in>
			<number name="page" scope="$arguments" optional="yes" default="1" />
			<structure name="pagination" scope="$arguments">
				<number name="recordCount" />
				<number name="recordPerPage" optional="yes" default="10" />
				<number name="pageVisible" optional="yes" default="999" />
			</structure>
		</in>
		<out />
	</io>
</fusedoc>
*/
if ( isset($arguments['pagination']) ) :
	// current page
	$arguments['page'] = !empty($arguments['page']) ? $arguments['page'] : 1;
	// param default
	$arguments['pagination']['recordPerPage'] = !empty($arguments['pagination']['recordPerPage']) ? $arguments['pagination']['recordPerPage'] : 10;
	$arguments['pagination']['pageVisible'] = !empty($arguments['pagination']['pageVisible']) ? $arguments['pagination']['pageVisible'] : 999;
	// calculate number of pages
	$page_count = ceil( $arguments['pagination']['recordCount'] / $arguments['pagination']['recordPerPage'] );
	// calculate visible pages
	$visible_start = max($arguments['page'] - ceil(($arguments['pagination']['pageVisible']-1)/2), 1);
	if ( $visible_start > ($page_count - $arguments['pagination']['pageVisible'] + 1) ) {
		$visible_start = $page_count - $arguments['pagination']['pageVisible'] + 1;
	}
	$visible_start = max($visible_start, 1);
	$visible_end = min($arguments['page'] + ceil(($arguments['pagination']['pageVisible']-1)/2), $page_count);
	if ( $visible_end < $arguments['pagination']['pageVisible'] ) {
		$visible_end = $arguments['pagination']['pageVisible'];
	}
	$visible_end = min($visible_end, $page_count);
	// calculate prev & next batch
	$prev_batch = max($arguments['page'] - $arguments['pagination']['pageVisible'], 1);
	$next_batch = min($arguments['page'] + $arguments['pagination']['pageVisible'], $page_count);
	if ( $prev_batch == $visible_start ) unset($prev_batch);
	if ( $next_batch == $visible_end   ) unset($next_batch);
	// preserve all url params except current page
	$url_without_page = $_SERVER['REQUEST_URI'];
	$url_without_page = str_ireplace("&page={$arguments['page']}", '', $url_without_page);
	$url_without_page = str_ireplace("?page={$arguments['page']}", '', $url_without_page);
	// display
	if ( $visible_end > 1 ) :
		?><ul class="pagination">
			<!-- FIRST -->
			<?php if ( $arguments['page'] > 1 ) : ?>
				<li class="page-item first"><a class="page-link" href="<?php echo "{$url_without_page}&amp;page=1"; ?>">&laquo; First</a></li>
			<?php else : ?>
				<li class="page-item first disabled"><a class="page-link">&laquo; First</a></li>
			<?php endif; ?>
			<!-- PREV -->
			<?php if ( $arguments['page'] > 1 ) : ?>
				<?php $prev = $arguments['page'] - 1; ?>
				<li class="page-item prev"><a class="page-link" href="<?php echo "{$url_without_page}&amp;page={$prev}"; ?>">&lsaquo; Prev</a></li>
			<?php else : ?>
				<li class="page-item prev disabled"><a class="page-link">&lsaquo; Prev</a></li>
			<?php endif; ?>
			<!-- ... -->
			<?php if ( !empty($prev_batch) ) : ?>
				<li class="page-item prev-batch">
					<a class="page-link" href="<?php echo "{$url_without_page}&amp;page={$prev_batch}"; ?>">...</a>
				</li>
			<?php endif; ?>
			<!-- PAGE -->
			<?php for ($i=$visible_start; $i<=$visible_end; $i++ ) : ?>
				<?php $selected = ( !empty($arguments['page']) and $arguments['page'] == $i ); ?>
				<li class="page-item page-<?php echo $i; ?> <?php if ( $selected ) echo 'active'; ?>">
					<?php if ( $selected ) : ?>
						<a class="page-link"><?php echo $i; ?></a>
					<?php else : ?>
						<a class="page-link" href="<?php echo "{$url_without_page}&amp;page={$i}"; ?>"><?php echo $i; ?></a>
					<?php endif; ?>
				</li>
			<?php endfor; ?>
			<!-- ... -->
			<?php if ( !empty($next_batch) ) : ?>
				<li class="page-item next-batch">
					<a class="page-link" href="<?php echo "{$url_without_page}&amp;page={$next_batch}"; ?>">...</a>
				</li>
			<?php endif; ?>
			<!-- NEXT -->
			<?php if ( $arguments['page'] < $page_count ) : ?>
				<?php $next = $arguments['page'] + 1; ?>
				<li class="page-item next"><a class="page-link" href="<?php echo "{$url_without_page}&amp;page={$next}"; ?>">Next &rsaquo;</a></li>
			<?php else : ?>
				<li class="page-item next disabled"><a class="page-link">Next &rsaquo;</a></li>
			<?php endif; ?>
			<!-- LAST -->
			<?php if ( $arguments['page'] < $page_count ) : ?>
				<li class="page-item last"><a class="page-link" href="<?php echo "{$url_without_page}&amp;page={$page_count}"; ?>">Last &raquo;</a></li>
			<?php else : ?>
				<li class="page-item last disabled"><a class="page-link">Last &raquo;</a></li>
			<?php endif; ?>
		</ul><?php
	endif; // if-visible-end
endif; // if-has-pagination

