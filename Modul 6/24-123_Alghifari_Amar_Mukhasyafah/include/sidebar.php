<nav id="sidebar" class="sticky">
<div class="custom-menu">
	<button type="button" id="sidebarCollapse" style="z-index: 100;" class="btn btn-primary">
		<i class="fa fa-bars"></i>
		<span class="sr-only">Toggle Menu</span>
	</button>
</div>
	<div class="p-4">
		<h1><a href="index.html" class="logo">Pengelola <span>Pengelolaan Master Detail</span></a></h1>
	<ul class="list-unstyled components mb-5">
		<li class=<?= isset($active) && $active == "pelanggan" ? "active" : "" ?>>
			<a href="./pelanggan.php"><span class="fa fa-user mr-3"></span> Pelanggan</a>
		</li>
		<li class=<?= isset($active) && $active == "transaksi" ? "active" : "" ?>>
			<a href="./transaksi.php"><span class="fa fa-money mr-3"></span> Transaksi</a>
		</li>
		<li class=<?= isset($active) && $active == "" ? "active" : "" ?>>
			<a href="#"><span class="fa fa-car mr-3"></span> supplier</a>
		</li>
		<li class=<?= isset($active) && $active == "" ? "active" : "" ?>>
			<a href="#"><span class="fa fa-square mr-3"></span> Barang</a>
		</li>
	</ul>
	</div>
</nav>