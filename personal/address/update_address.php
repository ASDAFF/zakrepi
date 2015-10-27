<?
require($_SERVER['DOCUMENT_ROOT'].'/bitrix/header.php');
$APPLICATION->SetTitle('Личный кабинет');
?>
<?if(!$USER->IsAuthorized()):
    header("Location: /personal/");
    exit();
endif;

CModule::IncludeModule("useraddress");

$id = $_GET['id'];
$dbAddress = CUserAddress::getAddressId($id);

$id_user = $USER->GetID();

$dbUserAddress = CUserAddress::getAddressUser($id_user);
$count = count($dbUserAddress);

$maxCountAddress =  COption::GetOptionString('useraddress', 'zCount', 6);

$ok = (isset($dbAddress[0])) ? 'Y' : 'N';
$CURRENT_PAGE = (CMain::IsHTTPS()) ? "https://" : "http://";

/*echo '<pre>';
print_r($_SERVER);
echo '</pre>';*/
$SERVER_PORT = $_SERVER['SERVER_PORT'];
if($ok == 'N'):
    LocalRedirect("".$CURRENT_PAGE.$_SERVER['SERVER_NAME'].":".$SERVER_PORT."/personal/address/");
endif;

if($count >= IntVal($maxCountAddress) || $dbAddress[0]['ID_USER'] != $id_user):
    LocalRedirect("".$CURRENT_PAGE.$_SERVER['SERVER_NAME'].":".$SERVER_PORT."/personal/address/");
endif;


?>
    <div class="breadcrumbs">
        <a href="/personal/address/">Вернуться в адресную книгу</a>
    </div>
    <h1 class="page-title">Добавить новый адрес</h1>
    <div class="row address-book">
        <form method="POST" action="/personal/address/">
            <input type="hidden" name="ID" value="<?=$dbAddress[0]['ID']?>">
            <input type="hidden" name="ID_USER" value="<?=$id_user?>">
            <div class="col l7">
                <div class="base-card address-form">
                    <div class="table-field">
                        <span class="label">Город / Поселок / Деревня</span>
                        <div class="field">
                            <input type="text" id="addr-city" <?if($dbAddress[0]['CITY'] != ''):?> class="dirty" <?endif;?> name="CITY" value="<?=$dbAddress[0]['CITY']?>"/><label for="addr-city" class="textfield-placeholder">Например: Тюмень</label>
                        </div>
                    </div>
                    <div class="table-field">
                        <span class="label">Улица </span>
                        <div class="field">
                            <input type="text" id="addr-street" <?if($dbAddress[0]['STREET'] != ''):?> class="dirty" <?endif;?> name="STREET" value="<?=$dbAddress[0]['STREET']?>"/><label for="addr-street" class="textfield-placeholder">Например: Мельникайте</label>
                        </div>
                    </div>
                    <div class="table-field cols-3">
                        <span class="label">Дом / Корпус / Квартира</span>
                        <div class="field"><input type="text" <?if($dbAddress[0]['HOME'] != ''):?> class="dirty" <?endif;?> id="addr-dom" name="HOME" value="<?=$dbAddress[0]['HOME']?>"/><label for="addr-dom" class="textfield-placeholder">Дом</label></div>/
                        <div class="field"><input type="text" <?if($dbAddress[0]['HOUSING'] != ''):?> class="dirty" <?endif;?> id="addr-korp" name="HOUSING" value="<?=$dbAddress[0]['HOUSING']?>"/><label for="addr-korp" class="textfield-placeholder">Корпус</label></div>/
                        <div class="field"><input type="text" <?if($dbAddress[0]['FLAT'] != ''):?> class="dirty" <?endif;?> id="addr-kv" name="FLAT" value="<?=$dbAddress[0]['FLAT']?>"/><label for="addr-kv" class="textfield-placeholder">Квартира</label></div>
                    </div>
                    <?if($count == 1):?>
                        <input type="hidden" name="DEFAULT_ADDRESS" value="Y">
                    <?else:?>
                        <p class="def-addr">
                            <input type="checkbox" id="default-addr" name="DEFAULT_ADDRESS"/>
                            <label class="checkbox-lbl" for="default-addr">Адрес по умолчанию</label>
                        </p>
                    <?endif;?>
                </div>
                <input type="submit" class="btn primary fullwidth big" name="UPDATE" value="Изменить адрес"/>
            </div>
        </form>
    </div>
<?
require($_SERVER['DOCUMENT_ROOT'].'/bitrix/footer.php');
?>