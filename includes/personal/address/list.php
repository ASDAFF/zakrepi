<?require($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/prolog_before.php');?>
<div class="breadcrumbs">
    <a href="/personal/account/">Вернуться в личный кабинет</a>
</div>

<h1 class="page-title">Адресная книга</h1>
<div class="row h-boxes address-book lk-boxes">
    <?
    CModule::IncludeModule("useraddress");

        $add = (isset($_POST['ADD'])) ? 'Y' : 'N';
        if($add == 'Y'){
            $res=CUserAddress::setUserAddress($_POST);
            header("Location: /personal/address/?add=".$res);
            exit();
        }
        $update = (isset($_POST['UPDATE'])) ? 'Y' : 'N';
         if($update == 'Y') {
             $res = CUserAddress::updateUserAddress($_POST);
             header("Location: /personal/address/?update=".$res);
             exit();
         }
    $addresses = CUserAddress::getAddressUser($USER->GetID());
    $maxCountAddress =  COption::GetOptionString('useraddress', 'zCount', 6);

    ?>
    <?foreach($addresses as $item){ ?>
        <div class="col l4 address-item">
            <div class="base-card">
                <div class="card-content no-g-padding">
                    <?if($item['DEFAULT_ADDRESS'] == 'Y'):?>
                        <p class="color-text text-light">Адрес по умолчанию</p>
                    <?else:?>
                        <p><button class="btn btn-icon btn-delete-addr"><svg class="icon"><use xlink:href="#cross"/></svg></button></p>
                    <?endif;?>
                    <p class="medium-text">
                        <?
                        $address = 'г. '.$item['CITY'].', ул. '.$item['STREET'].' '.$item['HOME'];
                        if($item['HOUSING']!='')
                            $address .= ', корп. '.$item['HOUSING'];
                        if($item['FLAT']!='')
                            $address .= ', кв. '.$item['FLAT'];
                        ?>
                        <?=$address;?>
                    </p>
                </div>
                <div class="link-box clearfix">
                    <a href="/personal/address/update/?id=<?=$item['ID']?>">Изменить адрес</a>
                    <?if($item['DEFAULT_ADDRESS'] == 'N'):?>
                        <a href="#" class="right">Сделать по умолчанию</a>
                    <?endif;?>
                </div>
            </div>
        </div>
    <?
    } ?>
    <?if(count($addresses) < IntVal($maxCountAddress)):?>
    <div class="col l4">
        <div class="base-card v-center">
            <a href="/personal/address/add/">Добавить новый адрес</a>
        </div>
    </div>
    <?endif;?>
</div>