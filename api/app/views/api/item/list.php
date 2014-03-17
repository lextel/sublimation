    <?php 
    if(!empty($lists)):
    ?>
    <?php
    foreach($lists as $item): 
    ?>
    <div class="item">
        <div class="img-md fl">
            <span class="img-wide"><a href="" class="ui-link"><img src="<?php echo URL::to('http://www.llt.com/image/400x400/'.$item['image'])?>" alt="<?php echo $item['title']; ?>"></a></span>
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
    ?>
    <div class="iscroll-pullup">
        <span class="iscroll-pull-icon"></span>
        <span class="iscroll-pull-label"  data-iscroll-pulled-text="加载中..." data-iscroll-loading-text="上拉刷新" >上拉刷新</span>
    </div>
    <?php
    else:
    echo '没有商品';
    endif;
    ?>
