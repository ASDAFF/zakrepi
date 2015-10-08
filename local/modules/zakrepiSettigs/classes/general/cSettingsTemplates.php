<?php
class cCradoBaners{
    static $MODULE_ID="cradobaners";

    /**
     * �������, ������������� �������� � ����������
     * @param $arFields
     * @return bool
     */
    static function getCradoBaners(){
       //$arResult = array();

        CModule::IncludeModule('iblock');
        global $DB;
        $result = $DB->Query('SELECT * FROM b_cradobaners');

        $arResult = array();
        $i = 0;
        while($res = $result->fetch())
        {
            $arResult[$i]['ID']=$res['ID'];
            $arResult[$i]['COUNT_CLICK']=$res['UF_COUNTCLICK'];
            $arResult[$i]['COUNT_VIEW']=$res['UF_COUNTVIEW'];
            $arResult[$i]['DATE_LAST_CLICK']=$res['UF_DATECLICK'];

            $obElement = CIBlockElement::GetByID($res['UF_IDBANERS']);
                if($arEl = $obElement->GetNext())
                {
                    //$arResult[$i]['BANNER'] = $arEl;
                    $arResult[$i]['BANNER']['ID'] = $arEl['ID'];
                    $arResult[$i]['BANNER']['NAME'] = $arEl['NAME'];

                    //������ � ���������
                    if($arEl['PREVIEW_PICTURE']!='')
                    {
                        $arResult[$i]['BANNER']['BANNER_CATEGORY'] = CFile::ResizeImageGet($arEl['PREVIEW_PICTURE'], array('width'=>140, 'height'=>95), BX_RESIZE_IMAGE_PROPORTIONAL, true);
                    }
                    if($arEl['DETAIL_PICTURE']!='')
                    {
                        $arResult[$i]['BANNER']['BANNER_ELEMENT'] = CFile::ResizeImageGet($arEl['DETAIL_PICTURE'], array('width'=>82, 'height'=>140), BX_RESIZE_IMAGE_PROPORTIONAL, true);
                    }
                }
            $i++;
        }
        return $arResult;
    }

    static function setCradoBanersView($id){

        global $DB;
        //$id=10;
        $arResult = $DB->Query('SELECT * FROM b_cradobaners WHERE UF_IDBANERS = '.$id);
        while($res = $arResult->fetch())
        {
            $result = $res;
        }
        if(isset($result)) {
            $DB->Query('UPDATE b_cradobaners SET UF_COUNTVIEW=UF_COUNTVIEW+1 WHERE UF_IDBANERS = '.$id);
            //return 'UPDATE';
        }
        else{
            $return = cCradoBaners::addCradoBanners($id);
            //return $return;
        }
    }
    static function addCradoBanners($id){
        global $DB;
        $DB->Query('INSERT INTO b_cradobaners (UF_IDBANERS,UF_COUNTVIEW,UF_COUNTCLICK,UF_DATECLICK) VALUES ('.$id.',1,0,"0000-00-00 00:00:00")');
        //return 'INSERT';
    }

    static function setCradoBanersClick($id){
        global $DB;
        $date = date('Y-m-d H:i:s');
        $DB->Query('UPDATE b_cradobaners SET UF_COUNTCLICK=UF_COUNTCLICK+1, UF_DATECLICK="'.$date.'" WHERE UF_IDBANERS = '.$id);
        //return 'ClickOK';
    }
}