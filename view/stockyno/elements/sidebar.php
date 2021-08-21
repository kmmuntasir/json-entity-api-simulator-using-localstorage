<!-- Sidebar -->
<nav id="sidebar">
	<ul id="sidebar_main_links" class="list-unstyled components">
		<li <?php if ($page == 'dashboard') echo 'class="active"'; ?>>
			<button class="a" data-href="<?php echo site_url('/dashboard'); ?>">
                <span class="sidebar-link-icon">
                    <i class="fas fa-tachometer-alt"></i>
                </span>
				Dashboard
			</button>
		</li><!-- li end -->
		<li <?php if ($page == 'category') echo 'class="active"'; ?>>
			<button class="a" data-href="<?php echo site_url('/category'); ?>">
                <span class="sidebar-link-icon">
                    <i class="fas fa-sitemap"></i>
                </span>
				Category
			</button>
		</li><!-- li end -->
		<li <?php if ($page == 'subcategory') echo 'class="active"'; ?>>
			<button class="a" data-href="<?php echo site_url('/subcategory'); ?>">
                <span class="sidebar-link-icon">
                    <i class="fas fa-sitemap"></i>
                </span>
				Subcategory
			</button>
		</li><!-- li end -->
		<li <?php if ($page == 'post') echo 'class="active"'; ?>>
			<button class="a" data-href="<?php echo site_url('/post'); ?>">
                <span class="sidebar-link-icon">
                    <i class="fas fa-book"></i>
                </span>
				Post
			</button>
		</li><!-- li end -->
	</ul>
</nav>

<!-- Dark Overlay element -->
<div class="overlay"></div>
