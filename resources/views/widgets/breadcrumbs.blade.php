<?php 
	use Illuminate\Support\Facades\Request as LaraRequest;
	$segments = LaraRequest::segments();
?>

<ol class="breadcrumb">

	<?php foreach ($segments as $segment) : ?>
    	<li class="breadcrumb-item"><?= ucfirst($segment) ?></li>
	<?php endforeach; ?>

</ol>