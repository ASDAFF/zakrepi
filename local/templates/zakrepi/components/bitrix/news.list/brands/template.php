<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);
?>
	<h1 class="page-title">Бренды</h1>
	<div class="row">
		<div class="col l9">
			<div class="alphabet-menu">
				<ul class="horizontal-menu menu">

					<?
					$znachenie = '';
					$kZ = 'N';
					foreach($arResult["ITEMS"] as $arItem):

						$rest = substr(mb_strtolower($arItem['NAME']), 0,1);
						if($znachenie != $rest)
						{
							$znachenie = $rest;
							$kiril_i_mifodii = preg_match("/[а-я]/i", $znachenie) ? "Y" : "N";
							if($kiril_i_mifodii != 'Y')
							{
								?>
								<li class="menu-item"><a class="menu-link anchor-link" href="#<?=$znachenie;?>-box"><?=$znachenie;?></a></li>
								<?
							}
						}
						if($kiril_i_mifodii == 'Y' && $kZ == 'N')
						{
							$kZ = 'Y';
							?>
							<li class="menu-item"><a class="menu-link anchor-link" href="#aya-box">а-я</a></li>
							<?
						}
					endforeach;?>
				</ul>
			</div>
			<div class="brands-list">

			<?
				$znachenie = '';
				$kiril_i_mifodii = 'N';
				$kZ = 'N';
				foreach($arResult["ITEMS"] as $a=>$arItem){
					$rest = substr(mb_strtolower($arItem['NAME']), 0,1);
					if($znachenie != $rest && $kiril_i_mifodii  == 'N')
					{
						$znachenie = $rest;
						$kiril_i_mifodii = preg_match("/[а-я]/i", $znachenie) ? "Y" : "N";
						if($kiril_i_mifodii != 'Y')
						{
							if($a != 0)
							{
								?>
										</div>
									</div>
								<?
							}
								?>
								<div class="brands-box clearfix" id="<?=$znachenie;?>-box">
									<div class="letter-marker col l1 no-padding"><?=$znachenie;?></div>	
									<div class="brands col l8 no-padding">							
								<?
						}
					}
					if($kiril_i_mifodii  == 'Y' && $kZ == 'N'){
						$kZ = 'Y';
						if($a != 0)
							{
							?>

								</div>
							</div>

							<?
							}
							?>
							<div class="brands-box clearfix" id="aya-box">
								<div class="letter-marker col l1 no-padding">а-я</div>
								<div class="brands col l8 no-padding">
						<?
					}

					if($kiril_i_mifodii != 'Y')
					{?>
										<div class="brand-item col l2">
											<a href="<?=$arItem['DETAIL_PAGE_URL'];?>"><?=$arItem['NAME'];?></a>
										</div>
					<?}else{
						?>

						<div class="brand-item col l2">
							<a href="<?=$arItem['DETAIL_PAGE_URL'];?>"><?=$arItem['NAME'];?></a>
						</div>
						<?
					}

				}?>
					</div>
				</div>
			</div>
		</div>
	</div>