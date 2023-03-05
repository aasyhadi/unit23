<!-- sidebar menu -->
<?php
	$segment =  Request::segment(2);
	$sub_segment =  Request::segment(3);
?>
<div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
	<div class="menu_section">
		<?php
			// SUPER ADMIN //
			if ($userinfo['user_level_id'] == 1):
		
		?>
        <h3>General</h3>
		<ul class="nav side-menu">
			<li class="{{ ($segment == 'dashboard' ? 'active' : '') }}">
				<a href="<?=url('backend/dashboard');?>"><i class="fa fa-dashboard"></i> Dashboard</a>
			</li>
			<li class=" {{ ((($segment == 'setting') || ($segment == 'modules') || ($segment == 'access-control')) ? 'active' : '') }}">
				<a><i class="fa fa-cog"></i> System Admin <span class="fa fa-chevron-down"></span></a>
				<ul class="nav child_menu" style="{{ ((($segment == 'setting') || ($segment == 'modules') || ($segment == 'access-control')) ? 'display : block' : '') }}">
					
					
					<li class="{{ ($segment == 'setting' ? 'active' : '') }}">
						<a href="<?=url('backend/setting');?>">Setting</a>
					</li>
					<li class="{{ ($segment == 'modules' ? 'active' : '') }}">
						<a href="<?=url('backend/modules');?>">Modules</a>
					</li>
					<li class="{{ ($segment == 'access-control' ? 'active' : '') }}">
						<a href="<?=url('backend/access-control');?>">Access Control</a>
					</li>
				</ul>
            </li>
			<li class=" {{ ((($segment == 'users-level') || ($segment == 'users-user')) ? 'active' : '') }}">
				<a><i class="fa fa-users"></i> Membership <span class="fa fa-chevron-down"></span></a>
				<ul class="nav child_menu" style="{{ ((($segment == 'users-level') || ($segment == 'users-user')) ? 'display : block' : '') }}">
					<li class="{{ ($segment == 'users-level' ? 'active' : '') }}">
						<a href="<?=url('backend/users-level');?>">Master User Level</a>
					</li>
					<li class="{{ ($segment == 'users-user' ? 'active' : '') }}">
						<a href="<?=url('backend/users-user');?>">Master User</a>
					</li>
				</ul>
			</li>
		</ul>
		<?php
			endif;
			if ($userinfo['user_level_id'] <> 4):
		?>
    </div>
	
	<div class="menu_section">
        <h3>Master</h3>
		<ul class="nav side-menu">
			<li class="{{ ($segment == 'supplier' ? 'active' : '') }}">
				<a href="<?=url('backend/supplier');?>"><i class="fa fa-suitcase"></i> Master Supplier</a>
            </li>
			<li class="{{ ($segment == 'barang' ? 'active' : '') }}">
				<a href="<?=url('backend/barang');?>"><i class="fa fa-file"></i> Master Barang</a>
            </li>
			<li class="{{ ($segment == 'media-library' ? 'active' : '') }}">
				<a href="<?=url('backend/media-library');?>"><i class="fa fa-picture-o"></i> Media Library</a>
            </li>
			<?php
				// SUPER ADMIN & ADMIN //
				endif;
				if ($userinfo['user_level_id'] == 1 or $userinfo['user_level_id'] == 2):
			?>
			<li class="{{ ($segment == 'koreksi-stok' ? 'active' : '') }}">
                <a href="<?=url('backend/koreksi-stok');?>"><i class="fa fa-cogs"></i> Koreksi Stok</a>
            </li>
			<?php
				endif;
				if ($userinfo['user_level_id'] <> 4):
			?>
        <ul>
    </div>
	<div class="menu_section">
        <h3>Transaksi</h3>
		<ul class="nav side-menu">
			<li class="{{ ($segment == 'inden' ? 'active' : '') }}">
				<a href="<?=url('backend/inden');?>"><i class="fa fa-shopping-cart"></i> Daftar Inden</a>
			</li>
			<li class="{{ ($segment == 'purchase-order' ? 'active' : '') }}">
				<a href="<?=url('backend/purchase-order');?>"><i class="fa fa-shopping-cart"></i> Pembelian / PO</a>
			</li>

			<li class=" {{ ((($segment == 'penjualan') || ($segment == 'penjualan-barcode')) ? 'active' : '') }}">
				<a><i class="fa fa-gift"></i> Penjualan Barang<span class="fa fa-chevron-down"></span></a>
				<ul class="nav child_menu" style="{{ ((($segment == 'penjualan') || ($segment == 'penjualan-barcode')) ? 'display : block' : '') }}">
					<li class="{{ ($segment == 'penjualan' ? 'active' : '') }}">
						<a href="<?=url('backend/penjualan');?>"> Reguler</a>
					</li>
					<li class="{{ ($segment == 'penjualan-barcode' ? 'active' : '') }}">
						<a href="<?=url('backend/penjualan-barcode');?>"> Barcode</a>
					</li>
				</ul>
			</li>

			<li class="{{ ($segment == 'penjualan-umkm' ? 'active' : '') }}">
				<a href="<?=url('backend/penjualan-umkm');?>"><i class="fa fa-certificate"></i> Penjualan UMKM</a>
            </li>
			<?php
				// SUPER ADMIN & ADMIN //
				endif;
				if ($userinfo['user_level_id'] == 1 or $userinfo['user_level_id'] == 2):
			?>
			<li class="{{ ($segment == 'pengeluaran' ? 'active' : '') }}">
				<a href="<?=url('backend/pengeluaran');?>"><i class="fa fa-credit-card-alt"></i> Biaya Pengeluaran</a>
            </li>
			<?php
				endif;
			?>
        <ul>
    </div>
	<div class="menu_section">
        <h3>Laporan</h3>
		<ul class="nav side-menu">
			<li class=" {{ ((($segment == 'report-purchase') || ($segment == 'report-penjualan') || ($segment == 'report-umkm') || ($segment == 'report-kategori') || ($segment == 'report-stok')) ? 'active' : '') }}">
				<a><i class="fa fa-bar-chart-o"></i> Laporan <span class="fa fa-chevron-down"></span></a>
				<ul class="nav child_menu" style="{{ ((($segment == 'report-purchase') || ($segment == 'report-penjualan') || ($segment == 'report-umkm') || ($segment == 'report-kategori') || ($segment == 'report-stok')) ? 'display : block' : '') }}">
					<li class="{{ ($segment == 'report-purchase' ? 'active' : '') }}">
						<a href="<?=url('backend/report-purchase');?>">Pembelian / PO</a>
					</li>
					<li class="{{ ($segment == 'report-penjualan' ? 'active' : '') }}">
						<a href="<?=url('backend/report-penjualan');?>">Penjualan Barang</a>
                    </li>
					<li class="{{ ($segment == 'report-umkm' ? 'active' : '') }}">
						<a href="<?=url('backend/report-umkm');?>">Penjualan UMKM</a>
                    </li>
					<li class="{{ ($segment == 'report-kategori' ? 'active' : '') }}">
						<a href="<?=url('backend/report-rekap-penjualan');?>">Penjualan Kategori</a>
                    </li>
					<li class="{{ ($segment == 'report-stok' ? 'active' : '') }}">
						<a href="<?=url('backend/report-stok');?>">Stok Barang</a>
					</li>
				</ul>
			</li>

			<?php
				// SUPER ADMIN & ADMIN //
				if ($userinfo['user_level_id'] == 1 || $userinfo['user_level_id'] == 2 || $userinfo['user_level_id'] == 4):
			?>
			<li class=" {{ ((($segment == 'rekap-penerimaan') || ($segment == 'rekap-pengeluaran')) ? 'active' : '') }}">
				<a><i class="fa fa-pie-chart"></i> Rekapan <span class="fa fa-chevron-down"></span></a>
				<ul class="nav child_menu" style="{{ ((($segment == 'rekap-penerimaan') || ($segment == 'rekap-pengeluaran')) ? 'display : block' : '') }}">
					<li class="{{ ($segment == 'rekap-penerimaan' ? 'active' : '') }}">
						<a href="<?=url('backend/rekap-penerimaan');?>">Penerimaan</a>
                    </li>
					<li class="{{ ($segment == 'rekap-pengeluaran' ? 'active' : '') }}">
						<a href="<?=url('backend/rekap-pengeluaran');?>">Pengeluaran</a>
					</li>
				</ul>
			</li>
			<?php
				endif;
			?>
			
        <ul>
    </div>

</div>

