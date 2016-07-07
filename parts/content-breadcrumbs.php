<?php
/* Requires https://wordpress.org/plugins/breadcrumb-navxt/ */
?>
<nav aria-label="You are here:" role="navigation">
	<ul class="breadcrumbs" typeof="BreadcrumbList" vocab="http://schema.org/">
	    <?php if(function_exists('bcn_display_list'))
	    {
	        bcn_display_list();
	    }?>
	</ul>
</nav>