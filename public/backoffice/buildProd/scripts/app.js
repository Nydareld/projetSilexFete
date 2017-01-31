var app=angular.module("greenTeufBackOffice",["ngResource","ngRoute","ngAnimate","ngTouch","ui.bootstrap","bootstrap.fileField","textAngular"]);app.controller("MainController",["$scope",function(a){a.$on("PUSH_OPEN_SETTING_BUTTON",function(b){a.$broadcast("OPEN_SETTING")})}]),app.controller("Block.Footer.Controller",["$scope",function(a){$.AdminLTE.layout.fix()}]),app.controller("Block.SettingSideBar.Controller",["$scope",function(a){a.opened=!1,a.switchOpened=function(){a.opened=!a.opened},a.$on("OPEN_SETTING",function(b){a.switchOpened()})}]),app.controller("Block.SideBar.Controller",["$scope","$location",function(a,b){a.getClass=function(a){return b.path().substr(0,a.length)===a?"active":""}}]),app.controller("Block.TopBar.Controller",["$scope",function(a){var b=this;b.openSettings=function(){a.$emit("PUSH_OPEN_SETTING_BUTTON")}}]),app.config(["$locationProvider",function(a){a.hashPrefix("")}]),app.config(["$routeProvider",function(a){for(var b=[{name:"Accueil",templateUrl:"Modules/Main/Main.html",route:"home"},{name:"NotFound",templateUrl:"Modules/Main/404.html",route:"404"},{name:"ProductModule",templateUrl:"Modules/Product/ProductModule.html",route:"products",controller:"productController"},{name:"ImagesModule",templateUrl:"Modules/Images/ImagesModule.html",route:"images",controller:"imagesController"}],c=0;c<b.length;c++){var d=b[c];a.when("/"+d.route,{templateUrl:d.templateUrl,controller:d.controller,controllerAs:d.controller})}a.otherwise({redirectTo:"/404"})}]),app.factory("app.images",["$http",function(a){var b="http://fete.lc/api/images/categories",c="http://fete.lc/api/images/category",d="http://fete.lc/api/images";return this.getCategoriesList=function(){return a({method:"GET",url:b})},this.getCategory=function(b){return a({method:"GET",url:c+"/"+b})},this.save=function(b){var c=new FormData;return angular.forEach(b,function(a,b){c.append(b,a)}),a({method:"POST",url:d,transformRequest:angular.identity,headers:{"Content-Type":void 0},data:c})},this}]),app.factory("app.products",["$http",function(a){var b="http://fete.lc/api/product";return this.cget=function(){return a({method:"GET",url:b})},this.get=function(c){return a({method:"GET",url:b+"/"+c})},this.save=function(c){return a(c.id?{method:"PUT",url:b+"/"+c.id,data:c}:{method:"POST",url:b,data:c})},this}]),app.factory("app.resource",["$resource",function(a){var b=function(a,b){var c=angular.fromJson(a);return c.data},c={query:{method:"GET",isArray:!0,transformResponse:b},create:{method:"POST",transformResponse:b},update:{method:"PUT",transformResponse:b},get:{method:"GET",transformResponse:b},remove:{method:"DELETE",transformResponse:b}};return function(b,d,e){var f=angular.merge({},c,e);return a(b,d,f)}}]),app.filter("dateToISO",function(){return function(a){return a=new Date(a).toISOString()}}),app.filter("getById",function(){return function(a,b){for(var c=0,d=a.length;c<d;c++)if(+a[c].id==+b)return a[c];return null}}),app.controller("imagesController",["$scope","app.images","$filter",function(a,b,c){var d=this;return a.properties=[{name:"Nom",value:"name"},{name:"Description",value:"description"},{name:"Categorie",value:"category"},{name:"Lien",value:"path"},{name:"Créateur",value:"creator"},{name:"Date de création",value:"creationDate",render:function(a){return c("date")(c("dateToISO")(a.date),"dd/MM/yyyy HH:mm:ss",a.timezone)}}],d.refreshCategory=function(){return b.getCategoriesList().then(function(b){a.categories=b.data.data,a.setCurrentCategory(a.categories[0].name)})},d.addImage=function(b){d.refreshCategory().then(function(){a.setCurrentCategory(b.category)})},a.setNewImageCategory=function(b){a.newImage.category=b},a.clearNewImage=function(){a.imageToSet=!0,a.newImage={name:null,description:null,category:null,path:null,creator:null,image:{name:null}}},a.pathChange=function(b){""!=b||null!=b?a.imageToSet=!1:""!=a.newImage.image.name&&null!=a.newImage.image.name||(a.imageToSet=!0)},a.uploadChange=function(b){""!=b||null!=b?a.imageToSet=!1:""!=a.newImage.path&&null!=a.newImage.path||(a.imageToSet=!0)},a.setCurrentCategory=function(c){a.current=c,a.currentData||(a.currentData={}),a.currentData[c]||b.getCategory(c).then(function(b){a.currentData[c]=b.data.data}),d.verifySelected(a.currentData[c])},d.verifySelected=function(a){d.product&&a.forEach(function(a){a.selected=!1,d.product.images.forEach(function(b){a.id==b.id&&(a.selected=!0)})})},a.setCurrentProduct=function(b){a.currentImage=b},a.getClass=function(b){return a.current==b?"active":""},a.addImage=function(a){b.save(a).then(function(a){d.addImage(a.data.data),angular.element("#addImage").modal("hide")})},a.$on("selectImages",function(b,c){d.product=c,d.verifySelected(a.currentData[a.current])}),d.refreshCategory(),d}]),app.controller("productController",["$scope","app.products","$filter",function(a,b,c){var d=this;return d.reloadProducts=function(){b.cget().then(function(b){a.products=b.data.data})},d.reloadComentsCount=function(){if(a.comments=0,a.products)for(var b=0;b<a.products.length;b++)a.comments+=a.products[b].comments_count},d.addProduct=function(b){var d=c("getById")(a.products,b.id);d&&a.products.splice(a.products.indexOf(d),1),a.products.push(b)},a.resetCurrentProduct=function(){a.modalProduct={name:null,description:"",price:null}},a.setCurrentProduct=function(b){a.modalProduct=angular.copy(b)},a.saveProduct=function(a){b.save(a).then(function(a){d.addProduct(a.data.data),angular.element("#ProductModal").modal("hide")})},a.addImageToProduct=function(b){a.modalProduct&&(a.modalProduct.images||(a.modalProduct.images=[]),b.selected?(a.modalProduct.images.splice(a.modalProduct.images.indexOf(b)),b.selected=!1):(a.modalProduct.images.push(b),b.selected=!0))},a.addImages=function(b){return a.$broadcast("selectImages",b)},a.$watch("products",function(){d.reloadComentsCount()},!0),d.reloadProducts(),d}]);