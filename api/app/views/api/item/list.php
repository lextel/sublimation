<div data-role="navbar" class="sort-bar ui-navbar" role="navigation">
    <ul class="ui-grid-c">
        <?php
            $blockClass = ['a', 'b', 'c', 'd'];
            foreach (ItemClass::$sort as $key => $item) {
                $activeClass = '';
                if($alias == $item['alias']) $activeClass = ' ui-btn-active';
                if(is_array($item['sort'])) $sort = $sort == 'desc' ? 'asc' : 'desc';

                echo "<li class='ui-block-{$blockClass[$key]}'>" .
                     "<a href='SERVER/m?alias={$item['alias']}&sort={$sort}' class='ui-link ui-btn {$activeClass}'>{$item['name']}</a>".
                     "</li>";
            }

        ?>
    </ul>
</div>
<div class="product-list" data-inset="true" data-role="listview">
    <?php 
    if(!empty($lists)):
    foreach($lists as $item): 
    ?>
    <div class="item">
        <div class="img-md fl">
            <span class="img-wide"><a href="" class="ui-link"><img src="<?php echo URL::to('http://192.168.3.10/image/400x400/'.$item['image'])?>" alt="<?php echo $item['title']; ?>"></a></span>
        </div>
        <div class="info-wrap fr">
            <div class="title"><?php echo $item['title']; ?></div>
            <div class="price">价值：￥<?php echo sprintf('%.2f', $item['cost']); ?></div>
            <div class="inner-wide">
                <div class="progress-wrap fl">
                    <div class="progress">
                        <div class="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $item['joined']/$item['amount'] * 100; ?>%;"></div>
                    </div>
                    <div class="row number-wrap">
                        <span class="fl"><?php echo $item['joined']; ?></span>
                        <span class="fr"><?php echo $item['remain']; ?></span>
                    </div>
                    <div class="row word-wrap">
                        <span class="fl">已参与人次</span>
                        <span class="fr">剩余人次</span>
                    </div>
                </div>
                <div class="addCart fr">
                    <button href="#" class="icon-cart ui-btn ui-shadow ui-corner-all"></button>
                </div>
            </div>
        </div>
    </div>
    <?php 
    endforeach; 
    else:
    echo '<div class="noitem">没有商品</div>';
    endif;
    ?>
</div>
