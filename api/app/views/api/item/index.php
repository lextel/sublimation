<link rel="stylesheet" href="<?php echo asset('assets/css/common.css');?>"/>
<link rel="stylesheet" href="<?php echo asset('assets/css/style.css');?>"/>
<div role='list' url='<?php echo URL::to('m/list'); ?>'>
    <div data-role="navbar" class="sort-bar ui-navbar" role="navigation">
        <ul class="ui-grid-c">
            <?php echo isset($sortList) ? $sortList : '';?>
        </ul>
    </div>
    <div class="product-list iscroll-list" data-page="<?php echo $page?>">
        <div data-role="listview"></div>
    </div>
</div>

