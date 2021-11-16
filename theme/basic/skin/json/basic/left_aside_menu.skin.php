
<?php 
    /*
        2021-06-28
        페이지 설명 : json 메뉴 스킨
    */
?>
<div id="l-aside">
    <div class="LeftmenuArea">
    <?php //echo var_dump($jsonmenus) ?>
        <?php foreach($jsonmenus as $jsonmenu){?>
            <div class="submenutitle"><?php echo $jsonmenu['title']?></div> 
            <div class="submenu">
                <ul>
                    <?php foreach($jsonmenu['items'] as $item){ ?>
                        <li class="<?php if($item['jsonName'] == $jsonName){echo "on" ;}else{ echo "off";}?>">
                            <a href="<?php echo G5_URL.'/json/json.php?jsonName='.$item['jsonName']?>" rel="nofollow">
                                <?php echo $item['title'];?>
                            </a>
                        </li>
                    <?php } ?>
                </ul>
            </div>
        <?php } ?>
    </div>
</div>