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
				<boolean name="allowShowAll" optional="yes" default="true" />
			</structure>
			<boolean name="showAll" scope="$arguments" optional="yes" />
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
	$arguments['pagination']['pageVisible']   = !empty($arguments['pagination']['pageVisible'])   ? $arguments['pagination']['pageVisible']   : 999;
	$arguments['pagination']['allowShowAll']  = $arguments['pagination']['allowShowAll'] ?? true;
	// calculate number of pages
	$page_count = ceil( $arguments['pagination']['recordCount'] / $arguments['pagination']['recordPerPage'] );
	if ( !empty($arguments['showAll']) ) $page_count = 1;
	// calculate visible pages
	$visible_start = max($arguments['page'] - ceil(($arguments['pagination']['pageVisible']-1)/2), 1);
	$visible_start = min($visible_start, ($page_count - $arguments['pagination']['pageVisible'] + 1));
	$visible_start = max($visible_start, 1);
	$visible_end = min($arguments['page'] + ceil(($arguments['pagination']['pageVisible']-1)/2), $page_count);
	$visible_end = max($visible_end, $arguments['pagination']['pageVisible']);
	$visible_end = min($visible_end, $page_count);
	// calculate prev & next batch
	$prev_batch = max($arguments['page'] - $arguments['pagination']['pageVisible'], 1);
	$next_batch = min($arguments['page'] + $arguments['pagination']['pageVisible'], $page_count);
	if ( $prev_batch == $visible_start ) unset($prev_batch);
	if ( $next_batch == $visible_end   ) unset($next_batch);
	// prepare clean url
	// ===> preserve all url params except current page
	// ===> remove show-all flag (when necessary)
	parse_str($_SERVER['QUERY_STRING'], $qs);
	if ( isset($qs['page']) ) unset($qs['page']);
	if ( isset($arguments['showAll']) and isset($qs['showAll']) ) unset($qs['showAll']);
	$url_without_page = empty($qs) ? $fusebox->self : ($fusebox->self.'?'.http_build_query($qs));
	// display
	?><div id="pagination" class="mt-4"><?php
		if ( $visible_end > 1 ) :
			// pagination (if multiple pages)
			?><ul class="pagination float-left"><?php
				// first
				if ( $arguments['page'] > 1 ) :
					$url2go = $url_without_page.( ( strpos($url_without_page, '?') === false ) ? '?' : '&' ).'page=1';
					?><li class="page-item first"><a class="page-link" href="<?php echo $url2go; ?>">&laquo; First</a></li><?php
				else :
					?><li class="page-item first disabled"><a class="page-link">&laquo; First</a></li><?php
				endif;
				// prev
				if ( $arguments['page'] > 1 ) :
					$prev = $arguments['page'] - 1;
					$url2go = $url_without_page.( ( strpos($url_without_page, '?') === false ) ? '?' : '&' ).'page='.$prev;
					?><li class="page-item prev"><a class="page-link" href="<?php echo $url2go; ?>">&lsaquo; Prev</a></li><?php
				else :
					?><li class="page-item prev disabled"><a class="page-link">&lsaquo; Prev</a></li><?php
				endif;
				// more (prev)
				if ( !empty($prev_batch) ) :
					$url2go = $url_without_page.( ( strpos($url_without_page, '?') === false ) ? '?' : '&' ).'page='.$prev_batch;
					?><li class="page-item prev-batch"><a class="page-link" href="<?php echo $url2go; ?>">...</a></li><?php
				endif;
				// page
				for ($i=$visible_start; $i<=$visible_end; $i++ ) :
					$selected = ( !empty($arguments['page']) and $arguments['page'] == $i );
					if ( $selected ) :
						?><li class="page-item page-<?php echo $i; ?> active"><a class="page-link"><?php echo $i; ?></a></li><?php
					else :
						$url2go = $url_without_page.( ( strpos($url_without_page, '?') === false ) ? '?' : '&' ).'page='.$i;
						?><li class="page-item page-<?php echo $i; ?>"><a class="page-link" href="<?php echo $url2go; ?>"><?php echo $i; ?></a></li><?php
					endif;
				endfor;
				// more (next)
				if ( !empty($next_batch) ) :
					$url2go = $url_without_page.( ( strpos($url_without_page, '?') === false ) ? '?' : '&' ).'page='.$next_batch;
					?><li class="page-item next-batch"><a class="page-link" href="<?php echo $url2go; ?>">...</a></li><?php
				endif;
				// next
				if ( $arguments['page'] < $page_count ) :
					$next = $arguments['page'] + 1;
					$url2go = $url_without_page.( ( strpos($url_without_page, '?') === false ) ? '?' : '&' ).'page='.$next;
					?><li class="page-item next"><a class="page-link" href="<?php echo $url2go; ?>">Next &rsaquo;</a></li><?php
				else :
					?><li class="page-item next disabled"><a class="page-link">Next &rsaquo;</a></li><?php
				endif;
				// last
				if ( $arguments['page'] < $page_count ) :
					$url2go = $url_without_page.( ( strpos($url_without_page, '?') === false ) ? '?' : '&' ).'page='.$page_count;
					?><li class="page-item last"><a class="page-link" href="<?php echo $url2go; ?>">Last &raquo;</a></li><?php
				else :
					?><li class="page-item last disabled"><a class="page-link">Last &raquo;</a></li><?php
				endif;
			?></ul><!--/.pagination--><?php
		endif; // if-multiple-pages
		// show all button (when necessary)
		if ( $arguments['pagination']['allowShowAll'] and ( $page_count > 1 or !empty($arguments['showAll']) ) ) :
			$btnLink = empty($arguments['showAll']) ? ( $url_without_page.( ( strpos($url_without_page, '?') === false ) ? '?' : '&' ).'showAll=1' ) : $url_without_page;
			$btnText = empty($arguments['showAll']) ? 'Show all' : "Show {$arguments['pagination']['recordPerPage']} per page";
			?><a href="<?php echo $btnLink; ?>" class="btn btn-primary btn-show-all border-0 ml-3"><?php echo $btnText; ?></em></a><?php
		endif;
	?></div><!--/#pagination--><?php
endif; // if-has-pagination