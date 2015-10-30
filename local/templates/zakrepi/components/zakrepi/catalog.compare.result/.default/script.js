BX.namespace("BX.Iblock.Catalog");

BX.Iblock.Catalog.CompareClass = (function()
{
	var CompareClass = function(wrapObjId)
	{
		this.wrapObjId = wrapObjId;
	};

	CompareClass.prototype.MakeAjaxAction = function(url)
	{
		//BX.showWait(BX(this.wrapObjId));
		BX.ajax.post(
			url,
			{
				ajax_action: 'Y'
			},
			BX.proxy(function(result)
			{
				//BX.closeWait();
				BX(this.wrapObjId).innerHTML = result;
				compareSlider.Init();
			}, this)
		);
	};
	return CompareClass;
})();

var compareSlider = {
    visible: 4,
    allItemsCount: 0,
	productBox: "#compareSliderProducts",
	rightBtn: "#compareSliderBtnRight",
	leftBtn: "#compareSliderBtnLeft",
	sliderBox: ".carousel-inner",
	itemWidth: 0,
	x: 0,
	sliderWidth: 0,
    Init: function(){
		this.allItemsCount = $(this.productBox).find(".item").length;
		this.itemWidth = $(this.productBox).find(".item:first").innerWidth();
		this.sliderWidth = this.itemWidth * this.allItemsCount;
		this.x = 0;

		$(this.sliderBox).css({'left': this.x});

		if (this.allItemsCount > this.visible)
			$(this.rightBtn).show();
		else
			$(this.rightBtn).hide();
		$(this.leftBtn).hide();

		$(this.rightBtn).on('click', function(){
		  	compareSlider.slideRight();
		});

		$(this.leftBtn).on('click', function(){
		  	compareSlider.slideLeft();
		});
    },
    checkArrows: function(){
    	if (this.x < 0)
    		$(this.leftBtn).show();
    	else
    		$(this.leftBtn).hide();

    	if (Math.abs(this.x) < (this.sliderWidth - this.itemWidth * this.visible))
    		$(this.rightBtn).show();
    	else
    		$(this.rightBtn).hide();
    },
    slideRight: function(){
    	if (Math.abs(this.x - this.itemWidth) <= (this.sliderWidth - this.itemWidth * this.visible)){
    		this.x = this.x - this.itemWidth;
    		$(this.sliderBox).css({'left': this.x});
    	}
    	compareSlider.checkArrows();
    },
    slideLeft: function(){
    	if (Math.abs(this.x + this.itemWidth) >= 0){
    		this.x = this.x + this.itemWidth;
    		$(this.sliderBox).css({'left': this.x});
    	}
    	compareSlider.checkArrows();
    },
}












