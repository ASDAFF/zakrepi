<?
require($_SERVER['DOCUMENT_ROOT'].'/bitrix/header.php');
$APPLICATION->SetTitle('Личный кабинет');
?>
<?if(!$USER->IsAuthorized()):
    header("Location: /personal/");
    exit();
endif;?>
    <?
        $rsUser = CUser::GetByID($USER->GetID());
        $arUser = $rsUser->Fetch();

        /*address*/
        CModule::IncludeModule("useraddress");
        $default_address = CUserAddress::getAddressDefault($USER->GetID());
		if(!empty($default_address)){
			$address = 'г. '.$default_address['CITY'].', ул. '.$default_address['STREET'].' '.$default_address['HOME'];
			if($default_address['HOUSING']!='')
				$address .= ', корп. '.$default_address['HOUSING'];
			if($default_address['FLAT']!='')
				$address .= ', кв. '.$default_address['FLAT'];
		}else{
			$address = 'N';
		}
        /*end address*/
    ?>
    <h1 class="page-title">Личный кабинет</h1>
   <?
        $arGroups = $USER->GetUserGroupArray();
        $uGroup = 'fiz';
        foreach($arGroups as $group)
        {
            if($group == 6) // Юр лицо
            {
                $uGroup = 'ur';
            }
            if($group == 5) //Физ лицо
            {
                 $uGroup = 'fiz';
            }
        }
        if( $uGroup == 'fiz')
        {
            ?>
            <p class="page-note-text">Здравствуйте, <b><?=$USER->GetFullName()?></b>, добро пожаловать в Ваш личный кабинет!</p>
            <?
        }
         if( $uGroup == 'ur')
        {
            $rsUser = CUser::GetList(($by="ID"), ($order="desc"), array("ID"=>$USER->GetID()),array("SELECT"=>array("UF_CONTACT_MANAGER")));
            $arUser = $rsUser->Fetch();
            ?>
            <p class="page-note-text">Здравствуйте, <b><?=$arUser['UF_CONTACT_MANAGER']?></b>, добро пожаловать в Ваш личный кабинет!</p>
            <?
        }
   ?>
    
<?/*orders*/?>
<div class="base-card">
   <?$APPLICATION->IncludeComponent(
		"zakrepi:sale.personal.order.list",
		"list-order",
		Array(
			"ACTIVE_DATE_FORMAT" => "d.m.Y",
			"CACHE_GROUPS" => "Y",
			"CACHE_TIME" => "3600",
			"CACHE_TYPE" => "A",
			"COMPONENT_TEMPLATE" => ".default",
			"HISTORIC_STATUSES" => array(""),
			"ID" => $ID,
			"NAV_TEMPLATE" => "",
			"ORDERS_PER_PAGE" => "2",
			"PATH_TO_BASKET" => "",
			"PATH_TO_CANCEL" => "",
			"PATH_TO_COPY" => "",
			"PATH_TO_DETAIL" => "/personal/account/orders/detail.php",
			"SAVE_IN_SESSION" => "Y",
			"SET_TITLE" => "Y",
			"STATUS_COLOR_F" => "gray",
			"STATUS_COLOR_N" => "green",
			"STATUS_COLOR_O" => "gray",
			"STATUS_COLOR_P" => "yellow",
			"STATUS_COLOR_PSEUDO_CANCELLED" => "red",
			"STATUS_COLOR_W" => "gray"
		)
	);?>
</div>
<?/*end orders*/?>

<?/*personal*/?>
<div class="row h-boxes lk-boxes">
    <div class="col l4">
        <div class="base-card">
            <div class="title big-text">Личные данные</div>
            <div class="card-content no-g-padding">
                <p class="medium-text"><?=$USER->GetFullName()?></p>
                <p><?=$arUser['EMAIL']?></p>
                <p><?=$arUser['PERSONAL_PHOTO']?></p>
            </div>
            <div class="link-box">
                <p><a href="/personal/account/update/">Изменить личные данные</a></p>
                <?/*
                <p><a href="/personal/account/password/">Изменить пароль</a></p>
                */?>
            </div>
        </div>
    </div>
    <div class="col l4">
        <div class="base-card">
            <div class="title big-text">Адресная книга</div>
            <div class="card-content no-g-padding">
				<?if($address!='N'){?>
					<p class="color-text text-light">Адрес по умолчанию</p>
					<p class="medium-text">
						<?=$address?>
					</p>
				<?}else{?>
					<p class="color-text text-light">Ваша адресная книга пуста</p>
					<p class="color-text text-light">В адресную книгу Вы можете добавить несколько адресов для доставки</p>
				<?}?>
            </div>
            <div class="link-box">
				<?if($address!='N'){?>
					<p><a href="/personal/address/">Изменить адрес по умолчанию</a></p>
				<?}?>
                <p><a href="/personal/address/add/">Добавить новый адрес</a></p>
            </div>
        </div>
    </div>

    <?if( $uGroup == 'fiz')/*физ лицо*/
        {/*
            ?>
             <div class="col l4">
                <div class="base-card">
                    <div class="title big-text">Рассылка новостей</div>
                    <div class="card-content no-g-padding">
                        <p class="medium-text">Вы не подписаны ни на одну рассылку новостей</p>
                    </div>
                    <div class="link-box">
                        <p><a href="#">Настроить рассылку</a></p>
                    </div>
                </div>
            </div>
            <?*/
        }
         if( $uGroup == 'ur')/**юр лицо*/
        {
            ?>
            <div class="col l4">
                <div class="base-card">
                    <div class="title big-text">Ваш менеджер</div>
                    <div class="card-content no-g-padding">
                        <p class="medium-text">Екатерина Иванова</p>
                        <p><a href="mailto:#">e.ivanova@zakrepi.ru</a></p>
                        <p>+7 (922) 123-45-67</p>
                    </div>
                </div>
            </div>
            <?
        }
    ?>
</div>
<?/*end personal*/?>

<?
require($_SERVER['DOCUMENT_ROOT'].'/bitrix/footer.php');
?>