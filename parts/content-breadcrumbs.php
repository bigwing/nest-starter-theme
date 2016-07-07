<?php
/* Requires https://wordpress.org/plugins/breadcrumb-navxt/ */
?>
<?php if(function_exists('bcn_display_list')): ?>
<nav aria-label="You are here:" role="navigation">
	<ul class="breadcrumbs" typeof="BreadcrumbList" vocab="http://schema.org/">
	    <?php bcn_display_list(); ?>
	</ul>
</nav>
<?php endif; ?>