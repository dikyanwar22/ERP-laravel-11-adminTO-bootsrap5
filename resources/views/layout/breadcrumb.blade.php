
<?php
$db = new Illuminate\Support\Facades\DB;
$request = app('request');
?>
<section class="content-header">
  <ol class="breadcrumb" style="padding-top: 2%;">
    <li><a href="#"><i class="fa fa-home"></i> <?= str_replace('_', ' ', $request->segment(1)); ?></a></li>
    <li><a href="#"><?= str_replace('_', ' ', $request->segment(2)); ?></a></li>
    <?php if($request->segment(3) != '') : ?>
    <li class="active"><?= str_replace('_', ' ', $request->segment(3)); ?></li>
    <?php endif; ?>
  </ol>
</section>
<div style="margin-top: 5%;"></div>
