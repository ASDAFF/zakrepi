//"use strict"
var zakrepi = angular.module('zakrepi',[]);

zakrepi.controller('actionsCtrl', function($scope, $http){
	/*$http.get('content/home-products.json').success(function(data){
		$scope.products = data;
		console.log($scope.products);
	});*/
	$scope.actions = [
		{
			"id": 1,
			"title": "Скидка 40%  на электроинструменты",
			"image": "images/content/actions/actions-1.jpg",
			"anons": "Спецпредложение на технику Bosch",
			"terms": "Даты проведения акции: 18 сентября - 30 октября 2015г."
		},
		{
			"id": 2,
			"title": "Cнегоуборщики по прошлогодним ценам!",
			"image": "images/content/actions/actions-2.jpg",
			"anons": "Надежный помошник по уборке снега",
			"terms": "Даты проведения акции: 18 сентября - 30 октября 2015г."
		},
		{
			"id": 3,
			"title": "Новое измерение твоей свободы",
			"image": "images/content/actions/actions-3.jpg",
			"anons": "Палатки, рюкзаки, мебель и многое другое",
			"terms": "Даты проведения акции: 18 сентября - 30 октября 2015г."
		},
		{
			"id": 4,
			"title": "Распродажа!",
			"image": "images/content/actions/actions-4.jpg",
			"anons": "Надежный помошник по уборке снега",
			"terms": "Даты проведения акции: 18 сентября - 30 октября 2015г."
		},
		{
			"id": 5,
			"title": "Пора на охоту",
			"image": "images/content/actions/actions-5.jpg",
			"anons": "Камуфляжная демисезонная  одежда",
			"terms": "Даты проведения акции: 18 сентября - 30 октября 2015г."
		},
		{
			"id": 6,
			"title": "Рыбалка",
			"image": "images/content/actions/actions-6.jpg",
			"anons": "Большой выбор лодок и мотоблоков",
			"terms": "Даты проведения акции: 18 сентября - 30 октября 2015г."
		},
	];
});
zakrepi.controller('newsCtrl', function($scope, $http){
	/*$http.get('content/home-products.json').success(function(data){
		$scope.products = data;
		console.log($scope.products);
	});*/
	$scope.news = [
		{
			"id": 1,
			"title": "Настоящий предприниматель – тот, кто умеет работать на пикирующем рынке.",
			"image": "images/content/news/news-1.jpg",
			"date": "2015-09-25"
		},
		{
			"id": 2,
			"title": "Грамотный спрос - грамотное предложение.",
			"image": "images/content/news/news-2.jpg",
			"date": "25 сентября 2015"
		},
		{
			"id": 3,
			"title": "Участвуй в бесплатном вебинаре!",
			"image": "images/content/news/news-3.jpg",
			"date": "25 сентября 2015"
		},
		{
			"id": 4,
			"title": "Мы в \"100 лучших товаров Тюменской области\"",
			"image": "images/content/news/news-4.jpg",
			"date": "25 сентября 2015"
		},
		{
			"id": 5,
			"title": "Подари себе путешествие!",
			"image": "images/content/news/news-5.jpg",
			"date": "25 сентября 2015"
		},
		{
			"id": 6,
			"title": "День Строителя!",
			"image": "images/content/news/news-6.jpg",
			"date": "25 сентября 2015"
		},{
			"id": 7,
			"title": "Лодки от 4999 р.",
			"image": "images/content/news/news-7.jpg",
			"date": "25 сентября 2015"
		},
		{
			"id": 8,
			"title": "Франчайзинг как стратегия развития моего бизнеса",
			"image": "images/content/news/news-8.jpg",
			"date": "25 сентября 2015"
		},
		{
			"id": 9,
			"title": "Подарочные сертификаты КрепыЖ!",
			"image": "images/content/news/news-9.jpg",
			"date": "25 сентября 2015"
		},
		{
			"id": 10,
			"title": "Рыбалка в Северном Вагае",
			"image": "images/content/news/news-10.jpg",
			"date": "25 сентября 2015"
		},
		{
			"id": 11,
			"title": "Выставка франчайзинг регионы",
			"image": "images/content/news/news-11.jpg",
			"date": "25 сентября 2015"
		},
		{
			"id": 12,
			"title": "Распродажа моек высокого давления!",
			"image": "images/content/news/news-12.jpg",
			"date": "25 сентября 2015"
		},
	];
});
zakrepi.controller('CatalogProductsCtrl', function($scope, $http){
	/*$http.get('content/catalog-products.json').success(function(data){
		$scope.products = data;
		//console.log($scope.products);
	});*/
	$scope.orderProp = 'id';
	$scope.products = [
		{
			"id": 1,
			"name": "Гайковерт ударный Makita 6271DWPE",
			"image": "images/content/products/cataloge-product-1.jpg",
			"rating": 2,
			"reviews": 13,
			"oldprice": "",
			"price": 7299,
			"quantity": 1,
		},
		{
			"id": 2,
			"name": "Гайковерт ударный Makita 6951",
			"image": "images/content/products/cataloge-product-2.jpg",
			"rating": 4,
			"reviews": 8,
			"oldprice": "",
			"price": 8599,
			"quantity": 2,
		},
		{
			"id": 3,
			"name": "Гайковерт ударный AEG BSS 18C 12Z-0",
			"image": "images/content/products/cataloge-product-3.jpg",
			"rating": 5,
			"reviews": 3,
			"oldprice": 6600,
			"price": 6060,
			"quantity": 3,
		},
		{
			"id": 4,
			"name": "Гайковерт угловой Makita 6766D",
			"image": "images/content/products/cataloge-product-4.jpg",
			"rating": 2,
			"reviews": 11,
			"oldprice": 13990,
			"price": 9990,
			"quantity": 10,
		},
		{
			"id": 5,
			"name": "Гайковерт угловой  Milwaukee M12 IR",
			"image": "images/content/products/cataloge-product-5.jpg",
			"rating": 4,
			"reviews": 1,
			"oldprice": "",
			"price": 12395,
			"quantity": 1,
		},
		{
			"id": 6,
			"name": "Гайковерт угловой FEIN SCW 16-6",
			"image": "images/content/products/cataloge-product-6.jpg",
			"rating": 5,
			"reviews": 3,
			"oldprice": 26060,
			"price": 19060,
			"quantity": 25,
		},
		{
			"id": 7,
			"name": "Гайковерт ударный Makita 6271DWPE",
			"image": "images/content/products/cataloge-product-1.jpg",
			"rating": 2,
			"reviews": 13,
			"oldprice": "",
			"price": 7299,
			"quantity": 1,
		},
		{
			"id": 8,
			"name": "Гайковерт ударный Makita 6951",
			"image": "images/content/products/cataloge-product-2.jpg",
			"rating": 4,
			"reviews": 8,
			"oldprice": "9600",
			"price": 8599,
			"quantity": 2,
		},
		{
			"id": 9,
			"name": "Гайковерт ударный AEG BSS 18C 12Z-0",
			"image": "images/content/products/cataloge-product-3.jpg",
			"rating": 5,
			"reviews": 3,
			"oldprice": 6600,
			"price": 6060,
			"quantity": 3,
		},
		{
			"id": 10,
			"name": "Гайковерт угловой Makita 6766D",
			"image": "images/content/products/cataloge-product-4.jpg",
			"rating": 2,
			"reviews": 11,
			"oldprice": "",
			"price": 9990,
			"quantity": 10,
		},
		{
			"id": 11,
			"name": "Гайковерт угловой  Milwaukee M12 IR",
			"image": "images/content/products/cataloge-product-5.jpg",
			"rating": 4,
			"reviews": 1,
			"oldprice": "",
			"price": 12395,
			"quantity": 1,
		},
		{
			"id": 12,
			"name": "Гайковерт угловой FEIN SCW 16-6",
			"image": "images/content/products/cataloge-product-6.jpg",
			"rating": 5,
			"reviews": 3,
			"oldprice": 26060,
			"price": 19060,
			"quantity": 25,
		},
	];
});